<?php

/**
 * This is the model class for table "{{category}}".
 *
 * The followings are the available columns in table '{{category}}':
 * @property integer $id
 * @property string $name
 * @property string $description
 * @property integer $parent_id
 *
 * The followings are the available model relations:
 * @property Ads[] $ads
 * @property Category $parent
 * @property Category[] $categories
 */
class Category extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return '{{category}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('name', 'required'),
			array('parent_id', 'numerical', 'integerOnly'=>true),
			array('parent_id', 'in', 'range' => self::getAllowedCatRange(),'message'=>'شما نمی توانید خود موضوع را بعنوان والد انتخاب کنید.'),
			array('name', 'length', 'max'=>255),
			array('description', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, name, description, parent_id', 'safe', 'on'=>'search'),
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
			'ads' => array(self::HAS_MANY, 'Ads', 'category_id'),
			'parent' => array(self::BELONGS_TO, 'Category', 'parent_id'),
			'categories' => array(self::HAS_MANY, 'Category', 'parent_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ردیف',
			'name' => 'نام',
			'description' => 'توضیحات',
			'parent_id' => 'موضوع والد',
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
		$criteria->compare('name',$this->name,true);
		$criteria->compare('description',$this->description,true);
		$criteria->compare('parent_id',$this->parent_id);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Category the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
	public function getCatOptions()
	{
		$array = array('' => '---');
		$id = 0;
		$t = self::model()->findAll('parent_id is NULL');
		foreach ($t as $cat) {
			$array[$cat->id] = $cat->name;
			foreach ($cat->categories as $subkey => $subcat) {
				$array[$subcat->id] = '  -> '.$subcat->name;
				foreach ($subcat->categories as $sub2key => $sub2cat) {
					$array[$sub2cat->id] = '  --> '.$sub2cat->name;
				}
			}
		}
		return $array;
	}
	public function getCatText()
	{
		$cat = $this->parent;
		$text = '';
		if(is_object($cat) && is_object($cat->parent) && is_object($cat->parent->parent) && is_object($cat->parent->parent->parent))
			$text = $cat->parent->parent->parent->name . ' - '.$cat->parent->parent->name . ' - '.$cat->parent->name . ' - '.$cat->name;
		elseif(is_object($cat) && is_object($cat->parent) && is_object($cat->parent->parent))
			$text = $cat->parent->parent->name . ' - '.$cat->parent->name . ' - '.$cat->name;
		elseif(is_object($cat) && is_object($cat->parent))
			$text = $cat->parent->name . ' - '.$cat->name;
		elseif(is_object($cat))
			$text = $cat->name;
		else
			$text = 'ندارد';
		return $text;
	}
	public function getAllowedCatRange()
	{
	 	$array = array_keys(self::getCatOptions());
	 	if(isset($this->id))
	 		unset($array[$this->id]);
	 	return $array;
	}

}
