<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\data\Pagination;
use yii\widgets\LinkPager;
use app\modules\admin\models\BMainpage;
use app\modules\admin\models\BRules;
use app\modules\admin\models\BVacancy;
use app\modules\admin\models\BTypesOfMassage;

class SiteController extends Controller
{
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['logout'],
                'rules' => [
                    [
                        'actions' => ['logout'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

    public function actionIndex()
    {
		$model = BMainpage::find()->where(['site' => 1])->one();
		
		$title_h1 = $model->title_h1;
		
		$title_h2 = $model->title_h2;
		
		$text_1 = $model->text_1;
		
		$text_2 = $model->text_2;
		
        return $this->render('index', ['title_h1' => $title_h1, 'text_1' => $text_1, 'title_h2' => $title_h2, 'text_2' => $text_2]);
    }

    public function actionContacts()
    {
        return $this->render('contacts');
    }	

    public function actionInterior()
    {
        return $this->render('interior');
    }
	
    public function actionPrograms_detail()
    {
        return $this->render('programs_detail');
    }
		
    public function actionPrograms()
    {
		$getName = $_GET['name'];
		if(!$getName){
			$query = BTypesOfMassage::find();

			$countQuery = clone $query;
			$pages = new Pagination(['totalCount' => $countQuery->count()]);
			$model = $query->offset($pages->offset)
				->limit($pages->limit)
				->orderBy('sort ASC')
				->all();

			return $this->render('programs', [
				 'model' => $model,
				 'page' => $pages,
			]);
		} else {
			return $this->render('programs_detail');
		}
		
    }	

    public function actionMasters()
    {
        return $this->render('masters');
    }	
	
    public function actionVacancy()
    {
		$model = BVacancy::find()->where(['site' => 1])->one();
		
		$title = $model->title;
		
		$text = $model->text;

        return $this->render('vacancy', ['title' => $title, 'text' => $text]);
    }	

    public function actionRules()
    {
		$model = BRules::find()->where(['site' => 1])->one();
	
		$title = $model->title;
		
		$text = $model->text;
		
	    return $this->render('rules', ['title' => $title, 'text' => $text]);
    }

    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }

    public function actionContact()
    {
        $model = new ContactForm();
        if ($model->load(Yii::$app->request->post()) && $model->contact(Yii::$app->params['adminEmail'])) {
            Yii::$app->session->setFlash('contactFormSubmitted');

            return $this->refresh();
        }
        return $this->render('contact', [
            'model' => $model,
        ]);
    }

    public function actionAbout()
    {
        return $this->render('about');
    }
}
