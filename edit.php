<?php
$error_fields=array();
$conn=mysqli_connect("localhost","root","01157447106Ab#","blog");
if(!$conn){
    echo mysqli_connect_error();
    exit;
}
$id=filter_input(INPUT_GET,'id',FILTER_SANITIZE_NUMBER_INT);
$select="select * from `users` where id=".$id;
$result=mysqli_query($conn,$select);
$row = mysqli_fetch_assoc($result);


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
        $id=filter_input(INPUT_GET,'id',FILTER_SANITIZE_NUMBER_INT);
        $name=mysqli_real_escape_string($conn,$_POST['name']);
        $Email=mysqli_real_escape_string($conn,$_POST['email']);
        //$password=$_POST['password'];
        $password=mysqli_real_escape_string($conn,$_POST['pass']);
        $admin=(isset($_post['admin']))? 1 : 0 ;
        $query="update `users` set name=".$name." email=".$Email." password=".$password." admin=".$admin." where id=" .$id;
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
          <input type="text" id="name" name="name" value="<?=(isset($row['name']))?$row['name']:''?>" >
          
          <?php if(in_array("name",$error_fields)){
            echo "please enter your name";
          } ?>
          <input type="hidden" name="id" id="id" value ="<?=(isset($row['id'])) ? $row['id'] :'' ?> ">
          <br>
          <label for="email">Email:</label><br>
          <input type="email" id="email" name="email" value="<?=(isset($row['email']))?$row['email']:''?>">
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
          <input type="checkbox" name="admin" <?=(isset($row['admin']))? 'checked':''?>>
          <br>
          <input type="submit" value="EDIT user">
        </form> 
        
       
    </body>
</html>