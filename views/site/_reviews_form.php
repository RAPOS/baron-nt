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
		<div style="padding-left: 15px;padding-bottom: 10px">
			<a href='javascript:setSmile(":)")'><img src='/images/smiles/ab.gif' title="Улыбка" alt=''/></a>
			<a href='javascript:setSmile(":yahoo:")'><img src='/images/smiles/bp.gif' title="Восторг" alt=''/></a>			
			<a href='javascript:setSmile("8-)")'><img src='/images/smiles/24.gif' title="Крутой" alt=''/></a>
			<a href='javascript:setSmile(":think:")'><img src='/images/smiles/73.gif' title="Раздумье" alt=''/></a>			
			<a href='javascript:setSmile(";)")'><img src='/images/smiles/105.gif' title="Подмигивание" alt=''/></a>
			<a href='javascript:setSmile(":cool:")'><img src='/images/smiles/33.gif' title="Класс" alt=''/></a>
			<a href='javascript:setSmile(":yes:")'><img src='/images/smiles/109.gif' title="Да" alt=''/></a>
			<a href='javascript:setSmile(":ok:")'><img src='/images/smiles/56.gif' title="Ок" alt=''/></a>
			<a href='javascript:setSmile(":dance:")'><img src='/images/smiles/21.gif' title="Танец" alt=''/></a>
			<a href='javascript:setSmile(":drug:")'><img src='/images/smiles/31.gif' title="Друзья" alt=''/></a>
			<a href='javascript:setSmile(":read:")'><img src='/images/smiles/65.gif' title="Читает" alt=''/></a>
			<a href='javascript:setSmile(":aplo:")'><img src='/images/smiles/15.gif' title="Аплодирует" alt=''/></a>
		</div>
		<?= $form->field($reviews, 'text')->textArea(['rows' => 6, 'placeholder' => 'Введите текст']) ?>
		<?= $form->field($reviews, 'verifyCode')->widget(Captcha::classname(), [
			'options' => [
				'style' => 'font-size: 24px;width: 105px;padding-left: 10px;padding-right: 10px;margin-left: 0px;height: 50px;',
			],
			'template' => '<div class="row"><div class="col-lg-3">{image}</div><div style="margin-left: 70px;" class="col-lg-6">{input}</div></div>',
		])?>
		<?= $form->field($reviews, 'section')->textInput(['value' => $section, 'style' => 'display: none;'])->label(false)?>
		<?if($section == 'masters' || $section == 'programs'){?>
			<?= $form->field($reviews, 'translate')->textInput(['value' => $name, 'style' => 'display: none;'])->label(false)?>
		<?}?>
		<div class="form-group">
			<?= Html::submitButton('Отправить', ['class' => 'btn btn-primary', 'name' => 'contact-button']) ?>
		</div>
	<?php ActiveForm::end(); ?>				
</div>