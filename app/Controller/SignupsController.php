<?php
/**
	* (Sample) Controller for Showing the use of Captcha*
	* @author     Arvind Kumar (arvind.mailto@gmail.com)
	* @link       http://www.devarticles.in/
	* @copyright  Copyright © 2014 http://www.devarticles.in/
	* @version 2.5 Tested OK in Cakephp 2.5.4
	*/
class SignupsController extends AppController {

	var $name = 'Signups';
	var $uses = array('Signup');
	//var $helpers = array('Captcha.Captcha');
	var $components = array('Captcha.Captcha'=>array('field'=>'security_code'));//'Captcha'

    function captcha()	{
        $this->autoRender = false;
        $this->layout='ajax';
        if(!isset($this->Captcha))	{ //if you didn't load in the header
            $this->Captcha = $this->Components->load('Captcha.Captcha'); //load it
        }
        $this->Captcha->create();
    }

    function add()	{
        //$this->Captcha = $this->Components->load('Captcha'); //load it
        if(!empty($this->request->data))	{
            /*if(!isset($this->Captcha))	{ //if Component was not loaded throug $components array()
                $this->Captcha = $this->Components->load('Captcha'); //load it
            }*/
            $this->Signup->setCaptcha('security_code', $this->Captcha->getCode('Signup.security_code')); //getting from component and passing to model to make proper validation check
            $this->Signup->set($this->request->data);
            if($this->Signup->validates())	{ //as usual data save call
                //$this->Signup->save($this->request->data);//save or something
                // validation passed, do something
                $this->Session->setFlash('Data Validation Success', 'default', array('class' => 'notice success'));
            }	else	{ //or
                $this->Session->setFlash('Data Validation Failure', 'default', array('class' => 'cake-error'));
                //pr($this->Signup->validationErrors);
                //something do something else
            }
        }
    }
    function demo($ctype='multiple')	{

        $this->set('ctype', $ctype);

        //$this->Captcha = $this->Components->load('Captcha'); //load it

        if(!empty($this->request->data))	{

            /*if(!isset($this->Captcha))	{ //if Component was not loaded throug $components array()
                $this->Captcha = $this->Components->load('Captcha'); //load it
            }*/
            if(isset($this->request->data['Signup']))   {
                $this->Signup->setCaptcha('security_code', $this->Captcha->getCode('Signup.security_code')); //getting from component and passing to model to make proper validation check
                $this->Signup->set($this->request->data);
                if($this->Signup->validates())	{ //as usual data save call
                    //$this->Signup->save($this->request->data);//save or something
                    // validation passed, do something
                    $this->Session->setFlash('Data Validation Success', 'default', array('class' => 'notice success'));
                }	else	{ //or
                    $this->Session->setFlash('Data Validation Failure', 'default', array('class' => 'cake-error'));
                    //pr($this->Signup->validationErrors);
                    //something do something else
                }
            }

            if(isset($this->request->data['User']))   {
                $this->loadModel('User');
                $this->User->setCaptcha('ssecurity', $this->Captcha->getCode('User.ssecurity')); //getting from component and passing to model to make proper validation check
                $this->User->set($this->request->data);
                if($this->User->validates())	{ //as usual data save call
                    //$this->Signup->save($this->request->data);//save or something
                    // validation passed, do something
                    $this->Session->setFlash('Data Validation Success','default', array('class' => 'notice success'));
                }	else	{ //or
                    $this->Session->setFlash('Data Validation Failure', 'default', array('class' => 'cake-error'));
                    //pr($this->Signup->validationErrors);
                    //something do something else
                }
            }

            if(isset($this->request->data['Contact']))   {

                $this->loadModel('Contact');
                $this->Contact->setCaptcha('math_question', $this->Captcha->getCode('Contact.math_question')); //getting from component and passing to model to make proper validation check
                $this->Contact->set($this->request->data);
                if($this->Contact->validates())	{ //as usual data save call
                    //$this->Signup->save($this->request->data);//save or something
                    // validation passed, do something
                    $this->Session->setFlash('Data Validation Success','default', array('class' => 'notice success'));
                }	else	{ //or
                    $this->Session->setFlash('Data Validation Failure', 'default', array('class' => 'cake-error'));
                    //pr($this->Signup->validationErrors);
                    //something do something else
                }
            }
        }
    }
}