<div class="col-md-12">
  <div class="form-group margin-b-5 margin-t-5{{ $errors->has('name') ? ' has-error' : '' }}">
    <label for="name">Name *</label>
    <input type="text" class="form-control" name="name" placeholder="Name" value="{{ old('name', $record->name) }}" required>
    @if ($errors->has('name'))
    <span class="help-block">
        <strong>{{ $errors->first('name') }}</strong>
    </span>
    @endif
  </div>
  <!-- /.form-group -->
</div>
<!-- /.col-md-12 -->

<div class="col-md-6">
  <div class="form-group margin-b-5 margin-t-5{{ $errors->has('countdown_s') ? ' has-error' : '' }}">
    <label for="countdown_s">CountDown Time(second)*</label>
    <input type="text" class="form-control" name="countdown_s" placeholder="Countdown time seconds" value="{{ old('countdown_s', $record->countdown_s) }}" required>
    @if ($errors->has('countdown_s'))
    <span class="help-block">
        <strong>{{ $errors->first('countdown_s') }}</strong>
    </span>
    @endif
  </div>
  <!-- /.form-group -->
  <div class="form-group margin-b-5 margin-t-5{{ $errors->has('level') ? ' has-error' : '' }}">
      <label for="status">Level</label>
    <?php $level= (isset($record->level)?$record->level:0);?>
      <div class="radio">
        <label>
          <input type="radio" name="level" class="minimal-red" @if($level==0 )checked @endif value="0">
          Easy
        </label>
        <label>
          <input type="radio" name="level" class="minimal-red" @if($level==1 )checked @endif value="1">
          Medium
        </label>
        <label>
          <input type="radio" name="level" class="minimal-red" @if($level==2 )checked @endif value="2">
          Hard
        </label>
      </div>
    </div>
    <!-- /.form-group -->
  <div class="form-group margin-b-5 margin-t-5{{ $errors->has('status') ? ' has-error' : '' }}">
    <label for="status">Status</label>
    <?php
    $statusId = (isset($record->status)?$record->status:0);
    ?>
    <div class="radio">
      <label>
        <input type="radio" name="status" class="minimal-red" @if($statusId==0 ) checked @endif value="0">
        Disabe
      </label>
      <label>
        <input type="radio" name="status" class="minimal-red"  @if($statusId==1 )checked @endif  value="1">
        Enable
      </label>
    </div>
  </div>
  <!-- /.form-group -->
</div>
<!-- /.col-md-6 -->
<div class="col-md-6">
  <div class="form-group margin-b-5 margin-t-5{{ $errors->has('course') ? ' has-error' : '' }}">
    <label for="Course">In Course</label>
    <div class="Course">
      @if(isset($record->course_id))
        @if($record->course_id=="0")
        <P>Not in any course</P>
        @else
        <a href="{{route('admin::courses.detail',['id' => $record->course_id])}}">
        <button type="button" class="btn btn-info" onclick="">
          <i class="fa fa-save"></i> <span>Course</span>
        </button>
        </a>
        @endif
      @else
      <p>You need create quiz first</p>
      </p>
      @endif
    </div>
  </div>
  <!-- /.form-group -->
  <div class="form-group margin-b-5 margin-t-5{{ $errors->has('questions') ? ' has-error' : '' }}">
    <label for="question">Questions</label>
    <div class="question">
      @if(isset($record->id))
      <a href="{{route('admin::QuizQuestion.index',['id' => $record->id])}}">
      <button type="button" class="btn btn-info" onclick="">
        <i class="fa fa-save"></i> <span>List Question</span>
      </button></a>
      @else
      <p>You need create quiz first</p>
      </p>
      @endif
    </div>
  </div>
  <!-- /.form-group -->
</div>
<!-- /.col-md-6 -->
@section('footer-extras')
<script>
  //Red color scheme for iCheck
    $('input[type="checkbox"].minimal-red, input[type="radio"].minimal-red').iCheck({
      checkboxClass: 'icheckbox_minimal-red',
      radioClass   : 'iradio_minimal-red'
    });

</script>
@endsection