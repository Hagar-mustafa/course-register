<!DOCTYPE html>
<?php
    $errors_arr[]=array();
    if(isset($_GET['error_fields'])){
        $errors_arr=explode(',',$_GET['error_fields']);
    }
    ?>
<html>
    <head>
        
    </head>
    <body>

        <form action="process2.php" method="post">
          <label for="name">Name:</label><br>
          <input type="text" id="name" name="name" >
          <?php if(in_array("name",$errors_arr)){
            echo "please enter your name";
          } ?>
          <br>
          <label for="email">Email:</label><br>
          <input type="email" id="email" name="email" >
          <?php if(in_array("email",$errors_arr)){
            echo "please enter your email";
          }?>
          <br>
          <label for="pass">Password</label><br>
          <input type="password" id="pass" name="pass">
          <?php if(in_array("pass",$errors_arr)){
            echo "please enter your password";
          }?>
          <br><br>
          <input type="submit" value="Submit">
        </form> 
        
       
    </body>
</html>