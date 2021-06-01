<?php
session_start();

echo '<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">

    <title> Welcome to WeDiscuss-coding forum</title>
  </head>
  <style>
  .form-group-top{
      margin-top :6.5rem;
      
  }
  .container{
    min-height :655px
  }
  .hitman{
    margin-top:3.5rem;
  }
  </style>
  <body>
  

  <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
  <a class="navbar-brand" href="#">WeDiscuss</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav mr-auto">
      <li class="nav-item active">
        <a class="nav-link" href="index.php">Home <span class="sr-only">(current)</span></a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="#">About</a>
      </li>
      

       <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          Top Categories
        </a>
        
        <div class="dropdown-menu" aria-labelledby="navbarDropdown">';
        
       include 'partials/_dbconnect.php';
        $sql1= "SELECT categories_name,categories_id  FROM `categories`";
       $result1=mysqli_query($conn,$sql1);
       while($row1=mysqli_fetch_assoc($result1)){
         echo' <a class="dropdown-item" href="threadlist.php?catid='.$row1['categories_id'].'">'.$row1['categories_name'].'</a>';
       }
        
        echo '</div>
      </li>
      
      <li class="nav-item">
        <a class="nav-link " href="contact.php" tabindex="-1" >Contact</a>
      </li>
    </ul>
    <form class="form-inline my-2 my-lg-0">
      <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
      <button class="btn btn-success my-2 my-sm-0" type="submit">Search</button>
    </form>';
    
      
  
if(!isset($_SESSION["sess_user"])){  
  echo'<div class="mx-2">
  <a href="/idiscuss/login.php">
  <button id="login" class="btn btn-outline-success" >Login</button>
  </a>
  <a href="/idiscuss/signup.php">
  <button id="signup" class="btn btn-outline-success" >Sign Up</button>
  </a>
  </div>';  
}else{
  echo'
    <div class="mx-2">
    
    <button id="login" class="btn btn-outline-success" >'.$_SESSION['sess_user'].'</button>
    
    <a href="logout.php">
    <button id="signup" class="btn btn-outline-success" >logout</button>
    </a>
    </div>';
}

  echo'</div>
</nav>';


include 'partials/_dbconnect.php';
$method=$_SERVER['REQUEST_METHOD'];
if($method=='POST')
{
  $_email=$_POST['email'];
  $_name=$_POST['name'];
  $_phone=$_POST['phone'];
  $_message=$_POST['message'];
  $sql2="INSERT INTO `contact` (`sno`, `email`, `name`, `phone`, `message`, `timestamp`) VALUES (NULL, '$_email', '$_name', '$_phone', '$_message', current_timestamp())";
   $result=mysqli_query($conn,$sql2);
   if($result)
   {
   echo'<div class=" hitman alert alert-success alert-dismissible fade show " role="alert">
   <strong>SUCCESS!</strong> Your Querry is submitted.please wait for someone to respond.
   <button type="button" class="close" data-dismiss="alert" aria-label="Close">
     <span aria-hidden="true">&times;</span>
   </button>
 </div>';
   }
   else {
       echo'<div class=" hitman alert alert-success alert-dismissible fade show " role="alert">
   <strong>SUCCESS!</strong> Your Querry is submitted.please wait for someone to respond.
   <button type="button" class="close" data-dismiss="alert" aria-label="Close">
     <span aria-hidden="true">&times;</span>
   </button>
 </div>';
    die(mysqli_error($conn));
}
   
}

echo '<div class="container my-4">
<form action="'. $_SERVER['REQUEST_URI'].'" method="post" >
  <div class="form-group-top">
    <label for="exampleFormControlInput1">Email address</label>
    <input type="email" class="form-control" id="exampleFormControlInput1" name="email" placeholder="Your email" required>
  </div>
  <div class="form-group">
    <label for="exampleFormControlInput1">Name</label>
    <input type="text" class="form-control" id="exampleFormControlInput2" name="name" placeholder="Your name">
  </div>
  <div class="form-group">
    <label for="exampleFormControlInput1">Mobile no.</label>
    <input type="tel" class="form-control" id="exampleFormControlInput3" name="phone" placeholder="Your number "
     maxlength="10" required>
  </div>
  

  <div class="form-group">
    <label for="exampleFormControlTextarea1">Message</label>
    <textarea class="form-control" id="exampleFormControlTextarea1" rows="3" name="message" placeholder="Write your message.."></textarea >
  </div>
  <button type="submit" class="btn btn-primary">Submit</button>
</form>
  </div>';

?>
<?php include 'partials/footer.php';?>

    <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: jQuery and Bootstrap Bundle (includes Popper) -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>

    <!-- Option 2: jQuery, Popper.js, and Bootstrap JS
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.min.js" integrity="sha384-w1Q4orYjBQndcko6MimVbzY0tgp4pWB4lZ7lr30WKz0vr/aWKhXdBNmNb5D92v7s" crossorigin="anonymous"></script>
    -->
  </body>
</html>
