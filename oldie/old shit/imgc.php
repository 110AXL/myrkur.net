<?php
        header('Content-type: image/png');
        $myImage = imagecreate(200, 100);
        $myGray = imagecolorallocate($myImage, 204, 204, 204);
        $myBlack = imagecolorallocate($myImage, 0, 0, 0);
        imageline($myImage, 15, 35, 130, 20, $myBlack);
		$text_color = imagecolorallocate($myImage, 233, 14, 91);
		imagestring($myImage, 1, 25, 25,  'A Simple Text String', $text_color);

        imagepng($myImage);
        imagedestroy($myImage);
?>