<?php

/**
 * This is the model class for table "{{ads}}".
 *
 * The followings are the available columns in table '{{ads}}':
 * @property integer $id
 * @property string $name
 * @property string $description
 * @property integer $price
 * @property integer $price_type
 * @property integer $category_id
 * @property string $create_time
 * @property integer $create_user_id
 * @property string $update_time
 * @property integer $update_user_id
 *
 * The followings are the available model relations:
 * @property User $updateUser
 * @property Category $category
 * @property User $createUser
 */
class Ads extends pActiveRecord
{
	//price type
	const PRICE_FIXED_IRI = 1;
	const PRICE_FIXED_DLR = 2;
	const PRICE_FREE = 3;
	const PRICE_SWAP = 4;
	const PRICE_ADAP = 5;
	const PRICE_REQU = 6;

	//status type
	const STATUS_APPROVED = 1;
	const STATUS_UNAPPROVED = 0;

	//ads type
	const TYPE_NEW = 0;
	const TYPE_USED = 1;

	//state type
	const STATE_AZARBAYJAN_SHARGHI = 1;
	const STATE_AZARBAYJAN_GHARBI = 2;
	const STATE_ARDEBIL = 3;
	const STATE_ISFAHAN = 4;
	const STATE_ALBORZ = 5;
	const STATE_ILAM = 6;
	const STATE_BOOSHEHR = 7;
	const STATE_TEHRAN = 8;
	const STATE_CHARMAHAL = 9;
	const STATE_KHORASAN_JONOOBI = 10;
	const STATE_KHORASAN_RAZAVI = 11;
	const STATE_KHORASAN_SHOMALI = 12;
	const STATE_KHOOZESTAN = 13;
	const STATE_ZANJAN = 14;
	const STATE_SEMNAN = 15;
	const STATE_SISTAN = 16;
	const STATE_FARS = 17;
	const STATE_GHAZVIN = 18;
	const STATE_GHOM = 19;
	const STATE_KORDESTAN = 20;
	const STATE_KERMAN = 21;
	const STATE_KERMANSHAH = 22;
	const STATE_KOHGILOOYE = 23;
	const STATE_GOLESTAN = 24;
	const STATE_GILAN = 25;
	const STATE_LORESTAN = 26;
	const STATE_MAZANDARAN = 27;
	const STATE_MARKAZI = 28;
	const STATE_HORMOZGAN = 29;
	const STATE_HAMEDAN = 30;
	const STATE_YAZD = 31;

