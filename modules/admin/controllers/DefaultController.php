<?php

namespace app\modules\admin\controllers;

use yii;
use yii\web\Controller;
use app\modules\admin\models\BAdmins;
use app\modules\admin\models\BHello;
use app\modules\admin\models\BSettings;
use app\modules\admin\models\BTypesOfMassage;

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
	
	public function actionBhello(){
		if(Yii::$app->user->isGuest){
			$this->redirect(Yii::$app->user->loginUrl);
		}
		
		$model = BHello::find()->where(['site' => 1])->one();
		if(!$model){
			$model = new BHello;
		}
		if ($model->load(Yii::$app->request->post())) {
			if ($model->validate()) {
				$model->site = 1;
				$model->save();
				
				return $this->render('bhello', ['model' => $model, 'success' => true]);
			}
		}

		return $this->render('bhello', [
			'model' => $model,
		]);
	}

	public function actionMassage(){
		$this->redirect('/admin/massage/');
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
}
