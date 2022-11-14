<div id="sidebar" class="sideNavContainer">

    <div class="d-flex">
        <a href="./index.php?all"><span class="material-symbols-outlined icon">
                home
            </span></a> <a class="sideNavTag" href="index.php?all">Home</a><br>
    </div>
    <!-- <div class="d-flex">
        <a href="./index.php"><span class="material-symbols-outlined icon">
                subscriptions
            </span></a><a class="sideNavTag" href="./subscribe.php">Subscription</a><br>
    </div> -->
    <div class="d-flex">
        <a href="./library.php"><span class="material-symbols-outlined icon">
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
    <?php
    if(isset($_COOKIE['true'])){ ?>
    <div class="d-flex">
        <a href="./upload?id=<?=$userData[0]['id'] ?>"><span class="material-symbols-outlined icon">
                smart_display
            </span></a> <a class="sideNavTag" href="./upload?id=<?=$userData[0]['id'] ?>">Your Videos</a><br>
    </div>

    <?php } ?>
</div>