
        {!! Form::open(['route' => 'search-businesses', 'method' => 'POST', 'role' => 'form', 'class' => 'needs-validation', 'id' => 'search_businesses']) !!}
        {!! csrf_field() !!}
        <div class="input-group">
            <a href="#" class="input-group-addon btn clear-search" data-toggle="tooltip" title="{{ trans('businesses.tooltips.clear-search') }}" style="display:none;">
                <i class="fa fa-fw fa-times" aria-hidden="true"></i>
                <span class="sr-only">
                    {!! trans('businesses.tooltips.clear-search') !!}
                </span>
            </a>
            <a href="#" class="input-group-addon btn" id="search_trigger" data-toggle="tooltip" data-placement="bottom" title="{{ trans('businesses.tooltips.submit-search') }}" >
                <i class="fa fa-search fa-fw" aria-hidden="true"></i>
                <span class="sr-only">
                    {!!  trans('businesses.tooltips.submit-search') !!}
                </span>
            </a>
            {!! Form::text('business_search_box', NULL, ['id' => 'business_search_box', 'class' => 'form-control', 'placeholder' => trans('businesses.search.search-businesses-ph'), 'aria-label' => trans('businesses.search.search-businesses-ph'), 'required' => false]) !!}
        </div>
    {!! Form::close() !!}
