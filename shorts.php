<?php 
require_once("./includes/config.php") 

?>

<!DOCTYPE html>
<html lang="en">
<?php  include "head.php"; ?>

<body>
    <?php  include("./header.php"); 

    $account = new Account($con);
    $success = $account->showShorts();

    ?>
    <div id="mainSectionContainer">
        <div id="sidebar" class="sideNavContainer">

            <div class="d-flex">
                <a href="./index.php?all"><span class="material-symbols-outlined icon">
                        home
                    </span></a> <a class="sideNavTag" href="index.php?all">Home</a><br>
            </div>
            <!-- <div class="d-flex">
                <a href="./index.php"><span class="material-symbols-outlined icon">
                        subscriptions
                    </span></a><a class="sideNavTag" href="./index.php">Subscription</a><br>
            </div> -->
            <div class="d-flex">
                <a href="./index.php"><span class="material-symbols-outlined icon">
                        video_library
                    </span></a><a class="sideNavTag" href="./library.php">Library</a><br>
            </div>
            <div class="d-flex">
                <a href="./shorts.php"><span class="material-symbols-outlined icon">
                        video_stable
                    </span></a><a class="sideNavTag" href="./shorts.php">Shorts</a><br>
            </div>
            <div class="d-flex">
                <a href="./index.php"><span class="material-symbols-outlined icon">
                        explore
                    </span></a><a class="sideNavTag" href="./index.php">Explore</a><br>
            </div>
        </div>

        <div id="mainContentContainer1">

            <div class="videoContainer1">
                <div class="container1">

                    <?php foreach($success as $data){ ?>
                    <div class="row shortsDiv">
                        <video controls>
                            <source src="./upload/uploaded_videos/<?php echo $data['video_name']; ?>">
                        </video>
                    </div>
                    <div class="row shortsTitle">
                        <h4><?=$data['title']?></h4>
                    </div>
                    <?php } ?>
                </div>
            </div>

        </div>

    </div>



    <?php require_once("./footer.php") ?>