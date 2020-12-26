<!DOCTYPE html>
<html>
<title>Ajax Without Refresh</title>
<head>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
</head>
<style>
div {
 background-color: aquamarine;
 width:350px;
}
</style>
<body>
<form id="loginform" method="post">
<input type="number" name="unique_code" id="uniqueID" value="" />
<button type="submit" class="refresher" onClick="myTimer = setInterval(incTimer, 1000)">Refresh Div</button>
</form>
<div class="card-body" id="timer">TIMER</div>
<div id="div-to-refresh">
<p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. </p>
</div>

<script type="text/javascript">
$(document).ready(function() {
    $('#loginform').submit(function(e) {
        e.preventDefault();
        $.ajax({
            type: "POST",
            url: 'http://localhost:8070/api/timers/',
            data: $(this).serialize(),
            success: function(response)
            {
                $('#div-to-refresh').html(response);
           }
       });
     });
});

function incTimer() {

var currentMinutes = Math.floor(totalSecs / 60);
var currentSeconds = totalSecs % 60;
if(currentSeconds <= 9) currentSeconds = "0" + currentSeconds;
if(currentMinutes <= 9) currentMinutes = "0" + currentMinutes;
totalSecs++;
$("#timer").text(currentMinutes + ":" + currentSeconds);
}

totalSecs = 1;

$(document).ready(function() {
$("#start").click(function() {
    incTimer();
});
});
</script>
</body>
</html>