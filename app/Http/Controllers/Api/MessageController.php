<?php

namespace App\Http\Controllers\Api;

use App\Events\NewMessage;
use App\Http\Controllers\Controller;
use App\Models\Message;
use App\Models\Post;
use App\Models\Thread;
use App\Models\User;
use Illuminate\Http\Request;

class MessageController extends Controller
{
    public function store(Request $request, $post_id, $thread_id = '')
    {
        $post = Post::find($post_id);
        $sender = $request->user();

        if (empty($post)) {
            return response(['message' => 'Not Found'], 404);
        }

        if ($thread_id === '') {
            $thread = Thread::where('post_id', $post->id)->where('initiator_id', $sender->id)->first();
            if (empty($thread)) {
                if ($sender->id === $post->user->id) {
                    return response(['message' => __('Post author cannot start a new thread')], 400);
                } elseif (
                    config('app.features.enforce_threads_limits') &&
                    Thread::where('initiator_id', $sender->id)->lastHour()->count() >= config('app.features.user_threads_hourly_limit')
                ) {
                    return response(['message' => __('You have created too many threads, try again later')], 400);
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
                return response(['message' => __('Thread not found')], 404);
            }
        }


        if (!in_array($sender->id, [$thread->initiator_id, $thread->post_author_id()])) {
            return response('Forbidden', 403);
        }

        $recipient = User::find($thread->initiator_id === $sender->id ? $thread->post_author_id : $thread->initiator_id);

        if (config('app.features.message_attachments') && !config('app.debug')) {
            if ($request->has('attachment')) {
                return response(['message' => 'Message attachments are not available yet'], 501);
            }
        }

        $validated = $request->validateWithBag('messageErrors', ['message' => 'required|min:1|max:1000']);

        $message = new Message;
        $message->post_id = $post->id;
        $message->thread_id = $thread->id;
        $message->user_id = $sender->id;
        $message->recipient_id = $recipient->id;
        $message->message = $validated['message'];

        $message->save();
        $thread->update(['last_message_id' => $message->id]);

        event(new NewMessage($recipient, $sender, $post, $thread));

        return response(['message' => __('Message has been sent')], 200);
    }

    public function countUnreadMessage(Request $request)
    {
        return response(['count' => Message::allUnreadForUser($request->user()->id)->count()]);
    }
}
