<?php

class AdsController extends Controller
{
	/**
	 * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
	 * using two-column layout. See 'protected/views/layouts/column2.php'.
	 */
	public $layout='//layouts/column2';

	/**
	 * @return array action filters
	 */
	public function filters()
	{
		return array(
			'accessControl', // perform access control for CRUD operations
			'postOnly + delete', // we only allow deletion via POST request
		);
	}

	/**
	 * Specifies the access control rules.
	 * This method is used by the 'accessControl' filter.
	 * @return array access control rules
	 */
	public function accessRules()
	{
		return array(
			array('allow',  // allow all users to perform 'index','create','view','searchAll' and 'DynamicCat' actions
				'actions'=>array('index','create','view','searchAll','DynamicCat','DynamicText'),
				'users'=>array('*'),
			),
			array('allow', // allow authenticated user to perform 'update','delete' and 'deleteImage' actions
				'actions'=>array('update','delete','deleteImage'),
				'users'=>array('@'),
			),
			array('allow', // allow admin user to perform 'admin' action
				'actions'=>array('admin'),
				'users'=>array('admin'),
			),
			array('deny',  // deny all users
				'users'=>array('*'),
			),
		);
	}

	/**
	 * Displays a particular model.
	 * @param integer $id the ID of the model to be displayed
	 */
	public function actionView($id)
	{
		$model = $this->loadModel($id);
		$this->layout='//layouts/column1';
		if(!$this->checkIf($model))
			$this->layout='//layouts/column2';
		$this->render('view',array(
			'model'=>$this->loadModel($id,true),
		));
	}

	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate()
	{
		$model=new Ads;
		if(Yii::app()->user->isGuest){
			throw new CHttpException(403,"برای ارسال رایگان آگهی می بایست وارد شوید. اگر قبلا ثبت نام نکردید ".CHtml::link('اینجا',array('/register'))." کلیک کنید و بصورت رایگان ثبت نام کنید. برای ورود نیز ".CHtml::link('اینجا',array('/login'))." کلیک کنید.");
		}
		if(User::model()->findByPk(Yii::app()->user->id)->status != 1){
			throw new CHttpException(403,"شما باید ابتدا حساب خود را تایید کنید. برای تایید ".CHtml::link('اینجا',array('/user/activation'))." کلیک کنید.");
		}
		$this->layout = '//layouts/column1';
		$images = array();
		if(isset($_POST['Ads']))
		{ 
			$model->attributes=$_POST['Ads'];

			$t = $model->save();
			$isId = $model->id;
			$images = CUploadedFile::getInstancesByName('images');
			$dir = Yii::getPathOfAlias('webroot').'/images/'.$isId;
			if (isset($images) && count($images) > 0) 
			{
				if(!is_dir($dir))
				{
					mkdir($dir); 
				}
				$i = 0;

				foreach ($images as $image => $pic) 
				{
					if($i++ > 3)break;
					if(in_array($pic->getType(), array('image/jpeg','image/gif','image/png')))
					{
						if ($pic->saveAs($dir.'/temp'.$pic->name)) 
						{
							$model->save();
							$file = $dir.'/temp'.$pic->name;
							$img = Yii::app()->simpleImage->load($file);
							$nf = $i.'.jpg';

							if($img->getHeight() > 800 || $img->getWidth() > 800)
								$img->resizeToWidth(800);

							$img->save($dir.'/'.$nf);
							$img->createThumbnail($dir.'/thumbnail_'.$nf);
							
							unlink($file);
							$img_add = new AdsImages();
							$img_add->photo_name = $nf;
							$img_add->ads_id = $model->id;
							$img_add->save();
						}
						else
						{
							Yii::app()->user->setFlash('error',"لطفا دوباره امتحان کنید."); 
							$this->redirect();
						}
					}
					else
					{
						Yii::app()->user->setFlash('error',"عکس \"". $pic->name."\" غیر قابل قوبل است."); 
						$this->redirect();
					}
				}
			}
			if($t)
			{
				throw new CHttpException(false,"آگهی شما با موفقیت ثبت و پس از تایید مدیر سایت به نمایش در خواهد آمد.");
				// $this->redirect(array('view','id'=>$model->id));
			}
		}

		$this->render('create',array(
			'model'=>$model,
			));
	}

