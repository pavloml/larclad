@if(session()->has('success'))
    <x-alert type="success" message="{{session('success')}}"/>
@elseif(session()->has('error'))
    <x-alert type="danger" message="{{session('error')}}"/>
@elseif(session()->has('warning'))
    <x-alert type="warning" message="{{session('warning')}}"/>
@elseif(session()->has('email-verification-warning'))
    <x-alert type="warning"
             message="{{session('email-verification-warning')}}"
             button_text="{{ __('Resend verification link') }}"
             button_action="{{ @url('/email/verification-notification') }}" />
@endif
