<div class="col-md-7">
  <div class="col-md-12">
    <div class="form-group margin-b-5 margin-t-5{{ $errors->has('name') ? ' has-error' : '' }}">
      <label for="name">Name *</label>
      <input type="text" class="form-control" name="name" placeholder="Name" value="{{ old('name', $record->name) }}" required>      @if ($errors->has('name'))
      <span class="help-block">
          <strong>{{ $errors->first('name') }}</strong>
      </span> @endif

    </div>
    <!-- /.form-group -->
  </div>
  <!-- /.col-md-12 -->
  <div class="col-md-12">
    <label for="detail">Detail *</label>
    <div class="form-group margin-b-5 margin-t-5{{ $errors->has('detail') ? ' has-error' : '' }}">
      <textarea class="textarea" name="detail" placeholder="Place some text here" style="width: 100%; height: 200px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;">
            {{ old('detail', $record->detail) }}
          </textarea> @if ($errors->has('detail'))
      <span class="help-block">
          <strong>{{ $errors->first('detail') }}</strong>
      </span> @endif
    </div>
    <!-- /.form-group -->
  </div>
</div>
<div class="col-md-5">
  <div class="col-md-12">
    <label for="status">Status</label>
    <div class="form-group margin-b-5 margin-t-5{{ $errors->has('status') ? ' has-error' : '' }}">
      <ul class="list">
        <li>
          <input type="radio" name="status" class="minimal-red" value="0" @if($record->status_id==0)checked @endif>
          <label>
            Disable
          </label>
        </li>
        <li>
          <input type="radio" name="status" class="minimal-red" value="1"@if($record->status_id==1)checked @endif>
          <label>
            Public
          </label>
        </li>
        <li>
          <input type="radio" name="status" class="minimal-red" value="2"@if($record->status_id==2)checked @endif>
          <label>
            Private
          </label>
        </li>
      </ul>
      @if ($errors->has('status'))
        <span class="help-block">
            <strong>{{ $errors->first('status') }}</strong>
        </span>
      @endif
    </div>
    <!-- /.form-group -->
  </div>
  <!-- /.col-md-12 -->
  <div class="col-md-12">
    <label for="code_invite">Code invite</label>
    <div class="form-group margin-b-5 margin-t-5{{ $errors->has('code_invite') ? ' has-error' : '' }}">
      <div class="info-box">
        <span class="info-box-icon bg-aqua">
          <i class="ion ion-ios-gear-outline"></i></span>

        <div class="info-box-content">
          <span class="info-box-number"  style="text-align:justify;">
          @if(!isset($record->name))
            Create course first
          @elseif($record->status_id==1)
            public course dont need code invite
          @else
          {{--
          <span class="info-box-text">CPU Traffic</span> --}}
          <div class="code_invite">{{$record->code_invite}}</div>
          <input type="hidden" name="code_invite" value="{{$record->code_invite}}">
          @endif
        </span>
        </div>
        <!-- /.info-box-content -->
      </div>
      <!-- /.info-box -->
      @if ($errors->has('code_invite'))
      <span class="help-block">
          <strong>{{ $errors->first('code_invite') }}</strong>
      </span>
      @endif
    </div>
    <!-- /.form-group -->
  </div>
  <!-- /.col-md-12 -->
</div>
<!-- /.col-md-12 -->



@section('footer-extras')
<!-- CSS for wysihtml5 -->>
<link rel="stylesheet" href="{{asset('/adminlte/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css')}}"> @parent
<style>
  .list{
    list-style-type:none;
  }
</style>
<!-- Js for wysihtml5 -->
<script src="{{asset('/adminlte/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js')}}"></script>
<script>
  $(function () {
    //bootstrap WYSIHTML5 - text editor
    $('.textarea').wysihtml5()
  })
  $('input[type="checkbox"].minimal-red, input[type="radio"].minimal-red').iCheck({
      radioClass   : 'iradio_minimal-red',
      increaseArea: '20%'
    })
</script>
@parent
@endsection