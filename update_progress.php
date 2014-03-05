<?php
$user_id = $_COOKIE['user_id']	;
#echo $_POST["identifier"];
$con=mysqli_connect("stardock.cs.virginia.edu","cs4720sz4fb","zsh210","cs4720sz4fb");
if ($_POST["identifier"]=="next"){
   $id_result=mysqli_query($con, "SELECT question_num FROM projectuser WHERE u_id='$user_id'");
   				 $row = mysqli_fetch_row($id_result);
				      $max = mysqli_query($con, "SELECT COUNT(question_num) FROM projectuser");
		 $temp = $row[0] + 1;
		if ($row[0]<5){
		mysqli_query($con, "UPDATE projectuser SET question_num='$temp' WHERE u_id='$user_id'");
									   }
									   }
									   elseif ($_POST["identifier"]=="last") {
									   	  $id_result=mysqli_query($con, "SELECT question_num FROM projectuser WHERE u_id='$user_id'");
										  				$row = mysqli_fetch_row($id_result);
														     $temp = $row[0] - 1;
														     	   if ($row[0]>1){
															       mysqli_query($con, "UPDATE projectuser SET question_num='$temp' WHERE u_id='$user_id'");
															       			  }
																		  }
																		  header('Location: project2.php');
																		  die();
																		  ?>