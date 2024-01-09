<?php
ob_start();
session_start();
if (isset($_SESSION["cp_user"])) {
    header("location: index_admin.php"); 
    exit();
}
?>

<?php 
// Parse the log in form if the user has filled it out and pressed "Log In"
if (isset($_POST["username"]) && isset($_POST["password"])) {
	
	//make sure the value of username and password not null
	if($_POST["username"]=="" && $_POST["password"]=="") 
	{
		$_SESSION['msg']="Please fill up username and password";
		header("location:login.php");
		exit();
	}

	$cp_user = preg_replace('#[^A-Za-z0-9]#i', '', $_POST["username"]); 
	// filter everything but numbers and letters
	
    $password = preg_replace('#[^A-Za-z0-9]#i', '', $_POST["password"]); 
	// filter everything but numbers and letters
	
    // Connect to the MySQL database  
    include ('../scripts/dbconnect.php');
	 
    $sql = mysql_query("SELECT id,user_status,name FROM users_tb WHERE user_login='$cp_user' AND user_pass='$password' LIMIT 1"); 
	
    // ------- MAKE SURE PERSON EXISTS IN DATABASE ---------
    $existCount = mysql_num_rows($sql); // count the row nums
    if ($existCount == 1) { // evaluate the count
	     while($row = mysql_fetch_array($sql))
		 { 
             $id = $row["id"];
			 $name = $row["name"];
			 $user_status = $row["user_status"]; 
		 }
		 
		 		 
		 $_SESSION["id"] = $id;
		 $_SESSION["cp_user"] = $cp_user;
		 $_SESSION["password"] = $password;
		 $_SESSION["user_status"] = $user_status;
		 $_SESSION["name"] = $name;
		 header("location:index_admin.php");
         exit();
    } 
	else 
	{
		$_SESSION['msg']="The username or password you enter is incorrect";
		header("location:login.php");
		exit();
	}
}
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" lang="pl" xml:lang="pl">
<head>
<meta http-equiv="content-type" content="text/html; charset=utf-8" />
<meta name="author" content="Paweł 'kilab' Balicki - kilab.pl" />
<title>Login Panel</title>
<link rel="stylesheet" type="text/css" href="css/login.css" media="screen" />
</head>
<body>
<div class="wrap">
	<div id="content">
		<div id="main">
			<div class="full_w">
            
            <div class="alert">
            Please login with your Username and Password. 
            </div>
            
				<form action="login.php" method="post">
					<label for="login">Username:</label>
					<input id="username" name="username" class="text" />
					<label for="pass">Password:</label>
					<input id="password" name="password" type="password" class="text" />
                    <?php if(isset($_SESSION['msg'])){ ?>
					<div class="n_error">
                    <p>
                    <?php 
					echo $_SESSION['msg'];
					unset($_SESSION['msg']); 
					?> 
                    </p>
                    </div>
                    <?php } ?>
                    <button type="submit" class="ok">Login</button>
					 <!--<a class="button" href="">Forgotten password?</a>-->
				</form>
			</div>
			<!--<div class="footer">&raquo; <a href="">http://yourpage.com</a></div>-->
		</div>
	</div>
</div>

</body>
</html>
<?php ob_end_flush(); ?>