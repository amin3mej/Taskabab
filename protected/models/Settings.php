<?php

/**
 * This is the model class for table "{{settings}}".
 *
 * The followings are the available columns in table '{{settings}}':
 * @property integer $id
 * @property string $key
 * @property string $value
 */
class Settings extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return '{{settings}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('key, value', 'required'),
			array('key', 'length', 'max'=>255),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, key, value', 'safe', 'on'=>'search'),
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
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ایدی',
			'key' => 'نام',
			'value' => 'مقدار',
			///////////////////
			'title' => 'عنوان سایت',
			'about' => 'محتوای صفحه تماس با ما',
			'smsuser' => 'نام کاربری پنل sms',
			'smspass' => 'رمز عبور پنل sms',
			'smsnumber' => 'شماره پنل sms',
			'smstext' => 'متن اس ام اس فعال سازی',
			'description' => 'توضیحات سایت',
			'adminEmail' => 'ایمیل مدیریت',
			///////////////////
			'ads1-img' => 'عکس آگهی 1',		
			'ads2-img' => 'عکس آگهی 2',		
			'ads3-img' => 'عکس آگهی 3',		
			'ads4-img' => 'عکس آگهی 4',		
			'ads5-img' => 'عکس آگهی 5',		
			'ads6-img' => 'عکس آگهی 6',		
			'ads7-img' => 'عکس آگهی 7',		
			'ads8-img' => 'عکس آگهی 8',		
			'ads9-img' => 'عکس آگهی 9',		
			'ads10-img' => 'عکس آگهی 10',		
			'ads11-img' => 'عکس آگهی 11',		
			'ads12-img' => 'عکس آگهی 12',		
			'ads13-img' => 'عکس آگهی 13',		
			'ads14-img' => 'عکس آگهی 14',		
			'ads15-img' => 'عکس آگهی 15',		
			'ads16-img' => 'عکس آگهی 16',		
			'ads17-img' => 'عکس آگهی 17',		
			'ads18-img' => 'عکس آگهی 18',		
			'ads19-img' => 'عکس آگهی 19',
			////////////////////
			'ads1-link' => 'لینک آگهی 1',		
			'ads2-link' => 'لینک آگهی 2',		
			'ads3-link' => 'لینک آگهی 3',		
			'ads4-link' => 'لینک آگهی 4',		
			'ads5-link' => 'لینک آگهی 5',		
			'ads6-link' => 'لینک آگهی 6',		
			'ads7-link' => 'لینک آگهی 7',		
			'ads8-link' => 'لینک آگهی 8',		
			'ads9-link' => 'لینک آگهی 9',		
			'ads10-link' => 'لینک آگهی 10',		
			'ads11-link' => 'لینک آگهی 11',		
			'ads12-link' => 'لینک آگهی 12',		
			'ads13-link' => 'لینک آگهی 13',		
			'ads14-link' => 'لینک آگهی 14',		
			'ads15-link' => 'لینک آگهی 15',		
			'ads16-link' => 'لینک آگهی 16',		
			'ads17-link' => 'لینک آگهی 17',		
			'ads18-link' => 'لینک آگهی 18',		
			'ads19-link' => 'لینک آگهی 19',		

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
		$criteria->compare('key',$this->key);
		$criteria->compare('value',$this->value);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Settings the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
	public function getFaTitle()
	{
		return $this->getAttributeLabel($this->key);
	}
}
