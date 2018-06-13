@extends('layouts.frontend') {{-- Page Title --}} 
@section('page-title', 'Quiz') {{-- Page Subtitle --}} 
@section('page-subtitle','')
{{-- Breadcrumbs --}} 
@section('breadcrumbs') {{-- {!! Breadcrumbs::render('quiz',$quiz->id) !!} --}}
@endsection
 
@section('header-extras')
<style>
  .tabs-right {
    border-bottom: none;
    padding-top: 2px;
  }

  .tabs-right {
    border-left: 1px solid #ddd;
  }

  .tabs-right>li {
    float: none;
    margin-bottom: 2px;
  }

  .tabs-right>li {
    margin-left: -1px;
  }

  .tabs-right>li.active>a,
  .tabs-right>li.active>a:hover,
  .tabs-right>li.active>a:focus {
    border-bottom: 1px solid #ddd;
    border-left-color: transparent;
  }

  .tabs-right>li>a {
    border-radius: 0 4px 4px 0;
    margin-right: 0;
  }

  .vertical-text {
    margin-top: 50px;
    border: none;
    position: relative;
  }

  .vertical-text>li {
    height: 20px;
    width: 120px;
    margin-bottom: 100px;
  }

  .vertical-text>li>a {
    border-bottom: 1px solid #ddd;
    border-right-color: transparent;
    text-align: center;
    border-radius: 4px 4px 0px 0px;
  }

  .vertical-text>li.active>a,
  .vertical-text>li.active>a:hover,
  .vertical-text>li.active>a:focus {
    border-bottom-color: transparent;
    border-right-color: #ddd;
    border-left-color: #ddd;
  }

  .vertical-text.tabs-right {
    right: -50px;
  }

  .vertical-text.tabs-right>li {
    -webkit-transform: rotate(90deg);
    -moz-transform: rotate(90deg);
    -ms-transform: rotate(90deg);
    -o-transform: rotate(90deg);
    transform: rotate(90deg);
  }
</style>
@endsection

<?php
  $_storeLink= route('sendQuiz',[$quiz->id]);
?>
  
@section('content')
  <?php
$questions=$quiz->Questions;
$count=count($questions);
$countdowntime_minutes=5;
?>

  <form class="form" role="form" method="POST" action="{{ $_storeLink }}">
    {{ csrf_field() }}
    <div class="col-xs-9">
      <!-- Tab panes -->
      <div class="tab-content">
        <div class="tab-pane active" id="home-r">Home Tab.

        </div>
        @for($i=1;$i<=$count;$i++) 
        <div class="tab-pane form-group" id="{{$i}}">
          @include('layouts.partials.frontend.question',['question'=>$questions[$i-1]])
        </div>
        @endfor
      </div>
    </div>
    <div class="col-xs-3">
      <!-- required for floating -->
      <div class="clock" style="height:100px; background-color:red;">
  @include('layouts.partials.frontend.countdown',['countdowntime_minutes'=>$countdowntime_minutes])
      </div>
      <div class="submit">
        <button class="btn btn-info">
          <i class="fa fa-save"></i> <span>Submit</span>
      </button>
      </div>
      <!-- Nav tabs -->
      <ul class="nav nav-tabs tabs-right">
        <li class="active"><a href="#home-r" data-toggle="tab">Home</a></li>
        @for($i=1;$i
        <=$count;$i++) <li><a href="#{{$i}}" data-toggle="tab">Question {{$i}}</a></li>
          @endfor
      </ul>
    </div>
  </form>
@endsection