<?php
/**
	* Component for Generating Captcha in CakePHP 2.x
	* PHP versions 5.2.8
	* @author     Arvind K.
	* @link       http://www.devarticles.in/
	* @copyright  Copyright © 2013 www.devarticles.in
	* @version 0.0.2
	* @copyright Copyright (c) Arvind K. (http://www.devarticles.in/)
	* @license   GPL (www.gnu.org/licenses/gpl.html)
	*   - Initial release
	*/
App::uses('Component', 'Controller');
class CaptchaComponent extends Component{
  public $fileroot = WWW_ROOT;
	public $themes = array(
		'default'=>array(
			'bgcolor'=>array(200,200, 200),
			'txtcolor'=>array(10, 30, 80),
			'noisecolor'=>array(60, 90, 120)
		)
	);
	public $settings = array(
		'font' => 'monofont.ttf', //arial.ttf - place font file somewhere and specify path here.
		'width' => 120,
		'height' => 40,
		'characters' => 6,
		'theme'=>'default',
		'font_adjustment'=>0.70
	);
	public function __construct(ComponentCollection $collection, $settings = array()) {
		$settings = array_merge($this->settings, (array)$settings);
		$this->Controller = $collection->getController();
		parent::__construct($collection, $settings);
	}
	function generateCode($characters) {
		/* list all possible characters ; similar looking characters and vowels have been removed */
		$possible = '23456789bcdfghjkmnpqrstvwxyz';//ABCDFGHJKMNPRSTVWXYZ
		$code = '';
		$i = 0;
		while ($i < $characters) { 
			$code .= substr($possible, mt_rand(0, strlen($possible)-1), 1);
			$i++;
		}
		return $code;
	}
	function create($settings = array()) {
		$width = $this->settings['width'];
		$height = $this->settings['height'];
		$characters = $this->settings['characters'];
		$this->prepare_themes();		
		$theme = $this->settings['theme'];
		$code = $this->generateCode($characters);
		/* font size will be 75% of the image height */
		$font_size = $height * $this->settings['font_adjustment'];
		$image = @imagecreate($width, $height) or die('Cannot initialize new GD image stream');
		/* set the colours */
		$background_color = imagecolorallocate($image, $this->themes[$theme]['bgcolor'][0], $this->themes[$theme]['bgcolor'][1], $this->themes[$theme]['bgcolor'][2]);
		$text_color = imagecolorallocate($image, $this->themes[$theme]['txtcolor'][0], $this->themes[$theme]['txtcolor'][1], $this->themes[$theme]['txtcolor'][2]);
		$noise_color = imagecolorallocate($image, $this->themes[$theme]['noisecolor'][0], $this->themes[$theme]['noisecolor'][1], $this->themes[$theme]['noisecolor'][2]);
		/* generate random dots in background */
		for( $i=0; $i<($width*$height)/3; $i++ ) {
			imagefilledellipse($image, mt_rand(0,$width), mt_rand(0,$height), 1, 1, $noise_color);
		}
		/* generate random lines in background */
		for( $i=0; $i<($width*$height)/150; $i++ ) {
			imageline($image, mt_rand(0,$width), mt_rand(0,$height), mt_rand(0,$width), mt_rand(0,$height), $noise_color);
		}
		/* create textbox and add text */
		$textbox = imagettfbbox($font_size, 0, $this->settings['font'], $code) or die('Error in imagettfbbox function');
		$x = ($width - $textbox[4])/2;
		$y = ($height - $textbox[5])/2;
		$y -= 5;
		imagettftext($image, $font_size, 0, $x, $y, $text_color, $this->settings['font'] , $code) or die('Error in imagettftext function');
		$this->Controller->Session->write('security_code',$code);
		@ob_end_clean(); //clean buffers, as a fix for 'headers already sent errors..'
		/* output captcha image to browser */
		header('Content-Type: image/jpeg');
		imagejpeg($image);
		imagedestroy($image);
	}
	function getVerCode()	{
		return $this->Controller->Session->read('security_code');
	}
	function prepare_themes()	{
		if($this->settings['theme']=='random')	{
			$this->themes['random'] = array(
				'bgcolor'=>array($bg_r=rand(0,255), $bg_g=rand(0,255), $bg_b=rand(0,255)),
				'txtcolor'=>array(rand(0,255), rand(0,255), rand(0,255)),
				'noisecolor'=>array(rand(0,255), rand(0,255), rand(0,255))
			);
			$ch_r = rand(40, 50);$ch_g = rand(40, 50);$ch_b = rand(40, 50);
			$txt_r = $bg_r+$ch_r >= 255 ? 255 : $bg_r+$ch_r;
			$txt_g = $bg_g+$ch_g >= 255 ? 255 : $bg_g+$ch_g;
			$txt_b = $bg_b+$ch_b >= 255 ? 255 : $bg_b+$ch_b;
			$this->themes['random']['txtcolor'] = array($txt_r, $txt_g, $txt_b);
		}
	}
}