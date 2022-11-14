<?php
// require_once("./includes/config.php");
require_once("../includes/config.php");

// require_once("./includes/classes/Constants.php");
require_once("../includes/classes/Constants.php");
// require_once("./includes/classes/Account.php");
require_once("../includes/classes/Account.php");
// require_once("./includes/classes/FormSanitizer.php"); 
require_once("../includes/classes/FormSanitizer.php"); 


if(isset($_COOKIE['true'])){
        $account = new Account($con);
        $success = $account->userData($_COOKIE['true']);
        $playlistData = $account->playlistData($_COOKIE['true']);
    }
    
if(isset($_POST['addPlaylist'])){
    $title = FormSanitizer::sanitizeFormname($_POST['title']);
    $discription = FormSanitizer::sanitizeFormname($_POST['discription']);
    $image = $_FILES['image'];
    $image_name = time() . basename($image['name']);
    $target_dir = __DIR__ . "/playlist_images/" . $image_name;
    
    move_uploaded_file($image['tmp_name'], $target_dir);
    
    $account = new Account($con);
    $success1  =  $account->addPlaylist($title,$discription,$image_name);
    if($success1){
        ?>
<script>
alert("Succefully added");
<?php header("Location:index.php"); ?>
</script>
<?php
    }else{?>
<script>
alert("Something went wrong Try again....");
</script>
<?php
    }
        
}

if(isset($_POST['upload'])){
    
    $title = FormSanitizer::sanitizeFormname($_POST['title']);
    $discription = $_POST['discription'];
    $category = FormSanitizer::sanitizeFormname($_POST['category']);
    $playlist_id = "";
    $playlist_id = $_POST['playlist'];
    $user_id = $success[0]['id'];
    if(($_POST['video_type'])=="video"){
        $video_type =  0;
    }else{
        $video_type =  1;
    }

    $image = $_FILES['image'];
    $image_name = time() . basename($image['name']);
    $target_dir = __DIR__ . "/video_thumbnails/" . $image_name;
    move_uploaded_file($image['tmp_name'], $target_dir);

    $video = $_FILES['Video'];
    foreach($_FILES['Video']['name'] as $key=>$value){
        $video_name = time() . basename($value);
        $target_dir = __DIR__ . "/uploaded_videos/" . $video_name;
        move_uploaded_file($_FILES['Video']['tmp_name'][$key],$target_dir);
        $account = new Account($con);
        if(isset($playlist_id)){
            $success1 = $account->uploadVideos_with_playlist($title,$discription,$category,$image_name,$playlist_id,$video_name,$user_id,$video_type);
        }else{
            $success1 = $account->uploadVideos_without_playlist($title,$discription,$category,$image_name,NULL,$video_name,$user_id,$video_type);
        }
    
    }

    if($success1){
        ?>
<script>
alert("Succefully Videos Uploaded");
<?php header("Location:index.php"); ?>
</script>
<?php
    }else{?>
<script>
alert("Something went wrong Try again....");
</script>
<?php
    }
            
            
}



?>





<div id="mastHeadContainer">
    <div class="container-logo">
        <button id="navShow" class="navShowHide">
            <img src="../images/icons/menu.png" alt="Menu">
        </button>
        <a class="logoContainer">
            <img src="../images/icons/logo.png" title="logo" alt="site logo">
        </a>
    </div>

    <div class="searchBarContainer">
        <form action="search.php" method="GET">
            <input type="text" class="searchBar" name="term" placeholder="Explore your Youtube account here">
            <button class="searchButton">
                <img src="../images/icons/searchBar.png" alt="site logo">
            </button>
        </form>

    </div>
    <div class="rightIcon">
        <div class="dropdown">
            <button class="btn btn-outline-primary dropdown-toggle ml-3" type="button" id="dropdownMenuButton2"
                data-bs-toggle="dropdown" aria-expanded="false">
                Create
            </button>
            <ul class="dropdown-menu dropdown-menu-light" aria-labelledby="dropdownMenuButton2">
                <li><a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#uploadBackdrop">Upload
                        Videos</a></li>
                <li><a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#playlistBackdrop">Create
                        Playlist</a></li>
                <li><a class="dropdown-item" href="#">Go Live</a></li>
            </ul>
        </div>
        <a id="profile">
            <img class="profileimg" src="../profile/<?php echo $success[0]['profile'] ?>" alt="profile">
        </a>
    </div>

