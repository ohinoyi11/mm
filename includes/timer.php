<?php
//session_start();

$takeexam = $_SESSION['id'];
$se = mysqli_query ($con,"SELECT * FROM timer WHERE student_id = '$takeexam'");
$rowse = mysqli_fetch_assoc($se);
$_SESSION['timerstudentid'] = $rowse['student_id'];
$_SESSION['duration'] = $rowse['duration'];
$duration = $_SESSION['duration'];
			$tim = $rowse['timer'];
			//No of Minute To Use
			$expected = 10;
			$dateFormat = "d F Y -- g:ia";
		// $targetDate = time() + (25*60);
		$targetDate = strtotime($rowse['timer']) + ($expected*60);

		// echo $targetDate;
		//Change the $expected to any minutes you want to countdown
$actualDate 			= time();
$secondsDiff 			= $targetDate - $actualDate;
$remainingDay     = floor($secondsDiff/60/60/24);
$remainingHour    = floor(($secondsDiff-($remainingDay*60*60*24))/60/60);
$remainingMinutes = floor(($secondsDiff-($remainingDay*60*60*24)-($remainingHour*60*60))/60);
$remainingSeconds = floor(($secondsDiff-($remainingDay*60*60*24)-($remainingHour*60*60))-($remainingMinutes*60));
$actualDateDisplay = date($dateFormat,$actualDate);
$targetDateDisplay = date($dateFormat,$targetDate);

			
			//echo $start.'<br>'.$used.'<br>'.$now.'<br>'.$expectedtime;	
				echo "
				<input type='hidden' value='$remainingDay' id='remainingDay'>
<input type='hidden' value='$remainingHour' id='remainingHour'>
<input type='hidden' value='$remainingMinutes ' id='remainingMinutes'>
<input type=\"hidden\" value=\"$remainingSeconds\" id=\"remainingSeconds\">
";

				
?>

<script src="./assets/js/jquery-3.2.1.min.js"></script>
<script type="text/javascript" src="assets/sweetalert.min.js"></script>


<script type="text/javascript">
  var days = $("#remainingDay").val();

  var hours = $("#remainingHour").val();

  var minutes = $("#remainingMinutes").val();
 
  var seconds =  $("#remainingSeconds").val();
function setCountDown()
{
  seconds--;
  if (seconds < 0){
      minutes--;
      seconds = 59
  }
  if (minutes < 0){
      hours--;
      minutes = 59
  }
  
  if (hours < 0){
      days--;
      hours = 23
  }
  $("#countdown").html(hours +":"+minutes+":"+seconds);
  	if(hours < 10){
  $("#countdown").html("0"+hours +":"+minutes+":"+seconds);
  	}
  	if(minutes < 10 && hours < 10){
  $("#countdown").html("0"+hours +":"+"0"+minutes+":"+seconds);
  	}
  	if(hours < 10 && minutes < 10 && seconds < 10){
  $("#countdown").html("0"+hours +":"+"0"+minutes+":"+"0"+seconds);
  	}
  	if (minutes < 2){
  		clearInterval(SD);
  		// window.location="hello.php";
  		$("#countdown").css({color:'red'});
  	}
 	
  if (minutes == '00' && seconds == '00') { 
  		 seconds = "00"; 
  		 clearInterval(SD);
   		//window.alert("Time is up. Press OK to continue."); // change timeout message as required
  		window.location = "timer.php" // Add your redirect url
 	} 

}
setCountDown;
var SD=setInterval( setCountDown, 1000 );


</script>