	/**
	 * Updates a particular model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 * @param integer $id the ID of the model to be updated
	 */
		public function actionUpdate($id)
	{
		$model=$this->loadModel($id);

		$images = array();
		if(isset($_POST['Ads']))
		{ 
			$model->attributes=$_POST['Ads'];

			$t = $model->save();
			$isId = $model->id;
			$images = CUploadedFile::getInstancesByName('images');
			$dir = Yii::getPathOfAlias('webroot').'/images/'.$isId.'/';
			if (isset($images) && count($images) > 0) 
			{
				if(!is_dir($dir))
				{
					mkdir($dir); 
				}
				$i = AdsImages::model()->count('ads_id = ?',array($isId));
				foreach ($images as $image => $pic) 
				{
					$i++;
					if($i < 4){
						if(in_array($pic->getType(), array('image/jpeg','image/gif','image/png')))
						{
							if ($pic->saveAs($dir.'/temp'.$pic->name)) 
							{
								$model->save();
								$file = $dir.'/temp'.$pic->name;
								$img = Yii::app()->simpleImage->load($file);
								$nf = 1;
								while(file_exists($dir.$nf.'.jpg')){
									$nf++;
								}
								$nf .= '.jpg';
								if($img->getHeight() > 800 || $img->getWidth() > 800)
								{
									$img->resizeToWidth(800);
								}
								$img->save($dir.'/'.$nf);
								$img->createThumbnail($dir.'/thumbnail_'.$nf);
								
								unlink($file);
								$img_add = new AdsImages();
								$img_add->photo_name = $nf;
								$img_add->ads_id = $model->id;
								$img_add->save();
							}
							else
							{
								Yii::app()->user->setFlash('error',"لطفا دوباره امتحان کنید."); 
								$this->redirect(array('update','id'=>$model->id));
							}
						}else{
							Yii::app()->user->setFlash('error',"عکس \"". $pic->name."\" غیر قابل قوبل است."); 
							$this->redirect(array('update','id'=>$model->id));
						}
					}else{
						Yii::app()->user->setFlash('error',"حداکثر ۳ عکس می توانید ارسال کنید."); 
						$this->redirect(array('update','id'=>$model->id));						
					}
				}
			}
			if($t){
				$this->redirect(array('view','id'=>$model->id));
			}
		}

		$this->render('update',array(
			'model'=>$model,
			));
		}

	/**
	 * Deletes a particular model.
	 * If deletion is successful, the browser will be redirected to the 'admin' page.
	 * @param integer $id the ID of the model to be deleted
	 */
	public function actionDelete($id)
	{
		$model = $this->loadModel($id);
		$this->checkAccess($model);
		$t = $model->images;
		foreach ($t as $value) {
			unlink(Yii::getPathOfAlias('webroot').'/images/'.$id.'/'.$value->photo_name);
			$value->delete();
		}
		$model->delete();

		// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
		if(!isset($_GET['ajax']))
			$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('index'));
	}
	public function actionDeleteImage($id)
	{
		$model = AdsImages::model()->findByPk($id);
		$this->checkAccess($model->ads);
		@unlink(Yii::getPathOfAlias('webroot').'/images/'.$model->ads_id.'/'.$model->photo_name);
		@unlink(Yii::getPathOfAlias('webroot').'/images/'.$model->ads_id.'/thumbnail_'.$model->photo_name);
		$model->delete();
		// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
		if(!isset($_GET['ajax']))
			$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('index'));
	}

	/**
	 * [actionIndex description]
	 * @param  [type] $type [description]
	 * @param  [type] $id   [description]
	 * @return [type]       [description]
	 */
	public function actionIndex()
	{
		$this->setPageTitle(Yii::app()->params['title']);
		$this->layout = '//layouts/main';
		$this->render('/ads/index');
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new Ads('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['ads'])){
			$model->attributes=$_GET['ads'];
			$model->name = $_GET['ads'];
		}

		$this->render('search',array(
			'model'=>$model,
		));
	}
	/**
	 * [actionDynamicCat description]
	 * @return [type] [description]
	 */
	public function actionDynamicCat()
	{

	    $data=Category::model()->findAll('parent_id=:parent_id',array(':parent_id'=>(int) $_POST['searchAll']['price_type']));
	 
	    $data=CHtml::listData($data,'id','name');
	    echo CHtml::tag('option',array('value'=>'-1'),'همه زیر موضوعات',true);
	    foreach($data as $value=>$name)
	    {
	        echo CHtml::tag('option',array('value'=>$value),CHtml::encode($name),true);
	    }
	}
	public function actionDynamicText()
	{
		// var_dump($_POST['Ads']['category_id']);
		// die();
	    $data=Category::model()->findByPk($_POST['Ads']['category_id']);
	    if($data != null && $data->description != null){
	    	echo '<td><label>توضیحات موضوع</label></td><td colspan="2">'.$data->description.'</td>';
	    }
	}
	/**
	 * Manages all models.
	 */
	public function actionSearchAll()
	{
		$model=new Ads('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_POST['searchAll']))
			$model->attributes=$_POST['searchAll'];
		if(isset($_GET['catId']))
			$model->category_id=$_GET['catId'];

		$this->render('searchAll',array(
			'model'=>$model,
		));
	}

 	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return Ads the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id,$x = false)
	{
		$model=Ads::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'آگهی مورد نظر موجود نیست.');
		if($x && $model->status == 0)
			throw new CHttpException(404,'آگهی مورد نظر موجود نیست.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param Ads $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='ads-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
	/**
	 * [checkIf description]
	 * @param  [type] $model [description]
	 * @return [type]        [description]
	 */
	public function checkIf($model)
	{
		return !((!Yii::app()->user->isGuest && Yii::app()->user->isAdmin)||(!Yii::app()->user->isGuest && Yii::app()->user->id == $model->author->id));
	}
	/**
	 * [checkAccess description]
	 * @param  [type] $model [description]
	 * @return [type]        [description]
	 */
	public function checkAccess($model)
	{   
		if($this->checkIf($model))
			throw new CHttpException(403,'شما دسترسی به این صفحه ندارید.');
			return true;
	} 
}
