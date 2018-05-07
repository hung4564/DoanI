


<div class="col-md-12">
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

    <div class="box">
      <div class="box-header">
        <h3 class="box-title">Bootstrap WYSIHTML5
          <small>Simple and fast</small>
        </h3>
        <!-- tools box -->
        <div class="pull-right box-tools">
          <button type="button" class="btn btn-default btn-sm" data-widget="collapse" data-toggle="tooltip" title="Collapse">
              <i class="fa fa-minus"></i></button>
          <button type="button" class="btn btn-default btn-sm" data-widget="remove" data-toggle="tooltip" title="Remove">
              <i class="fa fa-times"></i></button>
        </div>
        <!-- /. tools -->
      </div>
      <!-- /.box-header -->
      <div class="box-body pad">
        <form>
          <textarea class="textarea" placeholder="Place some text here" style="width: 100%; height: 200px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;">
            {{ old('detail', $record->detail) }}
          </textarea>
        </form>
      </div>
    </div>
    <!-- /.form-group -->
  </div>
  <!-- /.col-md-12 -->
</div>
<!-- /.col-md-12 -->

{{-- Footer Extras to be Included --}}
@section('footer-extras')
<!-- Js for wysihtml5 -->
<script src="{{asset('/adminlte/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js')}}"></script>
<script>
  $(function () {
    //bootstrap WYSIHTML5 - text editor
    $('.textarea').wysihtml5()
  })
</script>
<!-- CSS for wysihtml5 -->>
<link rel="stylesheet" href="{{asset('/adminlte/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css')}}">
@endsection