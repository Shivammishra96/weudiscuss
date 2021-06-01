<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Signup</title>
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
         <a href="index.php" class="btn btn-primary btn-lg active" role="button" aria-pressed="true">Home</a>
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
                  <button type="submit" name="regsubmit" class="btn btn-secondary">Register</button>
                  <p>Log in to your account</p>
                  <button class="btn btn-black"> <a href="login.php">Login</a></button>
               </form>
            </div>
         </div>
      </div>    
<?php    
if(isset($_POST["regsubmit"])){    
if(!empty($_POST['user']) && !empty($_POST['pass'])) {    
    $user=$_POST['user'];    
    $pass=md5($_POST['pass']);    
    $con=mysqli_connect('localhost','id16888492_weudiscuss','O66y^>rlLpyEwBir') or die(mysql_error());    
    mysqli_select_db($con,'id16888492_wediscuss') or die("cannot select DB");    
    
    $query=mysqli_query($con,"SELECT * FROM login WHERE username='".$user."'");    
    $numrows=mysqli_num_rows($query);    
    if($numrows==0)    
    {    
    $sql="INSERT INTO login(username,password) VALUES('$user','$pass')";    
    
    $result=mysqli_query($con,$sql);    
        if($result){    
    echo'<div class="main"><p>Account Successfully Created</p></div>';
    ;    
    } else {  
        echo'<div class="main"><p>Failure!</p></div>';
      
    }    
    
    } else {  
        echo'<div class="main"><p>That username already exists! Please try again with another.</p></div>';
       
    }    
    
} else { 
    echo'<div class="main"><p>All fields are required!</p></div>';
        
}    
}    
?>    
</body>    
</html>  