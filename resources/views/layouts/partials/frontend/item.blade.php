<!-- item -->
<div class=" col-sm-6 col-md-4 col-lg-3">
  <div class="col-md-12">
    <a href="{{route('visual',['id'=>$visual->id,'path'=>$visual->path])}}">
          <img class="img-responsive" src="image/320x150.png" alt="{{route('visual',['id'=>$visual->id,'path'=>$visual->path])}}">
      </a>
  </div>
  <div class="col-md-12">
    <a href="{{route('visual',['id'=>$visual->id,'path'=>$visual->path])}}"><strong>{{$visual->name}}</strong></a>
  </div>

  <div class="col-md-12">
    @foreach($visual->Categories as $category)
    <button type="button" class="btn btn-default btn-xs">{{$category->name}}</button> @endforeach
  </div>
</div>
<!-- end item -->