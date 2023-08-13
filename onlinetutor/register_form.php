  
<?php

@include 'config.php';

if(isset($_POST['submit'])){


      
   $name = mysqli_real_escape_string($conn, $_POST['name']);
   $email = mysqli_real_escape_string($conn, $_POST['email']);
   $pass = $_POST['password'];
   $usertype = $_POST['usertype'];

   $select = " SELECT * FROM userform WHERE email = '$email' && password = '$pass'";
 
   $result = mysqli_query($conn, $select);

       if(mysqli_num_rows($result) > 0){

      $error[] = 'user already exist!';

   }else{
         $insert = "INSERT INTO userform(name, email, password, usertype) VALUES('$name','$email','$pass','$usertype')";
         mysqli_query($conn, $insert);
         header('location:login_form.php');
      }
       
};
?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>register form</title>

   <link rel="stylesheet" href="css/style.css">
<style>
.error-msg{
   margin:10px 0;
   display: block;
   background:#992bff;
   color:#fff;
   border-radius: 5px;
   font-size: 20px;
   padding:10px;
}
   </style>
</head>
<body>
     
<div class="container" id="container">
   <div class="form-container sign-in-container">
   <form action="" method="post">
      <h2><b>Register now</b></h2><br>
      <?php
      if(isset($error)){
         foreach($error as $error){
            echo '<span class="error-msg">'.$error.'</span>';
         };
      };
      ?>
      <input type="text" name="name" required placeholder="enter your name">
      <input type="email" name="email" required placeholder="enter your email">
      <input type="password" name="password" required placeholder="enter your password">
      <select name="usertype">
         <option value="user">USER</option>
         <option value="admin">TEACHER</option>
      </select>
      <input type="submit" name="submit" value="Register" class="formbtn">
      <p>already have an account? <a href="login_form.php">login now</a></p>
    </form>
   </div>
    <div class="overlay-container">
		 <div class="overlay">
			 <div class="overlay-panel overlay-right">
				<h1>Hello, Friend!</h1>
				<p>Enter your personal details and start journey with us</p>
			 </div>
		 </div>
	 </div>
 </div>
 <script src="sign.js"></script>
</div>
</body>
</html>