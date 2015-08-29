<?
	use yii\helpers\Html;
	use yii\bootstrap\ActiveForm;
	use yii\captcha\Captcha;
	$this->title = 'Мужской спа-салон «Барон»';
?><div id="content" class="clearfix">
	<div id="reviews_page">
		<h1>Отзывы</h1>
		<a href="#reviews_box" class="add_reviews zoomimage">Оставить отзыв</a>
		<?=$this->render('_reviews_form', [
			'section' => 'reviews'
		]);?>
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