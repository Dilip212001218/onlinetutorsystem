<?php

@include 'config.php';

session_start();

if(isset($_POST['submit'])){

    
   $email = mysqli_real_escape_string($conn, $_POST['email']);
   $pass = $_POST['password'];
   $select = " SELECT * FROM userform WHERE email = '$email' && password = '$pass' ";

   $result = mysqli_query($conn, $select);
   
   if(mysqli_num_rows($result) > 0){

      $row = mysqli_fetch_array($result);
      $_SESSION['id'] = $row['id'];
      if($row['usertype'] == 'admin'){
         
         $_SESSION['name'] = $row['name'];
         $_SESSION['admin_name'] = $row['name'];
         $_SESSION['admin_id'] = $row['id'];
         $_SESSION['user'] = $row['usertype'];
         header('location:admin.php');

      }elseif($row['usertype'] == 'user'){
          
         $_SESSION['name'] = $row['name'];
         $_SESSION['user_name'] = $row['name'];
         $_SESSION['user_id'] = $row['id'];
         $_SESSION['user'] = $row['usertype'];
         header('location:home.php');
      }
   }else{
      $error[] = 'incorrect email or password!';
   }
};
?>
<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>login form</title>
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
      <h1>Login</h1><br><br><br>
      <?php
      if(isset($error)){
         foreach($error as $error){
            echo '<span class="error-msg">'.$error.'</span>';
         };
      };
      ?>
      <input type="email" name="email" required placeholder="enter your email">
      <input type="password" name="password" required placeholder="enter your password">
      <input type="submit" name="submit" value="login now" class="formbtn">
    </form>
    </div>
    <div class="overlay-container">
		 <div class="overlay">
			 <div class="overlay-panel overlay-right">
          <h1>Welcome Back!</h1>
				<p>To keep connected with us please login with your personal info</p>
			 </div>
		 </div>
    </div>
 </div>
</div>
</body>
</html>
 