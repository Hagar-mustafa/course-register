<?php
  
if(! (isset($_POST['name'])&&!empty($_POST['name']))){
    $error_fields[]="name";
}
if(! (isset($_POST['email'])&& filter_input(INPUT_POST,'email',FILTER_VALIDATE_EMAIL))){
    $error_fields[]="email";
}
if(! (isset($_POST['pass'])&& strlen($_POST['pass'])>5)){
    $error_fields[]="pass";
}
if(isset($error_fields)){
    header("location: form.php?error_fields=".implode(",",$error_fields));
    exit;
}
$conn=mysqli_connect("localhost","root","01157447106Ab#","blog");
if(!$conn){
    echo mysqli_connect_error();
    exit;
}
$name = mysqli_real_escape_string($conn, $_POST['name']);
$email=mysqli_real_escape_string($conn,$_POST['email']);
$pass=mysqli_real_escape_string($conn,$_POST['pass']);
$query="insert into users (name,email,password) values ('$name','$email','$pass')";
if(mysqli_query($conn,$query)){
    echo "thank you your information has been saved";
}else{
    echo $query;
    echo mysqli_error($conn);
}
/*if(isset($_POST['fname'])&& !empty($_POST['fname'])){
    echo $_POST['fname'];
}else{
    echo "plz enyer your email";
}*/
mysqli_close($conn);
?>