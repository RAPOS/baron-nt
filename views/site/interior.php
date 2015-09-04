<?php
use kartik\widgets\Alert;
use app\modules\admin\models\BImages;
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
	<div id="interior_page">
		<h1><?=$model->title?></h1>
		<div id="interior_image">
			<?$model_images = json_decode($model->images);
			foreach($model_images as $interior){
				$BImages = BImages::findOne($interior);
				if($BImages->path && file_exists(Yii::getAlias('@webroot/'.$BImages->path))){
					$image = Yii::$app->image->load(Yii::getAlias('@webroot/'.$BImages->path));
					$image->resize(280, 200);
					$image->save(Yii::getAlias('@webroot/assets/'.$BImages->name.'.'.$BImages->extension));
					?>			
					<a class="zoomimage" rel="interior-group" href="<?=$BImages->path?>">
						<img src="<?='/assets/'.$BImages->name.'.'.$BImages->extension?>" alt="">
					</a>
				<?}
			}?>
		</div>	
		<h2>Описание</h2>
		<div id="interior_text">
			<p><?=strip_tags($model->text)?></p>
		</div>
		<h3>Отзывы</h3>
		<div id="reviews">
		<a href="#reviews_box" class="add_reviews zoomimage">Оставить отзыв</a>
		<?=$this->render('_reviews_form', [
			'section' => 'interior'
		]);?>
		<?
		if($reviews){
			foreach($reviews as $key => $value){?>
				<div class="review_wrap">
					<p class="reviews_name"><?=$value->name?></p>
					<div class="review_background">
						<p class="review_text"><?=$value->text?></p>
					</div>
				</div>
			<?}
		}else{?>
			<p class="empty_reviews">Пока что не оставлено ни одного отзыва.</p>
		<?}?>			
		</div>				
	</div>
</div>