<!-- item -->
<div class="row">
  <div class=" col-xs-12">
    <div class="questioncontent">
      {!!$question->name!!}
    </div>
  </div>
  <div class="col-xs-12">
    <div class="questionchoice">
        <input type="hidden" name="questions[]" value="{{$question->id}}">            
      <div class="answer">
        {{-- Cau hoi viet cau tra loi --}}
      @if($question->question_type==0)  
          <input type="text" class="form-control answer" name="answer_{{$question->id}}" placeholder="Fill your answer" value="">             
      @elseif($question->question_type==1||$question->question_type==2)
        <?php
        $value=0
        ?>
        {{-- Cau hoi nhieu lua chon --}}
        @foreach($question->Choices() as $choice)
        <div class="input-group">
          <span class="input-group-addon">
            <input type="radio" name="answer_{{$question->id}}" value="{{$value}}" >
          </span>
          <input type="text" class="form-control" value="{{$choice}}" readonly>
        </div>
        <!-- /input-group -->
        <?php $value++;
        ?>
        @endforeach
      @endif
      </div> 
    </div>
  </div>
  <div class="col-xs-12">
    <div class="questionanswer">    
        <input type="hidden" name="questionanswer_{{$question->id}}" value="{{$question->answer}}">  
    </div>
  </div>
</div>
<!-- end item -->