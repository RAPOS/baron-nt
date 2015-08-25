<?php

namespace app\modules\admin\controllers;

use Yii;
use app\modules\admin\models\BMasters;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * MastersController implements the CRUD actions for BMasters model.
 */
class MastersController extends Controller
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
     * Lists all BMasters models.
     * @return mixed
     */
    public function actionIndex()
    {
		if(Yii::$app->user->isGuest){
			$this->redirect(Yii::$app->user->loginUrl);
		}
		
        $dataProvider = new ActiveDataProvider([
            'query' => BMasters::find(),
			'sort' => [
				'defaultOrder' => ['sort' => SORT_ASC],
			],
        ]);

        return $this->render('index', [
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single BMasters model.
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
     * Creates a new BMasters model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
		if(Yii::$app->user->isGuest){
			$this->redirect(Yii::$app->user->loginUrl);
		}
		
        $model = new BMasters();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id_master]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing BMasters model.
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
			if($_POST[id_img]){
				$array_id_img = json_decode($model->images);
				if(is_array($array_id_img)){
					$new_pre_images = array_merge($array_id_img, $_POST[id_img]);
					$model->images = json_encode(array_unique($new_pre_images));
					$model->save();
				} else {
					$model->images = json_encode($_POST[id_img]);
					$model->save();
				}
			}
            return $this->redirect(['view', 'id' => $model->id_master]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing BMasters model.
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
     * Finds the BMasters model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return BMasters the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = BMasters::findOne($id)) !== null) {
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
			$model = $this->findModel($_POST['id_master']);
			$model->images = json_encode($new_array_images);
			if($model->save()){
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
	
	public function actionSort(){
		if(!$_POST){
			return $this->redirect('/admin/masters');
		}
		
		if($_POST['id_master']){
			foreach($_POST['id_master'] as $key => $id_master){
				$ids[] ="(".$id_master.",".($key+1).")";
				$model = $this->findModel($id_master);
				$model->sort = $key+1;
				$model->save();
			}
			print json_encode(array('msg' => 'ОК'));
		}
	}
}
