<?php
class Account {

    private $con;
    private $errorArray = array();
    
    public function __construct($con){
        $this->con = $con;
    }

    public function login($first_nm, $last_nm, $email,$image){
        $query = $this->con->prepare("SELECT * FROM users WHERE email=:em");
        $query->bindValue(":em",$email);
        $query->execute();
        if($query->rowCount() != 0){
            array_push($this->errorArray, Constants::$emailTaken);
            return false;
        }else{
            $query = $this->con->prepare("INSERT INTO users(first_name,last_name,email,profile) VALUES(:fnm,:lnm,:em,:img)");
            $query->bindValue(":fnm",$first_nm);
            $query->bindValue(":lnm",$last_nm);
            $query->bindValue(":em",$email);
            $query->bindValue(":img",$image);
        
            if($query->execute()){
                return true;
            }
        }
    }
    
    public function addPlaylist($title,$disricption,$image){
        $query = $this->con->prepare("INSERT INTO playlists(title,discription,image) VALUES(:title,:disc,:img)");
        $query->bindValue(":title",$title);
        $query->bindValue(":disc",$disricption);
        $query->bindValue(":img",$image);
        
        $result =  $query->execute();
        return $result;
    }
    
    
    public function playlistData(){
        $query = $this->con->prepare("SELECT * FROM playlists");
        $query->execute();
        $result = $query->fetchAll();
       return $result;
    }

    public function userData($email){
        $query = $this->con->prepare("SELECT * FROM users WHERE email=:em");
        $query->bindValue(":em",$email);
        $query->execute();
        $result = $query->fetchAll();
       return $result;
    }
    
    public function showVideo(){
        $query = $this->con->prepare("SELECT * FROM uploaded_videos LEFT JOIN users ON uploaded_videos.user_id=users.id");
        $query->execute();
        return $query->fetchAll();
    }
    
    public function showCategoryVideo($category){
        $query = $this->con->prepare("SELECT * FROM uploaded_videos LEFT JOIN users ON uploaded_videos.user_id=users.id WHERE uploaded_videos.category=:cat");
        $query->bindValue(":cat",$category);
        $query->execute();
        return $query->fetchAll();
    }

    
    public function showShorts(){
        $query = $this->con->prepare("SELECT * FROM uploaded_videos where video_type=1");
        $query->execute();
        $result = $query->fetchAll();
        return $result;
    }
    
    public function channelData($id){
        $query = $this->con->prepare("SELECT * FROM users WHERE id=:id");
        $query->bindValue(":id",$id);
        $query->execute();
        $result = $query->fetchAll();
        return $result;
    }

    public function uploadVideos_with_playlist($title,$disricption,$category,$image_nm,$playlist_id,$video_nm,$user_id,$video_type){
        $query = $this->con->prepare("INSERT INTO uploaded_videos(title,discription,category,image_name,video_name,playlist_id,user_id,video_type) 
        VALUES(:title,:disc,:cate,:img,:vid_nm,:ply_nm,:user_id,:v_type)");
        $query->bindValue(":title",$title);
        $query->bindValue(":disc",$disricption);
        $query->bindValue(":cate",$category);
        $query->bindValue(":img",$image_nm);
        $query->bindValue(":ply_nm",$playlist_id);
        $query->bindValue(":vid_nm",$video_nm);
        $query->bindValue(":user_id",$user_id);
        $query->bindValue(":v_type",$video_type);
        
        $result =  $query->execute();
        return $result;
    }

    public function uploadVideos_without_playlist($title,$disricption,$category,$image_nm,$playlist_id,$video_nm,$user_id,$video_type){
        $query = $this->con->prepare("INSERT INTO uploaded_videos(title,discription,category,image_name,video_name,playlist_id,user_id,video_type) 
        VALUES(:title,:disc,:cate,:img,:vid_nm,:ply_nm,:user_id,:v_type)");
        $query->bindValue(":title",$title);
        $query->bindValue(":disc",$disricption);
        $query->bindValue(":cate",$category);
        $query->bindValue(":img",$image_nm);
        $query->bindValue(":ply_nm",$playlist_id);
        $query->bindValue(":vid_nm",$video_nm);
        $query->bindValue(":user_id",$user_id);
        $query->bindValue(":v_type",$video_type);
        
        $result =  $query->execute();
        return $result;
    }
    
    public function Videoplayer($id){
        $query = $this->con->prepare("SELECT * FROM uploaded_videos where id=:id");
        $query->bindValue(":id",$id);
        $query->execute();
        $result = $query->fetchAll();
        return $result;
    }
    
    public function getError($error) {
        if(in_array($error, $this->errorArray)) {
            return "<span class='errorMessage'>$error</span>";
        }
    }

    public function showProfileVideo($id){
        $query = $this->con->prepare("SELECT * FROM uploaded_videos WHERE uploaded_videos.user_id=:id");
        $query->bindValue(":id",$id);
        $query->execute();
        $result = $query->fetchAll();
        return $result;
    }
    
    public function checkLogin($email){
        $query = $this->con->prepare("SELECT * FROM users WHERE email=:em");
        $query->bindValue(":em",$email);
        $query->execute();
        $result = $query->fetchAll();
       return $result;
    }

    public function categoryNav(){
        $query = $this->con->prepare("SELECT DISTINCT uploaded_videos.category FROM uploaded_videos");
        $query->execute();
        $result = $query->fetchAll();
        return $result;
    }
    public function randomVideo(){
        $query = $this->con->prepare("SELECT * FROM uploaded_videos ORDER BY RAND()");
        $query->execute();
        $result = $query->fetch();
        return $result;
    }

    
}
?>