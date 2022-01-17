<?php 
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link href="//netdna.bootstrapcdn.com/bootstrap/3.1.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <script src="//netdna.bootstrapcdn.com/bootstrap/3.1.0/js/bootstrap.min.js"></script>
    <script src="//code.jquery.com/jquery-1.11.1.min.js"></script>

    <title>Document</title>
</head>
<body>
    
<?php

if (isset($_POST['register'])) {
    $server = "localhost";
    $dbUsername = "root";
    $dbPassword = "";
    $dbName = "store";
    $email = $_POST['email'];
    $fname = $_POST['first_name'];
    $lname = $_POST['last_name'];
    $password = $_POST['password'];
    $repassword = $_POST['password_confirmation'];
    $regex = "/^[^ ]+@[^ ]+\.[a-z]{2,3}$/";
    $flag = false;
    if (preg_match($regex, $email) && strlen($password) >= 8 && $repassword === $password) {
        $conn = mysqli_connect($server,$dbUsername,$dbPassword,$dbName);
        if(!$conn){
            die("Connection failed: " . mysqli_connect_error());
        }

        $sql = "SELECT * FROM `users` WHERE `email`='".$email."'";
        $result = mysqli_query($conn,$sql);

        if(mysqli_num_rows($result)){
            exit("This email already exists");
        }

        $sqlInsert = "INSERT INTO `users` (`email`,`username`,`password`) VALUES ('$email','$fname','$password')";

        $resultInsert = mysqli_query($conn,$sqlInsert);

        if($result){
            echo "<h1> record added successfully </h1>";
            header('Location: login.php');
        }else{
            echo "Error: " . $sql . "<br>" . mysqli_error($conn);
        }

        mysqli_close($conn);
    }
}
?>
<?php 

if(isset($_POST["register"])){
$fname = $_POST['first_name'];
$lastname = $_POST['last_name'];
$email = $_POST['email'];
$password = $_POST['password'];
$passwordConfirm = $_POST['password_confirmation'];
$userinfo=array("fname"=>$fname,"lastname"=>$lastname,"email"=>$email,"password"=>$password,"passwordConfirm"=>$passwordConfirm);
if(strlen($fname)>5 && $password==$passwordConfirm && $password>5)
{
$_SESSION['users'][]=$userinfo;
header("Location:login.php");
    echo "<pre>";
    print_r($_SESSION) ;
    // session_destroy();
    echo "</pre>";
}}
?>
<div class="container" >
        <div class="row centered-form">
        <div class="col-xs-12 col-sm-8 col-md-4 col-sm-offset-2 col-md-offset-4">
        	<div class="panel panel-default">
        		<div class="panel-heading">
			    		<h3 class="panel-title">Please sign up<small>It's free!</small></h3>
			 			</div>
			 			<div class="panel-body">
			    		<form role="form"  method="post">
			    			<div class="row">
			    				<div class="col-xs-6 col-sm-6 col-md-6">
			    					<div class="form-group">
			                <input type="text" name="first_name" id="first_name" class="form-control input-sm" placeholder="First Name">
                                    
			    					</div>
			    				</div>
			    				<div class="col-xs-6 col-sm-6 col-md-6">
			    					<div class="form-group">
			    						<input type="text" name="last_name" id="last_name" class="form-control input-sm" placeholder="Last Name">
			    					</div>
			    				</div>
			    			</div>

			    			<div class="form-group">
			    				<input type="email" name="email" id="email" class="form-control input-sm" placeholder="Email Address">
			    			</div>

			    			<div class="row">
			    				<div class="col-xs-6 col-sm-6 col-md-6">
			    					<div class="form-group">
			    						<input type="password" name="password" id="password" class="form-control input-sm" Onkeyup=handle() placeholder="Password">
                                        <small id='pass1-error'></small>
			    					</div>
			    				</div>
			    				<div class="col-xs-6 col-sm-6 col-md-6">
			    					<div class="form-group">
			    						<input type="password" name="password_confirmation" id="password_confirmation" Onkeyup=handle() class="form-control input-sm" placeholder="Confirm Password">
                                        <small id='pass2-error'></small>
                                    </div>
			    				</div>
			    			</div>
			    			
			    			<input type="submit" name="register" value="Register" class="btn btn-info btn-block" >
			    		
			    		</form>
			    	</div>
	    		</div>
    		</div>
    	</div>
    </div>
    <script>
        function handle (){
        let    pass1=document.getElementById('password');
        let    pass2=document.getElementById('password_confirmation');
        let      password1=document.getElementById('pass1-error');
        let     password2=document.getElementById('pass2-error');
        if(pass1.length <5)
        {   password1.style.color="red";
            password1.style.display="block";
            password1.innerHTML='password too short';
            
        }
         if(pass1.value != pass2.value)
        {   password1.style.color="red";
            password2.style.color="red";
            password1.style.display="block";
            password2.style.display="block";
            password1.innerHTML='passwords not match';
            password2.innerHTML='passwords not match';
        }
        else {
            password1.style.display="none";
            password2.style.display="none";
        }
        }
    </script>
    
</body>
</html>