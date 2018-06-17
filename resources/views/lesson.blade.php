<?php
$_pageTitle = (isset($addVarsForView['_pageTitle']) && ! empty($addVarsForView['_pageTitle']) ? $addVarsForView['_pageTitle'] : ucwords('Lesson'));
$_pageSubtitle = (isset($addVarsForView['_pageSubtitle']) && ! empty($addVarsForView['_pageSubtitle']) ? $addVarsForView['_pageSubtitle'] : 'Detail');
?>
@extends('layouts.frontend')
{{-- Page Title --}}
@section('page-title',$_pageTitle)
 {{-- Page Subtitle--}}
@section('page-subtitle',$_pageSubtitle)
{{-- Breadcrumbs --}}
@section('breadcrumbs')
{!! Breadcrumbs::render('lesson',$lesson->id)!!}
@endsection

@section('header-extras')
<style>
body {
    position: relative;
}
.affix {
    top: 20px;
    z-index: 9999 !important;
}
#myScrollspy{
  text-overflow:ellipsis
}
</style>
@endsection
@section('content')
<h1>{{$lesson->title}}</h1>
<div class="col-md-9">
  <article>
    <p>{!!$detail!!}</p>
  </article>
</div>
<div class="col-md-3">
    <div class="all-questions" id="myScrollspy"></div>
  </div>
@endsection
@section('footer-extras')
<script>
  $(document).ready(function(){
   $('body').attr('data-spy','scroll');
   $('body').attr('data-target','#myScrollspy');
   $('body').attr('data-offset','20');
  });
  var ToC =
  '<nav id="myScrollspy">' +
    "<h3>Index:</h3>" +
    '<ul class="nav nav-pills nav-stacked" data-spy="affix" data-offset-top="205">';

var newLine, el, title, link;

$("article h3").each(function(index,element) {

  el = $(this);
  el.attr('id', 'title3-'+index);
  title = el.text();
  link = "#" + el.attr("id");

  newLine =
    "<li>" +
      "<a href='" + link + "'>" +
        title +
      "</a>" +
    "</li>";

  ToC += newLine;

});

ToC +=
   "</ul>" +
  "</nav>";

$(".all-questions").prepend(ToC);
</script>
@endsection