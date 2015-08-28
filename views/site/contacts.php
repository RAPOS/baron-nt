<?php
	use yii\helpers\Html;
	use yii\bootstrap\ActiveForm;
	use yii\captcha\Captcha;
	$this->title = 'Мужской спа-салон «Барон»';

?>
	<div id="content" class="clearfix">
		<h1 class="contacts_title">Контакты</h1>
		<p class="contacts_text"><?=$text?></p>
		<section id="contacts_page">
				<div id="map">
				
				</div>
		</section>
		<aside>
			<div id="feedback">
				<h2>Форма для вопросов и предложений</h2>
                <?php $form = ActiveForm::begin(['id' => 'contact-form']); ?>
                    <?= $form->field($feedback, 'name')->textInput(['placeholder' => 'Введите имя']) ?>
                    <?= $form->field($feedback, 'email')->textInput(['placeholder' => 'Введите e-mail']) ?>
                    <?= $form->field($feedback, 'subject')->textInput(['placeholder' => 'Введите тему']) ?>
                    <?= $form->field($feedback, 'text')->textArea(['rows' => 6, 'placeholder' => 'Введите текст']) ?>
                    <?= $form->field($feedback, 'verifyCode')->widget(Captcha::className(), [
						'options' => [
							'style' => 'font-size: 24px;width: 135px;padding-left: 10px;padding-right: 10px;',
						],
                        'template' => '<div class="row"><div class="col-lg-3">{image}</div><div class="col-lg-6">{input}</div></div>',
                    ]) ?>
                    <div class="form-group">
                        <?= Html::submitButton('Отправить', ['class' => 'btn btn-primary', 'name' => 'contact-button']) ?>
                    </div>

                <?php ActiveForm::end(); ?>				
			</div>
		</aside>
	</div>