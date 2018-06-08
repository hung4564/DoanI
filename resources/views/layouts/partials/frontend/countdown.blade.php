<span id="time">01:00</span>


@section('footer-extras')
@parent
<script>
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
window.onload = function () {
    var fiveMinutes = 60 * 0.1,
    display = document.querySelector('#time');
    startTimer(fiveMinutes, display);
};
</script>
@endsection