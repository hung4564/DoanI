@extends('layouts.frontend') {{-- Page Title --}} 
@section('page-title') {{$visual->name}}
@endsection
 {{-- Page Subtitle
--}} 
@section('page-subtitle','') {{-- Breadcrumbs --}} 
@section('breadcrumbs') {!! Breadcrumbs::render('visual',$visual)
!!}
@endsection
 
@section('header-extras')
<style>
  .vungve {
    height: 450px;
  }

  .bar {
    fill: steelblue;
  }

  .chart text {
    fill: white;
    font: 10px sans-serif;
    text-anchor: end;
  }

  .highlight {
    fill: orange;
  }

  .bar {
    pointer-events: all
  }

  .svg-container {
    display: inline-block;
    position: relative;
    width: 100%;
    padding-bottom: 100%;
    /* aspect ratio */
    vertical-align: top;
    overflow: hidden;
  }

  .svg-content-responsive {
    display: inline-block;
    position: absolute;
    top: 10px;
    left: 0;
  }
</style>
@endsection
 
@section('content')
<!-- Page Content -->
<div class="row main-row fill">
  <div class="col-sm-9 vungve scrollmenu" style="background-color:lavender" id="viz">
  </div>
  <div class="col-sm-3" style="background-color:lavenderblush;">
    <input type="button" value="lay du lieu" onclick="redner(test)">
    <input type="button" value="doi cho" onclick="swap(6,7)">
    <input type="button" value="sap xep" onclick="bubblesort()">
  </div>
</div>
<!-- end Page Content -->
@endsection
 
@section('footer-extras')
<script src="{{ asset('/js/d3.min.js') }}"></script>
<script src="{{ asset('/js/chart.js') }}"></script>
<script src="{{ asset('/js/bubble-sort.js') }}"></script>
@endsection