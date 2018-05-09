<!-- item -->
<div class=" col-sm-6 col-md-4 col-lg-3">
  <div class="col-md-12">
    <a href="{{$visual->id}}/{{$visual->path}}.html">
          <img class="img-responsive" src="image/320x150.png" alt="">
      </a>
  </div>
  <div class="col-md-12">
    <a href="{{$visual->id}}/{{$visual->path}}.html"><strong>{{$visual->name}}</strong></a>
  </div>

  <div class="col-md-12">
    @foreach($visual->getCategory as $category)
    <button type="button" class="btn btn-default btn-xs">{{$category->name}}</button> @endforeach
  </div>
</div>
<!-- end item -->