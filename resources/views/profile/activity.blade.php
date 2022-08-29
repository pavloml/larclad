<x-layout :title="$title">
    <x-profile-header/>
    <div class="row">
        <div class="col-12 col-md-3">
            <x-profile-settings-menu />
        </div>
        <div class="col-12 col-md-9 mt-3 mt-md-0">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title mb-0">Session log</h3>
                </div>
                <div class="card-body">
                    <table class="table table-hover table-sm">
                        <thead>
                        <tr>
                            <th scope="col">Time</th>
                            <th scope="col">Type</th>
                            <th scope="col">IP</th>
                            <th scope="col">Device</th>
                        </tr>
                        </thead>
                        <tbody>
                        @forelse($sessionsActivities as $sessionsActivity)
                            <tr class="{{ Str::contains(Str::lower($sessionsActivity->description), 'failed') ? 'text-danger' : 'text-success' }}">
                                <td>
                                    <span class="time-tooltip"
                                         data-toggle="tooltip"
                                         data-placement="top"
                                         title="{{$sessionsActivity->created_at->format('D, M j, g:i A Y T')}}"
                                         onclick="helpers.replaceText(this,'{{$sessionsActivity->created_at->format('D, M j, g:i A Y T')}}')">
                                        <x-time :time="$sessionsActivity->created_at" :diff_for_humans="true"/>
                                    </span>
                                </td>
                                <td>{{ $sessionsActivity->description }}</td>
                                <td>{{ json_decode($sessionsActivity->properties)->IP }}</td>
                                <td class="text-break">{{ json_decode($sessionsActivity->properties)->UserAgent  }}</td>
                            </tr>
                        @empty
                            <tr>
                                <th colspan="4" class="text-center">No records</th>
                            </tr>
                        @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-12 offset-md-3 col-md-9 mt-3">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title mb-0">Account updates log</h3>
                </div>
                <div class="card-body">
                    <table class="table table-hover table-sm">
                        <thead>
                        <tr>
                            <th scope="col">Time</th>
                            <th scope="col">Type</th>
                            <th scope="col">IP</th>
                            <th scope="col">Device</th>
                        </tr>
                        </thead>
                        <tbody>
                        @forelse($userUpdateActivities as $updateActivity)
                        <tr>
                            <td>
                                <span class="time-tooltip"
                                     data-toggle="tooltip"
                                     data-placement="top"
                                     title="{{$updateActivity->created_at->format('D, M j, g:i A Y T')}}"
                                     onclick="helpers.replaceText(this,'{{$updateActivity->created_at->format('D, M j, g:i A Y T')}}')">
                                    <x-time :time="$updateActivity->created_at" :diff_for_humans="true"/>
                                </span>
                            </td>
                            <td>{{ $updateActivity->description }}</td>
                            <td>{{ json_decode($updateActivity->properties)->IP }}</td>
                            <td class="text-break">{{ json_decode($updateActivity->properties)->UserAgent  }}</td>
                        </tr>
                        @empty
                        <tr>
                            <th colspan="4" style="text-align: center;">No records</th>
                        </tr>
                        @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-layout>

