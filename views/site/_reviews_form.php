<?
use app\modules\admin\models\BReviews;
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\captcha\Captcha;
$reviews = new BReviews;
?>
<div id="reviews_box" class="reviews_form_block">
	<p class="title">Оставить отзыв</p>
		<?php $form = ActiveForm::begin([
			'id' => 'contact-form',
			'action' => '/reviews',
		]);?>
		<?= $form->field($reviews, 'name')->textInput(['placeholder' => 'Введите имя']) ?>
		<?= $form->field($reviews, 'email')->textInput(['placeholder' => 'Введите e-mail']) ?>
		<?= $this->render('_reviews_form_smiles') ?>
		<?= $form->field($reviews, 'text')->textArea(['rows' => 6, 'placeholder' => 'Введите текст']) ?>
		<?= $form->field($reviews, 'verifyCode')->widget(Captcha::classname(), [
			'options' => [
				'style' => 'font-size: 24px;width: 105px;padding-left: 10px;padding-right: 10px;margin-left: 0px;height: 50px;',
			],
			'template' => '<div class="row"><div class="col-lg-3">{image}</div><div style="margin-left: 70px;" class="col-lg-6">{input}</div></div>',
		])?>
		<?= $form->field($reviews, 'section')->textInput(['value' => $section, 'style' => 'display: none;'])->label(false)?>
		<?if($section == 'masters' || $section == 'programs'){?>
			<?= $form->field($reviews, 'translate')->textInput(['value' => $translate, 'style' => 'display: none;'])->label(false)?>
		<?}?>
		<div class="form-group">
			<?= Html::submitButton('Отправить', ['class' => 'btn btn-primary', 'name' => 'contact-button']) ?>
		</div>
	<?php ActiveForm::end(); ?>				
</div>