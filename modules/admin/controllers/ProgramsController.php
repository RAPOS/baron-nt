<?php

namespace app\modules\admin\controllers;

use Yii;
use app\modules\admin\models\BImages;
use app\modules\admin\models\BTypesOfMassage;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * ProgramsController implements the CRUD actions for BTypesOfMassage model.
 */
class ProgramsController extends Controller
{
	public $layout = 'dark';
	
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['post'],
                ],
            ],
        ];
    }

    /**
     * Lists all BTypesOfMassage models.
     * @return mixed
     */
    public function actionIndex()
    {
		if(Yii::$app->user->isGuest){
			$this->redirect(Yii::$app->user->loginUrl);
		}
		
        $dataProvider = new ActiveDataProvider([
            'query' => BTypesOfMassage::find(),
        ]);

        return $this->render('index', [
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single BTypesOfMassage model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
		if(Yii::$app->user->isGuest){
			$this->redirect(Yii::$app->user->loginUrl);
		}
		
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new BTypesOfMassage model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
		if(Yii::$app->user->isGuest){
			$this->redirect(Yii::$app->user->loginUrl);
		}
		
        $model = new BTypesOfMassage();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
			$model->images = json_encode($_POST[id_img]);
			$model->save();
            return $this->redirect(['view', 'id' => $model->id_massage]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing BTypesOfMassage model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
		if(Yii::$app->user->isGuest){
			$this->redirect(Yii::$app->user->loginUrl);
		}
		
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
			if(isset($_POST[id_img])){
				$array_id_img = json_decode($model->images);
				$new_pre_images = array_merge($array_id_img, $_POST[id_img]);
				$model->images = json_encode(array_unique($new_pre_images));
				$model->save();
			}
            return $this->redirect(['view', 'id' => $model->id_massage]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing BTypesOfMassage model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
		if(Yii::$app->user->isGuest){
			$this->redirect(Yii::$app->user->loginUrl);
		}
		
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the BTypesOfMassage model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return BTypesOfMassage the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = BTypesOfMassage::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
	
	public function actionDeleteimages(){
		if($_POST){
			$new_array_images = array();
			for($i=0;$i<count($_POST['id_images']);$i++){
				if($_POST['delete_id_img'] != $_POST['id_images'][$i]){
					$new_array_images[] = $_POST['id_images'][$i];
				}
			}
			$BTypesOfMassage = BTypesOfMassage::findOne($_POST['id_massage']);
			$BTypesOfMassage->images = json_encode($new_array_images);
			if($BTypesOfMassage->save()){
				$BImages = BImages::findOne($_POST['delete_id_img']);
				if($BImages->delete()){
					if(!unlink(Yii::getAlias('@webroot/'.$_POST['delete_path']))){
						return 'Не удалось удалить изображение локально';
					} else {
						return true;
					}
				} else {
					return 'Не удалось удалить изображение из базы';
				}
			} else {
				return 'Не удалось перезаписать изображения';
			}
		} else {
			return 'Не пришли данные для удаления';
		}
	}
}
