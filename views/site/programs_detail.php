<?php

	$this->title = 'Мужской спа-салон «Барон»';	
	use app\modules\admin\models\BImages;
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

			<div class="yashare-auto-init" data-yashareL10n="ru" data-yashareType="small" data-yashareQuickServices="vkontakte,facebook,twitter,odnoklassniki,moimir" data-yashareTheme="counter"></div>				

		</div>

		<div class="prev-link"><span><</span>Предыдущая программа</div>	

		<div class="next-link">Следующая программа<span>></span></div>

	</div>

	<h2 class="reviews_title">Отзывы</h2>

	<div id="reviews">

		<p class="reviews_name">Андрей</p>

		<div class="review_background">

			<p class="review_text">Отличный салон!</p>

			<a>Читать далее</a>

		</div>

	</div>	

</div>