</div>


<div id="profileNav" class="active1">
    <div style="text-align: center; padding:20px;">
        <img src="../profile/<?php echo $success[0]['profile'] ?>" alt="profile_pic"
            style="width: 5rem; height:5rem; align-items:center; border-radius:50%;">
        <h3><?php echo $success[0]['first_name'] ?> <?php echo $success[0]['last_name'] ?></h3>
        <p><a href="#"> manage your google account</a></p>
    </div>
    <hr>
    <ul>
        <li><a href="#">Your Channel</a></li>
        <li><a href="#">Settings</a></li>
    </ul>
</div>


<!-- Modal for upload video -->

<div class="modal fade" id="uploadBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
    aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="staticBackdropLabel">Upload Videos</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body uploadForm">
                <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST" style="display:flex"
                    enctype="multipart/form-data">
                    <div class="mx-3 my-3">
                        <label class="text">choose your Thumbnail</label><br>
                        <label class="text mb-2">Type ( .jpg, .jpeg, .png )</label>
                        <div class="input-group mb-5">
                            <input type="file" name="image" class="form-control" id="inputGroupFile02" required>
                        </div>
                        <select class="form-select mb-5" name="playlist" aria-label="Default select example">
                            <option selected>Choose your Playlist</option>
                            <?php foreach($playlistData as $pd){ ?>
                            <option value="<?=$pd['id']?>"><?=$pd['title']?></option>
                            <?php } ?>
                        </select>
                        <select class="form-select" name="video_type" aria-label="Default select example" required>
                            <option selected>Choose your Video Type</option>
                            <option value="video">Video</option>
                            <option value="shorts">Shorts</option>
                        </select>
                    </div>
                    <div class="mx-3">
                        <div class=" form-floating mb-3">
                            <input type="text" name="title" class="form-control" id="floatingInput"
                                placeholder="name@example.com" required>
                            <label for="floatingInput">Title</label>
                        </div>
                        <div class="form-floating mb-3">
                            <input type="text" name="discription" class="form-control" id="floatingInput"
                                placeholder="name@example.com" required>
                            <label for="floatingInput">Discription</label>
                        </div>
                        <div class="form-floating mb-3">
                            <input type="text" name="category" class="form-control" id="floatingInput"
                                placeholder="name@example.com" required>
                            <label for="floatingInput">Category</label>
                        </div>
                        <label class="text">Upload Videos Type ( .mp4, .mkv )</label>
                        <div class="input-group mb-3">
                            <input type="file" name="Video[]" class="form-control" id="inputGroupFile02" multiple
                                required>
                        </div>
                        <button type="submit" name="upload" class="btn btn-primary">Upload</button>
                    </div>

                </form>


            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<!-- Create playlist modal -->


<div class="modal fade" id="playlistBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
    aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-md">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="staticBackdropLabel">Create Playlist</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST" enctype="multipart/form-data">
                    <div class="mb-3" style="padding:0 5px;display: flex; flex-direction:column;">
                        <label class="my-3">Add Playlist</label>
                        <div class="form-floating mb-3">
                            <input type="text" name="title" class="form-control" id="floatingInput"
                                placeholder="name@example.com" required>
                            <label for="floatingInput">Title</label>
                        </div>
                        <div class="form-floating">
                            <input type="text" name="discription" class="form-control" id="floatingPassword" rows="3"
                                placeholder="Password" style="height: 100px" required>
                            <label for="floatingPassword">Discription</label>
                        </div>
                    </div>

                    <div style="padding:5px 5px;display:flex; flex-direction:column; align-items:left">
                        <div class=" mb-3">
                            <label class="my-3">Choose your Playlist Thumbnail</label>
                            <input type="file" class="form-control mb-3" id="floatingInput" name="image" required>
                        </div>

                        <button type="submit" name="addPlaylist" class="my-2 btn btn-primary">Add Playlist</button>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>