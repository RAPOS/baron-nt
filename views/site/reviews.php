<?
use kartik\widgets\Alert;
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\captcha\Captcha;
$this->title = 'Мужской спа-салон «Барон»';
if(!$captcha){
	echo Alert::widget([
		'type' => Alert::TYPE_DANGER,
		'title' => 'Ошибка! Отзыв не отправлен!',
		'icon' => 'glyphicon glyphicon-remove-sign',
		'body' => 'Вы не верно ввели проверочный код!',
		'showSeparator' => true,
		'delay' => 5000,
		'options' => [
			'style' => 'position: absolute;top: 0;right: 0;width: 400px;',
		],
	]);
}
if($save){
	echo Alert::widget([
		'type' => Alert::TYPE_SUCCESS,
		'title' => 'Отзыв отравлен!',
		'icon' => 'glyphicon glyphicon-remove-sign',
		'body' => 'Отзыв будет опубликован после модерации!',
		'showSeparator' => true,
		'delay' => 5000,
		'options' => [
			'style' => 'position: absolute;top: 0;right: 0;width: 400px;',
		],
	]);
}
?>
<div id="content" class="clearfix">
	<div id="reviews_page">
		<h1>Отзывы</h1>
		<a href="#reviews_box" class="add_reviews zoomimage">Оставить отзыв</a>
		<?=$this->render('_reviews_form', [
			'section' => 'reviews'
		]);?>
		<div id="reviews">
		<?foreach($reviews as $key => $value){?>
			<div class="review_wrap">
				<p class="reviews_name"><?=$value->name?></p>
				<div class="review_background">
					<p class="review_text"><?=$value->text?></p>
				</div>
			</div>
		<?}?>
		</div>	
	</div>
</div>