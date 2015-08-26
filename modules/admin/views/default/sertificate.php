<?php
use app\modules\admin\models\BImages;
use yii\helpers\Html;
use yii\bootstrap\Alert;
use yii\widgets\ActiveForm;
use dosamigos\tinymce\TinyMce;
use kartik\widgets\FileInput;
/* @var $this yii\web\View */
/* @var $model app\modules\admin\models\BHello */
/* @var $form ActiveForm */
$this->title = 'Сертификат';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="bhello" style="width: 700px;">
	<?if($success){
		echo Alert::widget([
			'options' => [
				'class' => 'alert-success'
			],
			'body' => '<b>Сертификат успешно изменен!</b>'
		]);
	}?>
    <?php $form = ActiveForm::begin(); ?>
        <?= $form->field($model, 'title') ?>
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
		<?=FileInput::widget([
			'name' => 'image[]',
			'language' => 'ru',
			'options' => [
				'multiple' => true,
				'accept' => 'image/*',
			],
			'pluginOptions' => [
				'previewFileType' => 'image',
				'previewSettings' => [
					'image' => ['width' => 'auto', 'height' => '220px'],
				],
				'uploadUrl' => ['/admin/upload'],
				'browseClass' => 'btn btn-success',
				'uploadClass' => 'btn btn-info',
				'removeClass' => 'btn btn-danger',
				'removeIcon' => '<i class="glyphicon glyphicon-trash"></i> ',
				'maxFileCount' => 1,
				'initialPreview' => $array_image,
				'initialPreviewConfig' => $array_image_cfg,
				'overwriteInitial' => false,
			],
			'pluginEvents' => [
				'fileuploaded' => 'function(event, data, previewId, index){
					var form = data.form, files = data.files, extra = data.extra, response = data.response, reader = data.reader;
					$(".file-input").append(\'<input hidden type="text" name="id_img[]" value="\'+response["id_img"]+\'"/>\');
					$(".file-input input[name=\"id_img[]\"]").each(function(i, value){
						$(this).attr("data-name", files[i]["name"]);
					});
					if($(".file-input .file-preview-frame").length == 1){
						$(".file-input .input-group").hide();
					}
				}',
				'filesuccessremove' => 'function(event, id){
					if($(".file-input .file-preview-frame").length == 1){
						$(".file-input .input-group").show();
					}
				}',
			]
		]);?>
        <div class="form-group">
			<?= Html::submitButton('Сохранить', ['class' => 'btn btn-success']) ?>
			<?= Html::a('Отменить', ['/admin'], ['class'=>'btn btn-primary']) ?>
        </div>
    <?php ActiveForm::end(); ?>
</div>
