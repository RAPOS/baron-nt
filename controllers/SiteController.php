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
use app\modules\admin\models\BInterior;
use app\modules\admin\models\BContacts;
use app\modules\admin\models\BTypesOfMassage;
use app\modules\admin\models\BMainpageMassage;
use app\modules\admin\models\BMainpageMasters;
use app\modules\admin\models\BMasters;
use app\modules\admin\models\BFeedback;
use app\modules\admin\models\BSertificates;

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
		$mainpage = BMainpage::find()->where(['site' => 1])->one();
		
		$title_h1 = $mainpage->title_h1;
		
		$title_h2 = $mainpage->title_h2;
		
		$text_1 = $mainpage->text_1;
		
		$text_2 = $mainpage->text_2;
		
		$images = $mainpage->images;
		
		$masters = BMasters::find()->all();
		
		$sertificate = BSertificates::find()->where(['site' => 1])->one();
		
	
        return $this->render('index', ['title_h1' => $title_h1, 'text_1' => $text_1, 'title_h2' => $title_h2, 'text_2' => $text_2, 'masters' => $masters, 'sertificate' => $sertificate, 'images' => $images]);
    }
	
    public function actionActions()
    {
        return $this->render('actions');
    }	

    public function actionReviews()
    {
        return $this->render('reviews');
    }
	
    public function actionContacts()
    {
		$model = BContacts::find()->where(['site' => 1])->one();
		$title = $model->title;
		$text = $model->text;
		
		$feedback = new BFeedback;
		if ($feedback->load(Yii::$app->request->post()) && $feedback->save()){
			$feedback->date = time();
			$feedback->save();
		}
		
        return $this->render('contacts', [
			'title' => $title, 
			'text' => $text,
			'feedback' => $feedback,
        ]);
    }
	
    public function actionInterior()
    {
		$model = BInterior::find()->where(['site' => 1])->one();

        return $this->render('interior', ['model' => $model]);
    }
	
    public function actionPrograms_detail()
    {
        return $this->render('programs_detail');
    }
		
    public function actionPrograms($page = 0)
    {
		$getName = $_GET['name'];
		if(!$getName){
			$query = BTypesOfMassage::find();

			$countQuery = clone $query;
			$pages = new Pagination(['totalCount' => $countQuery->count(), 'PAGESIZE' => 6]);
			$pages->defaultPageSize = 9;
			$pages->page = $page - 1;
			$model = $query->offset($pages->offset)
				->limit($pages->limit)
				->orderBy('sort ASC')
				->all();

			$BMainpageMassage = BMainpageMassage::find()->where(['site' => 1])->one();
			
			return $this->render('programs', [
				 'model' => $model,
				 'page' => $pages,
				 'description' => $BMainpageMassage->text,
			]);
			
		} else {				
			$model = BTypesOfMassage::find()->where(['translate' => $getName])->one();
			
			if(!$model){
				return $this->render('error', ['name' => 'Not Found (#404)', 'message' => 'Страница не найдена']);
			}
			
			return $this->render('programs_detail', ['model' => $model]);
		}	
	}

    public function actionMasters($page = 0)
    {
		$getName = $_GET['name'];
		if(!$getName){
			$query = BMasters::find();

			$countQuery = clone $query;
			$pages = new Pagination(['totalCount' => $countQuery->count(), 'PAGESIZE' => 6]);
			$pages->defaultPageSize = 9;
			$pages->page = $page - 1;
			$model = $query->offset($pages->offset)
				->limit($pages->limit)
				->orderBy('sort ASC')
				->all();

			$BMainpageMasters = BMainpageMasters::find()->where(['site' => 1])->one();
			
			return $this->render('masters', [
				'model' => $model,
				'page' => $pages,
				'description' => $BMainpageMasters->text,
			]);
			
		} else {				
			$model = BMasters::find()->where(['translate' => $getName])->one();
			
			if(!$model){
				return $this->render('error', ['name' => 'Not Found (#404)', 'message' => 'Страница не найдена']);
			}
			
			return $this->render('masters_detail', ['model' => $model]);
		}	
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

}
