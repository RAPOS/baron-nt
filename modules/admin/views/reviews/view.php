<?php
use app\modules\admin\models\BMasters;
use app\modules\admin\models\BTypesOfMassage;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\widgets\DetailView;

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Отзывы', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="breviews-view" style="width: 700px;">
	<div class="clearfix">
		<?php $form = ActiveForm::begin(); ?>
			<div style="float: left;width: 440px;background: #f5f5f5;padding: 10px;margin-right: 10px">
				<p>Имя: <?=$model->name?></p>
				<p>Отзыв: <?=$model->text?></p>
				<?if($model->section == 'interior'){
					$page = 'Интерьер';
					$url = '/interior';
				} else if($model->section == 'reviews'){
					$page = 'Отзывы';
					$url = '/reviews';
				} else if($model->section == 'masters'){
					$BMasters = BMasters::find()->where(['translate' => $model->translate])->one();
					$page = 'Мастера / '.$BMasters->name;
					$url = '/masters/'.$model->translate;
				} else if($model->section == 'programs'){
					$BTypesOfMassage = BTypesOfMassage::find()->where(['translate' => $model->translate])->one();
					$page = 'Программы / '.$BTypesOfMassage->name;
					$url = '/programs/'.$model->translate;
				}?>
				<p>Отзыв к странице: <a href="<?=$url?>" target="_blank"><?=$page?></a></p>
				<?= $form->field($model, 'moderate')->checkbox() ?>
			</div>
			<div style="float: left;width: 250px;background: #f5f5f5;padding: 10px;">
				<p style="border-bottom: 1px dashed #777;padding-top: 5px;padding-bottom: 5px;">
					<span style="font-weight: bold;font-size: 18px;color: #777;">Дата:</span> 
					<span style="font-size: 18px;float: right;"><?=Yii::$app->formatter->asTime($model->date, 'php:d.m.Y');?></span>
				</p>
				<p style="border-bottom: 1px dashed #777;padding-top: 5px;padding-bottom: 5px;">
					<span style="font-weight: bold;font-size: 18px;color: #777;">Время:</span> 
					<span style="font-size: 18px;float: right;"><?=Yii::$app->formatter->asTime($model->date, 'php:H:i:s');?></span>
				</p>
				<p style="border-bottom: 1px dashed #777;padding-top: 5px;padding-bottom: 5px;">
					<span style="font-weight: bold;font-size: 18px;color: #777;">E-mail:</span> 
					<span style="font-size: 18px;float: right;"><a href="mailto:<?=$model->email?>"><?=$model->email?></a></span>
				</p>
				<p style="border-bottom: 1px dashed #777;padding-top: 5px;padding-bottom: 5px;">
					<span style="font-weight: bold;font-size: 18px;color: #777;">IP:</span> 
					<span style="font-size: 18px;float: right;"><?=$model->ip?></span>
				</p>
			</div>
		<?php ActiveForm::end(); ?>
	</div>
    <p>
        <?= Html::a('Ответить', ['update', 'id' => $model->id], ['class' => 'btn btn-success']) ?>
        <?= Html::a('Отмена', ['/admin/feedback'], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Удалить запись', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Вы уверены, что хотите удалить?',
                'method' => 'post',
            ],
        ]) ?>
    </p>
</div>
