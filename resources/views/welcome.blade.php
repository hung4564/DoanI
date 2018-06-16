@extends('layouts.frontend')

{{-- Page Title --}}
@section('page-title', 'Welcome')

{{-- Page Subtitle --}}
@section('page-subtitle', '')

{{-- Breadcrumbs --}}
@section('breadcrumbs')
{!! Breadcrumbs::render('home') !!}
@endsection

{{-- Header Extras to be Included --}}
@section('head-extras')

@endsection

@section('content')
<div class="row">
@foreach($records as $record)
@include('layouts.partials.frontend.item',['Course'=>$record])
@endforeach
</div>
@endsection
