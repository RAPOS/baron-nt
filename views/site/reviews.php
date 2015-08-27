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
                <?php $form = ActiveForm::begin(['id' => 'contact-form']); ?>

                    <?= $form->field($reviews, 'name')->textInput(['placeholder' => 'Введите имя']) ?>

                    <?= $form->field($reviews, 'email')->textInput(['placeholder' => 'Введите e-mail']) ?>

                    <?= $form->field($reviews, 'text')->textArea(['rows' => 6, 'placeholder' => 'Введите текст']) ?>

                    <?= $form->field($reviews, 'verifyCode')->widget(Captcha::className(), [
                        'template' => '<div class="row"><div class="col-lg-3">{image}</div><div class="col-lg-6">{input}</div></div>',
                    ]) ?>

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