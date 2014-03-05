
<?php

 $con1=mysqli_connect("stardock.cs.virginia.edu","cs4720sz4fb","zsh210","cs4720sz4fb");
 if (mysqli_connect_errno())
 {
	echo "Failed to connect to MySQL: " . mysqli_connect_error();
 } 
 
 $u_id = $_COOKIE['user_id'];
  $find = mysqli_query($con1, "SELECT question_num FROM projectuser where u_id = '$u_id' ");
 $lich=mysqli_fetch_array($find);
 $num = $lich['question_num'];
   $sample = mysqli_query($con1, "SELECT DISTINCT word, speech, definition, otherform, synonym FROM projectquestion NATURAL JOIN projectvocab where qn = $num");


  $i = 1;
  while($row=mysqli_fetch_array($sample)){

        $response[$i]['word']=$row['word'];
        $response[$i]['speech']=$row['speech'];
        
	$response[$i]['definition']=$row['definition'];
        $response[$i]['otherform']=$row['otherform'];

	$response[$i]['synonym']=$row['synonym'];
	
        $i = $i+1;
        }
    
  $tmp = json_encode($response);
  echo $tmp;




?>