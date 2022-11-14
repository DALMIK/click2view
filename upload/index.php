<!DOCTYPE html>
<html lang="en">
<?php  include "head.php"; ?>

<body>
    <?php
    
    include "header.php";  ?>


    <div id="mainSectionContainer">
        <div id="sidebar" class="sideNavContainer">

            <div class="d-flex">
                <a href="../index.php"><span class="material-symbols-outlined icon">
                        home
                    </span></a> <a class="sideNavTag" href="../index.php">Home</a><br>
            </div>
            <!-- <div class="d-flex">
                <a href="../subscribe.php"><span class="material-symbols-outlined icon">
                        subscriptions
                    </span></a><a class="sideNavTag" href="../subscribe.php">Subscription</a><br>
            </div> -->
            <div class="d-flex">
                <a href="../library.php"><span class="material-symbols-outlined icon">
                        video_library
                    </span></a><a class="sideNavTag" href="../library.php">Library</a><br>
            </div>
            <div class="d-flex">
                <a href="../shorts.php"><span class="material-symbols-outlined icon">
                        video_stable
                    </span></a><a class="sideNavTag" href="../shorts.php">Shorts</a><br>
            </div>
            <div class="d-flex">
                <a href="../index.php"><span class="material-symbols-outlined icon">
                        explore
                    </span></a><a class="sideNavTag" href="../index.php">Explore</a><br>
            </div>

        </div>


        <?php
        if(isset($_GET['id'])){
        $account = new Account($con);
        $result = $account->showProfileVideo($_GET['id']); ?>
        <div id="myprofile">

        </div>

        <div id="mainContentContainer2" class="yourVideosContainer">

            <?php foreach($result as $data){ ?>
            <div class="videoContainer2">
                <div class="manageVideos2">
                    <img src="./video_thumbnails/<?=$data['image_name']?>" alt="">
                </div>
                <div class="manageVideos3">
                    <h4><?=$data['title']?></h4>
                    <p><?=$data['discription']?></p>
                </div>

            </div>
            <?php } ?>

        </div>

        <?php }else{ ?>

        <div class="mainContentContainer">
            <div style="text-align:center;margin: 200px 200px;color:white;background-color:#021E48; padding:10px;border-radius:20px"
                class="videoContainer">
                <h3>Upload your Videos Here choosing Above Option</h3>
            </div>
        </div>

        <?php } ?>

    </div>


    <?php require_once("./footer.php") ?>