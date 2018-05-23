@extends('layouts.frontend')

{{-- Page Title --}}
@section('page-title', 'Tranning')

{{-- Page Subtitle --}}
@section('page-subtitle', '')

{{-- Breadcrumbs --}}
@section('breadcrumbs')
{!! Breadcrumbs::render('tranning') !!}
@endsection

@section('content')
@foreach($quizzes as $quiz)
  @include('layouts.partials.frontend.quiz',['quiz'=>$quiz])
@endforeach
@endsection
