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
use app\modules\admin\models\BMainpageMastersforwomen;
use app\modules\admin\models\BMasters;
use app\modules\admin\models\BMastersforwomen;
use app\modules\admin\models\BFeedback;
use app\modules\admin\models\BReviews;
use app\modules\admin\models\BSertificates;
use app\modules\admin\models\BSettings;
use app\modules\admin\models\BActions;

class SiteController extends Controller
{
    public function behaviors(){
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

    public function actions(){
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

    public function actionIndex(){
		$mainpage = BMainpage::find()->where(['site' => 1])->one();
		$title_h1 = $mainpage->title_h1;
		$title_h2 = $mainpage->title_h2;
		$text_1 = $mainpage->text_1;
		$text_2 = $mainpage->text_2;
		
		$mainpageinterior =  BInterior::find()->where(['site' => 1])->one();
		$images = $mainpageinterior->images;
		
		$masters = BMasters::find()->orderBy('sort')->all();
		$mastersforwomen = BMastersforwomen::find()->orderBy('sort')->all();
		$actions = BActions::find()->one();	
		$BReviews = BReviews::find()->where('moderate = 1')->all();	
		$sertificate = BSertificates::find()->where(['site' => 1])->one();
	
        return $this->render('index', ['title_h1' => $title_h1, 'text_1' => $text_1, 'title_h2' => $title_h2, 'text_2' => $text_2, 'masters' => $masters, 'mastersforwomen' => $mastersforwomen, 'sertificate' => $sertificate, 'images' => $images, 'actions' => $actions, 'reviews' => $BReviews]);
    }
	
    public function actionSertificate(){
		return $this->render('sertificate');
	}	

    public function actionMalchishnik(){
		return $this->render('malchishnik');
	}	
	
    public function actionActions(){
		$actions = BActions::find()->all();	
		
        return $this->render('actions',['actions' => $actions]);
    }	

    public function actionReviews(){
		$model = new BReviews;
		$reviews = BReviews::find()->where('moderate = 1')->orderBy('id DESC')->all();
		if(Yii::$app->request->post()){
			if($_SESSION['__captcha/site/captcha'] != $_POST['BReviews']['verifyCode']){
				Yii::$app->getSession()->setFlash('captcha', 'false');

				if($_POST['BReviews']['section'] == 'masters' || $_POST['BReviews']['section'] == 'programs'){
					return $this->redirect('/'.$_POST['BReviews']['section'].'/'.$_POST['BReviews']['translate']);
				} else {
					return $this->redirect([$_POST['BReviews']['section']]);
				}
			}
			if($model->load(Yii::$app->request->post()) && $model->validate()){
				$message = $model->text;
				$message = str_replace(":)", "<img src='/images/smiles/ab.gif' alt=''/>", $message);
				$message = str_replace("8-)", "<img src='/images/smiles/24.gif' alt=''/>", $message);
				$message = str_replace(";)", "<img src='/images/smiles/105.gif' alt=''/>", $message);
				$message = str_replace(":yahoo:", "<img src='/images/smiles/bp.gif' alt=''/>", $message);
				$message = str_replace(":think:", "<img src='/images/smiles/73.gif' alt=''/>", $message);
				$message = str_replace(":cool:", "<img src='/images/smiles/33.gif' alt=''/>", $message);
				$message = str_replace(":yes:", "<img src='/images/smiles/109.gif' alt=''/>", $message);
				$message = str_replace(":ok:", "<img src='/images/smiles/56.gif' alt=''/>", $message);
				$message = str_replace(":dance:", "<img src='/images/smiles/21.gif' alt=''/>", $message);
				$message = str_replace(":drug:", "<img src='/images/smiles/31.gif' alt=''/>", $message);
				$message = str_replace(":read:", "<img src='/images/smiles/65.gif' alt=''/>", $message);
				$message = str_replace(":aplo:", "<img src='/images/smiles/15.gif' alt=''/>", $message);
				$model->text = $message;
				$model->translate = $_POST['BReviews']['translate'];
				$model->ip = $_SERVER['REMOTE_ADDR'];		
				$model->date = time();
				if($model->save()){
					Yii::$app->getSession()->setFlash('save', 'true');
					if($model->section == 'masters' || $model->section == 'programs'){
						return $this->redirect('/'.$model->section.'/'.$_POST['BReviews']['translate']);
					} else {
						return $this->redirect([$model->section]);
					}
				}
			}
		}
		if(Yii::$app->getSession()->getFlash('captcha')){
			$captcha = false;
		} else {
			$captcha = true;
		}
		if(Yii::$app->getSession()->getFlash('save')){
			$save = true;
		} else {
			$save = false;
		}
		
        return $this->render('reviews', [
			'model' => $model,
			'reviews' => $reviews,
			'captcha' => $captcha,
			'save' => $save,
		]);
    }
	
    public function actionContacts(){
		$BContacts = BContacts::find()->where(['site' => 1])->one();
		$title = $BContacts->title;
		$text = $BContacts->text;
		$keywords = $model->keywords;
		$description = $model->description;				
		
		$model = new BFeedback;
		if(Yii::$app->request->post()){
			if($_SESSION['__captcha/site/captcha'] != $_POST['BFeedback']['verifyCode']){
				Yii::$app->getSession()->setFlash('captcha', 'false');

				return $this->redirect(['contacts']);
			}
			if ($model->load(Yii::$app->request->post()) && $model->validate()){
				$model->date = time();
				$model->ip = $_SERVER['REMOTE_ADDR'];
				if($model->save()){
					Yii::$app->getSession()->setFlash('save', 'true');
					
					return $this->redirect(['contacts']);
				}
			}
		}
		
		if(Yii::$app->getSession()->getFlash('captcha')){
			$captcha = false;
		} else {
			$captcha = true;
		}
		if(Yii::$app->getSession()->getFlash('save')){
			$save = true;
		} else {
			$save = false;
		}
		
        return $this->render('contacts', [
			'title' => $title, 
			'text' => $text,
			'feedback' => $model,
			'captcha' => $captcha,
			'save' => $save,
        ]);
    }
	
    public function actionInterior(){
		$model = BInterior::find()->where(['site' => 1])->one();
		$reviews = BReviews::find()->where('section = "interior" AND moderate = 1')->orderBy('id DESC')->all();
		if(Yii::$app->getSession()->getFlash('captcha')){
			$captcha = false;
		} else {
			$captcha = true;
		}
		if(Yii::$app->getSession()->getFlash('save')){
			$save = true;
		} else {
			$save = false;
		}
		
        return $this->render('interior', [
			'model' => $model,
			'reviews' => $reviews,
			'captcha' => $captcha,
			'save' => $save,
		]);
    }
	
    public function actionPrograms($page = 0){

			$getName = $_GET['name'];
			
			if(!$getName){
				
				$model = BTypesOfMassage::find()->orderBy('sort ASC')->all();

				$BMainpageMassage = BMainpageMassage::find()->where(['site' => 1])->one();
				
				return $this->render('programs', [
					 'model' => $model,
					 'description' => $BMainpageMassage->text,
				]);
				
			} else {				
				$model = BTypesOfMassage::find()->where(['translate' => $getName])->one();
				
				$allmodel = BTypesOfMassage::find()->count();
				
				if($model->sort == $allmodel){
					$nextprogram = 1;
					$prevprogram = $model->sort - 1;
				}else if($model->sort == 1){
					$nextprogram = $model->sort + 1;
					$prevprogram = $allmodel;				
				}else{
					$nextprogram = $model->sort + 1;
					$prevprogram = $model->sort - 1;		
				}

				$nextprogramtranslate = BTypesOfMassage::find()->where(['sort' => $nextprogram])->one();
				
				$prevprogramtranslate = BTypesOfMassage::find()->where(['sort' => $prevprogram])->one();
				
				$reviews = BReviews::find()->where('section = "programs" AND translate = "'.$getName.'" AND moderate = 1')->orderBy('id DESC')->all();
				if(!$model){
					return $this->render('error', ['name' => 'Not Found (#404)', 'message' => '�������� �� �������']);
				}
				
				if(Yii::$app->getSession()->getFlash('captcha')){
					$captcha = false;
				} else {
					$captcha = true;
				}
				if(Yii::$app->getSession()->getFlash('save')){
					$save = true;
				} else {
					$save = false;
				}
				
				return $this->render('programs_detail', [
					'model' => $model,
					'nextprogramtranslate' => $nextprogramtranslate,
					'prevprogramtranslate' => $prevprogramtranslate,
					'reviews' => $reviews,
					'captcha' => $captcha,
					'save' => $save,
				]);
			}	
	}

    public function actionMastersforwomen(){
	
		$getName = $_GET['name'];

		if(!$getName){
			
			$query = BMastersforwomen::find();

			$countQuery = clone $query;
	
			$model = BMastersforwomen::find()->orderBy('sort ASC')->all();
		 
			$BMainpageMasters = BMainpageMastersforwomen::find()->where(['site' => 1])->one();
			
			return $this->render('mastersforwomen', [
				'model' => $model,
				'keywords' => $BMainpageMasters->keywords,
				'description' => $BMainpageMasters->text,
			]);
			
		} else {				
			$model = BMastersforwomen::find()->where(['translate' => $getName])->one();
		
			$allmodel = BMastersforwomen::find()->count();
			
			if($model->sort == $allmodel){
				$nextmaster = 1;
				$prevmaster = $model->sort - 1;
			}else if($model->sort == 1){
				$nextmaster = $model->sort + 1;
				$prevmaster = $allmodel;				
			}else{
				$nextmaster = $model->sort + 1;
				$prevmaster = $model->sort - 1;		
			}

			$nextmastertranslate = BMastersforwomen::find()->where(['sort' => $nextmaster])->one();
			
			$prevmastertranslate = BMastersforwomen::find()->where(['sort' => $prevmaster])->one();
			
			
			$reviews = BReviews::find()->where('section = "masters" AND translate = "'.$getName.'" AND moderate = 1')->orderBy('id DESC')->all();
			if(!$model){
				return $this->render('error', ['name' => 'Not Found (#404)', 'message' => '�������� �� �������']);
			}
			
			if(Yii::$app->getSession()->getFlash('captcha')){
				$captcha = false;
			} else {
				$captcha = true;
			}
			if(Yii::$app->getSession()->getFlash('save')){
				$save = true;
			} else {
				$save = false;
			}
			
			return $this->render('mastersforwomen_detail', [
				'model' => $model,
				'nextmastertranslate' => $nextmastertranslate,
				'prevmastertranslate' => $prevmastertranslate,
				'reviews' => $reviews,
				'captcha' => $captcha,
				'save' => $save,
			]);
		}	
    }	
	
    public function actionMasters(){
	
		$getName = $_GET['name'];
		
		if(!$getName){
			
			$query = BMasters::find();

			$countQuery = clone $query;
	
			$model = BMasters::find()->orderBy('sort ASC')->all();
		 
			$BMainpageMasters = BMainpageMasters::find()->where(['site' => 1])->one();
			
			return $this->render('masters', [
				'model' => $model,
				'description' => $BMainpageMasters->text,
			]);
			
		} else {				
			$model = BMasters::find()->where(['translate' => $getName])->one();
		
			$allmodel = BMasters::find()->count();
			
			if($model->sort == $allmodel){
				$nextmaster = 1;
				$prevmaster = $model->sort - 1;
			}else if($model->sort == 1){
				$nextmaster = $model->sort + 1;
				$prevmaster = $allmodel;				
			}else{
				$nextmaster = $model->sort + 1;
				$prevmaster = $model->sort - 1;		
			}

			$nextmastertranslate = BMasters::find()->where(['sort' => $nextmaster])->one();
			
			$prevmastertranslate = BMasters::find()->where(['sort' => $prevmaster])->one();
			
			
			$reviews = BReviews::find()->where('section = "masters" AND translate = "'.$getName.'" AND moderate = 1')->orderBy('id DESC')->all();
			if(!$model){
				return $this->render('error', ['name' => 'Not Found (#404)', 'message' => '�������� �� �������']);
			}
			
			if(Yii::$app->getSession()->getFlash('captcha')){
				$captcha = false;
			} else {
				$captcha = true;
			}
			if(Yii::$app->getSession()->getFlash('save')){
				$save = true;
			} else {
				$save = false;
			}
			
			return $this->render('masters_detail', [
				'model' => $model,
				'nextmastertranslate' => $nextmastertranslate,
				'prevmastertranslate' => $prevmastertranslate,
				'reviews' => $reviews,
				'captcha' => $captcha,
				'save' => $save,
			]);
		}	
    }	
	
    public function actionVacancy(){
		$model = BVacancy::find()->where(['site' => 1])->one();
		
		$title = $model->title;
		$text = $model->text;
		$keywords = $model->keywords;
		$description = $model->description;

        return $this->render('vacancy', ['title' => $title, 'text' => $text, 'keywords' => $keywords, 'description' => $description]);
    }	

    public function actionRules(){
		$model = BRules::find()->where(['site' => 1])->one();
	
		$title = $model->title;
		$text = $model->text;
		$keywords = $model->keywords;
		$description = $model->description;
		
	    return $this->render('rules', ['title' => $title, 'text' => $text]);
    }

    public function actionLogout(){
        Yii::$app->user->logout();

        return $this->goHome();
    }

}