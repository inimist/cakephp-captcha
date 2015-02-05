<?php
/**
 * Captcha Behavior
 *
 * Behavior to handles Captcha verification
 *
 * PHP version 5+ and CakePHP version 2.6+
 *
 * Licensed under The MIT License
 * Redistributions of files must retain the copyright notice.
 *
 * @category    Behavior
 * @version     1.2
 * @author      Arvind Kumar <arvind.mailto@gmail.com>
 * @copyright   Copyright (C) Arvind Kumar
 * @license     MIT License (http://www.opensource.org/licenses/mit-license.php)
 *
 * Version history
 *
 * 2014-09-08  Initial version
 * 2014-12-27  Add configuration settings
 *
 */
App::uses('ModelBehavior', 'Model');

class CaptchaBehavior extends ModelBehavior
{
    /**
     * $config - Captcha Behavior configuration
     */
    public $config = array();

    /**
     * $captcha - The captcha Array
     */
    public $captcha = array();

    /**
     * $params - Parameters, added to $config
     */
    private $params = array(
        'field' => array('captcha'),
        'error' => 'Incorrect captcha code value'
    );

    /**
     * $rules - model validation rules
     */
    private $rules = array();

    /**
     * Store the captcha text value
     */
    private $_captcha = null;

    /**
     * setup() - Settings per model
     * @see (http://book.cakephp.org/2.0/en/models/behaviors.html) for details
     */
    public function setup(Model $model, $config = array()) {
        if (!isset($this->config[$model->alias])) {
            $this->config[$model->alias] = $this->params;
        }
        $this->config[$model->alias] = array_merge(
            $this->config[$model->alias], (array) $config);
        $this->rules[$model->alias] = $model->validate;
    }

    /**
     * beforeValidate() - Run just before our model validation sets off
     * @see (http://book.cakephp.org/2.0/en/models/behaviors.html) for details
     */
    public function beforeValidate(Model $model, $options = array()) {
        $validator = array(
            'rule' => array('validateCaptcha'),
            'message' => $this->config[$model->alias]['error']
        );
        $form_fields = $this->config[$model->alias]['field'];
        $fields = array();
        $fields = is_array($form_fields) ? $form_fields : array($form_fields);
        $rules = array();
        foreach ($fields as $field) {
            $rules[$field] = $validator;
        }
        $model->validate = array_merge($this->rules[$model->alias], $rules);
    }

    /**
     * Custom rule to validate captcha value
     *
     */
    public function validateCaptcha(Model $model, $check) {
        $field = key($check);
        return $check[$field] == $this->captcha[$field];
    }

    /**
     * Store captcha value in controller
     *
     */
    public function setCaptcha(Model $model, $field, $captcha) {
        $this->captcha[$field] = $captcha;
    }
}