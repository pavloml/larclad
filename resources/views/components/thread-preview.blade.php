@props(['thread', 'unreadMessages'])
<li class="{{ $unreadMessages > 0 ? 'unread' : '' }}">
    <a href="{{ route('profile.messages.thread', ['thread_id' => $thread->id]) }}">
        @if($unreadMessages > 0)
            <span class="badge badge-primary">{{ $unreadMessages }}</span>
        @endif
        <div class="message-header d-flex justify-content-between">
            <div class="message-preview-title">{{ $thread->post->title }}</div>
            <span><x-time :time="$thread->messages->last()->created_at" /></span>
        </div>
        <div class="message-preview">
            <span>{{ $thread->messages->last()->user->name === Auth::user()->name ? 'You' : $thread->messages->last()->user->name }}</span>
            <div class="message-preview-text">{{ $thread->messages->last()->message }}</div>
        </div>
    </a>
</li>
