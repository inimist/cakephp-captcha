<?php
/**
 * Captcha Behavior
 *
 * Behavior which handles Captcha verification
 *
 * PHP version 5 and CakePHP version 2.5+
 *
 * Licensed under The MIT License
 * Redistributions of files must retain the above copyright notice.
 *
 * @category    Behavior
 * @version     1.0
 * @author      Arvind Kumar <arvind.mailto@gmail.com>
 * @copyright   Copyright (C) Arvind Kumar
 * @license     MIT License (http://www.opensource.org/licenses/mit-license.php)
 *
 * Version history
 *
 * 2014-09-08  Initial version
 *
 */
App::uses('ModelBehavior', 'Model');

class CaptchaBehavior extends ModelBehavior
{

    /**
     * Behavior configuration settings
     *
     * @var array
     * @access public
     */
    public $_config = array();

    /**
     * Initialized Captcha
     *
     * @var array
     * @access public
     */
    public $captcha = array();

    /**
     * Default values to be merged with _config
     *
     * @var array
     * @access private
     */
    private $_defaults = array(
        'field' => array('captcha'),
        'error' => 'Incorrect captcha code value'
    );

    /**
     * Core validation rules set on model
     *
     * @var array
     * @access private
     */
    private $_rules = array();

    /**
     * Store the captcha text value
     *
     * @var string
     * @access private
     */
    private $_captcha = null;

    /**
     * (non-PHPdoc)
     * @see ModelBehavior::setup()
     */
    public function setup(Model $model, $config = array()) {
        if (!isset($this->_config[$model->alias])) {
            $this->_config[$model->alias] = $this->_defaults;
        }

        $this->_config[$model->alias] = array_merge(
            $this->_config[$model->alias], (array) $config);

        $this->_rules[$model->alias] = $model->validate;
    }

    /**
     * (non-PHPdoc)
     * @see ModelBehavior::beforeValidate()
     */
    public function beforeValidate(Model $model) {
        $validator = array(
            'rule' => array('validateCaptcha'),
            'message' => $this->_config[$model->alias]['error']
        );

        $original_fields = $this->_config[$model->alias]['field'];
        $fields = array();
        $fields = is_array($original_fields) ?
            $original_fields : array($original_fields);

        $rules = array();
        foreach ($fields as $field) {
            $rules[$field] = $validator;
        }

        $model->validate = array_merge($this->_rules[$model->alias], $rules);
    }

    /**
     * Custom validation rule to check captcha value 
     *
     * @param object $model The model reference
     * @param array $check The array containing captcha field value
     * @access public
     * @return boolean True if the captcha values match
     */
    public function validateCaptcha(Model $model, $check) {
        $field = key($check);
        return $check[$field] == $this->captcha[$field];
    }

    /**
     * Store captcha value (from session via controller)
     *
     * @param object $model The model reference
     * @param string $value The captcha value
     * @access public
     * @return void
     */
    public function setCaptcha(Model $model, $field, $captcha) {
        $this->captcha[$field] = $captcha;
    }

}