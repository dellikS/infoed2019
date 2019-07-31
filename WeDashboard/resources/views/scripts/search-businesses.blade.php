<script>
        $(function() {
            var cardTitle = $('#card_title');
            var businessesTable = $('#businesses_panel');
            var resultsContainer = $('#search_results');
            var businessesCount = $('#business_count');
            var clearSearchTrigger = $('.clear-search');
            var searchform = $('#search_businesses');
            var searchformInput = $('#business_search_box');
            var businessPagination = $('#business_pagination');
            var searchSubmit = $('#search_trigger');
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            searchform.submit(function(e) {
                e.preventDefault();
                resultsContainer.html('');
                businessesTable.hide();
                clearSearchTrigger.show();
                let noResulsHtml = '<div class="card">' +
                                    '<div class="card-body"' +
                                    '<span>{!! trans("businesses.search.no-results") !!}</span>' +
                                     '</div>' + 
                                    '</div>';
    
                $.ajax({
                    type:'POST',
                    url: "{{ route('search-businesses') }}",
                    data: searchform.serialize(),
                    success: function (result) {
                        let jsonData = JSON.parse(result);
                        if (jsonData.length != 0) {
                            $.each(jsonData, function(index, val) {
                                let applyCellHtml = '';
                                let hiringStatus = '';
                                
                                if(val.hiring == false) {
                                    hiringStatus = '<span class="text-danger"><i class="fa fa-lock"></i> No</span>';
                                    applyCellHtml = 'Closed'
                                } else {
                                    hiringStatus = '<span class="text-success"><i class="fa fa-unlock"></i> Yes</span>'
                                    applyCellHtml = '<a title="Make an application" class="btn btn-sm btn-info btn-block" href="businesses/' + val.id + '/apply" data-toggle="tooltip" title="Make an application">{!! trans("businesses.buttons.apply") !!}</a>';
                                }
                    /*<div class="card mt-3">
                        <div class="card-body">
                            <div class="row">
                                <div class="col">
                                    <h5><a href="{{ url('businesses/' . $business->id) }}"  class="text-uppercase font-weight-bold {{ ($business->isOwnerHere()) ? "text-info" : "third" }} {{ $employee ? $employee->isEmployeeHere($business->id) ? "text-success" : "" : "third" }}" data-toggle="tooltip" title="Details">{{$business->name}}</a></h5>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col">
                                    <span class="font-weight-bold text-secondary">{{$business->type}}</span>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col">
                                    <star-rating :inline="true" :show-rating="false" :rating="{{ $business->getStarRating() }}" :star-size="18" :read-only="true" :increment="0.1"></star-rating>
                                    <span class="hidden-xs hidden-sm">({{ $business->rating->count() }} {{ $business->rating->count() == 1 ? " review" : " reviews" }})</span>
                                </div>
                            </div>
                            <div class="row mt-2 mb-2">
                                <div class="col">
                                    <p class="text-secondary">{{ $business->description }}</p>
                                </div>
                            </div>
                            <hr>
                            <div class="row mt-2 mb-2">
                                <div class="col">
                                    <div class="float-left">
                                        <span class="text-secondary">{!! trans('businesses.table.owner') !!}: </span><a class="second" href="{{ url('profile/' . $business->user->name) }}" data-toggle="tooltip" title="View profile">{{$business->user->name}}</a>
                                    </div>
                                    <div class="clear-fix"></div>
                                    <div class="float-right">
                                    @if ($business->hiring == true && !Auth::user()->employee && $business->survey)  
                                        <a class="btn btn-sm btn-light btn-block" href="{{ url('businesses/'.$business->id.'/apply') }}" data-toggle="tooltip" title="Make an application">
                                            {!! trans('businesses.buttons.apply') !!}
                                        </a>
                                    @else
                                        <button class="btn btn-sm btn-light" disabled="disabled" data-toggle="tooltip" title="{{ ($business->survey==null) ? "This business has no application model set!" : "" }} {{ ($business->hiring == false) ? "Application Closed!\n" : ((Auth::user()->employee) ? "You are already employed!" : "")}}">
                                            You cannot apply here!
                                        </button>
                                    @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>*/
                                resultsContainer.append(
                                '<div class="card mt-3">' +
                                    '<div class="card-body">' +
                                        '<div class="row">' + 
                                            '<div class="col">' +
                                                '<h5><a class="text-uppercase font-weight-bold third" href="businesses/'+ val.id + '" title="Details">'+ val.name +'</a></td></h5>' +
                                            '</div>' +
                                        '</div>' +
                                        '<div class="row">' +
                                            '<div class="col">' +
                                                '<span class="font-weight-bold text-secondary">' + val.type + '</span>' +
                                            '</div>' +
                                        '</div>' +
                                        '<div class="row">' +
                                            '<div class="col">' +
                                                '<span class="text-secondary">' + val.email + '</span>' +
                                            '</div>' +
                                        '</div>' +
                                        '<div class="row mt-2 mb-2">' +
                                            '<div class="col">' +
                                                '<p class="text-secondary">' + val.description + '</p>' +
                                            '</div>' +
                                        '</div>' +
                                        '<hr>' +
                                        '<div class="row mt-2 mb-2">' +
                                            '<div class="col">' +
                                                '<div class="float-left">' +
                                                    '<span class="text-secondary"> Hiring: ' + hiringStatus + '</span>' +
                                                '</div>' +
                                            '</div>' +
                                        '</div>' +
                                    '</div>' +            
                                '</div>');
                            });
                        } else {
                            resultsContainer.append(noResulsHtml);
                        };
                        businessesCount.html(jsonData.length + " {!! trans('businesses.search.found-footer') !!}");
                        businessPagination.hide();
                        cardTitle.html("{!! trans('businesses.search.title') !!}");
                    },
                    error: function (response, status, error) {
                        if (response.status === 422) {
                            resultsContainer.append(noResulsHtml);
                            businessesCount.html(0 + " {!! trans('businesses.search.found-footer') !!}");
                            businessPagination.hide();
                            cardTitle.html("{!! trans('businesses.search.title') !!}");
                        };
                    },
                });
            });
            searchSubmit.click(function(event) {
                event.preventDefault();
                if ($('#business_search_box').val() == 'upside down') {
                    $('body').toggleClass('flip');
                }
                searchform.submit();
            });
            searchformInput.keyup(function(event) {
                if ($('#business_search_box').val() != '') {
                    clearSearchTrigger.show();
                } else {
                    clearSearchTrigger.hide();
                    resultsContainer.html('');
                    businessesTable.show();
                    cardTitle.html("{!! trans('businesses.showing-all-businesses') !!}");
                    businessPagination.show();
                    businessesCount.html(" ");
                };
            });
            clearSearchTrigger.click(function(e) {
                e.preventDefault();
                if ($('body').hasClass('flip')) {
                    $('body').removeClass('flip');
                }
                clearSearchTrigger.hide();
                businessesTable.show();
                resultsContainer.html('');
                searchformInput.val('');
                cardTitle.html("{!! trans('businesses.showing-all-businesses') !!}");
                businessPagination.show();
                businessesCount.html(" ");
            });
        });
    </script>
    