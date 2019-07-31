@extends('layouts.app')
@section('template_title')
    @if ($user->profile)
        @if (Auth::user()->id != $user->id)
        {{ $user->name }}'s Logs
        @else 
        My Logs
        @endif
    @endif
@endsection
@section('content')

@if ($user->profile)
    @include('profiles.partials.table-logs')
@endif

@endsection

@section('footer_scripts')
	@include('scripts.tooltips')
@endsection
