<?php
$showAlert=false;
$showError=false;

if($_SERVER['REQUEST_METHOD']=="POST"){
    require_once "partials/_condb.php";
    $username=$_POST['username'];
    $password=$_POST['password'];
    $cpassword=$_POST['cpassword'];
    if(!isset($_POST['submit'])){
        if(!empty($username) && !empty($password) && !empty($cpassword)){
            $uniquie_sqlCommand="SELECT * FROM `login` where username='$username'";
            $result=mysqli_query($con,$uniquie_sqlCommand);
            $numExitsRow=mysqli_num_rows($result);

            if($numExitsRow>0){
                $showError="UserName already Exits";
            }
            else{
                if($password==$cpassword){
                    $hash=password_hash($password,PASSWORD_DEFAULT);
                    $insert_command="INSERT INTO `login` (`username`, `password`, `dt`) VALUES ('$username', '$hash', current_timestamp());";
                    $result=mysqli_query($con,$insert_command);
                    if($result){
                        $showAlert=true;
                    }
                    else{
                        $showError="There are some of problem, please try again Some time";
                    }
                }
                else{
                    $showError="Password did't match";
                }
            }
        }
        else{
            $showError="Some Input Field are Empty";  
        }
    }
}



?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Signup Page</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
</head>

<body>
    <?php require "./partials/_nav.php"; ?>
    <?php
    if($showAlert){
        echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
        <strong>Success!</strong> You account has been creates and now you can login.
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
      </div>';
    }
    if($showError){
        echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
        <strong>Worning! </strong>'.$showError.'
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
      </div>';
    }
    ?>
    <div class="container my-2">
    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
            <h1 class="text-center">Signup to our website</h1>
            <div class="mb-3">
                <label for="username" class="form-label">UserName</label>
                <input type="text" class="form-control" id="username" name="username" aria-describedby="emailHelp">
            </div>
            <div class="mb-3">
                <label for="password" class="form-label">Password</label>
                <input type="password" class="form-control" id="password" name="password">
            </div>
            <div class="mb-3">
                <label for="cpassword" class="form-label">Password</label>
                <input type="password" class="form-control" id="cpassword" name="cpassword">
                <div id="emailHelp" class="form-text">Make sure to type the same password.</div>
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz"
        crossorigin="anonymous"></script>
</body>

</html>