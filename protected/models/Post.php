<?php

/**
 * This is the model class for table "{{post}}".
 *
 * The followings are the available columns in table '{{post}}':
 * @property integer $id
 * @property string $title
 * @property string $content
 * @property integer $status
 * @property string $create_time
 * @property string $update_time
 * @property integer $create_user_id
 * @property integer $update_user_id
 *
 * The followings are the available model relations:
 * @property User $updateUser
 * @property User $createUser
 */
class Post extends pActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return '{{post}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('title, content', 'required'),
			array('title', 'length', 'max'=>255),
			array('create_time, update_time, create_user_id, update_user_id', 'safe'),

			array('password','compare', 'on' => 'register'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, title, content, create_time, update_time, create_user_id, update_user_id', 'safe', 'on'=>'search'),
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
			'updateUser' => array(self::BELONGS_TO, 'User', 'update_user_id'),
			'author' => array(self::BELONGS_TO, 'User', 'create_user_id'),
			'attachments' => array(self::HAS_MANY, 'PostAttachments', 'post_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ایدی',
			'title' => 'عنوان',
			'content' => 'محتوا',
			'create_time' => 'زمان نوشتن',
			'update_time' => 'زمان بروزرسانی',
			'create_user_id' => 'نویسنده',
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
		$criteria->compare('title',$this->title,true);
		$criteria->compare('content',$this->content,true);
		$criteria->compare('create_time',$this->create_time,true);
		$criteria->compare('update_time',$this->update_time,true);
		$criteria->compare('create_user_id',$this->create_user_id);
		$criteria->compare('update_user_id',$this->update_user_id);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Post the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
	public static function getCMenu($limit = 5)
	{
		$array = array();
		$a = Post::model()->findAll(array('limit' => $limit,'order'=>'id DESC'));
		foreach ($a as $key => $value) {
			$array[] = array('label' => $value->title, 'url' => controller::createUrl('/post/view/'.$value->id));
		}
		return $array;
	}
	public function deleteAttachments()
	{
		foreach ($this->attachments as $value) {
			$value->delete();
		}
		return $this;
	}
	public function getJCreateTime()
	{
		return Yii::app()->jdate->date("d F Y ساعت H:i", strtotime($this->create_time));
	}
}
