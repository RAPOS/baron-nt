<?php
use yii\helpers\Html;
use yii\bootstrap\Alert;
use yii\widgets\ActiveForm;
use dosamigos\tinymce\TinyMce;
/* @var $this yii\web\View */
/* @var $model app\modules\admin\models\BHello */
/* @var $form ActiveForm */
$this->title = 'Описание';
$this->params['breadcrumbs'][] = ['label' => 'Мастера', 'url' => ['/admin/masters']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="bmainpage-massage" style="width: 700px;">
	<?if($success){
		echo Alert::widget([
			'options' => [
				'class' => 'alert-success'
			],
			'body' => '<b>Описание успешно изменено!</b>'
		]);
	}?>
    <?php $form = ActiveForm::begin(); ?>
		<?= $form->field($model, 'text')->widget(TinyMce::className(), [
			'options' => ['rows' => 10],
			'language' => 'ru',
			'clientOptions' => [
				'plugins' => [
					"advlist autolink lists link charmap print preview anchor",
					"searchreplace visualblocks code fullscreen",
					"insertdatetime media table contextmenu paste"
				],
				'toolbar' => "undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image"
			]
		]);?>
        <div class="form-group">
			<?= Html::submitButton('Сохранить', ['class' => 'btn btn-success']) ?>
			<?= Html::a('Отменить', ['/admin/masters'], ['class'=>'btn btn-primary']) ?>
        </div>
    <?php ActiveForm::end(); ?>
</div>