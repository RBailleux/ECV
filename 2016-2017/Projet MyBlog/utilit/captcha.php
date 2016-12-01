<?php 

	/*
	 * Generate a random sting
	 * @param 	int		$size	Length of the string
	 * @return 	string			A randomly generated string
	 */
	function generateText($size = 6){
		$chars = ['a','b','c','d','e','f','g','h','i','j','k','l','m','n','o','p','q','r','s','t','u','v','w','x','y','z','-','$','!','?'];
		$text = '';
		for($i = 0; $i<$size; $i++){
			$text.=$chars[rand(0,count($chars)-1)];
		}
		return $text;
	}

?>