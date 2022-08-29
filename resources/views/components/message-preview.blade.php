@props(['dir', 'message'])
<li class="{{ ($dir === 'from' && !$message->is_read) ? 'unread' : '' }}">
    <a href="{{ route('profile.messages.thread', ['post_id' => $message->post_id, 'participant' => ($dir === 'from') ? $message->user_id : $message->recipient_id]) }}">
        <div class="message-header d-flex justify-content-between">
            <span>{{ $dir === 'from' ? 'From: ' . $message->user->name : 'To: ' . $message->recipient->name }}</span>
            <span><x-time :time="$message->created_at" /></span>
        </div>
        <div class="message-preview">
            <div class="message-preview-title">{{ $message->post->title }}</div>
            <div class="message-preview-text">{{ $message->message }}</div>
        </div>
    </a>
</li>
