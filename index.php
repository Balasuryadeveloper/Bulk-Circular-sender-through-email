<?php 
session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>Bulk Mail Sender  </title> <link rel="shortcut icon" type="image" href="gct1.png">
  <!-- plugins:css -->
  <link rel="stylesheet" href="menu/vendors/ti-icons/css/themify-icons.css">
  <link rel="stylesheet" href="menu/vendors/base/vendor.bundle.base.css">
  <!-- endinject -->
  <!-- plugin css for this page -->
  <!-- End plugin css for this page -->
  <!-- inject:css -->
  <link rel="stylesheet" href="menu/css/style.css">
  <!-- endinject -->
  <link rel="shortcut icon" href="menu/images/favicon.png" />
<script src="https://kit.fontawesome.com/15b077b312.js" crossorigin="anonymous"></script></head>

<body>
  <div class="container-scroller">
    <div class="container-fluid page-body-wrapper full-page-wrapper">
      <div class="content-wrapper d-flex align-items-stretch auth auth-img-bg">
        <div class="row flex-grow">
          <div class="col-lg-6 d-flex align-items-center justify-content-center">
            <div class="auth-form-transparent text-left p-3">
            
                <center><img src="1.png" alt="logo" height="100px" width="250px"></center>
              
              <center><h4 class="my-3">Welcome to Bulk Email Sender !</h4></center>
             
              <form class="pt-3" action="index.php" method="post">
                <div class="form-group">
                  <label for="Username"><b>Username</b></label>
                  <div class="input-group">
                    <div class="input-group-prepend bg-transparent">
                      <span class="input-group-text bg-transparent border-right-0">
                        <i class="ti-user text-primary"></i>
                      </span>
                    </div>
                    <input type="text" class="form-control form-control-lg border-left-0" id="Username" placeholder="Username" autocomplete="off" name="Name">
                  </div>
                </div>
                <div class="form-group">
                  <label for="exampleInputPassword"><b>Password</b></label>
                  <div class="input-group">
                    <div class="input-group-prepend bg-transparent">
                      <span class="input-group-text bg-transparent border-right-0">
                        <i class="ti-lock text-primary"></i>
                      </span>
                    </div>
                    <input type="password" class="form-control form-control-lg border-left-0" id="exampleInputPassword" autocomplete="off" placeholder="Password" name="Password">                        
                  </div>
                </div>
                
                <div class="my-3">
                  <button class="btn btn-block btn-primary float-end text-light" name="login">LOGIN</button>
                </div>
                
              </form>
            </div>
          </div>
          <div class="col-lg-6 login-half-bg d-flex flex-row">
            <p class="text-white font-weight-medium text-center flex-grow align-self-end">@ S Balasurya B.TECH (2020 - 2024)</p>
          </div>
        </div>
      </div>
      <!-- content-wrapper ends -->
    </div>
    <!-- page-body-wrapper ends -->
  </div>
  <!-- container-scroller -->
  <!-- plugins:js -->
  <script src="menu/vendors/base/vendor.bundle.base.js"></script>
  <!-- endinject -->
  <!-- inject:js -->
  <script src="menu/js/off-canvas.js"></script>
  <script src="menu/js/hoverable-collapse.js"></script>
  <script src="menu/js/template.js"></script>
  <script src="menu/js/todolist.js"></script>
  <!-- endinject -->
</body>

</html>
<?php 
$con=new mysqli("localhost","root","","email");
if(isset($_POST['login']))
{
    $name = $_POST['Name'];
    $psw = $_POST['Password'];
    $sql = "SELECT * FROM person WHERE Name='$name'and Password='$psw'";
    $result=mysqli_query($con,$sql);
    if(mysqli_num_rows($result)==0)
    {
        echo "<script>alert('User Name Or Password Is Wrong')</script>";
    }
    else
    {
      // $_SESSION['Name']=$name;
      // $_SESSION['Password']=$psw;
        echo "<script>window.location='email_sender.php'</script>" ;
    }
    $_SESSION['Name']=$name;
    $_SESSION['Password']=$psw;
}
?>

<?php
// error_reporting(E_ERROR | E_PARSE);
// $name = $_POST['Name'];
// $psw = $_POST['Password'];
// $_SESSION['Name']=$name;
// $_SESSION['Password']=$psw;
?>