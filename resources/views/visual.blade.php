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
</style>
@endsection
 
@section('content')
<!-- Page Content -->
<div class="row">
  <div class="col-sm-9 vungve scrollmenu" style="background-color:lavender" id="viz">
  </div>
  <div class="col-sm-3" style="background-color:lavenderblush;">
    <!-- Custom Tabs -->
    <div class="nav-tabs-custom">
      <ul class="nav nav-tabs">
        <li class="active"><a href="#tab_1" data-toggle="tab">Tab 1</a></li>
        <li><a href="#tab_2" data-toggle="tab">Tab 2</a></li>
        <li><a href="#tab_3" data-toggle="tab">Tab 3</a></li> 
        <li class="pull-right"><a href="#" class="text-muted"><i class="fa fa-gear"></i></a></li>
      </ul>
      <div class="tab-content">
        <div class="tab-pane active" id="tab_1">
            <input type="button" value="lay du lieu" onclick="redner(test)">
            <input type="button" value="doi cho" onclick="swap(6,7)">
            <input type="button" value="sap xep" onclick="bubblesort()">
            <br>
          <b>How to use:</b>
  
          <p>Exactly like the original bootstrap tabs except you should use
            the custom wrapper <code>.nav-tabs-custom</code> to achieve this style.</p>
        </div>
        <!-- /.tab-pane -->
        <div class="tab-pane" id="tab_2">
        </div>
        <!-- /.tab-pane -->
        <div class="tab-pane" id="tab_3">
        </div>
        <!-- /.tab-pane -->
      </div>
      <!-- /.tab-content -->
    </div>
    <!-- nav-tabs-custom -->
  </div>
  <!-- /.col -->
</div>
<!-- end Page Content -->
@endsection
 
@section('footer-extras')
<script src="{{ asset('/js/d3.min.js') }}"></script>
<script src="{{ asset('/js/chart.js') }}"></script>
<script src="{{ asset('/js/bubble-sort.js') }}"></script>
@endsection