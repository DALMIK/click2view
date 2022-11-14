<?php 
require_once("./includes/config.php");
require_once("./includes/classes/Account.php");

?>

<!DOCTYPE html>
<html lang="en">
<?php  include "head.php"; ?>

<body>
    <?php  include("./header.php"); 

    $account = new Account($con);

    if(isset($_COOKIE['true'])){
    $userData = $account->userData($_COOKIE['true']);
    }
    $categoryNav = $account->categoryNav();
    $randomVideo = $account->randomVideo();

    ?>
    <div id="mainSectionContainer">
        <?php include("sideNav.php"); ?>
        <div class="categoryNav" style="top:0;">
            <ul>
                <li><a href="?all">All</a> </li>
                <?php foreach($categoryNav as $cN){ ?>
                <li><a href="?cat=<?=$cN['category']?>"><?=$cN['category']?></a> </li>
                <?php  } ?>
            </ul>
        </div>
        <div id="mainContentContainer">


            <?php if(isset($_GET['all'])){ ?>
            <div class="glass">
                <div style="height:100%;width:60%; border-radius:15px 0 0 15px;">
                    <video style="width:100%;padding:10px 0; height:100%; cursor:pointer;" muted controls loop autoplay>
                        <source style="width: 100%; height:100%;" src="
                            ./upload/uploaded_videos/<?=$randomVideo['video_name']?>">
                    </video>
                </div>
                <div style="height:100%;width:40%;border-radius:0 15px 15px 0;color:black;font-weight:500px">
                    <div style="width:60%;margin:40px auto">
                        <img style="width:100%" src="./images/icons/logo.png" alt="">
                    </div>
                    <div style="width:70%; margin:40px auto;text-align:center;filter:blur(0.79px)">
                        <h2><?=$randomVideo['title']?></h2>
                    </div>
                    <div style="width:70%;margin:40px auto;text-align:center;filter:blur(0.79px)">
                        <p><?=$randomVideo['discription']?></p>
                    </div>
                </div>
            </div>
            <?php } ?>


            <div class="videoContainer">
                <div class="container">
                    <div class="row">

                        <?php 
                        if(isset($_GET['cat'])){
                        $success1 = $account->showCategoryVideo($_GET['cat']);
                        foreach($success1 as $data1){  
                        ?>
                        <div class=" col-sm col-xs-12 col-lg-3 col-md-4 col-sm-6 my-2">
                            <a style="text-decoration: none; color:black;"
                                href="./video.php?id=<?=$data1['id']?>&vid=<?=$data1[0]?>">
                                <div class="card">
                                    <div style="overflow: hidden;">
                                        <img style="width:370px;height:250px"
                                            src="./upload/video_thumbnails/<?=$data1['image_name'] ?>"
                                            alt="Card image cap" />
                                    </div>

                                    <div class="d-flex">
                                        <div>
                                            <img style="width: 50px;height:50px; border-radius:50%; padding:6px 6px; margin: 2px 5px"
                                                src="./profile/<?php echo $data1['profile'];?>" alt="image">
                                        </div>
                                        <div>
                                            <h5><?=$data1['title']?></h5>
                                            <p style="font-size: 13px; color:grey;" class="card-text">
                                                <?=$data1['first_name']?>
                                                <?=$data1['last_name']?></p>
                                        </div>

                                    </div>
                                    <button
                                        style="border:none; margin:7px; padding:8px; height:15%; background-color:#021E48;color:white; border-radius:5px"
                                        class="d-flex">
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

                        <?php  
                            }
                        }else{
                            $success = $account->showVideo();
                            foreach($success as $data){ 
                        ?>

                        <div class=" col-sm col-xs-12 col-lg-3 col-md-4 col-sm-6 my-2">
                            <a style="text-decoration: none; color:black;"
                                href="./video.php?id=<?=$data['id']?>&vid=<?=$data[0]?>">
                                <div class="card">
                                    <div style="overflow: hidden; ">
                                        <img style="width:370px;height:250px"
                                            src="./upload/video_thumbnails/<?=$data['image_name'] ?>"
                                            alt="Card image cap" />
                                    </div>

                                    <div class="d-flex">
                                        <div>
                                            <img style="width: 50px;height:50px; border-radius:50%; padding:6px 6px; margin: 2px 5px"
                                                src="./profile/<?php echo $data['profile'];?>" alt="image">
                                        </div>
                                        <div>
                                            <h5><?=$data['title']?></h5>
                                            <p style="font-size: 13px; color:grey;" class="card-text">
                                                <?=$data['first_name']?>
                                                <?=$data['last_name']?></p>
                                        </div>

                                    </div>
                                    <button
                                        style="border:none; margin:7px; padding:8px; height:15%; background-color:#021E48;color:white; border-radius:5px"
                                        class="d-flex">
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

                        <?php 
                            } 
                        } ?>

                    </div>
                </div>
            </div>

        </div>

    </div>



    <?php require_once("./footer.php") ?>