<?php

function imageList($dirname){
	$arrayfiles=Array();
	if(file_exists($dirname)){
		$handle = opendir($dirname);
		while (false !== ($file = readdir($handle))) { 
			if(is_file($dirname.$file)){
				array_push($arrayfiles,$file);
			}
		}
		$handle = closedir($handle);
	}
	sort($arrayfiles);
	return $arrayfiles;
}


function thumbGenerate($imageName,$galleryPath,$thumbSizes,$root,$respThumb) {
	$imageName = $root.$galleryPath.$imageName;
    $thumbDir = $root.$galleryPath.'thumb';
    if (!file_exists($thumbDir)) {
        mkdir($thumbDir, 0777, true);
    }
	$name = basename($imageName);
	$image = imagecreatefromjpeg($imageName);
	$filename = $root.$galleryPath.'thumb/thumb-'.$name;
    
    // update 1.1.3
    if ($respThumb == TRUE) {
        $name = basename($name,'.jpg');
        $filename = $root.$galleryPath.'thumb/thumb-'.$name.'@2x.jpg';
    }
	
	$thumb_width = $thumbSizes[0];
	$thumb_height = $thumbSizes[1];
	
	$width = imagesx($image);
	$height = imagesy($image);
	
	$original_aspect = $width / $height;
	$thumb_aspect = $thumb_width / $thumb_height;
	
	if ( $original_aspect >= $thumb_aspect )
	{
	   // If image is wider than thumbnail (in aspect ratio sense)
	   $new_height = $thumb_height;
	   $new_width = $width / ($height / $thumb_height);
	}
	else
	{
	   // If the thumbnail is wider than the image
	   $new_width = $thumb_width;
	   $new_height = $height / ($width / $thumb_width);
	}
	
	$thumb = imagecreatetruecolor( $thumb_width, $thumb_height );
	
	// Resize and crop
	imagecopyresampled($thumb,
					   $image,
					   0 - ($new_width - $thumb_width) / 2, // Center the image horizontally
					   0 - ($new_height - $thumb_height) / 2, // Center the image vertically
					   0, 0,
					   $new_width, $new_height,
					   $width, $height);
	imagejpeg($thumb, $filename, 100);
    
    md5gen($galleryPath,$root);

}

function md5gen($galleryPath,$root) {
    $logDir = $root.$galleryPath.'/logs';
    if (!file_exists($logDir)) {
        mkdir($logDir, 0777, true);
    }
    $logFile = $logDir.'/gallery-log.txt';
	$handle = fopen($logFile, 'w') or die('Cannot open file:  '.$logFile);
    $md5 = md5_file($root.$galleryPath);
	fwrite($handle, $md5);
}

function md5check($galleryPath,$root) {
    $md5file = $root.$galleryPath.'/logs/gallery-log.txt';
    $md5file = file_get_contents($md5file);
    if (md5_file($root.$galleryPath) == $md5file) {
        $result = "not-changed";
    }else{
        $result = "changed";
    }
    return $result;
}

function galleryGenerate($galleryPath,$forceGenerate,$thumbSizes,$elementId,$root,$responsive) {
    $md5check = md5check($galleryPath,$root);
	$galleryImages = imageList($root.$galleryPath);
	$galleryNumb = count($galleryImages);
	for ($i=0; $i<$galleryNumb; $i++) {
		if (($forceGenerate == 1) or (md5check == "changed")) {
            $respThumb = FALSE;
			thumbGenerate($galleryImages[$i],$galleryPath,$thumbSizes,$root,$respThumb);
            //update 1.1.3
            if ($responsive == TRUE) {
                $respThumb = TRUE;
                $respThumbW = $thumbSizes[0] * 2;
                $respThumbH = $thumbSizes[1] * 2;
                $respThumbSizes[] = $respThumbW;
                $respThumbSizes[] = $respThumbH;
                thumbGenerate($galleryImages[$i],$galleryPath,$respThumbSizes,$root,$respThumb);
            }
		}	
        $alt = $i+1;
		$code['jsonFancy'][] = "<a href=\"".$galleryPath.$galleryImages[$i]."\"><img src=\"".$galleryPath."thumb/thumb-".$galleryImages[$i]."\" alt=\"Image ".$alt."\" /></a>";
        $code['jsonNoFancy'][] = "<img src=\"".$galleryPath."thumb/thumb-".$galleryImages[$i]."\" alt=\"Image ".$alt."\" />";
		$galleryJsArray[] = "
				{
					'href'	: '".$galleryPath.$galleryImages[$i]."'
				}
			";
	}
	return $code;
}


	
?>


