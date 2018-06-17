<div class="col-md-12">
  <div class="form-group margin-b-5 margin-t-5{{ $errors->has('name') ? ' has-error' : '' }}">
    @if(isset($quizID))
    <input type="hidden" value="{{$quizID}}" name="quizID" /> @endif
    <label for="name">Name *</label>
    <textarea class="textarea" name="name" placeholder="Place some text here" style="width: 100%; height: 200px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;">
      {{ old('name', $record->name) }}
    </textarea>
    @if ($errors->has('name'))
      <span class="help-block">
          <strong>{{ $errors->first('name') }}</strong>
      </span>
    @endif
  </div>
  <!-- /.form-group -->
</div>
<!-- /.col-md-12 -->
<div class="col-md-12">
  <div class="form-group margin-b-5 margin-t-5{{ $errors->has('type') ? ' has-error' : '' }}">
    <label for="type">Type *</label>
    <select class="form-control select2" style="width: 100%;" name="question_type" id="choice_type">
      <option value="0" @if($record->question_type==0) selected @endif>Identification</option>
      <option value="1" @if($record->question_type==1) selected @endif>True or False</option>
      <option value="2" @if($record->question_type==2) selected @endif>Multiple choice</option>
    </select>
    @if ($errors->has('type'))
      <span class="help-block">
          <strong>{{ $errors->first('type') }}</strong>
      </span>
    @endif
  </div>
  <!-- /.form-group -->
</div>
<!-- /.col-md-12 -->

<div class="col-md-12">
  <div class="form-group margin-b-5 margin-t-5{{ $errors->has('choices') ? ' has-error' : '' }}">
    <label for="type">Choices *</label>
      <div class="choice" id="multichoice" @if($record->question_type!=2) hidden @endif>
        <?php
          $choices=$record->Choices();
          ?>
          @for ($i = 0; $i< 4; $i++)
          <div class="col-md-6">
            <label class="control-label"><i class="fa fa-check"></i>Choice {{$i+1}}</label>
            @if($choices!=null&&$i<count($choices))
              <input type="text" class="form-control" name="choices[]" placeholder="" value="{{$choices[$i]}}">
            @else
              <input type="text" class="form-control mulitchoice" name="choices[]" placeholder="" value=""> 
            @endif
          </div>
          @endfor
      </div>
        <div class="choice" id="trueorflase" @if($record->question_type!=1) hidden @endif>
          <input type="text" class="form-control" name="choice_tof" placeholder="Fill your answer below" value="" disabled>
        </div>
        <div class="choice" id="identification" @if($record->question_type!=0) hidden @endif>
          <input type="text" class="form-control" name="choice_ide" placeholder="Fill your answer below" value="" disabled>
        </div>
      @if ($errors->has('choices'))
        <span class="help-block">
          <strong>{{ $errors->first('choices') }}</strong>
        </span> 
      @endif
    </div>
  <!-- /.form-group -->
</div>
<!-- /.col-md-12 -->
<div class="col-md-12">
  <div class="form-group margin-b-5 margin-t-5{{ $errors->has('answer') ? ' has-error' : '' }}">
    <label for="type">Answer *</label>
    <input type="hidden" name="" id="answer_data" value="{{ old('answer', $record->answer) }}">
    <div class="answer" id="div_answer_single" @if($record->question_type!=0) hidden @endif>
    <input type="text" class="form-control answer" name="answer" placeholder="Fill your answer" value="{{ old('answer', $record->answer) }}" id="answer_input" @if($record->question_type!=0) hidden @endif> 
    </div>
    <div class="answer" id="div_answer_multi" @if($record->question_type==0) hidden @endif>
      <select class="form-control select2 answer" style="width: 100%;" name="answer" id="answer_multi" @if($record->question_type==0) hidden @endif>
      </select>
    </div>
    @if ($errors->has('answer'))
      <span class="help-block">
          <strong>{{ $errors->first('answer') }}</strong>
      </span>
      @endif
  </div>
  <!-- /.form-group -->
</div>
<!-- /.col-md-12 -->
<div class="col-md-12">
    <div class="form-group margin-b-5 margin-t-5{{ $errors->has('points') ? ' has-error' : '' }}">
      <label for="points">Points *</label>
      <div class="radio">
        <?php ($points= isset($record->points)?$record->points:0);?>
        <label>
            <input type="radio" name="points" class="minimal-red" @if($points==0) checked @endif value="0">
            Easy
          </label>
          <label>
            <input type="radio" name="points" class="minimal-red" @if($points==1) checked @endif value="1">
            Medium
          </label>
          <label>
            <input type="radio" name="points" class="minimal-red" @if($points==2) checked @endif value="2">
            Hard
          </label>
      </div>
      @if ($errors->has('points'))
        <span class="help-block">
            <strong>{{ $errors->first('points') }}</strong>
        </span>
        @endif
    </div>
    <!-- /.form-group -->
  </div>
  <!-- /.col-md-12 -->

@section('footer-extras')
<!-- CSS for wysihtml5 -->>
<link rel="stylesheet" href="{{asset('/adminlte/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css')}}">
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
<script>
  $('input[type="checkbox"].minimal-red, input[type="radio"].minimal-red').iCheck({
      checkboxClass: 'icheckbox_minimal-red',
      radioClass   : 'iradio_minimal-red'
    });
  val=$('#answer_data').val();
  $('#answer_multi').val(val);
  type=$('#choice_type').val();
  if(type==1){
    changeAnswer_TrueORFalse()
  }
  if(type==2){
    changeAnswer_Multichoice()
  }
  function changeAnswer_TrueORFalse(){
    $("#answer_multi").html('').select2();
  var data = [
      {
        id: 0,
        text: 'False'
      },
      {
        id: 1,
        text: 'True'
      },
    ];
    for(var i = 0, l = data.length; i < l; i++)
    {
      var option = data[i];
      newOption= new Option(option.text, option.id, option.selected);
      $('#answer_multi').append(newOption)
    }
    $('#answer_multi').trigger('change');
  }
  function changeAnswer_Multichoice(){
    $("#answer_multi").html('').select2();
  var data = [
      {
        id: 0,
        text: 'Choice 1'
      },
      {
        id: 1,
        text: 'Choice 2'
      },
      {
        id: 2,
        text: 'Choice 3'
      },
      {
        id: 3,
        text: 'Choice 4'
      },
    ];
    for(var i = 0, l = data.length; i < l; i++)
    {
      var option = data[i];
      newOption= new Option(option.text, option.id, option.selected);
      $('#answer_multi').append(newOption)
    }
    $('#answer_multi').trigger('change');
  }
  $('#choice_type').on('change', function (e) {
    var valueSelected = this.value;
    $('.choice').hide();
    $('.answer').hide();
    changeTypeChoice(valueSelected);
  });
  function changeTypeChoice(type){
    switch (type) {
      case "0":
      $('#identification').show();
      $('#div_answer_single').show();
      $('#answer_input').show();
      break;
      case "1":
      $('#trueorflase').show();
      $('#div_answer_multi').show();
      $('#answer_multi').show();
      changeAnswer_TrueORFalse();
        break;
      case "2":
      $('#multichoice').show();
      $('#div_answer_multi').show();
      $('#answer_multi').show();
      changeAnswer_Multichoice();
        break;
      default:
        break;
    }
  }
</script>
@endsection