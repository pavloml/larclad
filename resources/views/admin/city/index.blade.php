<x-admin.layout :title="$title">
    <main role="main" class="col-md-9 ml-sm-auto col-lg-10 pt-3 pl-2">
        <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pb-2 mb-3 border-bottom">
            <h1 class="h2">Cities</h1>
            <div class="btn-toolbar">
                <a class="btn btn-success mr-3" href="{{ @route('admin.cities.create') }}"><i class="fas fa-plus"></i> Add a city</a>
                <form>
                    <div class="input-group">
                        <input type="text" class="form-control" name="q" placeholder="Search for a city"
                               size="30"
                               value="{{ request('q') }}">
                        <span class="input-group-btn">
                <button class="btn btn-default border" type="submit"><i class="fas fa-search"></i></button>
                </span>
                    </div>
                </form>
            </div>
        </div>
        <x-session-alerts />
{{--    <section class="row">--}}
{{--        <div class="offset-1 col-3">--}}
{{--            <form>--}}
{{--                <div class="input-group">--}}
{{--                    <input type="search" class="form-control" name="q" placeholder="Search for a city" value="{{ request('q') }}">--}}
{{--                    <span class="input-group-btn">--}}
{{--                <button class="btn btn-default" type="submit"><i class="fas fa-search"></i></button>--}}
{{--                </span>--}}
{{--                </div>--}}
{{--            </form>--}}
{{--        </div>--}}
{{--        <div class="col-2 float-right">--}}
{{--            <a href="{{ url('/admin/cities/create') }}" class="btn btn-success">Add a city</a>--}}
{{--        </div>--}}
{{--    </section>--}}
    @if(!$cities->isEmpty())
            <div class="table-responsive">
                <table class="table table-striped" style="table-layout: fixed;">
                    <thead>
                    <tr>
                        <th>
                            <x-sortable-link column_id="id" column_name="ID"
                                             :active_column="$sort['column']"
                                             :active_direction="$sort['direction']"/>
                        </th>
                        <th>
                            <x-sortable-link column_id="name" column_name="Name"
                                             :active_column="$sort['column']"
                                             :active_direction="$sort['direction']"/>
                        </th>
                        <th>
                            <x-sortable-link column_id="slug" column_name="Slug"
                                             :active_column="$sort['column']"
                                             :active_direction="$sort['direction']"/>
                        </th>
                        <th>
                            <x-sortable-link column_id="created_at" column_name="Created at"
                                             :active_column="$sort['column']"
                                             :active_direction="$sort['direction']" />
                        </th>
                        <th>
                            Actions
                        </th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($cities as $city)
                        <tr>
                            <td>{{ $city->id }}</td>
                            <td>{{ $city->name }}</td>
                            <td>{{ $city->slug }}</td>
                            <td><time datetime="{{ $city->created_at->toW3cString() }}">{{ $city->created_at->diffForHumans() }}</time></td>
                            <td>
                                <a class="btn btn-info" href="{{ route('admin.cities.edit', ['id' => $city->id]) }}">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <button class="btn btn-danger" aria-label="Delete"
                                        data-toggle="modal"
                                        data-target="#deleteCityModal"
                                        data-action-link="{{ route('admin.cities.delete', ['id' => $city->id]) }}">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        <div class="row">
            <div class="col-12 text-center">
                {{ $cities->onEachSide(0)->links() }}
            </div>
        </div>
    @else
        <div class="row" style="margin-top: 10px;">
            <div class="col-12 text-center">
                <p class="h1 text-danger">No cities found</p>
                <p class="h3"><a href="{{ route('admin.cities')}}">Return to the list of all cities</a></p>
            </div>
        </div>
    @endif
    </main>
        <x-admin.modal.delete-city-modal />
        @push('scripts')
            <script>
                $('#deleteCityModal').on('show.bs.modal', function (event) {
                    let button = $(event.relatedTarget)
                    document.querySelector('#deleteCityModalForm').setAttribute('action', button.data('action-link'));
                })
            </script>
        @endpush

</x-admin.layout>
