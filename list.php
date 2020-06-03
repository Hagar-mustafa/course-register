
<?php
   $conn=mysqli_connect("localhost","root","01157447106Ab#","blog");
if(!$conn){
   echo mysqli_connect_error();
   exit;
}
$query="select * from users";

if(isset($_GET['search'])){
   $search=mysqli_real_escape_string($conn,$_GET['search']);
   $query.=" WHERE name LIKE '%".$search."%' OR email LIKE '%".$search."%'";
}
    
$result=mysqli_query($conn,$query);
?>
<html>
  <head>
      <title>
          Admin::list users
      </title>
      <body>
            <form method="GET">
               <input type="text" name="search" placeholder="enter your name or pass">
               <input type="submit" value="search">
            </form>
          <table>
              <thead>
                  <tr>
                      <th>ID</th>
                      <th>Name</th>
                      <th>Email</th>
                      <th>Admin</th>
                      <th>Action</th>
                  </tr>
              </thead>
              <?php
              while($row = mysqli_fetch_assoc($result)){
               ?>
              <tr>
                  <td><?=$row['Id']?></td>
                  <td><?=$row['name']?></td>
                  <td><?=$row['email']?></td>
                  <td><?= ($row['admin'])? 'yes':'no'?></td>
                  <td><a href="edit.php?id=<?=$row['Id']?>"> Edit</a>|<a href="delete.php?id<?=$row['Id']?>">Delete</a></td>
              </tr>
              <?php
              }
              ?>
               <tfoot>
                  <tr>
                      <td colspan="2" style="text-align: center;" ><?= mysqli_num_rows($result)?></td>
                      <td colspan="3" style="text-align: center;"><a href="add.php">Add user</a></td>
                  </tr>
              </tfoot>
              
              
          </table>
      </body>
  </head>  
</html>