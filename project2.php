<?php

session_start();

if (!isset($_COOKIE['username'])){
 echo "You should go play Dota2 now.";
 exit;
}

if(!isset($_SESSION['user_id'])){
    if(isset($_COOKIE['user_id'])&&isset($_COOKIE['username'])){
       
        $_SESSION['user_id']=$_COOKIE['user_id'];
		$_SESSION['username']=$_COOKIE['username'];
        $_SESSION['nickname']=$_COOKIE['nickname'];
    }
}

if(isset($_SESSION['username'])){
    echo 'You are Logged as '.$_SESSION['username'].'<br/>';
    echo '<a href="project3.php"> Log Out('.$_SESSION['username'].')</a>';
}

?>

<!DOCTYPE html>
<html>
<body>

<script>
function getVote(int, id)
{
if (window.XMLHttpRequest)
  {// code for IE7+, Firefox, Chrome, Opera, Safari
  xmlhttp=new XMLHttpRequest();
  }
else
  {// code for IE6, IE5
  xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
  }
xmlhttp.onreadystatechange=function()
  {
  if (xmlhttp.readyState==4 && xmlhttp.status==200)
    {
    document.getElementById("poll").innerHTML=xmlhttp.responseText;
    }
  }
xmlhttp.open("GET","answer_check.php?vote="+int+"&id="+id,true);
xmlhttp.send();
}
</script>


<?php
$con=mysqli_connect("stardock.cs.virginia.edu","cs4720sz4fb","zsh210","cs4720sz4fb");
// Check connection
if (mysqli_connect_errno())
{
	echo "Failed to connect to MySQL: " . mysqli_connect_error();
}
else{
    $user_id = $_COOKIE['user_id'];
    $id_result = mysqli_query($con, "SELECT question_num FROM projectuser WHERE u_id='$user_id'");
    $row = mysqli_fetch_row($id_result);

    $question_result = mysqli_query($con, "SELECT * FROM projectquestion WHERE q_id='$row[0]'");
    $counter = 0;

    while($row = mysqli_fetch_array($question_result)){
    	       echo "<p>"."(" .$row['q_id']. ") ". $row['question_text']. "</p>";
  	       	    echo "A: ". $row['choiceA'];
  		    	 echo "<br>";
  			      echo "B: ". $row['choiceB'];
  			      	   echo "<br>";
  				   	echo "C: ". $row['choiceC'];
  					     echo "<br>";
  					     	  echo "D: ". $row['choiceD'];
  						       echo "<br>";
  						       	    echo "E: ". $row['choiceE'];
  							    	 echo "<br>";
  								      $current_id = $row['q_id'];
  								      		  if ($counter == 0){
  										     	       break;
												}
  												}
}


mysqli_close($con);

?>
<div id="poll">
<form>
Choose A: 
<input type="radio" name="vote" value="1" onclick="getVote(this.value, <?php echo $current_id; ?>)">
B:
<input type="radio" name="vote" value="2" onclick="getVote(this.value, <?php echo $current_id; ?>)">
C:
<input type="radio" name="vote" value="3" onclick="getVote(this.value, <?php echo $current_id; ?>)">
D:
<input type="radio" name="vote" value="4" onclick="getVote(this.value, <?php echo $current_id; ?>)">
E:
<input type="radio" name="vote" value="5" onclick="getVote(this.value, <?php echo $current_id; ?>)">
</form>
</div>


<form method="post" action="update_progress.php">
  <input type="submit" name="identifier" value="last">
</form>
<form method="post" action="update_progress.php">
  <input type="submit" name="identifier" value="next">
</form>


<div id="output">

<a href="vocab.php" target="_blank">suck it</a>


</div>

</body>
</html>