Cakephp Captcha Component 2.0
=============================

A CakePHP Component to Display and Model Validation of Captcha.

Requirements
--------------------
This component requires the GD library and the FreeType (optional but recommended) library enabled. Please check [http://www.php.net/manual/en/function.imagettftext.php] for more details.


How to install
--------------------

Extract files to find a directory named "app". Copy this "app" directory on the top of "app" directory of your CakePHP install. It should automatically copy and merge package files to their actual locations. If you are not sure about this action consider to move files manually to the following locations.

Manually Copying files
--------------------
app/Controller/Component/CaptchaComponent.php (required)

app/Controller/SignupsController.php (example only file)

app/Model/Signup.php (example only file)

app/View/Helper/CaptchaHelper.php (required)

app/View/Signups/add.ctp (example only file)

app/webroot/monofont.ttf (required)

After files have been copied include CaptchaHelper in your controller. Example:

    var $helpers = array('Html', 'Form', '**Captcha**');

Next load CaptchaComponent. There are two ways to do it. eg.,

**Loading in the controller definitions**

    var $components = array('Captcha'=> 
      array('captchaType'=>'math', 
      'jquerylib'=>true, 
      'modelName'=>'Signup', 
      'fieldName'=>'captcha')
      ); //load it

**Loading on the fly** (see "add" function in the attached controller)

    $this->Captcha = $this->Components->load('Captcha', 
      array('captchaType'=>'math', 
      'jquerylib'=>true, 
      'modelName'=>'Signup', 
      'fieldName'=>'captcha')
      ); //load it

What's New
--------------------

* Supports Image and Simple Math captcha
* Works without GD Truetype font support
* Default and Random themes for Image Captcha
* Checks for missing font file
* Inclusion of jQuery library from Google
* Option to specify Model and Field names in form
* Demo: http://ww2.inimist.com/cakephp-2.4.1/signups/add

What's Next
--------------------

Making a CakePHP Plugin out of it. Contact me or throw me a message at http://www.devarticles.in/contact or to arvind dot mailto at gmail dot com
