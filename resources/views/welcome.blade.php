@extends('layouts.frontend')

{{-- Page Title --}}
@section('page-title', 'Welcome')

{{-- Page Subtitle --}}
@section('page-subtitle', '')

{{-- Breadcrumbs --}}
@section('breadcrumbs')
{!! Breadcrumbs::render('home') !!}
@endsection

@section('content')
@foreach(\App\Visual::all() as $visual)
@include('layouts.partials.frontend.item',['visual'=>$visual])    
@endforeach
@endsection
