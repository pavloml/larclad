@props(['diff_for_humans' => false, 'time'])
@if($diff_for_humans)
    <time datetime="{{ $time->toW3cString() }}">{{ $time->diffForHumans() }}</time>
@else
    <time datetime="{{ $time->toW3cString() }}">{{ $time->format("m/d/Y h:i A") }}</time>
@endif
