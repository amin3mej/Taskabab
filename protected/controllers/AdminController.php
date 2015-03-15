<?php

class AdminController extends Controller
{
	public function accessRules()
	{
		return array(
			array('deny',
				'expression' => array($this, 'isAdministrator'),
				'users'=>array('*'),
			),
			array('allow'),
		);
	}
	public function filters()
	{
		return array( 'accessControl' ); 
	}

	protected function isAdministrator()
	{ 
		return Yii::app()->user->isGuest || !isset(Yii::app()->user->isAdmin) || !Yii::app()->user->isAdmin;
	}
	public function actionIndex()
	{
		$this->render('index');
	}

	public function actionSetting()
	{
		//$this->redirect(array('/settings'));
		
		$this->layout = '//layouts/column1';
		$model=new Settings('search');
		$model->unsetAttributes();  // clear any default values
		$this->render('//admin/setting/admin',array('model'=>$model));
	}
	public function actionBackup($id = 0)
	{
		if($id == '1'){
			$return = $this->backupDb();
			$name = 'backup-'.Yii::app()->jdate->date('Y.m.d.H.i.s').'.sql';
			header('Content-Type: application/octet-stream');
			header('Content-Disposition: attachment; filename='.$name);
			header('Content-Transfer-Encoding: binary');
			header('Expires: 0');
			header('Cache-Control: must-revalidate');
			header('Pragma: public');
			header('Content-Length: ' . strlen($return));
			echo $return;
			Yii::app()->end();
		}elseif($id == '2'){
			$this->generatePDF();
		}else{
			$this->layout = '//layouts/column1';
			$this->render('//admin/backup');
		}
	}
	public function generatePDF()
	{
		$html2pdf = Yii::app()->ePdf->HTML2PDF();
        $html2pdf->WriteHTML(
        	$this->renderPartial('//layouts/pdf', array(), true)
        );
        $html2pdf->Output();
	}
	public function backupDb($tables = '*') {
		if ($tables == '*') {
			$tables = array();
			$tables = Yii::app()->db->schema->getTableNames();
		} else {
			$tables = is_array($tables) ? $tables : explode(',', $tables);
		}
		$return = '';

		foreach ($tables as $table) {
			$result = Yii::app()->db->createCommand('SELECT * FROM ' . $table)->query();
			$return.= 'DROP TABLE IF EXISTS ' . $table . ';';
			$row2 = Yii::app()->db->createCommand('SHOW CREATE TABLE ' . $table)->queryRow();
			$return.= "\n\n" . $row2['Create Table'] . ";\n\n";
			foreach ($result as $row) {
				$return.= 'INSERT INTO ' . $table . ' VALUES(';
				foreach ($row as $data) {
					$data = addslashes($data);

					// Updated to preg_replace to suit PHP5.3 +
					$data = preg_replace("/\n/", "\\n", $data);
					if (isset($data)) {
						$return.= '"' . $data . '"';
					} else {
						$return.= '""';
					}
					$return.= ',';
				}
				$return = substr($return, 0, strlen($return) - 1);
				$return.= ");\n";
			}
			$return.="\n\n\n";
		}
		return $return;
	}
	public function actionPost()
	{
		$this->redirect(array('/post'));
	}

	public function actionUser()
	{
		$this->redirect(array('/user'));
	}

	public function actionCategory()
	{
		$this->redirect(array('/category'));
	}

	public function actionAds()
	{
		$this->layout = '//layouts/column1';
		$model=new Ads('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Ads']))
			$model->attributes=$_GET['Ads'];

		$this->render('//admin/ads/admin',array('model'=>$model));
	}
	public function actionChangeAdmin()
	{
		$model=new changeAdmin;
		if(isset($_POST['changeAdmin']))
		{
			$model->attributes=$_POST['changeAdmin'];
			if($model->validate())
			{
				if($model->validatePassword()){
					if ($model->setNewPassword()) {
						Yii::app()->user->setFlash('changeAdmin','رمز با موفقیت عوض شد.');
						$this->refresh();
					}else{
						Yii::app()->user->setFlash('changeAdmin','مشکلی رخ داده. لطفا دوباره سعی کنید.');
						$this->refresh();
					}
				}else{
					Yii::app()->user->setFlash('changeAdmin','رمز قبلی صحیح نیست.');
					$this->refresh();
				}
			}
		}
		$this->render('newPassword',array('model'=>$model));
	}	
	public function actionApprove( $id )
	{
		$model = Ads::model()->findByPk($id);
		if($model)$model->approveAds(); 
	}

}