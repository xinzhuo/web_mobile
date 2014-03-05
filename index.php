<?php
session_start();

// Your database info
$db_host = 'stardock.cs.virginia.edu';
$db_user = 'cs4720sz4fb';
$db_pass = 'zsh210';
$db_name = 'cs4720sz4fb';
$db_table= 'projectuser';

session_start();

$error_msg = "";

if(!isset($_SESSION['user_id'])){
    if(isset($_POST['submit'])){
        $dbc = mysqli_connect($db_host, $db_user, $db_pass, $db_name);
        $user_username = mysqli_real_escape_string($dbc,trim($_POST['username']));
        $user_password = mysqli_real_escape_string($dbc,trim($_POST['password']));

        if(!empty($user_username)&&!empty($user_password)){
          
            $query = "SELECT * FROM projectuser WHERE username = '$user_username' AND "."password = '$user_password'";
            $data = mysqli_query($dbc,$query);

            
            if(mysqli_num_rows($data)==1){
                $row = mysqli_fetch_array($data);
                $_SESSION['user_id']=$row['u_id'];
                $_SESSION['username']=$row['username'];
		$_SESSION['nickname']=$row['nickname'];
                setcookie('user_id',$row['u_id'],time()+(60*60*24*30));
                setcookie('username',$row['username'],time()+(60*60*24*30));
                setcookie('nikename',$row['nikename'],time()+(60*60*24*30));
		$home_url = 'project2.php';
                header('Location: '.$home_url);
            }else{
                $error_msg = 'Sorry, you must enter a valid username and password to log in.';
            }
        }else{
            $error_msg = 'Sorry, you must enter a valid username and password to log in.';
        }
    }
}else{
    $home_url = 'project2.php';
    header('Location: '.$home_url);
}
?>
<html>
    <head>
        <title>Log In</title>
        <link rel="stylesheet" type="text/css" href="style.css">
    </head>

    <body>
        <h3>GRE Vocab Questions</h3>
      
        <?php
        if(!isset($_SESSION['user_id'])){
            echo '<p class="error">'.$error_msg.'</p>';
        ?>

        <form method = "post" action="<?php echo $_SERVER['PHP_SELF'];?>">
            <fieldset>
                <legend>Log In</legend>

                <label for="username">E-mail: &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</label>
                <input type="text" id="username" name="username"
                value="<?php if(!empty($user_username)) echo $user_username; ?>" />

                <br/>

                <label for="password">Password:</label>
                <input type="password" id="password" name="password"/>

            </fieldset>
            <input type="submit" value="Log In" name="submit"/>
        </form>
	
	<form action="adduser.php" method="get">
	<fieldset>
	<legend>New User</legend>
	Nickname: <input type="text" name="name" size="15">
	<br>
	E-mail: &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <input type="text" name="email" size = "15">
	<br>
	Password: &nbsp; <input type="password" name="password" size = "15">
	</fieldset>
	<input type="submit">
	</form>	

	<?php
        }
        ?>

    </body>
</html>



