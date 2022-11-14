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
    $userData = $account->userData($_COOKIE['true']);

    ?>
    <div id="mainSectionContainer">
        <?php include "sideNav.php"; ?>
        <div class="categoryNav" style="top:0;">
            <ul>
                <li><a href="">All</a> </li>
                <li><a href="">Trailer</a> </li>
                <li><a href="">Music</a> </li>
                <li><a href="">Movie</a> </li>
                <li><a href="">Comedy</a> </li>

            </ul>
        </div>
        <div id="mainContentContainer">

            <div class="videoContainer">
                <div class="container">
                    <div class="row">

                        <?php foreach($success as $data){ ?>
                        <div class=" col-sm col-xs-12 col-lg-3 col-md-4 col-sm-6 my-2">
                            <a style="text-decoration: none; color:black;"
                                href="./video.php?id=<?=$data['id']?>&vid=<?=$data[0]?>">
                                <div class="card">
                                    <div style="overflow: hidden;">
                                        <img style="width:370px;height:250px"
                                            src="./upload/video_thumbnails/<?=$data['image_name'] ?>"
                                            alt="Card image cap" />
                                    </div>

                                    <div class="d-flex">
                                        <div>
                                            <img style="width: 50px;height:45px; border-radius:50%; padding:6px 6px; margin: 2px 5px"
                                                src="./profile/<?php echo $data['profile'];?>" alt="image">
                                        </div>
                                        <div>
                                            <h5><?=$data['title']?></h5>
                                            <p style="font-size: 13px; color:grey;" class="card-text">
                                                <?=$data['first_name']?>
                                                <?=$data['last_name']?></p>
                                        </div>

                                    </div>
                                    <button style="border:none; margin:7px; padding:8px; height:15%" class="d-flex">
                                        <div style="padding: 0 5px 0 30px; width:40%">
                                            <span style="font-size: 25px;" class="material-symbols-outlined">
                                                schedule
                                            </span>
                                        </div>
                                        <div>
                                            <p href="#"> Watch Later</p>
                                        </div>
                                    </button>

                                </div>
                            </a>
                        </div>
                        <?php  }?>

                    </div>
                </div>
            </div>

        </div>

    </div>



    <?php require_once("./footer.php") ?>