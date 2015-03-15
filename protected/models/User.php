<?php

/**
 * This is the model class for table "{{user}}".
 *
 * The followings are the available columns in table '{{user}}':
 * @property integer $id
 * @property string $username
 * @property string $email
 * @property string $password
 * @property string $fullname
 * @property string $phone
 * @property string $last_login_time
 * @property string $create_time
 * @property integer $create_user_id
 * @property string $update_time
 * @property integer $update_user_id
 *
 * The followings are the available model relations:
 * @property Ads[] $ads
 * @property Ads[] $ads1
 */
class User extends pActiveRecord
{
	public $password_repeat;
	public $verifyCode;
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return '{{user}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('username, email, password, fullname, phone', 'required', 'on' => 'register'),
			array('username, email, phone', 'unique'),
			array('email','email'),
			array('create_user_id, update_user_id', 'numerical', 'integerOnly'=>true),
			array('username, email, password, fullname', 'length', 'max'=>255),
			array('phone', 'length', 'min' => '11', 'max'=>11),
			array('last_login_time, create_time, update_time, address, activation_code, status', 'safe'),
			array('password','compare', 'on' => 'register'),
			array('password','length','min' => '6', 'on' => 'register'),
			array('password,password_repeat','required', 'on' => 'register'),
			array('verifyCode', 'required', 'on' => 'register'),
			array('verifyCode', 'captcha', 'on' => 'register', 'allowEmpty'=>!CCaptcha::checkRequirements()),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, username, email, password, address, fullname, phone, last_login_time, create_time, create_user_id, update_time, update_user_id', 'safe', 'on'=>'search'),
		);
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
			'ads' => array(self::HAS_MANY, 'Ads', 'create_user_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ردیف',
			'username' => 'نام کاربری',
			'email' => 'ایمیل',
			'password' => 'رمز عبور',
			'password_repeat' => 'تکرار رمز عبور',
			'verifyCode' => 'کد امنیتی',
			'captcha' => 'کد امنیتی',
			'status' => 'وضعیت',
			'activation_code' => 'کد فعالسازی',
			'fullname' => 'نام و نام خانوادگی',
			'phone' => 'شماره موبایل',
			'address' => 'آدرس',
			'last_login_time' => 'آخرین دفعه ورود',
			'create_time' => 'زمان ثبت نام',
			'create_user_id' => 'سازنده',
			'update_time' => 'زمان بروزرسانی',
			'update_user_id' => 'بروزرسان',
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 *
	 * Typical usecase:
	 * - Initialize the model fields with values from filter form.
	 * - Execute this method to get CActiveDataProvider instance which will filter
	 * models according to data in model fields.
	 * - Pass data provider to CGridView, CListView or any similar widget.
	 *
	 * @return CActiveDataProvider the data provider that can return the models
	 * based on the search/filter conditions.
	 */
	public function search()
	{
		// @todo Please modify the following code to remove attributes that should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('id',$this->id);
		$criteria->compare('username',$this->username,true);
		$criteria->compare('email',$this->email,true);
		$criteria->compare('password',$this->password,true);
		$criteria->compare('fullname',$this->fullname,true);
		$criteria->compare('phone',$this->phone,true);
		$criteria->compare('last_login_time',$this->last_login_time,true);
		$criteria->compare('create_time',$this->create_time,true);
		$criteria->compare('address',$this->address,true);
		$criteria->compare('create_user_id',$this->create_user_id);
		$criteria->compare('update_time',$this->update_time,true);
		$criteria->compare('update_user_id',$this->update_user_id);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return User the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	/**
	 * apply a hash on the password before we store it in the database
	 */
	protected function afterValidate()
	{   
		parent::afterValidate();
		//ensure we don't have any other errors
		if(!$this->hasErrors())
		{
			if($this->password == '')
			{
				$db = $this->findByPk($this->id);
				$this->password = $db->password;
			}
			else
			{
				$this->password = $this->hashPassword($this->password);                     
			}
		}
	}
	/**
	 * Generates the password hash.
	 * @param string password
	 * @return string hash
	 */
	public function hashPassword($password)
	{
		return md5($password);
	}
	
	/**
	 * Checks if the given password is correct.
	 * @param string the password to be validated
	 * @return boolean whether the password is valid
	 */
	public function validatePassword($password,$status)
	{
		if(!$status)
			return $this->hashPassword($password)==$this->password;
		else
			return $password==$this->password;
	}
	public function getStatusText()
	{
		return $this->status == 1 ? 'فعال' : 'غیر فعال';
	}
	public function getJ_create_Time()
	{
	    return Yii::app()->jdate->date("H:i Y/m/d", strtotime($this->create_time));
	}
	public function getJ_last_login_time()
	{
	    return Yii::app()->jdate->date("H:i Y/m/d", strtotime($this->last_login_time));
	}
	public function activate()
	{
		$sql = "update tbl_user SET `status` = 1 WHERE `id` = :id";
		$command = Yii::app()->db->createCommand($sql);
		$command->bindValue(":id", $this->id, PDO::PARAM_INT);
		return $command->execute()==1 ? true : false;
	}
}

