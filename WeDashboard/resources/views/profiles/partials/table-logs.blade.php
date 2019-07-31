<section class="profile-zone banner pb-4">
    <div class="container">
        <div class="row content">
            <div class="col">
                <div class="profile-info float-left">
                    <h4>
                        @if (Auth::user()->id != $user->id)
                        {{ $user->name }}'s Logs
                        @else 
                        Your profile logs
                        @endif
                    </h4>
                </div>
            </div>
        </div>
    </div>
</section>
<section class="mt-n4">
    <div class="container">
        <div class="row">
            <div class="col">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title m-0">Logs</h4>
                    </div>
                    <div class="table-responsive ">
                    <table class="table table-striped  table-condensed m-0">
                        <thead>
                            <tr>
                            <th>User</th>
                            <th>Attribute</th>
                            <th>Old Value</th>
                            <th>New Value</th>
                            <th>Date</th>
                            <th>IP</th>
                            </tr>
                        </thead>
                        <tbody>
                        @foreach ($audits as $audit)
                        
                            @foreach ($audit->getModified() as $attribute => $modified)         
                            <tr> 
                                <td><a href="{{ url('/profile/'.$audit->user->name) }}">{{ $audit->user->name }}</a></td> 
                                <td>@lang('article.'.$audit->event.'.modified.'.$attribute, $modified)</td>
                                <td>@lang('article.'.$audit->event.'.modified.old', $modified)</td>
                                <td>@lang('article.'.$audit->event.'.modified.new', $modified)</td>
                                <td>{{ \Carbon\Carbon::parse($audit->updated_at)->format('d/m/Y H:i:s') }}</td>
                                @if (Auth::user()->id == $audit->user_id)    
                                    <td>{{ $audit->ip_address }}</td> 
                                @else
                                    <td>Secret</td>
                                @endif
                            </tr>       
                            @endforeach
                        @endforeach
                        </tbody>
                    </table>
                </div>
                    <div class="text-center mt-4">
                        @if(config('usersmanagement.enablePagination'))
                            {{ $audits->links() }}
                            <p>{{ 'Showing '.$audits->firstitem().' - '.$audits->lastitem().' of '.$audits->total().' results ('.$audits->perPage().' per page)'}}</p>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>