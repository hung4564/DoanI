@extends('layouts.backend')
<?php
$_pageTitle = (isset($addVarsForView['_pageTitle']) && ! empty($addVarsForView['_pageTitle']) ? $addVarsForView['_pageTitle'] : ucwords('Course'));
$_pageSubtitle = (isset($addVarsForView['_pageSubtitle']) && ! empty($addVarsForView['_pageSubtitle']) ? $addVarsForView['_pageSubtitle'] : 'Detail');

    $totalStudent = count($record->Students);
    $totalQuiz = count($record->Quizzes);
    $totalStudent_wait = count($record->Students_wait);
?>
<?php
$totalQuiz = count($record->Quizzes);
$totalStudent = count($record->Students);
$totalLesson = count($record->Lessons);
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
 {!! Breadcrumbs::render('admin::courses.detail',$record->id) !!}
@endsection

@section('content')
<div class="col-12">
  <div class="box box-primary">
    <div class="box-header with-border">
      Course Information
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
              <div class="itemlabel">Course:</div>
              <div class="itemvalue">{{$record->name}}</div>
            </div>
            <div class="listitem">
              <div class="itemlabel">Teacher:</div>
              <div class="itemvalue">{{$record->Teacher->name}}</div>
            </div>
            <div class="listitem">
              <div class="itemlabel">Status:</div>
              <div class="itemvalue">{{$record->Status->name}}</div>
            </div>
            <div class="listitem">
              <div class="itemlabel">Category:</div>
              <div class="itemvalue">
                  @foreach($record->Categories as $category){{$category->name}}
                @endforeach
              </div>
            </div>
        </div>
        <div class="btn-group margin-b-5 margin-t-5">
        @if($record->IsEnable())
          <button type="button" class="btn btn-default" onclick="location.href='{{route('admin::courses.disable',$record->id)}}'">Disable</button>
        @else
          <button type="button" class="btn btn-warning" onclick="location.href='{{route('admin::courses.enable',$record->id)}}'">Enable</button>
        @endif
        @if($record->IsPublic())
          <button type="button" class="btn btn-default" onclick="location.href='{{route('admin::courses.enable',$record->id)}}'">Unpublic</button>
        @else
          <button type="button" class="btn btn-danger" onclick="location.href='{{route('admin::courses.public',$record->id)}}'">Public</button>
        @endif
        @can('update', $record)
        <button type="button" class="btn btn-primary" onclick="location.href='{{route('admin::courses.edit',$record->id)}}'">Edit Course</button>
        @endcan
        </div>
        <br>
        <div class="btn-group margin-b-5 margin-t-5">
        @can('addLesson', $record)
        <button type="button" class="btn btn-info" data-toggle="modal" data-target="#modal-addlesson">Add Lesson</button>
        @endcan
        @can('addQuiz', $record)
        <button type="button" class="btn btn-info"  data-toggle="modal" data-target="#modal-addquiz">Add Quiz</button>
        @endcan
        @can('addStudent', $record)
        <button type="button" class="btn btn-info" data-toggle="modal" data-target="#modal-addstudent">Add Student</button>
        @endcan
        </div>
      </div>
      <div class="col-md-2 hidden-sm hidden-xs">
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
<div class="box">
  <div class="box-header with-border">
    <h3 class="box-title">Course Student</h3>
    <div class="box-tools pull-right">
      <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
      </button>
    </div>
  </div>
  <!-- /.box-header -->
  <div class="box-body no-padding">
    @if(count($record->Students_wait) > 0)
    <?php
        $tableCounter = 0;
    ?>
    <div class="table-responsive list-records">
      <table class="table table-hover table-bordered">
        <thead>
          <!--<th style="width: 10px;"><button type="button" class="btn btn-default btn-sm checkbox-toggle"><i class="fa fa-square-o"></i></button></th>-->
          <th>#</th>
          <th>ID</th>
          <th>Name</th>
          <th>Email</th>
          <th style="width: 100px;">Action</th>
        </thead>
        <tbody>
          @foreach ($record->Students_wait as $student)
            <?php
              $tableCounter++;
            ?>
            <tr>
              <!--<td><input type="checkbox" name="ids[]" value="{{ $student->id }}" class="square-blue"></td>-->
              <td>{{ $tableCounter }}</td>
              <td>{{ $student->id }}</td>
              <td class="table-text">
                {{ $student->name }}
              </td>
              <td>{{ $student->email }}</td>
              <td>
                <div class="btn-group">
                  @can('addStudent', $record)
                  <a href="{{route('admin::course.addstudent',[$record->id,$student->id])}}" class="btn btn-warning btn-sm"><i class="fa fa-plus"></i></a>
                  @endcan
                </div>
              </td>
            </tr>
            @endforeach
        </tbody>
      </table>
    </div>
    @endif
    @if (count($record->Students) > 0)
        <?php
            $tableCounter = 0;
        ?>
        <div class="table-responsive list-records">
          <table class="table table-hover table-bordered">
            <thead>
              <!--<th style="width: 10px;"><button type="button" class="btn btn-default btn-sm checkbox-toggle"><i class="fa fa-square-o"></i></button></th>-->
              <th>#</th>
              <th>ID</th>
              <th>Name</th>
              <th>Email</th>
              <th style="width: 100px;">Action</th>
            </thead>
            <tbody>
              @foreach ($record->Students as $student)
                <?php
                  $tableCounter++;
                ?>
                <tr>
                  <!--<td><input type="checkbox" name="ids[]" value="{{ $student->id }}" class="square-blue"></td>-->
                  <td>{{ $tableCounter }}</td>
                  <td>{{ $student->id }}</td>
                  <td class="table-text">
                    {{ $student->name }}
                  </td>
                  <td>{{ $student->email }}</td>
                  <td>
                    <div class="btn-group">
                      @can('removeStudent', $record)
                      <a href="{{route('admin::course.removestudent',[$record->id,$student->id])}}" class="btn btn-danger btn-sm"><i class="fa fa-minus"></i></a>
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
<!-- /.box student -->
<div class="box">
  <div class="box-header with-border">
    <h3 class="box-title">Course Quiz</h3>
    <div class="box-tools pull-right">
      <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
      </button>
    </div>
  </div>
  <!-- /.box-header -->
  <div class="box-body no-padding">
    @if ($totalQuiz > 0)
        <div class="padding-5">
            <span class="text-green padding-l-5">Total: {{ $totalQuiz }} items.</span>&nbsp;
        </div>
        <?php
            $tableCounter = 0;
        ?>
        <div class="table-responsive list-records">
          <table class="table table-hover table-bordered">
            <thead>
              <!--<th style="width: 10px;"><button type="button" class="btn btn-default btn-sm checkbox-toggle"><i class="fa fa-square-o"></i></button></th>-->
              <th>#</th>
              <th>ID</th>
              <th>Name</th>
              <th>Status</th>
              <th style="width: 100px;">Action</th>
            </thead>
            <tbody>
              @foreach ($record->Quizzes as $quiz)
                <?php
                  $tableCounter++;
                ?>
                <tr>
                  <!--<td><input type="checkbox" name="ids[]" value="{{ $quiz->id }}" class="square-blue"></td>-->
                  <td>{{ $tableCounter }}</td>
                  <td>{{ $quiz->id }}</td>
                  <td class="table-text">
                    {{ $quiz->name }}
                  </td>
                  <td></td>
                  <td>
                    <div class="btn-group">
                      @can('view', $quiz)
                      <a href="{{route('admin::quizzes.detail',$quiz->id)}}" class="btn btn-info btn-sm"><i class="fa fa-list"></i></a>
                      @endcan
                      @can('removeQuiz', $record)
                      <a href="{{route('admin::course.removequiz',[$record->id,$quiz->id])}}" class="btn btn-danger btn-sm"><i class="fa fa-minus"></i></a>
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
<!-- /.box quiz -->
<div class="box">
  <div class="box-header with-border">
    <h3 class="box-title">Course Lesson</h3>
    <div class="box-tools pull-right">
      <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
      </button>
    </div>
  </div>
  <!-- /.box-header -->
  <div class="box-body no-padding">
    @if ($totalLesson  > 0)
        <div class="padding-5">
            <span class="text-green padding-l-5">Total: {{ $totalLesson  }} items.</span>&nbsp;
        </div>
        <?php
            $tableCounter = 0;
        ?>
        <div class="table-responsive list-records">
          <table class="table table-hover table-bordered">
            <thead>
              <!--<th style="width: 10px;"><button type="button" class="btn btn-default btn-sm checkbox-toggle"><i class="fa fa-square-o"></i></button></th>-->
              <th>#</th>
              <th>ID</th>
              <th>Title</th>
              <th>Level</th>
              <th style="width: 100px;">Action</th>
            </thead>
            <tbody>
              @foreach ($record->Lessons as $lesson)
                <?php
                  $tableCounter++;
                ?>
                <tr>
                  <!--<td><input type="checkbox" name="ids[]" value="{{ $lesson->id }}" class="square-blue"></td>-->
                  <td>{{ $tableCounter }}</td>
                  <td>{{ $lesson->id }}</td>
                  <td class="table-text">
                    {{ $lesson->title }}
                  </td>
                  <td>
                    {{ $lesson->level }}
                  </td>
                  <td>
                    <div class="btn-group">
                      @can('view', $quiz)
                      <a href="{{route('admin::lessons.edit',$quiz->id)}}" class="btn btn-info btn-sm"><i class="fa fa-list"></i></a>
                      @endcan
                      @can('removeQuiz', $record)
                      <a href="{{route('admin::course.removelesson',[$record->id,$lesson->id])}}" class="btn btn-danger btn-sm"><i class="fa fa-minus"></i></a>
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
<!-- /.box lesson -->
<div class="modal fade" id="modal-addquiz">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Add Quiz</h4>
      </div>
      <div class="modal-body">
        <label for="">Quiz Id:</label>
        <input type="text" name="" id="idQuiz">
        @can('addQuiz', $record)
        <button type="button" class="btn btn-primary" onclick="getInfoQuiz()"><i class="fa fa-plus"></i></button>
        @endcan
        <div id="resultQuiz" >

        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary" onclick="addQuiz()">Add Quiz</button>
      </div>
    </div>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>
