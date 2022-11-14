<?php 
require_once("./includes/config.php") 

?>

<!DOCTYPE html>
<html lang="en">
<?php  include "head.php"; ?>

<body>
    <?php  include("./header.php"); 

    $account = new Account($con);
    $success = $account->showVideo();

    ?>
    <div id="mainSectionContainer">
        <div id="sidebar" class="sideNavContainer">

            <div class="d-flex">
                <a href="./index.php"><span class="material-symbols-outlined icon">
                        home
                    </span></a> <a class="sideNavTag" href="index.php">Home</a><br>
            </div>
            <!-- <div class="d-flex">
                <a href="./index.php"><span class="material-symbols-outlined icon">
                        subscriptions
                    </span></a><a class="sideNavTag" href="./index.php">Subscription</a><br>
            </div> -->
            <div class="d-flex">
                <a href="./library.php"><span class="material-symbols-outlined icon">
                        video_library
                    </span></a><a class="sideNavTag" href="./index.php">Library</a><br>
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

            <?php
            if(isset($_COOKIE['true'])){ ?>
            <div class="d-flex">
                <a href="./upload?id=<?=$success[0]['id']?>"><span class="material-symbols-outlined icon">
                        smart_display
                    </span></a> <a class="sideNavTag" href="./upload?id=<?=$success[0]['id']?>">Your Videos</a><br>
            </div>
            <?php } ?>

        </div>
        <div id="mainContentContainer">

            <div class="videoContainer">
                <div class="container">
                    <div class="row">
                        <div class=" col-sm col-xs-12 col-lg-3 col-md-4 col-sm-6 my-2">
                            <a style="text-decoration: none; color:black;" href="#">
                                <div class="card" style="transform:scale(0.95); border-radius:15px">
                                    <div class="cardBody">
                                        <div class="cardContent">

                                            <h2>TRENDING</h2>
                                        </div>

                                    </div>

                                </div>
                            </a>
                        </div>
                        <div class=" col-sm col-xs-12 col-lg-3 col-md-4 col-sm-6 my-2">
                            <a style="text-decoration: none; color:black;" href="#">
                                <div class="card" style="transform:scale(0.95); border-radius:15px">
                                    <div class="cardBody">
                                        <div class="cardContent">
                                            <h2>PLAYLIST</h2>
                                        </div>

                                    </div>

                                </div>
                            </a>
                        </div>
                        <div class=" col-sm col-xs-12 col-lg-3 col-md-4 col-sm-6 my-2">
                            <a style="text-decoration: none; color:black;" href="#">
                                <div class="card" style="transform:scale(0.95); border-radius:15px">
                                    <div class="cardBody">
                                        <div class="cardContent">
                                            <h2>MUSIC</h2>
                                        </div>

                                    </div>

                                </div>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>