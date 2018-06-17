<!-- item -->
<div class="row">
  <div class=" col-xs-12">
    <div class="questioncontent">
      <h2>{!!$question->name!!}</h2>
    </div>
  </div>
  <div class="col-xs-12">
    <div class="questionchoice">
      <input type="hidden" name="questions[]" value="{{$question->id}}">
      <div class="answer">
      <div class="question_type"  hidden>{{$question->question_type}}</div>
        {{-- Cau hoi viet cau tra loi --}}
      @if($question->question_type==0)
        <div class="form-group margin-b-5 margin-t-5">
          <input type="text" class="form-control" name="answer_{{$question->id}}" placeholder="Fill your answer" value="">
        </div>
      @elseif($question->question_type==1||$question->question_type==2)
        <?php
        $value=0
        ?>
        {{-- Cau hoi nhieu lua chon --}}
        @foreach($question->Choices() as $choice)
        <div class="form-group margin-b-5 margin-t-5">
          <input type="radio" name="answer_{{$question->id}}" value="{{$value}}" >
          <span>{{$choice}}</span>
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
    <div class="questionanswer" hidden>
        Correct Answer is:
        <div id="questionanswer_{{$question->id}}" style="display:inline">{{$question->answer}}</div>
        <input type="hidden" name="questionanswer_{{$question->id}}" value="{{$question->answer}}">
    </div>
  </div>
</div>
<!-- end item -->