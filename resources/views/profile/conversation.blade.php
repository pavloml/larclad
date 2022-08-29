<x-layout :title="$title">
<x-profile-header />
    <section class="row justify-content-center">
    <ul class="list-unstyled col-12 pm-container mx-1">
    @forelse($messages as $message)
        @if($message->recipient_id === Auth::id())
            <x-private-message :is_yours="false" :message="$message" />
        @else
            <x-private-message :is_yours="true" :message="$message" />
        @endif
    @empty
        <li>
                <p class="font-weight-bold text-center">No messages</p>
        </li>
    @endforelse
    </ul>
    </section>
<div class="row justify-content-center">
    <div class="col-12 col-md-9">
    <form method="post" action="{{ @route('profile.message.store', ['post_id' => $thread->post_id, 'thread_id' => $thread->id]) }}"
            id="replyForm">
        @csrf
        <div class="form-group">
            <label for="message">Reply: </label>
            <textarea class="form-control" name="message" id="message" placeholder="Write your reply" rows="3" required></textarea>
            @error('message')
            <x-form-error-message :message="$message"/>
            @enderror
        </div>
        @if(config('app.features.message_attachments'))
            <div class="form-group ad-file-upload">
                <label for="messageAttachment" class="d-block">Attach a file (optional):</label>
                <input type="file" title="Add attachment" id="messageAttachment" name="attachment">
                <p><small class="text-muted">2 MB Maximum. Only jpg and png files are allowed.</small></p>
            </div>
        @endif
        <div class="form-group">
            <button type="submit" class="btn btn-success col-12 col-md-3"><i class="fa fa-paper-plane"></i> Send</button>
        </div>
    </form>
    </div>
</div>
    @push('scripts')
        <script>
            const container = document.querySelector('.pm-container');
            window.addEventListener('load', function () { container.lastElementChild.scrollIntoView()});
        </script>
    @endpush
</x-layout>
