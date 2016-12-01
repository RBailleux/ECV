<?php 

	function generateCaptcha($mot)
	{
		$img = imagecreate(strlen($mot)*20, 20);
		$blanc = imagecolorallocate($img, 255, 255, 255); 
		$noir = imagecolorallocate($img, 0, 0, 0);
		imagestring($img, 8, 5, 0, $mot, $noir);
		imagepng($img);
		imagedestroy($img);
	}
	
	session_start();
	generateCaptcha($_SESSION['captcha']);

?>