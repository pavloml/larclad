@props(['column_name', 'column_id', 'active_column', 'active_direction'])
<a href="{{
    request()
    ->fullUrlWithQuery(['sortBy' => $column_id,
    'sortDir' => ($column_id === $active_column && $active_direction !== 'DESC') ? 'desc' : 'asc'])
    }}">
    @if($column_id === $active_column)
    <i class="fas {{ $active_direction === 'DESC' ? 'fa-chevron-down' : 'fa-chevron-up' }}" aria-hidden="true"></i>
    @endif
    {{ $column_name }}
</a>
