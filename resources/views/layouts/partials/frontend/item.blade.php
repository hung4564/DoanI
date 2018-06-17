<div class="col-md-3">
  <div class="box box-primary" style="height:150px">
    <div class="box-header with-border">
      <h3 class="box-title">{{$Course->name}}</h3>
    </div>
    <div class="box-body">
      <small>Teacher</small>: {{$Course->Teacher->name}}
    </div>
    <div class="box-footer">
      <a href="{{route('course.detail',[$Course->id])}}" class="btn btn-primary btn-block">More info <i class="fa fa-arrow-circle-right"></i></a>
    </div>
  </div>
</div>