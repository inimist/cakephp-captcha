  <?php
  /**
  * Component for Generating Captcha in CakePHP 2.x
  * PHP versions 5.2.8
  * @author     Arvind K. (arvind.mailto@gmail.com)
  * @link       http://www.devarticles.in/
  * @copyright  Copyright © 2013 www.devarticles.in
  * @version 2.0
  * @copyright Copyright (c) Arvind K. (http://www.devarticles.in/)
  * @license   GPL (www.gnu.org/licenses/gpl.html)
  *   - Initial release
  */
  App::uses('Component', 'Controller');
  class CaptchaComponent extends Component{
    public $fileroot = WWW_ROOT;
    public $errors = array();
    public $fatalError = false;
    public $TTFSupport = true;
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
      'fontAdjustment'=>0.70,
      'captchaType'=>'image',
      'jquerylib'=>false,
       'modelName' => 'Signup',
       'fieldName' => 'captcha'
    );
    public function __construct(ComponentCollection $collection, $settings = array()) {
      $settings = array_merge($this->settings, (array)$settings);
      $this->Controller = $collection->getController();
      parent::__construct($collection, $settings);
      $this->init();
    }
    function init() {
      $this->checkTTFSupport();
      $this->initType();
      if($this->hasFatalError()) {
        die($this->getStringErrors());
      }
      $this->Controller->set('captchaSettings', $this->getSettings());
    }
    function generateCode($characters) {
      /* list all possible characters ; similar looking characters and vowels have been ommitted */
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
      switch($this->getType()):
        case 'image';
          $this->renderImageCaptcha();
        break;
        case 'math';
        if(isset($this->Controller->request->data[$this->settings['modelName']][$this->settings['fieldName']]))  {
          $this->Controller->Session->write('security_code_math', $this->Controller->Session->read('security_code'));
        }
        $this->renderMathCaptcha();
        break;
      endswitch;
    }
    function initType()  {      
      if($this->getType() == 'image')  {       
        if(!$this->gdInfo())  {
           $this->setError('Cannot use image captcha as GD library is not enabled! Set $this->settings[\'captchaType\'] => \'math\' in order to show a simple math captcha instead!');
           $this->fatalError = true;
        } else  {
          if(!$this->TTFEnabled())  {
            $this->setError("For best results use GD library with freetype font enabled!");
            if(Configure::read('debug'))  {
              debug("CAPTCHA COMPONENT - For best results use GD library with Freetype enabled!");
            }
          } else if(!file_exists($this->settings['font'])) {
            $this->setError("The font file does not exist at the location: " . $this->settings['font']);
            $this->fatalError = true;
          }
        }
      } else  {
        $this->create();
      }
    }
    function setType($type)  {
      $this->settings['captchaType'] = $type;
    }
    function getType()  {
      return $this->settings['captchaType'];
    }
    function renderMathCaptcha()  {
      $operators = array("+", "-", "*");
      $rand_key = array_rand($operators);
      switch($operators[$rand_key]):
        case "+":
          $a = rand(0,20);
          $b = rand(0,20);
          $code = $a + $b;
          $stringOperation = $a . " + " . $b;
        break;
        case "-":
          $a = rand(0,20);
          $b = rand(0,20);
          $code = $a > $b ? $a - $b : $b - $a;
          $stringOperation =  $a > $b ? $a . " - " . $b : $b . " - " . $a;
        break;
        case "*":
          $a = rand(0,10);
          $b = rand(0,10);
          $code = $a * $b;
          $stringOperation = $a . " * " . $b;
        break;
      endswitch;

      $this->settings['stringOperation'] = $stringOperation;
      $this->Controller->Session->write('security_code',$code);
    }
    function renderImageCaptcha() {
      $width = $this->settings['width'];
      $height = $this->settings['height'];
      $characters = $this->settings['characters'];
      $this->prepare_themes();
      $theme = $this->settings['theme'];
      if(!$this->TTFEnabled())  {
        $width = 70;
        $height = 30;
        $theme = "default";
        $this->themes[$theme]['txtcolor'] = array(255, 255, 255);
      }
      $code = $this->generateCode($characters);
      /* font size will be 75% of the image height */
      $font_size = $height * $this->settings['fontAdjustment'];
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
      if($this->TTFEnabled())  {
        $textbox = imagettfbbox($font_size, 0, $this->settings['font'], $code) or die('Error in imagettfbbox function');
        $x = ($width - $textbox[4])/2;
        $y = ($height - $textbox[5])/2;
        $y -= 5;
        imagettftext($image, $font_size, 0, $x, $y, $text_color, $this->settings['font'] , $code) or die('Error in imagettftext function');
      } else if(function_exists("imagestring"))  {
        //$font_size = imageloadfont($this->settings['font']);
        $textbox = imagestring($image, 5, 5, 5, $code, $text_color) or die('Error in imagestring function');
      } else  {
        $this->setError("Cannot use image captcha without GD Library enabled!");
      }
      $this->Controller->Session->write('security_code',$code);
      @ob_end_clean(); //clean buffers, as a fix for 'headers already sent errors..'
      /* output captcha image to browser */
      header('Content-Type: image/jpeg');
      imagejpeg($image);
      imagedestroy($image);
    }
    function getVerCode()	{
      if($this->getType()=='image')  {
        return $this->Controller->Session->read('security_code');
      } else if($this->getType()=='math')  {
        return $this->Controller->Session->read('security_code_math');
      }
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
    function setError($error_message) {
      $this->errors[] = $error_message;
    }
    function getErrors() {
      return $this->errors;
    }
    function hasErrors() {
      return !is_null($this->errors);
    }
    function hasFatalError()  {
      return $this->fatalError;
    }
    function getStringErrors()  {
      if($this->hasErrors())  {
        $html = '<p>CAPTCH ERRORS:</p><ul class="c-errors">';
        foreach($this->getErrors() as $error) {
          $html .= '<li>' . $error . '</li>';
        }
        $html .= '</ul>';
        return $html;
      }
    }
    function checkTTFSupport() {
      if(!function_exists("imagettftext")) $this->TTFSupport = false;
    }
    function TTFEnabled()  {
      return $this->TTFSupport;
    }
    function getSettings()  {
      return $this->settings;
    }
    function gdInfo() {
      if(!function_exists("gd_info")) return false;
      return true;
    }
  }