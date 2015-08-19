<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use dosamigos\tinymce\TinyMce;
use kartik\widgets\FileInput;
/* @var $this yii\web\View */
/* @var $model app\modules\admin\models\BTypesOfMassage */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="btypes-of-massage-form">
    <?php $form = ActiveForm::begin(); ?>
	<div class="clearfix">
		<div style="float: left;">
			<?= $form->field($model, 'name')->textInput([
				'style' => 'width: 500px;',
				'maxlength' => true
			]) ?>
		</div>
		<div style="float: left;margin-left: 50px;">
			<?= $form->field($model, 'duration')->dropDownList (
				[
					'' => '',
					'60' => '60',
					'60' => '60',
					'50' => '50',
					'40' => '40',
					'30' => '30',
					'20' => '20',
					'10' => '10',
				],
				[
					'style' => 'width: 100px;',
				]
			)?>
		</div>
	</div>
    <?= $form->field($model, 'keywords')->textInput(['maxlength' => true]) ?>
	<?= $form->field($model, 'description')->widget(TinyMce::className(), [
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
	<?=FileInput::widget([
		'name' => 'image[]',
		'language' => 'ru',
		'options' => [
			'multiple' => true,
			'accept' => 'image/*',
		],
		'pluginOptions' => [
			'previewFileType' => 'image',
			'uploadUrl' => ['/admin/upload'],
			'browseClass' => 'btn btn-success',
			'uploadClass' => 'btn btn-info',
			'removeClass' => 'btn btn-danger',
			'removeIcon' => '<i class="glyphicon glyphicon-trash"></i> ',
		]
	]);?>
	<br>
    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Сохранить' : 'Обновить', ['class' => 'btn btn-success']) ?>
		<?= Html::a('Отменить', ['/admin/massage/'], ['class'=>'btn btn-primary']) ?>
    </div>
    <?php ActiveForm::end(); ?>

</div>