@extends('layouts.frontend') {{-- Page Title --}}
@section('page-title', 'Quiz') {{-- Page Subtitle --}}
@section('page-subtitle','')
{{-- Breadcrumbs --}}
@section('breadcrumbs') {{-- {!! Breadcrumbs::render('quiz',$quiz->id) !!} --}}
@endsection

@section('header-extras')
<style>
  div .question {
    height:60vh;
    position:relative;
  }
  div #result{
    height:60vh;
  }
  div .question .btn-holder {
    padding-top: 50px;
    bottom:   0;
    left: 10%;
  }
  div .question .btn-holder .before{
    display: inline-block;

  }
  div .question .btn-holder .next{
    display: inline-block;
    height: 10vh;
    padding-left: 20px;
  }
  div .question .btn-holder .btn{
    height: 10vh;
    width: 100px;
  }
  div .form-group span{
    padding-left: 10px;
  }
  div .submitbutton .btn{
    height: 10vh;
    width: 100px;
  }
  #time{
    font-size:50px;
  }
</style>
@endsection

<?php
  $_storeLink= route('sendQuiz',[$quiz->id]);
?>

@section('content')
  <?php
$questions=$quiz->Questions;
$count=count($questions);
$countdown_s=$quiz->countdown_s;
$minutes=$countdown_s/60;
$seconds=$countdown_s%60
?>
<form id="QuizForm" class="form" role="form" method="POST" action="{{ $_storeLink }}">
  {{ csrf_field() }}
  <div id="currenttab" hidden>0</div>
  <div id="current" hidden>{{$questions[0]->id}}</div>
  <div class="row">
    <nav class="col-sm-2">
        <div class="center">
          <span id="time">{!!sprintf("%02d", $minutes );!!}:{!!sprintf("%02d",$seconds);!!}</span>
          <div class="submitbutton">
            <button class="btn btn-danger" type="button" onclick="submitForm()">Submit</button>
          </div>
        </div>
      <div class="tab">
        <ul class="nav nav-stacked">
          <br/>
          @for($i=0;$i<$count;$i++)
          <li> <a onclick="sectionQuestion({{$i}})" href="javascript:void(0);" ><i class=" fa fa-square-o"></i>  Question {{$i+1}}</a></li>
          @endfor
        </ul>
      </div>
    </nav>
    <div class="col-sm-10">
      <div id="begin">
        <button class="btn btn-primary" type="button" onclick="beginQuiz()">Begin</button>
      </div>
      @for($i=0;$i<$count;$i++)
      <div class = "question" id="section{{$i}}" hidden>
        <h3>Question {{($i+1)}}:</h3>
        @include('layouts.partials.frontend.question',['question'=>$questions[$i]])
        <div class="btn-holder">
          @if($i!=0)
          <div class="before">
            <button class="btn btn-primary" type="button" onclick="sectionQuestion({{$i-1}})">Before</button>
          </div>
          @endif
          @if($i<$count-1)
          <div class="next">
            <button class="btn btn-primary" type="button" onclick="sectionQuestion({{$i+1}})">Next</button>
          </div>
          @else
          <div class="next">
              <button class="btn btn-danger submitbutton" type="button" onclick="submitForm()">Submit</button>
            </div>
          @endif
        </div>
      </div>
      @endfor
      <div id="result" hidden>
          <h1>Result</h1>
          <h2>Correct: <span id="totalRight"></span>/{{$count}} </h2>
      </div>
    </div>
  </div>
</form>
@endsection

{{-- Footer Extras to be Included --}}
@section('footer-extras')
<script>
  function sectionQuestion(id){
    if(!$('#begin').is(':hidden')) beginQuiz();
    idcurrent = $("#current").text();
    idcurrenttab=  $("#currenttab").text();
    question_type=$("#section"+idcurrenttab+" .question_type").text();
    checkIfAnswer(idcurrent,question_type,idcurrenttab);
    // hien thi cau hoi tiep theo
    $('.question').hide();
    $('#section'+id).show();
    $(".tab li").removeClass('active');
    $(".tab li").eq(id).addClass('active');
    // cap nhap lai id cua cau hoi va tab hien gio
    $("#current").text($("#section"+id+" input[type=hidden]").val());
    $("#currenttab").text(id);
  }
  function checkIfAnswer(id,question_type,idtab){
    var record;
    switch (question_type) {
      case "0":
        record = ($("input[name='answer_"+id+"']").val().length>0);
        break;
      case "1":
        record = $("input[name='answer_"+id+"']:checked").val()!=undefined;
        break;
      case "2":
        record = $("input[name='answer_"+id+"']:checked").val()!=undefined;
        break;
        record =undefine
      default:
        break;
    }
    if(record){
      $(".tab li i").eq(idtab).removeClass('fa-square-o').addClass('fa-check-square-o');
    }
    else{
    }

  }
 function startTimer(duration, display) {
    var timer = duration, minutes, seconds;
    var countedonw=setInterval(function () {
        minutes = parseInt(timer / 60, 10)
        seconds = parseInt(timer % 60, 10);

        minutes = minutes < 10 ? "0" + minutes : minutes;
        seconds = seconds < 10 ? "0" + seconds : seconds;

        display.textContent = minutes + ":" + seconds;

        if (--timer < 0) {
          clearInterval(countedonw);
          display.textContent="tesst xong";
            timer = duration;
        }
    }, 1000);
}
function showCorrectAnswer(){
  var questionIds=new Array();
  $("input[name='questions[]']").each(function(){
      var aValue = $(this).val();
      questionIds.push(aValue);
   });
   var totalRight=0;
   var length = questionIds.length;
   for (let index = 0; index < length; index++) {
     let questionId = questionIds[index];
     let questionanswer = $("input[name='questionanswer_"+questionId+"']").val();
     let answer = $("input[name='answer_"+questionId+"']").val()
    //  let answer = $("input[name='answer_"+questionId+"']").each(function(){
    //   var aValue = $(this).val();
    //   if(aValue==questionanswer) {
    //     console.log("question "+questionId+" true:" +aValue+":"+questionanswer);
    //     $(this).val();
    //   }
    //   else{
    //     console.log("question "+questionId+" false:"+aValue+":"+questionanswer);
    //   }
    //   });
    if(questionanswer==answer){
        console.log("question "+questionId+" true:" +answer+":"+questionanswer);
        totalRight++;
      }
      else{
        console.log("question "+questionId+" false:"+answer+":"+questionanswer);
      }
    }
    return totalRight;
  }
  function submitForm(){
    $('.question').hide();
    var frm = $('#QuizForm');
    $("#QuizForm").submit(function(e) {
      e.preventDefault();
      $.ajax({
          type: frm.attr('method'),
          url: frm.attr('action'),
          data: frm.serialize(),
          success: function (data) {
              console.log('Submission was successful.');
              console.log(data);
          },
          error: function (data) {
              console.log('An error occurred.');
              console.log(data);
          },
      });
    });
    $('#totalRight').text(showCorrectAnswer());
    $('#result').show();
  }
  function beginQuiz(){
    $('#begin').hide();
    $('#section0').show();
    var fiveMinutes = {{$countdown_s}},
    display = document.querySelector('#time');
    startTimer(fiveMinutes, display);
  }
</script>
@endsection