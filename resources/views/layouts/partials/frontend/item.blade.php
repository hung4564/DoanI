<div class="col-md-3 text-center">
    <div class="box">
        <div class="box-content no-padding">
          <img class="img-responsive" src="image/320x150.png" alt="" height="150px">
          {{$Course->name}}<br />
          <small>{{$Course->Teacher->name}}</small>
          <hr />
          <p>{!!$Course->detail!!}</p>
          <a href="{{route('course.detail',[$Course->id])}}" class="btn btn-primary btn-block">More info <i class="fa fa-arrow-circle-right"></i></a>
        </div>
    </div>
</div>