	public $value;
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return '{{ads}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('name, description, price, category_id, type, state', 'required'),
			array('price, category_id, create_user_id, update_user_id', 'numerical', 'integerOnly'=>true),
			array('images','file','allowEmpty'=>true,'maxFiles'=>3),
			array('price_type', 'in', 'range' => self::getAllowedPriceRange()),
			array('category_id', 'in', 'range' => self::getAllowedCatRange()),
			array('state', 'in', 'range' => self::getAllowedStateRange()),
			array('type', 'in', 'range' => self::getAllowedTypeRange()),
			array('name', 'length', 'max'=>255),
			array('price','numerical','integerOnly'=>true,'min'=>'0','max'=>2000000000,'tooSmall'=>'لطفا یک قیمت صحبح وارد کنید.','tooBig'=>'حداکثر قیمت ممکن 2.000.000.000 ریال است.'),
			array('create_time, update_time', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, name, description, price, price_type, state, category_id, create_time, create_user_id, update_time, update_user_id', 'safe', 'on'=>'search'),
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
			'category' => array(self::BELONGS_TO, 'Category', 'category_id'),
			'author' => array(self::BELONGS_TO, 'User', 'create_user_id'),
			'images' => array(self::HAS_MANY, 'AdsImages', 'ads_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ردیف',
			'name' => 'نام تجهیز، کالا، ملک یا عنوان خدمات',
			'author' => 'نویسنده',
			'description' => 'توضیحات',
			'price' => 'قیمت پیشنهادی',
			'images' => 'ضمیمه عکس',
			'state' => 'موقعیت',
			'status' => 'منتشر شده؟',
			'type' => 'وضعیت',
			'price_type' => 'نوع قیمت',
			'category_id' => 'موضوع',
			'create_time' => 'تاریخ انتشار',
			'create_user_id' => 'نویسنده',
			'update_time' => 'زمان بروزرسانی',
			'update_user_id' => 'کاربر بروزرسان',
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 *
	 * Typical usecase:
	 * - Initialiself::e model fields with values from filter form.
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
		$criteria->compare('price',preg_replace("/[^0-9\<\>\=]/","",$this->price));
		$finded = false;
		foreach ($this->priceOptions as $key => $value) {
			if(strpos($this->price,$value) !== false){
					$criteria->compare('price_type',$key);
					$finded = true;
			}
		}
		if(!$finded)$criteria->compare('price_type','');
		$criteria->compare('state',$this->state);

		$author = User::model()->find('`fullname` LIKE ?', array(isset($this->create_user_id) ? $this->create_user_id : ''));
		if($author){
			//$criteria->addInCondition('create_user_id', array($author->id));
			$criteria->compare('create_user_id',$author->id);
		}

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
	public function searchAll()
	{
		$balance = Yii::app()->db->createCommand()->select('id')->from('{{ads}}')->where('status=1');
        $param = array();
		if(isset($this->name) && !empty($this->name)){
			$balance = $balance->andwhere('`description` LIKE :value OR `name` LIKE :value', array(':value'=>'%'.$this->name.'%'));
		}
		if(isset($this->state) && $this->state > 0){
			$balance = $balance->andwhere('`state` = :state', array(':state'=>$this->state));
		}
		if(isset($this->category_id) && $this->category_id > 0){
			$cat = Category::model()->with('categories')->findByPk($this->category_id);
			$number = array($this->category_id);
			foreach ($cat->categories as $value) {
				$number[]= $value->id;
				if($value->categories != null){
					foreach ($value->categories as $valu) {
						$number[]= $valu->id;
					}
				}
			}
			$balance = $balance->andwhere(array('in', 'category_id', $number));
		}
		elseif(isset($this->price_type) && $this->price_type > 0){
			$cat = Category::model()->with('categories')->findByPk($this->price_type);
			$number = array($this->price_type);
			foreach ($cat->categories as $value) {
				$number[]= $value->id;
				if($value->categories != null){
					foreach ($value->categories as $valu) {
						$number[]= $valu->id;
					}
				}
			}
			$balance = $balance->andwhere(array('in', 'category_id', $number));
		}
        $balance = $balance->order('create_time DESC');
        $balance = $balance->queryAll();
		$tt = array();
		foreach ($balance as $key => $value) {
			$tt[] = Ads::model()->findByPk($value['id']);
		}

		$dataProvider=new CArrayDataProvider($tt, array(
		    'pagination'=>array(
		        'pageSize'=>10,
		    ),
		));
		return $dataProvider;
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Ads the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
	public function getJcreateTime() {
	    return Yii::app()->jdate->date("d F Y در H:i", strtotime($this->create_time));
	}
	////////////////////////////////////////////////////
	public function getPriceOptions()
	{
		return array(
			self::PRICE_FIXED_IRI => 'ریال مقطوع',
			self::PRICE_FIXED_DLR => 'دلار مقطوع',
			self::PRICE_FREE => 'فقط جهت اطلاع',
			self::PRICE_SWAP => 'توافقی',
			self::PRICE_ADAP => 'معاوضه ای',
			self::PRICE_REQU => 'متقاضی خرید تجهیز هستم',
		);
	}
	public function getPriceText()
	{
		$priceOptions=$this->priceOptions;
		return isset($priceOptions[$this->price_type]) ? $priceOptions[$this->price_type] : " قیمت غیر قابل تشخصی({$this->price_type})";
	}
	public function getFullPriceText()
	{
		$priceOptions=$this->priceOptions;
		return (($this->price_type < 3) ? $this->price.' ' : '' ).$this->priceText;
	}
	public static function getAllowedPriceRange()
	{
	 	return array_keys(self::getPriceOptions());
	}
	////////////////////////////////////////////////////
	public function getTypeOptions()
	{
		return array(
			-1 => '---',
			self::TYPE_NEW => 'نو',
			self::TYPE_USED => 'مستعمل',
		);
	}
	public function getTypeText()
	{
		$typeOptions=$this->typeOptions;
		return isset($typeOptions[$this->type]) ? $typeOptions[$this->type] : "نامعلوم ({$this->type})";
	}
	public static function getAllowedTypeRange()
	{
	 	return array_keys(self::getTypeOptions());
	}
	////////////////////////////////////////////////////
	public function getStatusOptions()
	{
		return array(
			self::STATUS_APPROVED => 'بله',
			self::STATUS_UNAPPROVED => 'خیر',
		);
	}
	public function getStatusText()
	{
		$statusOptions=$this->statusOptions;
		return isset($statusOptions[$this->status]) ? $statusOptions[$this->status] : "نامعلوم ({$this->status})";
	}
	public static function getAllowedStatusRange()
	{
	 	return array_keys(self::getPriceOptions());
	}
	////////////////////////////////////////////////////
	public function getStateOptions()
	{
		return array(
			0 => '---',
			self::STATE_AZARBAYJAN_SHARGHI => "آذربایجان شرقی",
			self::STATE_AZARBAYJAN_GHARBI => "آذربایجان غربی",
			self::STATE_ARDEBIL => "اردبیل",
			self::STATE_ISFAHAN => "اصفهان",
			self::STATE_ALBORZ => "البرز",
			self::STATE_ILAM => "ایلام",
			self::STATE_BOOSHEHR => "بوشهر",
			self::STATE_TEHRAN => "تهران",
			self::STATE_CHARMAHAL => "چهارمحال و بختیاری",
			self::STATE_KHORASAN_JONOOBI => "خراسان جنوبی",
			self::STATE_KHORASAN_RAZAVI => "خراسان رضوی",
			self::STATE_KHORASAN_SHOMALI => "خراسان شمالی",
			self::STATE_KHOOZESTAN => "خوزستان",
			self::STATE_ZANJAN => "زنجان",
			self::STATE_SEMNAN => "سمنان",
			self::STATE_SISTAN => "سیستان و بلوچستان",
			self::STATE_FARS => "فارس",
			self::STATE_GHAZVIN => "قزوین",
			self::STATE_GHOM => "قم",
			self::STATE_KORDESTAN => "کردستان",
			self::STATE_KERMAN => "کرمان",
			self::STATE_KERMANSHAH => "کرمانشاه",
			self::STATE_KOHGILOOYE => "کهگیلویه و بویراحمد",
			self::STATE_GOLESTAN => "گلستان",
			self::STATE_GILAN => "گیلان",
			self::STATE_LORESTAN => "لرستان",
			self::STATE_MAZANDARAN => "مازندران",
			self::STATE_MARKAZI => "مرکزی",
			self::STATE_HORMOZGAN => "هرمزگان",
			self::STATE_HAMEDAN => "همدان",
			self::STATE_YAZD => "یزد",
		);
	}
	public function getStateText()
	{
		$StateOptions=$this->StateOptions;
		return isset($StateOptions[$this->state]) ? $StateOptions[$this->state] : " استان ما معلوم({$this->state})";
	}
	public function StateStatus($state)
	{
		$StateOptions=$this->StateOptions;
		return isset($StateOptions[$state]);
	}
	public static function getAllowedStateRange()
	{
		$m = self::getStateOptions();
		unset($m[0]);
	 	return array_keys($m);
	}

	////////////////////////////////////////////////////
	public function getCatOptions($m = true,$id = 0)
	{
		$array = array('0' => '---');
		$id = 0;
		foreach (Category::model()->findAll('parent_id is NULL') as $cat) {
			$array[$cat->id] = $cat->name;
			if($m){
				foreach ($cat->categories as $subkey => $subcat) {
					$array[$subcat->id] = str_repeat('&nbsp;', 3).'-> '.$subcat->name;
					foreach ($subcat->categories as $sub2key => $sub2cat) {
						$array[$sub2cat->id] = str_repeat('&nbsp;', 6).'-> '.$sub2cat->name;
					}
				}
			}
		}
		return $array;
	}
	public function getCatText()
	{
		$catOptions=$this->catOptions;
		$cat = Category::model()->findByPk($this->category_id);
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
			$text = 'ناشناخته';
		return $text;
	}
	public static function getAllowedCatRange()
	{
	 	$array = array_keys(self::getCatOptions());
	 	unset($array[0]);
	 	return $array;
	}
	public function approveAds()
	{
	    $this->status = !$this->status;
		$this->save();
	}
}
