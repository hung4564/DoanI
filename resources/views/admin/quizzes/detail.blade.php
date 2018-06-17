@extends('layouts.backend')
<?php
$_pageTitle = (isset($addVarsForView['_pageTitle']) && ! empty($addVarsForView['_pageTitle']) ? $addVarsForView['_pageTitle'] : ucwords('Quiz'));
$_pageSubtitle = (isset($addVarsForView['_pageSubtitle']) && ! empty($addVarsForView['_pageSubtitle']) ? $addVarsForView['_pageSubtitle'] : 'Detail');
$totalQuiz= count($records);
?>

{{-- Page Title --}}
@section('page-title', $_pageTitle)

{{-- Page Subtitle --}}
@section('page-subtitle', $_pageSubtitle)

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

@section('breadcrumbs')
 {!! Breadcrumbs::render('admin::quizzes.detail',$record->id) !!}
@endsection

@section('content')

<div class="col-12">
  <div class="box box-primary">
    <div class="box-header with-border">
      Quiz Information
    </div>
    <div class="box-body">
      <div class="col-md-2 col-sm-3 hidden-xs">
        <div class="col-12">
          <img class="img-responsive  center-block" src="{{url('image/150x200.png')}}" height="150" width="200" >
        </div>
      </div>
      <div class="col-md-8 col-sm-9">
        <div class="list">
            <div class="listitem">
              <div class="itemlabel">Quiz:</div>
              <div class="itemvalue">{{$record->name}}</div>
            </div>
            <div class="listitem">
              <div class="itemlabel">Teacher:</div>
              <div class="itemvalue">{{$record->Teacher()->name}}</div>
            </div>
            <div class="listitem">
              <div class="itemlabel">Status:</div>
              <div class="itemvalue">{{$record->Status->name}}</div>
            </div>
        </div>
        @if(!$record->Disabe())
          <button type="button" class="btn btn-default" onclick="location.href='{{route('admin::quizzes.disable',$record->id)}}'">Disable</button>
        @else
          <button type="button" class="btn btn-default" onclick="location.href='{{route('admin::quizzes.enable',$record->id)}}'">Enable</button>
        @endif
        @if($record->IsPublic())
          <button type="button" class="btn btn-default" onclick="location.href='{{route('admin::quizzes.enable',$record->id)}}'">Unpublic</button>
        @else
          <button type="button" class="btn btn-default"onclick="location.href='{{route('admin::quizzes.public',$record->id)}}'">Public</button>
        @endif
        <button type="button" class="btn btn-default"  onclick="location.href='{{route('admin::QuizQuestion.create',$record->id)}}'">Add Question</button>
      </div>
      <div class="col-md-2 hidden-sm hidden-xs">
          <li><i class="fa fa-question-circle"></i>: <b>{{$totalQuiz}}</b> Question</li>
          <li><i class="fa fa-hourglass-o"></i>: <b>{{$record->countdown_s}}</b> seconds </li>
          <li><i class="fa fa-book"></i>: <b>
              @if($record->level==0) Easy
              @elseif($record->level==1) Medium
              @else Hard
              @endif
            </b></li>
      </div>
    </div>
  </div>
</div>
{{-- ./info --}}
<div class="box">
  <div class="box-header with-border">
    <h3 class="box-title">List Question</h3>
  </div>
  <!-- /.box-header -->
  <div class="box-body no-padding">
      @if (count($records) > 0)
          <?php
              $tableCounter = 0;
          ?>
          <div class="table-responsive list-records">
            <table class="table table-hover table-bordered">
              <thead>
                <th>#</th>
                <th>ID</th>
                <th>Name</th>
                <th>Choices</th>
                <th>Answer</th>
                <th>Point</th>
                <th style="width: 100px;">Action</th>
              </thead>
              <tbody>
                @foreach ($records as $question)
                  <?php
                    $tableCounter++;
                  ?>
                  <tr>
                    <td>{{ $tableCounter }}</td>
                    <td>{{ $question->id }}</td>
                    <td class="table-text">
                      {{ $question->name }}
                    </td>
                    <td class="table-text">
                        @switch($question->question_type)
                        @case(0)
                        Identification
                        @break
                        @case(1)
                        True or False
                        @break
                        @case(2)
                        Multiple choice
                        @break
                        @default
                        Unknow
                        @endswitch
                    </td>
                    <td class="table-text">
                      {{ $question->answer }}
                    </td>
                    <td class="table-text">
                      {{ $question->points }}
                    </td>
                    <td>
                      <div class="btn-group">
                        @can('update', $question)
                          <a href="{{route('admin::questions.edit', $record->id)}}" class="btn btn-info btn-sm"><i class="fa fa-edit"></i></a>
                        @endcan
                        @can('removeQuestion', $record)
                          <a href="{{route('admin::quizzes.removeQuestion', [$record->id,$question->id])}}" class="btn btn-danger btn-sm"><i class="fa fa-minus"></i></a>
                        @endcan
                      </div>
                    </td>
                  </tr>
                  @endforeach
              </tbody>
            </table>
          </div>
      @else
          <p class="margin-l-5 lead text-green">No records found.</p>
      @endif
  </div>
  <!-- /.box-body -->
</div>
<!-- /.box -->

@endsection
{{-- Footer Extras to be Included --}}
@section('footer-extras')
@endsection