<?php
session_start();
require_once "../../dbh.php";
$UserId = $_SESSION['user_id'];
$PersonalDataId = $_SESSION['pd_id'];

$image_sql_read = "SELECT * FROM picture WHERE us_id = $UserId";
                if($image_result = mysqli_query($conn, $image_sql_read)){
                  	if(mysqli_num_rows($image_result) > 0){
                    	while($image_row = mysqli_fetch_array($image_result)){
                      		$image = $image_row['picture'];
                                          
                    	}
                  	}else{
                    	$image = "Unknown Picture";
                  	}
                } else {
                  echo "ERROR: Could not able to execute $image_sql_read. " . mysqli_error($conn);
                }

$target_Path = "../profile-picture/$image";
list( $width,$height ) = getimagesize( $target_Path );
if($height>$width){
	$newwidth = $width;
	$newheight = $width;
}else{
	$newwidth = $height;
	$newheight = $height;
}
$imagee = imagecreatefromjpeg($target_Path);
$imgcrop = imagecrop($imagee, ['x' => $width/2-$newwidth/2, 'y' => 0, 'width' => $newwidth, 'height' => $newheight]);
$filenamenew = $image;
imagejpeg($imgcrop, $filenamenew);
header("location: ../../form/personaldata.php");