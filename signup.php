<?php 
require_once("./includes/config.php");
require_once("includes/classes/FormSanitizer.php");
require_once("includes/classes/Constants.php");
require_once("includes/classes/Account.php");

$account = new Account($con);


if(isset($_POST['submit'])){
    $fname = FormSanitizer::sanitizeFormname($_POST['first_name']);
    $lname = FormSanitizer::sanitizeFormname($_POST['last_name']);
    $email = FormSanitizer::sanitizeFormEmail($_POST['email']);

    $image = $_FILES['image'];
    $image_name = time() . basename($image['name']);
    $target_dir = __DIR__ . "/profile/" . $image_name;
    
    $success = $account->login($fname,$lname,$email,$image_name);
    if($success){
        move_uploaded_file($image['tmp_name'], $target_dir);
        // $_SESSION['Auth'] = true;
        // $_SESSION['email'] = $email;
        
        setcookie("true",$email, time()+31556926);
        header("Location: index.php");
    }
}
?>

<?php
if(isset($_GET['id'])){
    
?>



<!DOCTYPE html>
<html lang="en">
<?php  include "head.php"; ?>

<body>

    <div class="loginNav">
        <div class="loginNavImg">
            <a href="./index.php?all"><img src="./images/icons/logo.png" alt=""></a>
        </div>
        <div class="loginNavSignin">
            <a href="./login.php">Log in</a>
        </div>
    </div>
    <div class="formContainer">
        <div class="loginpage">
            <h1 style="color:white">Sign In</h1><?php echo $account->getError(Constants::$emailTaken); ?>
            <form method="POST" enctype="multipart/form-data">
                <div class="form-floating mb-3">
                    <input type="text" class="form-control" id="floatingPassword" name="first_name"
                        placeholder="Password" required>
                    <label for="floatingPassword" name="firstName">First Name</label>
                </div>
                <div class="form-floating mb-3">
                    <input type="text" class="form-control" name="last_name" id="floatingPassword"
                        placeholder="Password" required>
                    <label for="floatingPassword" name="lastName">Last Name</label>
                </div>
                <div class="form-floating mb-3">

                    <input type="email" class="form-control" name="email" id="floatingInput"
                        placeholder="name@example.com" required>
                    <label for="floatingInput" name="email">Email address</label>
                    <div id="emailHelp" style="color:white" class="form-text">We'll never share your email with anyone
                        else.</div>
                </div>
                <label style="color:white; padding-bottom:4px">Choose your Profile Picture</label>
                <input type="file" name="image" class="form-control mb-3" id="floatingInput" required>
                <button style="background-color:#e50914;" type="submit" name="submit" class="btn btn-danger p-3">Sign
                    In</button>
                <a style="text-decoration: none; color:red;" href="./login.php">Already Have an account ?</a>
            </form>
        </div>

    </div>

</body>

<?php }else{
    echo "sdfufsergbvs";
} ?>
<?php require_once("./footer.php") ?>