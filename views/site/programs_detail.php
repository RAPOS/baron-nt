<?php
use kartik\widgets\Alert;
use app\modules\admin\models\BImages;
$this->title = 'Программа эротического массажа - '.$model->name;

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
	<div id="oneprogram_page" class="clearfix">
		<h1><?=$model->name?></h1>		
			<?$model_images = json_decode($model->images);
				$BImages = BImages::findOne($model_images[0]);
				if($BImages->path && file_exists(Yii::getAlias('@webroot/'.$BImages->path))){
					$image = Yii::$app->image->load(Yii::getAlias('@webroot/'.$BImages->path));
					$image->resize(280, 200);
					$image->save(Yii::getAlias('@webroot/assets/'.$BImages->name.'.'.$BImages->extension));
					?>			
					<img src="<?='/assets/'.$BImages->name.'.'.$BImages->extension?>" alt="">
				<?} else {?>
					<a href="/programs/<?=$programs->translate?>">
						<img src="/images/default_massage.png" width="280" height="200" alt="">
						<p><?=$programs->name?></p>						
					</a>
				<?}?>
		<div class="info">			
			<p class="time">Продолжительность: <?=$model->duration?> минут</p>
			<p class="description_title">В программу входит:</p>
			<p class="description_text"><?=$model->description?></p>	
			<script type="text/javascript" src="//yastatic.net/share/share.js" charset="utf-8"></script>
			<div class="yashare-auto-init" data-yashareL10n="ru" data-yashareType="big" data-yashareQuickServices="vkontakte,facebook,twitter,odnoklassniki,moimir" data-yashareTheme="counter"></div>				
			<div class="appeal">
				<p>Хочешь ощутить незабываемое удовольствие? Запишись на программу <a href='tel: +7 (3435) 42-06-06'>(3435) 42-06-06</a></p>
			</div>
		</div>
		<a href="/programs/<?=$prevprogramtranslate->translate?>" class="prev-link"><span></span>Предыдущая программа</a>	
		<a href="/programs/<?=$nextprogramtranslate->translate?>" class="next-link">Следующая программа<span></span></a>
	</div>
	<h2 class="reviews_title">Отзывы</h2>
	<div id="reviews">
		<a href="#reviews_box" class="add_reviews zoomimage">Оставить отзыв</a>
		<?=$this->render('_reviews_form', [
			'section' => 'programs',
			'translate' => $model->translate,
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