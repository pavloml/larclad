<div class="list-group">
    <a href="{{ @route('profile.settings') }}"
       class="list-group-item list-group-item-action {{ request()->is('profile/settings') ? 'active' : '' }}">Edit profile</a>
    <a href="{{ @route('profile.password.edit') }}"
       class="list-group-item list-group-item-action {{ request()->is('profile/settings/change_password') ? 'active' : '' }}">Change password</a>
    <a href="{{ @route('profile.email.edit') }}"
       class="list-group-item list-group-item-action {{ request()->is('profile/settings/change_email') ? 'active' : '' }}">Change email</a>
    <a href="{{ @route('profile.activity.show') }}"
       class="list-group-item list-group-item-action {{ request()->is('profile/settings/activity_log') ? 'active' : '' }}">Security logs</a>
</div>
