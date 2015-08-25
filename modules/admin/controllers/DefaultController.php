<?php

namespace app\modules\admin\controllers;

use Yii;
use yii\web\Controller;
use app\modules\admin\models\BAdmins;
use app\modules\admin\models\BImages;
use app\modules\admin\models\BMainpage;
use app\modules\admin\models\BRules;
use app\modules\admin\models\BSettings;
use app\modules\admin\models\BTypesOfMassage;
use app\modules\admin\models\BVacancy;

class DefaultController extends Controller
{
	public $layout = 'dark';
	
    public function actionIndex()
    {
		if(Yii::$app->user->isGuest){
			$this->redirect(Yii::$app->user->loginUrl);
		}
		
        return $this->render('index');
    }

    public function actionRules() {
		if(Yii::$app->user->isGuest){
			$this->redirect(Yii::$app->user->loginUrl);
		}
		$model = BRules::find()->where(['site' => 1])->one();
		
		if(!$model){
		print_r($_POST);
			$model = new BRules;
		}
		
		if ($model->load(Yii::$app->request->post())) {
			if ($model->validate()) {
				$model->site = 1;
				$model->save();

				return $this->render('rules', ['model' => $model, 'success' => true]);
			}
		}

		return $this->render('rules', [
			'model' => $model,
		]);
	
    }
	
    public function actionVacancy()
    {
				
		if(Yii::$app->user->isGuest){
			$this->redirect(Yii::$app->user->loginUrl);
		}

		$model = BVacancy::find()->where(['site' => 1])->one();
		
		if(!$model){
			$model = new BVacancy;
		}

		if ($model->load(Yii::$app->request->post())) {
			if ($model->validate()) {
				$model->site = 1;
				$model->save();
				
				return $this->render('vacancy', ['model' => $model, 'success' => true]);
			}
		}

		return $this->render('vacancy', [
			'model' => $model,
		]);
    }

	public function actionLogin()
	{
		$model = new BAdmins;
		if(Yii::$app->request->post()){
			$model->attributes = Yii::$app->request->post('BAdmins');
			if($model->validate()) {
				$BAdmins = BAdmins::find()->where(["name" => $model->name])->one();
				if($BAdmins){
					if($BAdmins->password === md5(md5($model->password))){
						if($BAdmins->login()) $this->redirect(Yii::$app->user->returnUrl);
					} else {
						print "Не верный пароль.";
						return;
					}
				} else {
					print "Не верный логин.";
					return;
				}
			} else {
				print "Не прошло валидацию.";
				return;
			}
		}

		return $this->render('login', [
			'model' => $model,
		]);
	}
	
    public function actionLogout()
    {
        Yii::$app->user->logout();
		return $this->goHome();
    }
	
	public function actionMainpage(){
		if(Yii::$app->user->isGuest){
			$this->redirect(Yii::$app->user->loginUrl);
		}
		
		$model = BMainpage::find()->where(['site' => 1])->one();
		if(!$model){
			$model = new BMainpage;
		}
		if ($model->load(Yii::$app->request->post())) {
			if ($model->validate()) {
				$model->site = 1;
				$model->save();
				
				return $this->render('mainpage', ['model' => $model, 'success' => true]);
			}
		}

		return $this->render('mainpage', [
			'model' => $model,
		]);
	}
	
	public function actionPrograms(){
		$this->redirect('/admin/programs/');
	}

	public function actionMasters(){
		$this->redirect('/admin/masters/');
	}
	
	public function actionSettings(){
		if(Yii::$app->user->isGuest){
			$this->redirect(Yii::$app->user->loginUrl);
		}
		
		$model = BSettings::find()->where(['site' => 1])->one();;
		if(!$model){
			$model = new BAdmins;
		}
		if ($model->load(Yii::$app->request->post())) {
			if ($model->validate()) {
				$model->site = 1;
				
				return $this->render('settings', ['model' => $model, 'success' => true]);
			}
		}

		return $this->render('settings', [
			'model' => $model,
		]);
	}
	
	public function actionUserchange(){
		if(Yii::$app->user->isGuest){
			$this->redirect(Yii::$app->user->loginUrl);
		}
		
		$model = BAdmins::findOne(Yii::$app->user->id);
		if(!$model){
			$model = new BAdmins;
		}
		if ($model->load(Yii::$app->request->post())) {
			if ($model->validate()) {
				$model->site = 1;
				$model->password = md5(md5($model->password));
				$model->save();
				
				return $this->render('userchange', ['model' => $model, 'success' => true]);
			}
		}

		return $this->render('userchange', ['model' => $model]);
	}
	
	public function actionUpload(){
		if($_FILES){
			for($i=0;$i<count($_FILES);$i++){
				if(!in_array(exif_imagetype($_FILES['image']['tmp_name'][$i]), array(IMAGETYPE_GIF, IMAGETYPE_JPEG, IMAGETYPE_PNG))){
					return false;
				}
				$path_info = pathinfo($_FILES['image']['name'][$i]);
				$name = md5($path_info['filename'].md5(rand(1,1000000)));
				$dir = 'files/images';
				
				$BImages = new BImages;
				$BImages->name = $name;
				$BImages->extension = $path_info['extension'];
				if($BImages->save()){
					$BImages->path = $dir.'/'.$BImages->id_img.'/'.$name.'.'.$path_info['extension'];
					$BImages->save();
					
					$path = $dir.'/'.$BImages->id_img;
					mkdir($_SERVER['DOCUMENT_ROOT'].'/'.$path, 0777, true);
					if(!file_exists($_SERVER['DOCUMENT_ROOT'].'/files/uploads/')){
						mkdir($_SERVER['DOCUMENT_ROOT'].'/files/uploads/');
					}
					if(move_uploaded_file($_FILES['image']['tmp_name'][$i], $_SERVER['DOCUMENT_ROOT'].'/files/uploads/'.$name.'.'.$path_info['extension'])){
						$image = Yii::$app->image->load(Yii::getAlias('@webroot/files/uploads/'.$name.'.'.$path_info['extension']));
						$image->resize(800, NULL, \yii\image\drivers\Image::AUTO);
						$mark = Yii::$app->image->load(Yii::getAlias('@webroot/images/label.png'));
						$image->watermark($mark, TRUE, TRUE);
						$image->save(Yii::getAlias('@webroot/'.$BImages->path));
						
						unlink($_SERVER['DOCUMENT_ROOT'].'/files/uploads/'.$name.'.'.$path_info['extension']);
						print json_encode(array('id_img' => $BImages->id_img));
					}
				}
			}
		}
	}
}