<!-- /.modal quiz-->
<div class="modal fade" id="modal-addstudent">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Add Student</h4>
      </div>
      <div class="modal-body">
        <label for="">Student Id:</label>
        <input type="text" name="" id="idStudent">
        @can('addStudent', $record)
        <button type="button" class="btn btn-primary" onclick="getInfoStudent()"><i class="fa fa-plus"></i></button>
        @endcan
        <div id="resultStudent" >

        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary" onclick="addStudent()">Add Student</button>
      </div>
    </div>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>
<!-- /.modal student-->

<div class="modal fade" id="modal-addlesson">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Add lesson</h4>
      </div>
      <div class="modal-body">
        <label for="">lesson Id:</label>
        <input type="text" name="" id="idlesson">
        @can('addLesson', $record)
        <button type="button" class="btn btn-primary" onclick="getInfoLesson()"><i class="fa fa-plus"></i></button>
        @endcan
        <div id="resultLesson" >

        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary" onclick="addLesson()">Add Lesson</button>
      </div>
    </div>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>
<!-- /.modal student-->
@endsection
{{-- Footer Extras to be Included --}}
@section('footer-extras')
<script>
  function getInfoQuiz()
  {
    var quizId=$('#idQuiz').val();
    if(quizId!=""){
      $.ajax({
            type:'get',
            url:'/ajax/quiz/'+ quizId,
            success:function(data){
              $('#resultQuiz').html(data);
            }
        });
    }
    else {
      $('#resultQuiz').html("input the quiz id first");
    }
  }
  function addQuiz(){
    var url= "{{route('admin::course.addquiz',[$record->id,"#link"])}}";
    var quizId=$('#quizIdget').text();
    if(quizId!=""){
      url = url.replace("#link", quizId);
      location.href=url;
    }
    else{
      alert('need quiz id');
    }
  }
  function getInfoStudent()
  {
     var studentID=$('#idStudent').val();
    if(studentID!=""){
      $.ajax({
            type:'get',
            url:'/ajax/student/'+ studentID,
            success:function(data){
              $('#resultStudent').html(data);
            }
        });
    }
    else {
      $('#resultStudent').html("input the quiz id first");
    }
  }
  function addStudent(){
    var url= "{{route('admin::course.addstudent',[$record->id,"#link"])}}";
    var studentId=$('#studentIdget').text();
    if(studentId!="")
    {
      url = url.replace("#link", studentId);
      location.href=url;
    }
    else{
      alert('need quiz id');
    }
  }
  function getInfoLesson(){
    var lessonID=$('#idlesson').val();
    if(lessonID!=""){
      $.ajax({
            type:'get',
            url:'/ajax/lesson/'+ lessonID,
            success:function(data){
              $('#resultLesson').html(data);
            }
        });
    }
    else {
      $('#resultLesson').html("input the quiz id first");
    }
  }
  function addLesson(){
    var url= "{{route('admin::course.addlesson',[$record->id,"#link"])}}";
    var lessonId=$('#lessonIdget').text();
    if(lessonId!="")
    {
      url = url.replace("#link", lessonId);
      location.href=url;
    }
    else{
      alert('need quiz id');
    }
  }
</script>
@endsection
