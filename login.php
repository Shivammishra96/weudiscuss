<?php
session_start();
if(isset($_POST["logsubmit"])){  
  
if(!empty($_POST['user']) && !empty($_POST['pass'])) {  
    $user=$_POST['user'];  
    $pass=md5($_POST['pass']);  
  
    $con=mysqli_connect('localhost','id16888492_weudiscuss','O66y^>rlLpyEwBir') or die(mysql_error());  
    mysqli_select_db($con,'id16888492_wediscuss') or die("cannot select DB");  
  
    $query=mysqli_query($con,"SELECT * FROM login WHERE username='".$user."' AND password='".$pass."'");  
    $numrows=mysqli_num_rows($query);  
    
    if($numrows!=0)  
    {  
    while($row=mysqli_fetch_assoc($query))  
    {  
    $dbusername=$row['username'];  
    $dbpassword=$row['password']; 
    $sno=$row['sno']; 
    }  
  
    if($user == $dbusername && $pass == $dbpassword)  
    {  
    
    $_SESSION['sess_user']=$user;
    $_SESSION['loggedin']=true;
    $_SESSION['sno']=$sno;  
  
    /* Redirect browser */  
    header("Location:index.php"); 
    }  
    } else {  
    echo "Invalid username or password!";  
    }  
  
} else {  
    echo "All fields are required!";  
}  
}  
?>
<?php

echo '<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8 BOM">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <link rel="stylesheet" href="newlogin.css">
<script src="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
<script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
<!------ Include the above in your HEAD tag ---------->

</head>
<body>

<div class="sidenav">
         <div class="login-main-text">
            <h2>WEUDISCUSS<br> Login Page</h2>
            <p>Login or register from here to discuss.</p>
         </div>
      </div>
      <div class="main">
         <div class="col-md-6 col-sm-12">
            <div class="login-form">
               <form action="" method="POST">
                  <div class="form-group">
                     <label>User Name</label>
                     <input type="text" name="user" class="form-control" placeholder="User Name">
                  </div>
                  <div class="form-group">
                     <label>Password</label>
                     <input type="password" name="pass" class="form-control" placeholder="Password">
                  </div>
                  <button type="submit" name="logsubmit" class="btn btn-black">Login</button>
                  <p>Don"t have a account </p>
                  <p><a href="signup.php">Sign-Up</a> </p> 
                  
               </form>
            </div>
         </div>
      </div>'
?>

</body>  
</html>      