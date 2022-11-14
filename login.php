<?php 
require_once("./includes/config.php");
require_once("includes/classes/FormSanitizer.php");
require_once("includes/classes/Constants.php");
require_once("includes/classes/Account.php");

$account = new Account($con);


if(isset($_POST['submit'])){
    $email = FormSanitizer::sanitizeFormEmail($_POST['email']);
    $success = $account->checkLogin($email);
    if($success){
        // $_SESSION['Auth'] = true;
        // $_SESSION['email'] = $email;
        
        setcookie("true",$email,time()+31556926);
        header("Location: index.php");
    }else{
        ?>

<script>
alert("No Database Exists with this Email Id..!!!!");
</script>

<?php
}
}
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
            <a href="./signup.php?id">Sign in</a>
        </div>
    </div>
    <div class="formContainer">

        <div class="loginpage">
            <!-- <img src="./images/icons/logo.png" class="mb-3" alt=""> -->
            <form method="POST">
                <?php //echo $account->getError(Constants::$emailTaken); ?>
                <div class="titleDiscription">
                    <h1>Unlimited videos, Shorts and more.</h1>
                    <h3>Watch anywhere. create anytime.</h3>
                    <p>Ready to watch? Enter your email to create or restart your channel</p>
                </div>
                <div class="loginForm">
                    <div class="form-floating mb-3 loginFormInput">

                        <input type="email" name="email" class="form-control" id="floatingInput"
                            placeholder="name@example.com" required>
                        <label for="floatingInput">Email address</label>
                    </div>
                    <div class="loginFormButton">
                        <button name="submit" value="submit">
                            Get Started
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>

</body>

<?php require_once("./footer.php") ?>