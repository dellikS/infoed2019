<div class="modal fade" id="changeLng" role="dialog" aria-labelledby="changeLngLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">
                        {{ trans('Change your language') }}
                </h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body">
                <form action="{{ route('language') }}" method="post" >
                <ul class="list-unstyled">
                @foreach ($translation_array as $translation)
                    <li>
                        <button value="{{$translation->code}}" type="submit" name="locale" class="btn" {{ App::getLocale() == $translation->code ? ' disabled="disabled"' : '' }}><img width="16px" src="{{asset('assets/svg/flags/'.$translation->code.'.svg')}}"/> {{ $translation->name }}</button>
                    </li>
                @endforeach
                </ul>
                @csrf
                </form>
            </div>
        </div>
    </div>
</div>
