<?php  
require_once("./includes/config.php");
require_once("includes/classes/FormSanitizer.php");
require_once("includes/classes/Constants.php");
require_once("includes/classes/Account.php");

if(isset($_GET["signout"])){
    $res ="";
    setcookie("true",$res,time()-31556937);
    header("Location: index.php");
}


if(isset($_COOKIE['true'])){
    $account = new Account($con);
    $success = $account->userData($_COOKIE['true']);
}



?>


<div id="mastHeadContainer">
    <button id="navShow" class="navShowHide">
        <img src="./images/icons/menu.png" alt="Menu">
    </button>
    <a class="logoContainer" href="./index.php">
        <img src="./images/icons/logo.png" title="logo" alt="site logo">
    </a>
    <div class="searchBarContainer">
        <form action="search.php" method="GET">
            <input type="text" class="searchBar" name="term" placeholder="search here">
            <button class="searchButton">
                <img src="./images/icons/searchBar.png" alt="site logo">
            </button>
        </form>

    </div>
    <div class="rightIcon">
        <?php if(isset($_COOKIE['true'])){ ?>
        <a href="./upload">
            <img src="./images/icons/upload.png" alt="upload here">
        </a>
        <?php }?>
        <?php 
                if(isset($_COOKIE['true'])){ 
                         
            ?>
        <a href="#" id="profile">
            <img class="profileimg" src="./profile/<?php  echo $success[0]['profile'];?>" alt="profile">

        </a>
        <?php }else{ ?>
        <a href="./signup.php?id">
            <input type="submit" value="SIGN IN"
                style="padding:5px; color:blue; border: 1px solid blue; margin-left:40px">
            <?php }?>
        </a>
    </div>

</div>

<div id="profileNav" class="active1">
    <div style="text-align: center; padding:20px;">
        <img src="./profile/<?=$success[0]['profile'];?>" alt="profile_pic"
            style="width: 5rem; height:5rem; align-items:center; border-radius:50%;">
        <h3><?=$success[0]['first_name']?> <?=$success[0]['last_name']?></h3>
        <p><?=$success[0]['email']?></p>
        <p><a href="#">Manage your account</a></p>
    </div>
    <hr>
    <ul>
        <li><a href="">Your Channel</a></li>
        <li><a href="?signout">Sign out</a></li>
    </ul>
</div>