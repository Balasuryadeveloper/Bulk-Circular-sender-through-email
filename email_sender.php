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
    <title>Email Sender</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
</head>
<body>
<?php 
include("navbar.php");
?>
    <div class="container mt-2">
        
            <form action="email_sender.php" method="post" enctype="multipart/form-data" class="row g-3 shadow-lg mt-3 py-2 px-3">
                <div class="my-2 bg-primary py-2">
                    <h1 class="h3 text-light text-center">Send Mail</h1>
                </div>
                <div class="form-group col-md-6 col-sm-12 mb-2">
                    <label class="mb-2" for="name">User Name <span class="text-danger">*</span></label>
                    <input type="text" name="username" class="form-control" required autocomplete="off" placeholder="Enter Here">
                </div>
                <div class="form-group col-md-6 col-sm-12 mb-2">
                    <label class="mb-2" for="Email Id">Email Id <span class="text-danger">*</span></label>
                    <input type="email" name="email_id" class="form-control" required autocomplete="off" placeholder="Enter Here">
                </div>
                <div class="form-group col-md-6 col-sm-12 mb-2">
                    <label class="mb-2" for="label">Label <span class="text-danger">*</span></label>
                    <input type="text" name="label" class="form-control" required autocomplete="off" placeholder="Enter Here">
                </div>
                <div class="form-group col-md-6 col-sm-12 mb-2">
                    <label class="mb-2" for="subject">Subject <span class="text-danger">*</span></label>
                    <input type="text" name="subject" class="form-control" required autocomplete="off" placeholder="Enter Here">
                </div>
                <div class="form-group col-md-12 col-sm-12 mb-2">
                    <label class="mb-2" for="Content">Content <span class="text-danger">*</span></label>
                    <textarea name="Content" class="form-control" required autocomplete="off" placeholder="Enter Here" cols="30" rows="5"></textarea>
                </div>
                
                <div class="form-group col-md-12 col-sm-12 mb-2">
                    <input type="file" name="file" class="form-control" accept=".pdf">
                </div>
                <div class="form-group col-md-6 col-sm-12 mb-2">
                        <!-- <input type="checkbox" name="circular_for[]" value="all">
                        All -->
                        <input type="checkbox" name="circular_for[]" value="HOD" class="mx-2">
                        HOD
                        <input type="checkbox" name="circular_for[]" value="Faculties" class="mx-2">
                        Faculties
                        <input type="checkbox" name="circular_for[]" value="Students" class="mx-2">
                        Students
                    </div>
                    <div class="form-group col-md-6 col-sm-12 mb-2">
                       <button class="btn btn-primary float-end" name="submit">Submit</button>
                       <br><br>
                    </div>
            </form>
    </div>
</body>
</html>

<?php
$con=new mysqli("localhost","root","","email");
// $sql="SELECT * FROM user";
// $res=mysqli_query($con,$sql);
if(isset($_POST['submit']))
{
require 'PHPMailerAutoload.php';
$username=$_POST['username'];
$email_id=$_POST['email_id'];
$label=$_POST['label'];
$subject=$_POST['subject'];
$filepath=realpath($_FILES['file']['tmp_name']);
$Content=$_POST['Content'];
$mail = new PHPMailer;

$mail->SMTPDebug = 4;                               // Enable verbose debug output

$mail->isSMTP();                                      // Set mailer to use SMTP
$mail->Host = 'smtp.gmail.com';  // Specify main and backup SMTP servers
$mail->SMTPAuth = true;                               // Enable SMTP authentication
$mail->Username = 'balasuryas44210@gmail.com';                 // SMTP username
$mail->Password = 'surya123@';                           // SMTP password
$mail->SMTPSecure = 'tls';                            // Enable TLS encryption, `ssl` also accepted
$mail->Port = 587;                                    // TCP port to connect to

$mail->setFrom("$email_id", "$label");

foreach($_POST['circular_for'] as $check)
{
    $sql1="SELECT * FROM user WHERE designation='$check'";
    $res1=mysqli_query($con,$sql1);

    while($row=mysqli_fetch_assoc($res1))
    {
        $mailid=$row['email_id'];
        $mail->addAddress("$mailid"); 
        error_reporting(E_ERROR | E_PARSE);
        $mail->addAttachment("$filepath","new.pdf");    // Optional name
        $mail->isHTML(true);                                  // Set email format to HTML

        $mail->Subject = "$subject";
        $mail->Body    = 'Name :'. $username.'<br>'.$Content;
        $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';
    }
}

if(!$mail->send()) {
    echo '<script>alert("Message could not been sent")</script>';
    echo 'Mailer Error: ' . $mail->ErrorInfo;
    echo '<script>window.location="email_sender.php"</script>';
} else {
    $con=new mysqli("localhost","root","","email");
    $sql="INSERT INTO mails(username, email_id, label, subject, Content) VALUES ('$username', '$email_id', '$label', '$subject', '$Content')";
    $res=mysqli_query($con,$sql);
    echo '<script>alert("Message has been sent")</script>';
    echo '<script>window.location="email_sender.php"</script>';
}
}
?>
<?php
}
else{
    header("Location:index.php");
}
?>