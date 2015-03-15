<?php

/**
 * ContactForm class.
 * ContactForm is the data structure for keeping
 * contact form data. It is used by the 'contact' action of 'SiteController'.
 */
class changeAdmin extends CFormModel
{
	public $oldpassword;
	public $password;
	public $password_repeat;

	/**
	 * Declares the validation rules.
	 */
	public function rules()
	{
		return array(
			array('password, oldpassword, password_repeat', 'required'),
			array('password', 'length', 'min' => '6'),
			array('password', 'compare', 'compareAttribute'=>'password_repeat'),
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
			'oldpassword'=>'رمز قبلی',
			'password'=>'رمز جدید',
			'password_repeat'=>'تکرار رمز جدید',
		);
	}
	public function setNewPassword()
	{
		$user = User::model()->find('lower(username) = \'admin\'');
		$user->password = $this->password;
		return $user->save();
	}
	public function validatePassword()
	{
		$user = User::model()->find('lower(username) = \'admin\'');
		return $user->validatePassword($this->oldpassword,0);
	}
}