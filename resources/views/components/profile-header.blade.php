<x-session-alerts />
<div class="row mb-2">
    <div class="col-12">
        <ul class="nav nav-tabs nav-justified">
            <li class="nav-item">
                <a class="nav-link {{ request()->route()->getPrefix() === 'profile/posts' ? 'active' : '' }}" href="{{ route('profile.posts.active') }}">Your ads</a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ request()->route()->getPrefix() === 'profile/messages' ? 'active' : '' }}" href="{{ route('profile.messages.threads') }}">Messages <span class="badge text-white bg-primary unread-messages-badge"></span></a></li>
            <li class="nav-item">
                <a class="nav-link {{ request()->route()->getPrefix() === 'profile/settings' ? 'active' : '' }}" href="{{ route('profile.settings') }}">Settings</a>
            </li>
        </ul>
    </div>
</div>
