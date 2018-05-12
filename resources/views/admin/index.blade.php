{{-- Extends Layout --}} 
@extends('layouts.backend') {{-- Page Title --}} 
@section('page-title', 'Admin') {{-- Page Subtitle
--}} 
@section('page-subtitle', 'Control panel') {{-- Breadcrumbs --}} 
@section('breadcrumbs')
{!! Breadcrumbs::render('admin') !!}
@endsection
 {{-- Header Extras
to be Included --}} 
@section('head-extras') @parent
@endsection
 
@section('content')

<!-- Small boxes (Stat box) -->
<div class="row">
  <div class="col-lg-3 col-xs-6">
    <!-- small box -->
    <div class="small-box bg-aqua">
      <div class="inner">
        <h3>{{ $reports->getTotalUsers() }}</h3>
        <p>Users</p>
      </div>
      <div class="icon">
        <i class="ion ion-ios-people-outline"></i>
      </div>
      <a href="{{ route('admin::users.index') }}" class="small-box-footer">List Users <i class="fa fa-arrow-circle-right"></i></a>
    </div>
  </div>
  <!-- ./col -->

  <div class="col-lg-3 col-xs-6">
    <!-- small box -->
    <div class="small-box bg-green">
      <div class="inner">
        <h3>{{ $reports->getTotalCategory()}}</h3>

        <p>Category</p>
      </div>
      <div class="icon">
        <i class="ion ion-stats-bars"></i>
      </div>
      <a href="{{ route('admin::categories.index') }}" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
    </div>
  </div>
  <!-- ./col -->
  <div class="col-lg-3 col-xs-6">
    <!-- small box -->
    <div class="small-box bg-yellow">
      <div class="inner">
        <h3>{{ $reports->getTotalVisual()}}</h3>

        <p>Visual</p>
      </div>
      <div class="icon">
        <i class="ion ion-person-add"></i>
      </div>
      <a href="{{ route('admin::visuals.index') }}" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
    </div>
  </div>
  <!-- ./col -->
  <div class="col-lg-3 col-xs-6">
    <!-- small box -->
    <div class="small-box bg-red">
      <div class="inner">
        <h3>{{ $reports->getTotalQuiz()}}</h3>

        <p>Quiz</p>
      </div>
      <div class="icon">
        <i class="ion ion-pie-graph"></i>
      </div>
      <a href="{{ route('admin::quizzes.index') }}" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
    </div>
  </div>
  <!-- ./col -->
  <div class="col-lg-3 col-xs-6">
    <!-- small box -->
    <div class="small-box bg-red">
      <div class="inner">
        <h3>{{ $reports->getTotalQuiz()}}</h3>

        <p>Quiz</p>
      </div>
      <div class="icon">
        <i class="ion ion-pie-graph"></i>
      </div>
      <a href="{{ route('admin::questions.index') }}" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
    </div>
  </div>
  <!-- ./col -->
@endsection
 {{-- Footer Extras to be Included --}} 
@section('footer-extras')
@endsection