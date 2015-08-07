<?php

namespace app\modules\admin\controllers;

use yii\web\Controller;
use app\modules\admin\models\BAdmins;

class DefaultController extends Controller
{
	public $layout = 'dark';
	
    public function actionIndex()
    {
        return $this->render('index');
    }
	
	public function actionLogin()
	{
		if(Yii::$app->request->post()){
			$model = new BAdmins();
			$model->attributes = Yii::$app->request->post('BAdmins');
			if($model->validate()) {
					// form inputs are valid, do something here
				return;
			}
		}

		return $this->render('login', [
			'model' => $model,
		]);
	}
	
    public function actionLogout()
    {
        return $this->render('logout');
    }
}
