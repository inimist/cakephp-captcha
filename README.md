[CakePHP 3 Captcha Plugin](https://github.com/inimist/cakephp3-captcha/)

Cakephp Captcha Support Plugin 2.7
=============================

A CakePHP Captchas support with automatic Model Validation. Tested upto CakePHP 2.9.3.

Features
--------------------
* Multiple Captcha Support.
	- It simply supports multiple captchas on a page. In different forms or 
	in a single form.
* Model Validation attahced as Behavior
* Image and/or Simple Math Captchas
* Configurable Model Name, Field Name, Captcha Height, Width, Number of 
Characters and Font Face, Size, Angle 
of rotation
* Works without GD Truetype font support
* Random or Fixed Captcha Themes for Image Captchaa
* Random Font face

Demo
--------------------
https://captcha.inimisttech.com


Installation
--------------------

Place all files bundled in this package in corresponding folders. Then follow 
instructions given below.

Configuration (optional)
--------------------

Open app/Plugin/Captcha/Controller/Component/CaptchaComponent.php file and make necessary changes in the $settings variable 
defined near line 125.

Implementation
--------------------

Follow instructions given below to place code in Controller, Model and View files.

###In Controller

Add in the top definitions, in $uses, $components and $helpers in your controller, as per the CakePHP convensions.

    var $components = array('Captcha.Captcha'=>array('Model'=>'Signup', 
    'field'=>'captcha'));//'Captcha.Captcha'

    var $uses = array('CurrentModel'); //replace "CurrentModel" with your current. The default model in this example is "Signup"

    public $helpers = array('Captcha.Captcha'); // and the default helpers like Form, Session, HTML etc

    //(Thanks to "Vasile Martiniuc" for pointing out the error due to different model than Signup in $uses :))

Note: "*captcha*" is the field name for which we are binding this captcha here 
in examples. Replace with 
appropriate name.

Add this function in your controller.

    function captcha()	{
        $this->autoRender = false;
        $this->layout='ajax';
        $this->Captcha->create();
    }

Add the similar logic to the function which is the "action" of your form, in 
your controller. The highlighted 
line (line 3 here) is the one which is related to the captcha component.

    function add()	{
        if(!empty($this->request->data))	{
            $this->Signup->setCaptcha('captcha', 
	    $this->Captcha->getCode('Signup.captcha'));
            $this->Signup->set($this->request->data);
            if($this->Signup->validates())	{ //as usual data save call
                // validation passed, do save or something
            }	else	{ //or
                $this->Session->setFlash('Data Validation Failure', 'default', 
		array('class' => 
		'cake-error'));
                //validation not passed, do something else
            }
        }
    }


###In Model

Add CaptchaBehaviour in the Model definitions, as following:

    public $actsAs = array(
        'Captcha.Captcha' => array(
            'field' => array('captcha'),
            'error' => 'Incorrect captcha code value'
        )
    );

###In View

Add form code in the view file, in the form where you want the captcha image to 
appear:

    echo $this->Form->create("Signups");
    $this->Captcha->render();
    echo $this->Form->submit(__(' Submit ',true));
    echo $this->Form->end();


And importanly place the following javascript script code in somewhere in your 
page so it is called properly 
and execute.

    <script 
    src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></scr
    ipt>
    <script>
    jQuery('.creload').on('click', function() {
        var mySrc = $(this).prev().attr('src');
        var glue = '?';
        if(mySrc.indexOf('?')!=-1)  {
            glue = '&';
        }
        $(this).prev().attr('src', mySrc + glue + new Date().getTime());
        return false;
    });
    </script>

That should be it!

##More examples

###Custom settings:

    echo $this->Form->create("Signups");
    $custom1['width']=150;
    $custom1['height']=50;
    $custom1['theme']='default';
    $this->Captcha->render($custom1);

###Multiple captchas:

    //form 1
    echo $this->Form->create("Signups");
    $custom1['width']=150;
    $custom1['height']=50;
    $this->Captcha->render($custom1);

    //form 2, A math captcha, anywhere on the page
    echo $this->Form->create("Users");
    $custom2['type']='math';
    $this->Captcha->render($custom2);


**Settings that can be set in your view file:**

* *model*: model name.
* *field*: field name.
* *type*: image or math. If set to 'math' all following settings will be 
obsolete
* *width*: width of image captcha
* *height*: height of image captcha
* *theme*: theme/difficulty image captcha
* *length*: number of characters in image captcha
* *angle*: angle of rotation for characters in image captcha

Additional settings that can be set in Component file.

* *fontAdjustment*: Responsible for the font size relational to Captcha Image 
Size
* *reload_txt*: The phrase which appears as a Captcha Reload link
* *clabel*: Label for Image Captcha Value input field
* *mlabel*: Label for Math Captcha Value input field

What's New
--------------------
* Tested upto CakePHP 2.9.3
* Multiple Image and Simple Math captcha
* Default and Random themes for Image Captcha
* Multiple font files placed in Lib
* Fully controlled from View file through Helper

~~

License
--------------------
Licensed under The MIT License
Redistributions of files must retain the given copyright notice.
http://opensource.org/licenses/MIT


Copyright
--------------------
Copyright (C) Arvind Kumar, arvind@inimist.com


-----------------------------
Looking for a CakePHP Developer?
-----------------------------
* I like to build Websites in **CakePHP** & **Wordpress**. [Contact me](http://devarticles.in/contact/).
* Upwork: https://www.upwork.com/freelancers/~01ea3d34e0a88133b3
