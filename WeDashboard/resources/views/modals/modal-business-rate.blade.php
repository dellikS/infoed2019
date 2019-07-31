<div class="modal fade modal-warning" id="rate" role="dialog" aria-labelledby="rateLabel" aria-hidden="true" tabindex="-1">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">
                    {!! trans('modals.rate_business') !!}
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    <span class="sr-only">close</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="container">
                    <div class="row">
                        <div class="col">
                            <rating-form :business="{{$business}}" :rating="{{ $business->getStarRating() }}" url="{{ url('businesses/'.$business->id.'/rate')}}"></rating-form>
                        </div>
                    </div>
                
                </div>
            </div>
        </div>
    </div>
</div>
