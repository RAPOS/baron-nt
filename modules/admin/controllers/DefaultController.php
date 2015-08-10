<?php

namespace app\modules\admin\controllers;

use yii;
use yii\web\Controller;
use app\modules\admin\models\BAdmins;
use app\modules\admin\models\BSettings;

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
	
	public function actionUserchange(){
		$BAdmins = BAdmins::findOne(Yii::$app->user->id);
		return $this->render('userchange', ['model' => $BAdmins]);
	}
}
