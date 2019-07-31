@extends('layouts.app')
@section('template_title')
    {{ $business->name }}'s Logs
@endsection
@section('content')
    @include('businesses.partials.table-logs')
@endsection

@section('footer_scripts')
	@include('scripts.tooltips')
@endsection
