<?php

require_once('DB/DB.php');
// require_once('../ClassLibraries/DB/adminCredDB.php');

define('KB', 1024);
define('MB', 1048576);
define('GB', 1073741824);
define('TB', 1099511627776);

class mainClass extends DataBase{
    function processImage($name, $type, $size, $tmp_name, $error, $image_width, $image_height){
        // processing image
        
        
        $target_dir = "admin/images/uploads/";
        $datetime = date("Ymdhis");
        $imageName = str_replace(' ', '', basename($name));
        $target_file = $target_dir . $datetime . $imageName;
        $fileLoc = '../images/uploads/'. $datetime . $imageName;
        // $fileLoc = __DIR__.'/images/'. $datetime . $imageName;
        $allowedExts = array("png", "PNG", "JPEG", "JPG", "jpeg", "jpg");
        $extension = strtolower(pathinfo($name, PATHINFO_EXTENSION));
        $imageLink = 'http://localhost/acacia_blog/'.$target_file;
        
        // if ((($type == "image/svg")
        // || ($type == "image/jpeg") ||($type == "image/png"))
        $max_height = 1080;
        $max_width = 1920;
        $min_height = 500;
        $min_width = 800;

        if(($image_height <= $max_height && $image_height >= $min_height) && ($image_width <= $max_width && $image_width >= $min_width))
        {
        
        if($size < 1*MB)
        
          {
            if(in_array($extension, $allowedExts))
            {
          if ($error > 0)
            {
            return $error;
            }
          else
            { 
              if(move_uploaded_file($tmp_name, $fileLoc)){
                  return 'uploaded';
              }else{
                  return 'not up';
              }

              return $imageLink;
              
            }
        }else{
            return "ext_err";
        }
          }
        else
          {
          return "size_err";
          // PRINT_R($_FILES["file"]["size"]);
          }
        }else{
            return "dimension_err";
        }
        

  }



  function uploadBlog($data)
  {
      if(is_object($data) || is_array($data)){
        //   return $_FILES;

        switch ($data['radio']) {
            case "single":
            // $name = $_FILES["single_img"]["name"];
            // $type = $_FILES["single_img"]["type"];
            // $size = $_FILES["single_img"]["size"];
            // $error = $_FILES["single_img"]["error"];
            // $tmp_name = $_FILES["single_img"]["tmp_name"];
            // $arr = getimagesize($_FILES["single_img"]["tmp_name"]);

            // $image_width = $arr[0];
            // $image_height = $arr[1];
            // $single_img_link = $this->processImage($name, $type, $size, $tmp_name, $error, $image_width, $image_height);
            // return $single_img_link;
            // if($single_img_link == 'ext_err')
            // {
            //     return $single_img_link;
            // }elseif($single_img_link == 'file_err')
            // {
            //     return $single_img_link;
            // }elseif($single_img_link == 'dimension_err')
            // {
            //     return $single_img_link;
            // }

            $target_dir = "uploads/";
$target_file = $target_dir . basename($_FILES["single_img"]["name"]);
$uploadOk = 1;
$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

// Check if image file is a actual image or fake image
if(isset($_POST["submit"])) {
  $check = getimagesize($_FILES["single_img"]["tmp_name"]);
  if($check !== false) {
    echo "File is an image - " . $check["mime"] . ".";
    $uploadOk = 1;
  } else {
    echo "File is not an image.";
    $uploadOk = 0;
  }
}

// Check if file already exists
if (file_exists($target_file)) {
  echo "Sorry, file already exists.";
  $uploadOk = 0;
}

// Check file size
if ($_FILES["single_img"]["size"] > 500000) {
  echo "Sorry, your file is too large.";
  $uploadOk = 0;
}

// Allow certain file formats
if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
&& $imageFileType != "gif" ) {
  echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
  $uploadOk = 0;
}

// Check if $uploadOk is set to 0 by an error
if ($uploadOk == 0) {
  echo "Sorry, your file was not uploaded.";
// if everything is ok, try to upload file
} else {
  // if (move_uploaded_file($_FILES["single_img"]["tmp_name"], $target_file)) {
  //   echo "The file ". htmlspecialchars( basename( $_FILES["single_img"]["name"])). " has been uploaded.";
  // } else {
  //   echo "Sorry, there was an error uploading your file.";
  // }

  if (move_uploaded_file($_FILES["single_img"]["tmp_name"], $target_file)) {
    //do some code if file properly moved

}else {
    echo "File could not be successfully moved!<br>";
}
}
            break;
        }










        

        if(!empty(basename($_FILES["home-image1"]["name"])))
        {
            $name = $_FILES["home-image1"]["name"];
            $type = $_FILES["home-image1"]["type"];
            $size = $_FILES["home-image1"]["size"];
            $error = $_FILES["home-image1"]["error"];
            $tmp_name = $_FILES["home-image1"]["tmp_name"];
            $arr = getimagesize($_FILES["home-image1"]["tmp_name"]);

            $image_width = $arr[0];
            $image_height = $arr[1];
            $home_image1_link = $this->processImage($name, $type, $size, $tmp_name, $error, $image_width, $image_height);
            if($home_image1_link == 'ext_err')
            {
                return $home_image1_link;
            }elseif($home_image1_link == 'file_err')
            {
                return $home_image1_link;
            }elseif($home_image1_link == 'dimension_err')
            {
                return $home_image1_link;
            }else{
                return $home_image1_link;
            }
        }
        

          $home_image1_heading = filter_var($data['home_image1_heading'], FILTER_SANITIZE_STRING);
          $home_image1_desc = filter_var($data['home_image1_desc'], FILTER_SANITIZE_STRING);
          
          if(isset($home_image1_link))
          {
            $myQuery = "UPDATE homepage SET 
            home_image1 = '$home_image1_link'
            WHERE id = 1";
  
            
            $result = mysqli_query($this->db, $myQuery);
            if(!$result){
            return "Error: " .mysqli_error($this->db);
            }
          }


          $myQuery = "UPDATE homepage SET 
          home_image1_heading = '$home_image1_heading',
          home_image1_desc = '$home_image1_desc'
          WHERE id = 1";

          
          $result = mysqli_query($this->db, $myQuery);
          if(!$result){
          return "Error: " .mysqli_error($this->db);
          }else{
          return 'good';
          }
      }

  }

}