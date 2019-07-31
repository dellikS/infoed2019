@if (session('message'))
  <div class="alert alert-{{ Session::get('status') }} status-box alert-dismissable fade show flash" role="alert">
    {{ session('message') }}
    <button type="button" class="close ml-2" data-dismiss="alert" aria-label="Close">
      <span aria-hidder="true">&times;</span>
    </button>
  </div>
@endif

@if (session('success'))
  <div class="alert alert-success alert-dismissable fade show flash" role="alert">
    <strong><i class="icon fa fa-check fa-fw" aria-hidden="true"></i> Success</strong>
    {{ session('success') }}
    <button type="button" class="close ml-2" data-dismiss="alert" aria-label="Close">
      <span aria-hidder="true">&times;</span>
    </button>
  </div>
@endif

@if(session()->has('status'))
    @if(session()->get('status') == 'wrong')
        <div class="alert alert-danger status-box alert-dismissable fade show flash" role="alert">
            {{ session('message') }}
            <button type="button" class="close ml-2" data-dismiss="alert" aria-label="Close">
              <span aria-hidder="true">&times;</span>
            </button>
        </div>
    @endif
@endif

@if (session('error'))
  <div class="alert alert-danger alert-dismissable fade show flash" role="alert">
    <strong>
      <i class="icon fa fa-warning fa-fw" aria-hidden="true"></i>
      Error
    </strong>
    {{ session('error') }}
    <button type="button" class="close ml-2" data-dismiss="alert" aria-label="Close">
      <span aria-hidder="true">&times;</span>
    </button>
  </div>
@endif

@if (session('errors') && count($errors) > 0)
<div class="alert alert-danger alert-dismissible fade show flash" role="alert">
    <strong><i class="icon fa fa-warning fa-fw" aria-hidden="true"></i> {{ __('auth.whoops') }}</strong>{{ __('auth.someProblems') }}
    <ul class="list-unstyled">
      @foreach ($errors->all() as $error)
        <li class="list-item">{{ $error }}</li>
      @endforeach
    </ul>
    <button type="button" class="close ml-2" data-dismiss="alert" aria-label="Close">
        <span aria-hidder="true">&times;</span>
    </button>
  </div>
@endif
