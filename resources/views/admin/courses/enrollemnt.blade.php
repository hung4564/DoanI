{{-- Extends Layout --}}
@extends('layouts.backend')

<?php
$_pageTitle = (isset($addVarsForView['_pageTitle']) && ! empty($addVarsForView['_pageTitle']) ? $addVarsForView['_pageTitle'] : ucwords($resourceTitle));
$_pageSubtitle = (isset($addVarsForView['_pageSubtitle']) && ! empty($addVarsForView['_pageSubtitle']) ? $addVarsForView['_pageSubtitle'] : 'Enrollemnt');
$_updateLink=route($resourceRoutesAlias.".postenrollment");
?>

{{-- Breadcrumbs --}}
@section('breadcrumbs')
 {!! Breadcrumbs::render($resourceRoutesAlias.".list") !!}
@endsection

{{-- Page Title --}}
@section('page-title', $_pageTitle)

{{-- Page Subtitle --}}
@section('page-subtitle', $_pageSubtitle)

{{-- Header Extras to be Included --}}
@section('head-extras')
    @parent
@endsection

@section('content')
<form class="form" role="form" method="POST" action="{{ $_updateLink }}" >
    {{ csrf_field() }}

<div class="margin-b-5 margin-t-5">
<label class="control-label">Code Course</label>
<div class="margin-b-5 margin-t-5">
  <input type="text" class="form-control" name="code_invite" placeholder="" value="">
</div>
<div class="margin-b-5 margin-t-5">
  <input type="submit" class="btn btn-primary" value="Enrollemnt">
</div>
</form>
@endsection

{{-- Footer Extras to be Included --}}
@section('footer-extras')
@endsection
