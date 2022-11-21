<?php 
require_once("./includes/config.php") 

?>

<!DOCTYPE html>
<html lang="en">
<?php  include "head.php"; ?>

<body>
    <?php  include("./header.php"); 

    $channeldata = array();
    $videodata = array();
    
    $account = new Account($con);
    $sideVideo = $account->showVideo();
    if(isset($_GET['id'])){
        $account = new Account($con);
        $channeldata = $account->channelData($_GET['id']);
    }
    if(isset($_GET['vid'])){
        $account = new Account($con);
        $videodata = $account->Videoplayer($_GET['vid']);
    }
    if(isset($_COOKIE['true'])){
    $userData = $account->userData($_COOKIE['true']);
    }
    ?>

    <div id="mainSectionContainer">

        <?php include "sideNav.php"; ?>

        <div class="videoPageContainer">
            <!-- <div class="floatingDiv">

            </div> -->
            <div class="videoContainer">
                <div class="video">
                    <video style="width: 100%; height:100%; cursor:pointer;" controls autoplay>
                        <source src="./upload/uploaded_videos/<?=$videodata[0]['video_name'];?>">
                    </video>
                </div>

                <div class="videoNavBar">
                    <div class="videoChannelProfile">
                        <img src="./profile/<?=$channeldata[0]['profile']?>" alt="">
                        <a href="#" style="text-decoration:none; color:#021E48;font-weight:bolder;font-size:18px">
                            <?php echo $channeldata[0]['first_name']?> <?php echo $channeldata[0]['last_name']?>
                        </a>
                        <button class="subscribeButton">
                            <a href="<?=$_SERVER['REQUEST_URI']?>">Subscribe</a>
                        </button>
                    </div>
                </div>
            </div>
            <div class=" videoRightNav">
                <?php foreach($sideVideo as $sv){ ?>
                <a href="<?php echo $_SERVER['PHP_SELF'];?>?id=<?=$sv['id'];?>&vid=<?=$sv[0]?>"
                    style="text-decoration: none; color:black">
                    <div class="slidesVideo">
                        <div>
                            <img src="./upload/video_thumbnails/<?=$sv['image_name']?>" alt="">
                        </div>
                        <div class="slidesVideoRightContainer">
                            <h6><strong><?php echo $sv['title'];?></strong> </h6>
                            <p style="font-size: 15px;"><?php echo $sv['discription'];?> </p>
                            <p style="font-size: 13px;color:grey"><?php echo $sv['first_name'];?>
                                <?php echo $sv['last_name'];?>
                            </p>
                        </div>
                    </div>
                    <?php }?>
                </a>
            </div>
        </div>

    </div>

    <script>
    let video = document.getElementById("rbdvideo");
    </script>

    <?php require_once("./footer.php") ?>