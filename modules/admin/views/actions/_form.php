<?php
use dosamigos\tinymce\TinyMce;
use kartik\widgets\DatePicker;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
/* @var $this yii\web\View */
/* @var $model app\modules\admin\models\BActions */
/* @var $form yii\widgets\ActiveForm */
?>
<div class="bactions-form">
    <?php $form = ActiveForm::begin(); ?>
	<div class="clearfix">
		<div style="float: left;width: 189px;">
			<?= $form->field($model, 'date')->widget(DatePicker::classname(), [
				'options' => [
					'placeholder' => 'Выберите дату ...',
					'style' => 'width: 150px;',
				],
				'type' => DatePicker::TYPE_COMPONENT_APPEND,
				'removeButton' => false,
				'pluginOptions' => [
					'autoclose'=>true
				]
			]);?>
		</div>
		<div style="float: left;">
			<?= $form->field($model, 'status')->textInput() ?>
		</div>
	</div>
	<?= $form->field($model, 'text')->widget(TinyMce::className(), [
		'options' => ['rows' => 6],
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
		<?= Html::submitButton($model->isNewRecord ? 'Сохранить' : 'Обновить', ['class' => 'btn btn-success']) ?>
		<?= Html::a('Отменить', ['/admin/masters'], ['class'=>'btn btn-primary']) ?>
	</div>
    <?php ActiveForm::end(); ?>
</div>
