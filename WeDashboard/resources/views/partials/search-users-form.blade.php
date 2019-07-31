
        {!! Form::open(['route' => 'search-users', 'method' => 'POST', 'role' => 'form', 'class' => 'needs-validation', 'id' => 'search_users']) !!}
            {!! csrf_field() !!}
            <div class="input-group">
                <a href="#" class="input-group-addon btn clear-search" data-toggle="tooltip" title="{{ trans('usersmanagement.tooltips.clear-search') }}" style="display:none;">
                    <i class="fa fa-fw fa-times" aria-hidden="true"></i>
                    <span class="sr-only">
                        {!! trans('usersmanagement.tooltips.clear-search') !!}
                    </span>
                </a>
                <a href="#" class="input-group-addon btn" id="search_trigger" data-toggle="tooltip" data-placement="bottom" title="{{ trans('usersmanagement.tooltips.submit-search') }}" >
                    <i class="fa fa-search fa-fw" aria-hidden="true"></i>
                    <span class="sr-only">
                        {!!  trans('usersmanagement.tooltips.submit-search') !!}
                    </span>
                </a>
                {!! Form::text('user_search_box', NULL, ['id' => 'user_search_box', 'class' => 'form-control', 'placeholder' => trans('usersmanagement.search.search-users-ph'), 'aria-label' => trans('usersmanagement.search.search-users-ph'), 'required' => false]) !!}
            </div>
        {!! Form::close() !!}
