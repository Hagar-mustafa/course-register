<?php
$error_fields=array();
if ($_SERVER["REQUEST_METHOD"] == "POST"){
  
if(! (isset($_POST['name'])&&!empty($_POST['name']))){
    $error_fields[]="name";
}
if(! (isset($_POST['email'])&& filter_input(INPUT_POST,'email',FILTER_VALIDATE_EMAIL))){
    $error_fields[]="email";
}
if(! (isset($_POST['pass'])&& strlen($_POST['pass'])>5)){
    $error_fields[]="pass";
}
if(!$error_fields){
    $conn=mysqli_connect("localhost","root","01157447106Ab#","blog");
    if(!$conn){
        mysqli_connect_error();
        exit;
    }
    $name=mysqli_real_escape_string($conn,$_POST['name']);
    $Email=mysqli_real_escape_string($conn,$_POST['email']);
    //$password=$_POST['password'];
    $password=mysqli_real_escape_string($conn,$_POST['pass']);
    $admin=(isset($_post['admin']))? 1 : 0 ;
    $query="insert into `users`(name,email,password,admin) values ('$name','$Email','$password','$admin')";
    if(mysqli_query($conn,$query)){
        header("location: list.php");
        exit;
    }else{
        echo mysqli_error($conn);
    }
    mysqli_close($conn);
}
}
?>
<html>
    <head>
        
    </head>
    <body>


        <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
          <label for="name">Name:</label><br>
          <input type="text" id="name" name="name" value="<?=(isset($_post['name']))?$_post['name']:''?>" >
          <?php if(in_array("name",$error_fields)){
            echo "please enter your name";
          } ?>
          <br>
          <label for="email">Email:</label><br>
          <input type="email" id="email" name="email" value="<?=(isset($_post['email']))?$_post['email']:''?>">
          <?php if(in_array("email",$error_fields)){
            echo "please enter your email";
          }?>
          <br>
          <label for="pass">Password</label><br>
          <input type="password" id="pass" name="pass" >
          <?php if(in_array("pass",$error_fields)){
            echo "please enter your password";
          }?>
          <br>
          <input type="checkbox" name="admin" value="<?=(isset($_post['admin']))? 'Checked':''?> ">
          <br>
          <input type="submit" value="Add user">
        </form> 
        
       
    </body>
</html>