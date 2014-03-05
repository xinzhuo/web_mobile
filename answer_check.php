<?php
$vote = $_REQUEST['vote'];
$questionId = $_REQUEST['id'];

$con=mysqli_connect("stardock.cs.virginia.edu","cs4720sz4fb","zsh210","cs4720sz4fb");
// Check connection
if (mysqli_connect_errno())
{
	echo "Failed to connect to MySQL: " . mysqli_connect_error();
	}
	else{
		$result= mysqli_query($con, "SELECT answer FROM projectquestion WHERE q_id='$questionId'");
		  	 $row = mysqli_fetch_row($result);
			      if ($row[0]== $vote){
			         	    echo "Your answer is correct";
					      	 }
							else{
									$display;
											if ($row[0]==1){
													$display='A';
															}
															    elseif ($row[0]==2) {
															      	   		 $display='B';
																		     }
																		         elseif ($row[0]==3) {
																			   		      $display='C';
																					          }
																						      elseif ($row[0]==4) {
																						             		   $display='D';
																									       }
																									           elseif ($row[0]==5) {
																										     	  	        $display='E';
																													    }
																													        echo "Your answer is incorrect, the correct answer is: ". $display;
   
																														     }
																														     }
																														     mysqli_close($con);
																														     ?>