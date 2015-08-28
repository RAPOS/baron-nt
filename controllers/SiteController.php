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
use app\modules\admin\models\BReviews;
use app\modules\admin\models\BSertificates;
use app\modules\admin\models\BActions;

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
                //'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
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
		
		$actions = BActions::find()->one();	
		
		$sertificate = BSertificates::find()->where(['site' => 1])->one();
	
        return $this->render('index', ['title_h1' => $title_h1, 'text_1' => $text_1, 'title_h2' => $title_h2, 'text_2' => $text_2, 'masters' => $masters, 'sertificate' => $sertificate, 'images' => $images, 'actions' => $actions]);
    }
	
    public function actionActions()
    {
		$actions = BActions::find()->all();	
		
        return $this->render('actions',['actions' => $actions]);
    }	

    public function actionReviews()
    {
		$reviews = new BReviews;
		if ($reviews->load(Yii::$app->request->post()) && $reviews->validate()){
			$message = $reviews->text;
			$message = str_replace(":)", "<img src='/base/img/smiles/ab.gif' alt=''/>", $message);
			$message = str_replace("8-)", "<img src='/base/img/smiles/24.gif' alt=''/>", $message);
			$message = str_replace(";)", "<img src='/base/img/smiles/105.gif' alt=''/>", $message);
			$message = str_replace(":yahoo:", "<img src='/base/img/smiles/bp.gif' alt=''/>", $message);
			$message = str_replace(":think:", "<img src='/base/img/smiles/73.gif' alt=''/>", $message);
			$message = str_replace(":cool:", "<img src='/base/img/smiles/33.gif' alt=''/>", $message);
			$message = str_replace(":yes:", "<img src='/base/img/smiles/109.gif' alt=''/>", $message);
			$message = str_replace(":ok:", "<img src='/base/img/smiles/56.gif' alt=''/>", $message);
			$message = str_replace(":dance:", "<img src='/base/img/smiles/21.gif' alt=''/>", $message);
			$message = str_replace(":drug:", "<img src='/base/img/smiles/31.gif' alt=''/>", $message);
			$message = str_replace(":read:", "<img src='/base/img/smiles/65.gif' alt=''/>", $message);
			$message = str_replace(":aplo:", "<img src='/base/img/smiles/15.gif' alt=''/>", $message);
			$reviews->text = $message;
			$reviews->ip = $_SERVER['REMOTE_ADDR'];		
			$reviews->date = time();
			$reviews->save();
		} else {
			$errors = $model->errors;
			//Yii::$app->general->print_r(Yii::$app->request->post($errors));die();
		}
		
        return $this->render('reviews', ['reviews' => $reviews]);
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
