<?
	use yii\helpers\Html;
	use yii\bootstrap\ActiveForm;
	use yii\captcha\Captcha;
	$this->title = 'Мужской спа-салон «Барон»';
?><div id="content" class="clearfix">
	<div id="reviews_page">
		<h1>Отзывы</h1>
		<p class="add_reviews">Оставить отзыв</p>
		<div class="reviews_form_block">
				<p class="title">Оставить отзыв</p>
                <?php $form = ActiveForm::begin(['id' => 'contact-form',]); ?>
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
                    <?= $form->field($reviews, 'verifyCode')->widget(Captcha::className(), [
						'options' => [
							'style' => 'font-size: 24px;width: 105px;padding-left: 10px;padding-right: 10px;',
						],
                        'template' => '<div class="row"><div class="col-lg-3">{image}</div><div class="col-lg-6">{input}</div></div>',
                    ])?>
					<?= $form->field($reviews, 'section')->textInput(['value' => 'reviews', 'style' => 'display: none;'])->label(false)?>
                    <div class="form-group">
                        <?= Html::submitButton('Отправить', ['class' => 'btn btn-primary', 'name' => 'contact-button']) ?>
                    </div>
                <?php ActiveForm::end(); ?>				
		</div>
		<div id="reviews">
			<div class="review_wrap">
				<p class="reviews_name">Андрей</p>
				<div class="review_background">
					<p class="review_text">Отличный салон!</p>
					<a>Читать далее</a>
				</div>
			</div>
			<div class="review_wrap">
				<p class="reviews_name">Леха</p>
				<div class="review_background">
					<p class="review_text">Отличный салон!</p>
					<a>Читать далее</a>
				</div>
			</div>
		</div>	
	</div>
</div>