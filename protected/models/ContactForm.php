<?php

/**
 * ContactForm class.
 * ContactForm is the data structure for keeping
 * contact form data. It is used by the 'contact' action of 'SiteController'.
 */
class ContactForm extends CFormModel
{
	public $name;
	public $email;
	public $subject;
	public $body;
	public $verifyCode;
	public $mobile;

	/**
	 * Declares the validation rules.
	 */
	public function rules()
	{
		return array(
			// name, email, subject and body are required
			array('name, email, subject, body', 'required'),
			array('mobile', 'length', 'min' => '11', 'max'=>11),
			array('mobile', 'numerical', 'integerOnly'=>true),
			// email has to be a valid email address
			array('email', 'email'),
			// verifyCode needs to be entered correctly
			array('verifyCode', 'captcha', 'allowEmpty'=>!CCaptcha::checkRequirements()),
		);
	}

	/**
	 * Declares customized attribute labels.
	 * If not declared here, an attribute would have a label that is
	 * the same as its name with the first letter in upper case.
	 */
	public function attributeLabels()
	{
		return array(
			'name'=>'نام',
			'email'=>'ایمیل',
			'subject'=>'موضوع',
			'mobile' => 'شماره تلفن',
			'body'=>'متن',
			'captcha'=>'کد امنیتی',
			'verifyCode'=>'کد امنیتی',
		);
	}
}