@props(['is_yours', 'message'])
<li class="col-12 col-md-9 pm-message {{ $is_yours ? 'text-white bg-primary offset-md-3' : 'bg-light'}}">
    <div class="font-weight-bold border-bottom">
        <span class="author">{{ $is_yours ? 'You' : $message->user->name }}</span>
        <span class="date float-right"><x-time :time="$message->created_at"/></span>
    </div>
    <div class="message">{{ $message->message }}</div>
</li>
