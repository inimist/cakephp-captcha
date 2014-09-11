Cakephp Captcha Component 2.5
=============================

A CakePHP Component to Display and Model Validation of Captcha.

Features
--------------------
* Multiple Captcha Support.
	- It simply supports multiple captchas on a page. In different forms or in a single form.
* Model Validation attahced as Behavior
* Image and/or Simple Math Captchas
* Configurable Model Name, Field Name, Captcha Height, Width, Number of Characters and Font Face, Size, Angle of rotation
* Works without GD Truetype font support
* Random or Fixed Captcha Themes for Image Captchaa
* Random Font face

Installation
--------------------

Place all files bundled in this package in corresponding folders. Then follow instructions given below.

**In Controller**

Add in the top definitions of your controller.

    var $components = array('Captcha'=>array('Model'=>'Signup', 'field'=>'captcha'));//'Captcha'

Note: "*captcha*" is the field name for which we are binding this captcha here in examples. Replace with appropriate name.

Add this function in your controller.

    function captcha()	{
        $this->autoRender = false;
        $this->layout='ajax';
        $this->Captcha->create();
    }

Add the similar logic to the function which is the "action" of your form, in your controller. The highlighted line is the one which is related to the captcha component.

    function add()	{
        if(!empty($this->request->data))	{
            <span style="background:yellow">$this->Signup->setCaptcha('captcha', $this->Captcha->getCode('Signup.captcha'));</span>
            $this->Signup->set($this->request->data);
            if($this->Signup->validates())	{ //as usual data save call
                // validation passed, do save or something
            }	else	{ //or
                $this->Session->setFlash('Data Validation Failure', 'default', array('class' => 'cake-error'));
                //validation not passed, do something else
            }
        }
    }


##In Model

Add CaptchaBehaviour in the Model definitions, as following:

    public $actsAs = array(
        'Captcha' => array(
            'field' => array('captcha'),
            'error' => 'Incorrect captcha code value'
        )
    );

##In View

Add form code in the view file, in the form where you want the captcha image to appear:

    echo $this->Form->create("Signups");
    $this->Captcha->render();
    echo $this->Form->submit(__(' Submit ',true));
    echo $this->Form->end();


And importanly place the following javascript script code in somewhere in your page so it is called properly and execute.

    &lt;script src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js">&lt;/script>
    &lt;script>
    jQuery('.creload').on('click', function() {
        var mySrc = $(this).prev().attr('src');
        var glue = '?';
        if(mySrc.indexOf('?')!=-1)  {
            glue = '&';
        }
        $(this).prev().attr('src', mySrc + glue + new Date().getTime());
        return false;
    });
    &lt;/script>

That should be it!

**Few more examples

Example of custom settings:

<pre class=prettyprint>
echo $this->Form->create("Signups");
$custom1['width']=150;
$custom1['height']=50;
$custom1['theme']='default';
$this->Captcha->render($custom1);


Example of multiple captchas:

<pre class=prettyprint>
//form 1
echo $this->Form->create("Signups");
$custom1['width']=150;
$custom1['height']=50;
$this->Captcha->render($custom1);

//form 2, A math captcha, anywhere on the page
echo $this->Form->create("Users");
$custom2['type']='math';
$this->Captcha->render($custom2);


**Options which can be set in your view file with form, are:**

* *model*: model name.
* *field*: field name.
* *type*: image or math. If set to 'math' all settings given below are ignored
* *width*: width of image captcha
* *height*: height of image captcha
* *theme*: theme/difficulty image captcha
* *length*: number of characters in image captcha
* *angle*: angle of rotation for characters in image captcha


**There are a few other options which, at the moment, can be set in the component file directly**

What's New
--------------------
* Tested upto CakePHP 2.5.4
* Multiple Image and Simple Math captcha
* Default and Random themes for Image Captcha
* Multiple font files placed in Lib
* Fully controlled from View file through Helper

*Demo: [http://captcha.inimist.com]*

**Download**
[Send me a message](http://devarticles.in/contact/) to receive latest captcha files*.

The version here at Github is also a stable one but without multiple Captcha Support.

*(My apologies but this work is being duplicated and published without my knowledge and credit.)*