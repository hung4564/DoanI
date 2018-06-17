<div class="col-md-12">
  <div class="col-md-12">
    <div class="form-group margin-b-5 margin-t-5{{ $errors->has('title') ? ' has-error' : '' }}">
      <label for="title">Name *</label>
      <input type="text" class="form-control" name="title" placeholder="title" value="{{ old('title', $record->title) }}" required>      @if ($errors->has('name'))
      <span class="help-block">
          <strong>{{ $errors->first('title') }}</strong>
      </span> @endif

    </div>
    <!-- /.form-group -->
  </div>
  <!-- /.col-md-12 -->


  <div class="col-md-12">
    <label for="detail">Detail *</label>
    <input type="hidden" name="link" value="{{$record->link}}">
    <div class="form-group margin-b-5 margin-t-5{{ $errors->has('detail') ? ' has-error' : '' }}">
      <textarea class="textarea" name="detail" placeholder="Place some text here" style="width: 100%; height: 200px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;">
            {{ old('detail', $record->detail) }}
          </textarea>
           @if ($errors->has('detail'))
      <span class="help-block">
          <strong>{{ $errors->first('detail') }}</strong>
      </span> @endif
    </div>
    <!-- /.form-group -->
  </div>
  <!-- /.col-md-12 -->
</div>
<!-- /.col-md-12 -->


@section('footer-extras')
<!-- Js for wysihtml5 -->
<script src="{{asset('/adminlte/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js')}}"></script>
<script>
  $(function () {
    //bootstrap WYSIHTML5 - text editor
    $('.textarea').wysihtml5()
  })

</script>
@parent
@endsection
 
@section('footer-extras')
<!-- CSS for wysihtml5 -->>
<link rel="stylesheet" href="{{asset('/adminlte/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css')}}"> @parent
@endsection