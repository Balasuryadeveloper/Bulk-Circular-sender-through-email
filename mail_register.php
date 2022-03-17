<?php 
session_start();
$con=new mysqli("localhost","root","","email");
$sql="SELECT * FROM person";
$res=mysqli_query($con,$sql);
$row=mysqli_fetch_assoc($res);
extract($_REQUEST);
$name=$row['Name'];
$psw=$row['Password'];
if(!empty($_SESSION['Name']==$name and $_SESSION['Password']==$psw)){
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>New User</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
</head>
<body>
<?php 
include("navbar.php");
?>
    <div class="container mt-5">
<div class="card shadow-lg px-3 py-3">
<form class="row g-3" method="post" action="mail_register.php">
    <div class="my-2 bg-primary py-1">
        <h1 class="h5 text-light text-center">New User</h1>
    </div>
    <div class="col-md-6">
    <label for="" class="form-label">User Name <span class="text-danger">*</span></label>
    <input type="text" class="form-control" name="username"  placeholder="Enter Here" autocomplete="off">
  </div>
  <div class="col-md-6">
    <label for="inputEmail4" class="form-label">Email <span class="text-danger">*</span></label>
    <input type="email" class="form-control" name="email_id"  placeholder="Enter Here" autocomplete="off">
  </div>
  <div class="col-md-6">
    <label  class="form-label">Designation <span class="text-danger">*</span></label>
    <select name="designation" id="" class="form-select">
      <option>-- Select Option --</option>
      <option>HOD</option>
      <option>Faculties</option>
      <option>Students</option>
    </select>
  </div>
  <div class="col-6">
    <label for="dept" class="form-label">Department <span class="text-danger">*</span></label>
    <input type="text" class="form-control" name="dept" placeholder="Enter Here" autocomplete="off">
  </div>
  
  <div class="col-12">
    <button type="submit" class="btn btn-primary float-end" name="save">Save</button>
  </div>
</form>
</div>
    </div>
</body>
</html>
<?php
$con=new mysqli("localhost","root","","email");
if(isset($_POST['save']))
{
  $username=$_POST['username'];
  $email_id=$_POST['email_id'];
  $designation=$_POST['designation'];
  $dept=$_POST['dept'];
  $sql="INSERT INTO user(username, email_id, designation, dept) VALUES ('$username', '$email_id', '$designation', '$dept')";
  $res=mysqli_query($con,$sql);
  if($res)
  {
    echo "<script>alert('Successfully Inserted')</script>";
  }
  else
  {
    echo "<script>alert('Failed !!')</script>";
  }
}

?>
<?php
}
else{
    header("Location:index.php");
}
?>