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
        
        
        $target_dir = "images/uploads/";
        $datetime = date("Ymdhis");
        $imageName = str_replace(' ', '', basename($name));
        $target_file = $target_dir . $datetime . $imageName;
        $fileLoc = '../images/uploads/'. $datetime . $imageName;
        // $fileLoc = __DIR__.'/images/'. $datetime . $imageName;
        $allowedExts = array("png", "PNG", "JPEG", "JPG", "jpeg", "jpg");
        $extension = strtolower(pathinfo($name, PATHINFO_EXTENSION));
        $imageLink = 'http://localhost/acacia_blog_admin/'.$target_file;
        
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
              // if(move_uploaded_file($tmp_name, $fileLoc)){
              //     return 'uploaded';
              // }else{
              //     return 'not up';
              // }
              move_uploaded_file($tmp_name, $fileLoc);
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
          $unique_code = $data['unique_code']; 


        switch ($data['radio']) {
            case "single":
            $name = $_FILES["single_img"]["name"];
            $type = $_FILES["single_img"]["type"];
            $size = $_FILES["single_img"]["size"];
            $error = $_FILES["single_img"]["error"];
            $tmp_name = $_FILES["single_img"]["tmp_name"];
            $arr = getimagesize($_FILES["single_img"]["tmp_name"]);

            $image_width = $arr[0];
            $image_height = $arr[1];
            $single_img_link = $this->processImage($name, $type, $size, $tmp_name, $error, $image_width, $image_height);
            if($single_img_link == 'ext_err')
            {
                return $single_img_link;
            }elseif($single_img_link == 'file_err')
            {
                return $single_img_link;
            }elseif($single_img_link == 'dimension_err')
            {
                return $single_img_link;
            }
            

            $myQuery = "INSERT INTO blog 
            (unique_code, blog_single_img)
            VALUES 
            ('$unique_code','$single_img_link')";
  
            
            $result = mysqli_query($this->db, $myQuery);
            if(!$result){
            return "Error: " .mysqli_error($this->db);
            }
            break;


            case "slider":

              $sliders = [];
              for($x = 1; $x <= 5; $x++){
                $name = $_FILES["slider-img".$x]["name"];
                $type = $_FILES["slider-img".$x]["type"];
                $size = $_FILES["slider-img".$x]["size"];
                $error = $_FILES["slider-img".$x]["error"];
                $tmp_name = $_FILES["slider-img".$x]["tmp_name"];
                $arr = getimagesize($_FILES["slider-img".$x]["tmp_name"]);
                // return $arr;
    
                $image_width = $arr[0];
                $image_height = $arr[1];
                $slider_img = $this->processImage($name, $type, $size, $tmp_name, $error, $image_width, $image_height);
                if($slider_img == 'ext_err')
                {
                    return $slider_img.$x;
                }elseif($slider_img == 'file_err')
                {
                    return $slider_img.$x;
                }elseif($slider_img == 'dimension_err')
                {
                    return $slider_img.$x;
                }
                array_push($sliders, $slider_img);
              }


              // return $sliders;
              $blog_slider1 = $sliders[0];
              $blog_slider2 = $sliders[1];
              $blog_slider3 = $sliders[2];
              $blog_slider4 = $sliders[3];
              $blog_slider5 = $sliders[4];


              $myQuery = "INSERT INTO blog 
              (
                unique_code,
                blog_slider1,
                blog_slider2,
                blog_slider3,
                blog_slider4,
                blog_slider5
              )
              VALUES 
              (
                '$unique_code',
                '$blog_slider1',
                '$blog_slider2',
                '$blog_slider3',
                '$blog_slider4',
                '$blog_slider5'
              )";
    
              
              $result = mysqli_query($this->db, $myQuery);
              if(!$result){
              return "Error: " .mysqli_error($this->db);
              }
        }

        $blog_title = filter_var($data['blog_title'], FILTER_SANITIZE_STRING);
        $blog_body = filter_var($data['blog_body'], FILTER_SANITIZE_STRING);
        $blog_video = isset($data['video_link']) ? filter_var($data['video_link'], FILTER_SANITIZE_STRING) : NULL;

             $myQuery = "UPDATE blog SET 
            blog_title = '$blog_title',
            blog_body = '$blog_body',
            blog_video = '$blog_video'
            WHERE unique_code = '$unique_code'";

        
        $result = mysqli_query($this->db, $myQuery);
        if(!$result){
        return "Error: " .mysqli_error($this->db);
        }else{
          return 'good';
        }








        }

      }
    
    }



        

  //       if(!empty(basename($_FILES["home-image1"]["name"])))
  //       {
  //           $name = $_FILES["home-image1"]["name"];
  //           $type = $_FILES["home-image1"]["type"];
  //           $size = $_FILES["home-image1"]["size"];
  //           $error = $_FILES["home-image1"]["error"];
  //           $tmp_name = $_FILES["home-image1"]["tmp_name"];
  //           $arr = getimagesize($_FILES["home-image1"]["tmp_name"]);

  //           $image_width = $arr[0];
  //           $image_height = $arr[1];
  //           $home_image1_link = $this->processImage($name, $type, $size, $tmp_name, $error, $image_width, $image_height);
  //           if($home_image1_link == 'ext_err')
  //           {
  //               return $home_image1_link;
  //           }elseif($home_image1_link == 'file_err')
  //           {
  //               return $home_image1_link;
  //           }elseif($home_image1_link == 'dimension_err')
  //           {
  //               return $home_image1_link;
  //           }else{
  //               return $home_image1_link;
  //           }
  //       }
        

  //         $home_image1_heading = filter_var($data['home_image1_heading'], FILTER_SANITIZE_STRING);
  //         $home_image1_desc = filter_var($data['home_image1_desc'], FILTER_SANITIZE_STRING);
          
  //         if(isset($home_image1_link))
  //         {
  //           $myQuery = "UPDATE homepage SET 
  //           home_image1 = '$home_image1_link'
  //           WHERE id = 1";
  
            
  //           $result = mysqli_query($this->db, $myQuery);
  //           if(!$result){
  //           return "Error: " .mysqli_error($this->db);
  //           }
  //         }


  //         $myQuery = "UPDATE homepage SET 
  //         home_image1_heading = '$home_image1_heading',
  //         home_image1_desc = '$home_image1_desc'
  //         WHERE id = 1";

          
  //         $result = mysqli_query($this->db, $myQuery);
  //         if(!$result){
  //         return "Error: " .mysqli_error($this->db);
  //         }else{
  //         return 'good';
  //         }
