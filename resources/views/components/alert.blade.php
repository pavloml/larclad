@props(['button_text' => '', 'button_action' => ''])
<div {{  $attributes->merge(['class' => 'alert alert-dismissible alert-'.$type]) }} role="alert">
    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
   {{ $message }}
    @if($button_text !== '')
        <div>
            <form method="post" action="{{ $button_action }}">
            <button type="submit" class="btn btn-link">{{ $button_text }}</button>
                @csrf
            </form>
        </div>
    @endif
</div>
