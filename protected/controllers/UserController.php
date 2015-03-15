<?php

class UserController extends Controller
{
	/**
	 * Declares class-based actions.
	 */
	public function actions()
	{
		return array(
			// captcha action renders the CAPTCHA image displayed on the contact page
			'captcha'=>array(
				'class'=>'CaptchaAction',
				'backColor'=>0xFFFFFF,
			),
		);
	}
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
			array('allow',  // allow all users to perform 'index' and 'view' actions
				'actions'=>array('register', 'captcha'),
				'users'=>array('*'),
			),
			array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array('index','activation'),
				'users'=>array('@'),
			),
			array('allow', // allow admin user to perform 'admin' and 'delete' actions
				'actions'=>array('admin','view','update','delete'),
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
		$this->render('view',array(
			'model'=>$model,
		));
	}

	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionRegister()
	{

		$this->layout='//layouts/column1';
		$model=new User;
        $model->setScenario('register');


		if(isset($_POST['User']))
		{
			$activation_code = rand(1111,9999);
			$_POST['User']['activation_code'] = $activation_code;
			$model->attributes=$_POST['User'];
			if($model->save()){ 
				$client = new SoapClient("http://www.sms.ardindata.com:80/webservice/smsService.php?wsdl", array("trace" => true));
				$result = $client->send_sms(Yii::app()->params['smsuser'], Yii::app()->params['smspass'], Yii::app()->params['smsnumber'], $model->phone, str_replace('{code}',$activation_code, Yii::app()->params['smstext']));
		   		$identity=new UserIdentity($model->username,$model->password);
			    $identity->setStatus(true);
			    $identity->authenticate();
			    $res = Yii::app()->user->login($identity);
				$this->redirect(array('/user/activation')); 
			}
		}

		$this->render('register',array(
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

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['User']))
		{
			$model->attributes=$_POST['User'];
			if($model->save())
				$this->redirect(array('view','id'=>$model->id));
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
		$this->loadModel($id)->delete();

		// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
		if(!isset($_GET['ajax']))
			$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
	}

	/**
	 * Lists all models.
	 */
	public function actionIndex()
	{
		$model=new User('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['User']))
			$model->attributes=$_GET['User'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}
	public function actionActivation()
	{
		$this->layout='//layouts/column1';
		if(Yii::app()->user->isGuest || User::model()->findByPk(Yii::app()->user->id)->status != 0){
			$this->redirect('//');
		}else{
			$mm = User::model()->findByPk(Yii::app()->user->id);
			if(isset($_POST['activationForm']))
			{
				if($_POST['activationForm']['code'] == $mm->activation_code){
					$mm->activate();
					Yii::app()->user->setFlash('activation','حساب شما با موفقیت فعال شد.<br>حالا می توانید بطور رایگان آگهی ارسال کنید.');
					$this->redirect(array('//'));
				}else{
					Yii::app()->user->setFlash('activation','کد فعال سازی اشتباه است. لطفا دوباره تلاش کنید.');	
				}
			}
			$this->render('activation');
		}
	}
	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return User the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model=User::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'صفحه در خواستی وجود ندارد!');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param User $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='user-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
