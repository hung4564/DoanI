<!-- item -->
<div class="row">
  <div class=" col-xs-12">
    <div class="col-xs-2">
      <a href="{{route('quiz',$quiz->id)}}">
            <img   class="img-responsive" src="" alt="" style=" width: 150px;   height: 150px;  background-color:red;">
        </a>
    </div>
    <div class="col-xs-10">
      <a href="{{route('quiz',$quiz->id)}}"><strong>{{$quiz->getRecordTitle()}}</strong></a>
    </div>
    <div class="col-xs-10">
      Question: {{count($quiz->Questions)}}
    </div>
    <div class="col-xs-10">
      Visual: {{$quiz->Visual->name}}
    </div>
    <div class="col-xs-10">
      @foreach($quiz->Categories as $category)
      <button type="button" class="btn btn-default btn-xs">{{$category->name}}</button> 
      @endforeach
    </div>
  </div>
</div>
<!-- end item -->