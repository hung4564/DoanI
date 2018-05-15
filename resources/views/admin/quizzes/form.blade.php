<div class="col-md-12">
  <div class="form-group margin-b-5 margin-t-5{{ $errors->has('name') ? ' has-error' : '' }}">
    <label for="name">Name *</label>
    <input type="text" class="form-control" name="name" placeholder="Name" value="{{ old('name', $record->name) }}" required>    @if ($errors->has('name'))
    <span class="help-block">
          <strong>{{ $errors->first('name') }}</strong>
      </span> @endif
  </div>
  <!-- /.form-group -->
</div>
<!-- /.col-md-12 -->

<div class="col-md-12">
  <div class="form-group margin-b-5 margin-t-5{{ $errors->has('visual') ? ' has-error' : '' }}">
    <label for="visual">Visual</label>
    <select class="form-control select2" style="width: 100%;" name="visual">
          @foreach(\App\Visual::All() as $visual)
          <option value="{{$visual->id}}">{{$visual->name}}</option>
          @endforeach
      </select>
  </div>
  <!-- /.form-group -->
</div>
<!-- /.col-md-12 -->
<div class="col-md-6">
  <!-- checkbox -->
  <div class="form-group margin-b-5 margin-t-5{{ $errors->has('status') ? ' has-error' : '' }}">
    <label for="status">Status</label>
    <div class="radiob">
      <label>
          <input type="radio" name="status" class="minimal-red" checked value="0">
          Disabe
        </label>
      <label>
          <input type="radio" name="status" class="minimal-red" value="1">
          Enable
        </label>
    </div>
  </div>
  <!-- /.form-group -->
</div>
<!-- /.col-md-6 -->
<div class="col-md-6">
  <!-- checkbox -->
  <div class="form-group margin-b-5 margin-t-5{{ $errors->has('status') ? ' has-error' : '' }}">
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