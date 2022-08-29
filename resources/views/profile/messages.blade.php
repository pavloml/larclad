<x-layout :title="$title">
    <x-profile-header />
    <div class="row mb-1">
        <div class="col-12">
            @if($unreadMessagesCount > 0)
                <div class="text-center h5">You have {{ $unreadMessagesCount }}
                    unread messages
                </div>
            @else
                <div class="text-center h5">You don't have any unread messages</div>
            @endif
        </div>
    </div>
    @if(!$threads->isEmpty())
        <div class="row">
            <div class="col-12">
                <ul class="messages">
                    @foreach($threads as $thread)
                        <x-thread-preview :thread="$thread"
                                          unreadMessages="{{ $thread->messages->filter(fn ($item) => !$item->is_read)->filter(fn ($item) => $item->recipient_id === Auth::id())->count() }}"/>
                    @endforeach
                </ul>
            </div>
        </div>
        <div class="row">
            <div class="col-12 text-center">
                {{ $threads->onEachSide(0)->links() }}
            </div>
        </div>
    @else
        <div class="row mt-1">
            <div class="col-12 text-center">
                <p class="h4">No messages</p>
            </div>
        </div>
    @endif
</x-layout>
