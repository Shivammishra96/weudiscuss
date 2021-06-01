<?php
session_start(); 
  include 'partials/_dbconnect.php';
  //SELECT * FROM `categories` WHERE `categories_id`=1;
$id=$_GET['threadid'];
$sql="SELECT * FROM `threads` WHERE thread_id=$id";
$result=mysqli_query($conn,$sql);
while($row=mysqli_fetch_assoc($result))
{
  $title=$row['thread_title'];
  $desc=$row['thread_desc'];
  $thread_user_id=$row['thread_user_id'];
  $sql2="SELECT username FROM `login` WHERE sno=$thread_user_id";
  $result2=mysqli_query($conn,$sql2);
  $row2=mysqli_fetch_assoc($result2);
  $postby=$row2['username'];
}
  
 
echo'<!doctype html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css"
    integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
    <style>
      #ques{
          min-height:400px;
      }
    </style>

  <title> Welcome to WeDiscuss-coding forum</title>
</head>

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
    <form class="form-inline my-2 my-lg-0" method="get" action="search.php">
      <input class="form-control mr-sm-2" name="search" type="search" placeholder="Search" aria-label="Search">
      <button class="btn btn-success my-2 my-sm-0" type="submit">Search</button>
    </form>';
    
      
 
if(!isset($_SESSION["sess_user"])){  
  echo'<div class="mx-2">
  <a href="login.php">
  <button id="login" class="btn btn-outline-success" >Login</button>
  </a>
  <a href="signup.php">
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
    ?>
  </div>
</nav>

  <?php
  if(isset($_SESSION["sess_user"]) && $_SESSION['loggedin']=true){
   $method=$_SERVER['REQUEST_METHOD'];
   if($method=='POST')
   {
     $_comment=$_POST['comment'];
     $sno=$_POST['sno'];
     
   
   $sql="INSERT INTO `comments` ( `comment_desc`, `thread_id`, `user_id`, `comment_time`) VALUES ( '$_comment', '$id', '$sno', current_timestamp())";
   $result=mysqli_query($conn,$sql);
   if($result)
   echo'<div class="alert alert-success alert-dismissible fade show" role="alert">
   <strong>SUCCESS!</strong> Your Comment has been posted.
   <button type="button" class="close" data-dismiss="alert" aria-label="Close">
     <span aria-hidden="true">&times;</span>
   </button>
 </div>';
   }
  }
   ?>

  <div  class="container my-4">
    <div class="jumbotron">
      <h1 class="display-4"><?php echo $title; ?> </h1>
      <p class="lead"><?php echo $desc; ?></p>
      <hr class="my-4">
      <p>This is forum for sharing knowledge in between.No Spam / Advertising / Self-promote in the forums. ...
        Do not post copyright-infringing material. ...
        Do not post “offensive” posts, links or images.Remain respectful of other members at all times.</p>
      <p>Posted by: <b><?php echo $postby;?></b></p>
    </div>

  </div>
  <?php
  
  if(isset($_SESSION["sess_user"]) && $_SESSION['loggedin']=true){
  echo '<div class="container">
    <h2 class="py-2">Post a Comment</h2>
    <form action="'. $_SERVER['REQUEST_URI'] .'" method="post">
      
        <div class="form-group">
          <label for="exampleFormControlTextarea1">Type your comment</label>
          <textarea class="form-control" id="comment" name="comment" rows="3"></textarea>
        </div>
        <input type="hidden" name="sno" value="'. $_SESSION['sno'].'">
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>

  </div>';
  }
  else{
    echo'<div class="container">
    <h2 class="py-2">Post a Comment</h2>
    <p class="lead">You are not Logged in.Please Log in to comment</p>
    
    </div>';
  }
  ?>

  <div id="ques"  class="container ">
    <h2 class="py-2">Discussions</h2>
   
    <?php
  include 'partials/_dbconnect.php';
  //SELECT * FROM `categories` WHERE `categories_id`=1;
$id=$_GET['threadid'];
$sql="SELECT * FROM `comments` WHERE thread_id=$id";
$result=mysqli_query($conn,$sql);
$noresult=true;
while($row=mysqli_fetch_assoc($result))
{
  $noresult=false;
 $id=$row['comment_id'];
 $desc=$row['comment_desc'];
 $user_id=$row['user_id'];
 $time=$row['comment_time'];

 $sql2="SELECT * FROM `login` WHERE sno='$user_id'";
 $result2=mysqli_query($conn,$sql2);
 $row2=mysqli_fetch_assoc($result2);
 


   echo ' <div class="media my-3">
      <img src="img/userdefault.jpg" width="34px" class="mr-3" alt="...">
      <div class="media-body">
      <p class="font-weight-bold my-0">'. $row2['username'].'</p>
      '.$desc.'
      </div><p ><b> at </b>'.$time.'.</p>
    </div>';

  }
   if($noresult)
   echo '<div class="jumbotron jumbotron-fluid">
   <div class="container">
     <h1 class="display-4">No Comments Found</h1>
     <p class="lead">Be the First person to comment.</p>
   </div>
 </div>';
  ?>

  </div>
  


  <?php include 'partials/footer.php';?>

  <!-- Optional JavaScript; choose one of the two! -->

  <!-- Option 1: jQuery and Bootstrap Bundle (includes Popper) -->
  <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"
    integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj"
    crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx"
    crossorigin="anonymous"></script>

  <!-- Option 2: jQuery, Popper.js, and Bootstrap JS
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.min.js" integrity="sha384-w1Q4orYjBQndcko6MimVbzY0tgp4pWB4lZ7lr30WKz0vr/aWKhXdBNmNb5D92v7s" crossorigin="anonymous"></script>
    -->
   
</body>

</html>
