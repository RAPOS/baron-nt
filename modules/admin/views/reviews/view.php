<?php
use app\modules\admin\models\BMasters;
use app\modules\admin\models\BTypesOfMassage;
use kartik\widgets\SwitchInput;
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
			<div class="breviews-view-left">
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
				<p class="breviews-view-border">Отзыв к странице: <a href="<?=$url?>" target="_blank"><?=$page?></a></p>
				<p class="breviews-view-name clearfix"> 
					<img src="/images/panel/user.png" width="48"/>
					<span><?=$model->name?></span>
				</p>
				<p class="breviews-view-baloon"><?=$model->text?></p>
				<?= $form->field($model, 'moderate', [
					'labelOptions' => [
						'class' => 'breviews-label-switch'
					]
				])->widget(SwitchInput::classname(), [
					'pluginOptions' => [
						'size' => 'large',
						'onColor' => 'success',
						'offColor' => 'danger',
						'onText' => 'Включить',
						'offText' => 'Выключить',
						
					],
				])?>
			</div>
			<div class="breviews-view-right">
				<p>
					<span>Дата:</span> 
					<span><?=Yii::$app->formatter->asTime($model->date, 'php:d.m.Y');?></span>
				</p>
				<p>
					<span>Время:</span> 
					<span><?=Yii::$app->formatter->asTime($model->date, 'php:H:i:s');?></span>
				</p>
				<p>
					<span>E-mail:</span> 
					<span><a href="mailto:<?=$model->email?>"><?=$model->email?></a></span>
				</p>
				<p>
					<span>IP:</span> 
					<span><?=$model->ip?></span>
				</p>
			</div>
		<?php ActiveForm::end(); ?>
	</div>
	<br>
    <p>
        <?= Html::a('Сохранить', ['update', 'id' => $model->id], ['class' => 'btn btn-success']) ?>
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
