<?php
$totalQuiz = count($course->Quizzes);
$totalStudent = count($course->Students);
?>

@extends('layouts.frontend')

{{-- Page Title --}}
@section('page-title', $course->name)

{{-- Page Subtitle --}}
@section('page-subtitle', '')

{{-- Breadcrumbs --}}
@section('breadcrumbs')
{!! Breadcrumbs::render('home') !!}
@endsection

{{-- Header Extras to be Included --}}
@section('head-extras')
<style>
    .list {
      margin-bottom: 30px;
    }
    .listitem{ margin-bottom: 10px; line-height: 32px; position: relative; padding-left: 75px; }
    .itemlabel{ position: absolute; left: 0; top: 0; color: #666; }
    .itemvalue{ color: #333; }
    </style>
@endsection

@section('content')

<div class="col-12">
  <div class="box box-primary">
    <div class="box-header with-border">
      Course Information
    </div>
    <div class="box-body">
      <div class="col-md-3 col-sm-3 hidden-xs">
        <div class="col-12">
          <img class="img-responsive  center-block" src="{{url('image/150x200.png')}}" height="150" width="200" >
        </div>
      </div>
      <div class="col-md-6 col-sm-9">
        <div class="list">
          <div class="listitem">
            <div class="itemlabel">Course:</div>
            <div class="itemvalue">{{$course->name}}</div>
          </div>
          <div class="listitem">
            <div class="itemlabel">Category:</div>
            <div class="itemvalue">
                @foreach($course->Categories as $category)
                <a href="{{$category->id}}" class="btn btn-sm">{{$category->name}}</a>
              @endforeach
            </div>
          </div>
        </div>
        <button type="button" class="btn btn-primary" onclick="location.href='{{route('enrollment',[$course->id])}}'">Enrollment</button>
      </div>
      <div class="col-md-3 hidden-sm hidden-xs">
        <ul style="list-style-type:none">
          <li><i class="fa fa-question-circle"></i> <b>{{$totalQuiz}}</b> Quiz</li>
          <li><i class="fa fa-user"></i> <b>{{$totalStudent}}</b> Student</li>
          <li></li>
        </ul>
      </div>
    </div>
  </div>
</div>
{{-- ./info --}}
<div class="col-md-9">
  <div class="box box-primary">
    <div class="box-header with-border">
      Course Detail
    </div>
    <div class="box-body">
      {!!$course->detail!!}
    </div>
  </div>
</div>
<div class="col-md-3">
  <div class="box box-primary">
    <div class="box-header with-border">
      Course Teacher
    </div>
    <div class="box-body">
      <img src="{{ $course->Teacher->getLogoPath() }}" class="user-image img-circle">
      <div class="text-center">
        <span>{{ $course->Teacher->name }}</span><br/>
        <span class="hidden-xs">Teacher</span>
      </div>
    </div>
  </div>
</div>
<div class="col-md-9">
    <div class="box box-primary">
      <div class="box-header with-border">
        Course Quiz
        <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
            </button>
        </div>
      </div>
      <div class="box-body">
          <div class="table-responsive list-records">
              <table class="table table-hover table-bordered">
                <thead>
                  <th>Name</th>
                  <th>Level</th>
                  <th style="width: 100px;">Question</th>
                </thead>
                <tbody>
                  @foreach ($course->Quizzes as $quiz)
                    <?php
                        $totalQuestion = count($quiz->Questions)
                    ?>
                    <tr>
                      <td class="table-text">
                        {{ $quiz->name }}
                      </td>
                      <td>
                      </td>
                      <td>
                        {{$totalQuestion}}
                      </td>
                    </tr>
                    @endforeach
                </tbody>
              </table>
            </div>
      </div>
    </div>
  </div>
@endsection
