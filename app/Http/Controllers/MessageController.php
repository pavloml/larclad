<?php

namespace App\Http\Controllers;

use App\Events\NewMessage;
use App\Models\Message;
use App\Models\Post;
use App\Models\Thread;
use App\Models\User;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class MessageController extends Controller
{
    public function store(Request $request, $post_id, $thread_id = '')
    {
        $post = Post::find($post_id);
        $sender = $request->user();

        if (empty($post)) {
            return back()->withErrors(['message' => __('Post not found')]);
        }

        if ($thread_id === '') {
            $thread = Thread::where('post_id', $post->id)->where('initiator_id', $sender->id)->first();
            if (empty($thread)) {
                if ($sender->id === $post->user->id) {
                    return back()->withErrors(['message' => __('Post author cannot start a new thread')]);
                } elseif (
                    config('app.features.enforce_threads_limits') &&
                    Thread::where('initiator_id', $sender->id)->lastHour()->count() >= config('app.features.user_threads_hourly_limit')
                ) {
                    return back()->withErrors(['message' => __('You have created too many threads, try again later')]);
                }
                $thread = new Thread;
                $thread->post_id = $post->id;
                $thread->initiator_id = $sender->id;
                $thread->post_author_id = $post->user->id;
                $thread->save();
            }
        } else {
            $thread = Thread::find($thread_id);
            if (empty($thread)) {
                return back()->withErrors(['message' => __('Thread not found')]);
            }
        }


        if (!in_array($sender->id, [$thread->initiator_id, $thread->post_author_id])) {
            return response('Forbidden', 403);
        }

        $recipient = User::find($thread->initiator_id === $sender->id ? $thread->post_author_id : $thread->initiator_id);

        if (config('app.features.message_attachments') && !config('app.debug')) {
            if ($request->has('attachment')) {
                return back()->withErrors(['message' => __('Message attachments are not available yet')]);
            }
        }

        $validated = $request->validate(['message' => 'required|min:1|max:1000']);

        $message = new Message;
        $message->post_id = $post->id;
        $message->thread_id = $thread->id;
        $message->user_id = $sender->id;
        $message->recipient_id = $recipient->id;
        $message->message = $validated['message'];
        $message->save();
        $thread->update(['last_message_id' => $message->id]);

        event(new NewMessage($recipient, $sender, $post, $thread));

        return back();
    }

    public function showThreads(Request $request)
    {
        $threads = Thread::with('messages.user', 'post')
            ->participant($request->user()->id)
            ->orderBy('last_message_id', 'DESC')
            ->paginate(20)
            ->withQueryString();

        return view('profile.messages', ['user' => $request->user(),
            'unreadMessagesCount' => Message::allUnreadForUser($request->user()->id)->count(),
            'threads' => $threads,
            'title' => __('Messages')]);
    }

    /**
     * @param string $thread_id id of the thread
     * @param Request $request
     * @return View|Response
     */
    public function showThread(string $thread_id, Request $request)
    {
        $thread = Thread::findOrFail($thread_id);


        if (!in_array($request->user()->id, [$thread->initiator_id, $thread->post_author_id])) {
            return response('Forbidden', 403);
        }

        $messages = Message::with(['user'])
            ->thread($thread->id)
            ->orderBy('created_at')
            ->get();

        Message::where('thread_id', $thread->id)
            ->recipient($request->user()->id)
            ->unread()
            ->update(['is_read' => true]);


        if (empty($messages)) {
            return response('Not Found', 404);
        }

        return view('profile.conversation', ['user' => $request->user(),
            'thread' => $thread,
            'messages' => $messages,
            'title' => __('Thread: ') . $thread->post->title]);
    }
}
