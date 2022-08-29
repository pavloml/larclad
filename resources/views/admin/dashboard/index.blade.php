<x-admin.layout :title="$title">
    <main role="main" class="col-md-9 ml-sm-auto col-lg-10 pt-3 pl-2">
        <div class="d-flex justify-content-center flex-wrap flex-md-nowrap align-items-center pb-2 mb-3 border-bottom">
            <h1 class="h2">Dashboard</h1>
{{--            <div class="btn-toolbar mb-2 mb-md-0">--}}
{{--                <div class="btn-group mr-2">--}}
{{--                    <button class="btn btn btn-outline-info">Export</button>--}}
{{--                </div>--}}
{{--                <button class="btn btn-sm btn-outline-secondary dropdown-toggle">--}}
{{--                    <span data-feather="calendar"></span>--}}
{{--                    This week--}}
{{--                </button>--}}
{{--            </div>--}}
        </div>
        <div class="row row-cols-1 row-cols-md-3 text-center">
            <div class="col">
                <div class="card">
                    <div class="card-header">
                        New posts today
                    </div>
                    <div class="card-body card-body font-weight-bolder">
                        {{ $newPostsToday }}
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="card">
                    <div class="card-header">
                        Updated posts today
                    </div>
                    <div class="card-body font-weight-bolder">
                        {{ $updatedPostsToday }}
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="card">
                    <div class="card-header">
                        New users today
                    </div>
                    <div class="card-body font-weight-bolder">
                        {{ $newUsersToday }}
                    </div>
                </div>
            </div>
        </div>
        <div class="my-4">
            <canvas id="weekNewPosts" width="400" height="100" aria-label="New posts weekly statistics chart" role="img"></canvas>
        </div>
{{--        <div class="my-4">--}}
{{--            <canvas id="weekNewUsers" width="400" height="100" aria-label="New users weekly statistics chart" role="img"></canvas>--}}
{{--        </div>--}}

    </main>
    @push('scripts')
        <script src="{{ mix('/js/charts.js') }}"></script>
        <script>
            const weekNewPostsStats = {!! $weekNewPostsStats !!};
            const weekNewUsersStats = {!! $weekNewUsersStats !!};

            let days = [];
            weekNewPostsStats.forEach(day => days.push(day.day));

            let postsCount = [];
            weekNewPostsStats.forEach(day => postsCount.push(day.count))

            let usersCount = [];
            weekNewUsersStats.forEach(day => usersCount.push(day.count));

            const weekNewPostsChart = document.querySelector('#weekNewPosts');
            // const weekNewUsersChart = document.querySelector('#weekNewUsers');

            const postsChart = new Chart(weekNewPostsChart, {
                type: 'line',
                data: {
                    labels: days,
                    datasets: [{
                        data: postsCount,
                        label: 'New posts',
                        lineTension: 0,
                        backgroundColor: 'rgba(54, 162, 235, 0.5)',
                        borderColor: 'rgb(54, 162, 235)',
                        borderWidth: 4,
                        pointBackgroundColor: 'rgb(54, 162, 235)'
                    },{
                        data: usersCount,
                        label: 'New users',
                        lineTension: 0,
                        backgroundColor: 'rgba(255, 99, 132, 0.5)',
                        borderColor: 'rgb(255, 99, 132)',
                        borderWidth: 4,
                        pointBackgroundColor: 'rgb(255, 99, 132)'
                    }]
                },
                options: {
                    plugins: {
                        title: {
                            display: true,
                            text: 'Weekly statistics'
                        }
                    },
                    scales: {
                        y: {
                            beginAtZero: true
                        }
                    }
                }
            });

        </script>
    @endpush
</x-admin.layout>
