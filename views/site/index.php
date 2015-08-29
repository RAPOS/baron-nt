<?php
	/* @var $this yii\web\View */
	use app\modules\admin\models\BImages;
	$this->title = 'Мужской спа-салон «Барон»';
?>
		<!--Content-->
		<div id="content" class="clearfix">
			<section id="main_page">
				<h1><?=$title_h1?></h1>
				<div class="owl-container">
					<div class="owl-carousel owl-theme slideimage">
						<?
						$model_images = json_decode($images);
						for($i=0;$i<count($model_images);$i++){
							$BImages = BImages::findOne($model_images[$i]);
							if($BImages->path && file_exists(Yii::getAlias('@webroot/'.$BImages->path))){
								$image = Yii::$app->image->load(Yii::getAlias('@webroot/'.$BImages->path));
								$image->resize(280, 200);
							$image->save(Yii::getAlias('@webroot/assets/'.$BImages->name.'.'.$BImages->extension));
							?>
							<div class="item">
								<img src="<?='/assets/'.$BImages->name.'.'.$BImages->extension?>" alt="">
							</div><?						
							}
						}?>											 
					</div>
					<div class="owl-prev"></div>
					<div class="owl-next"></div>
				</div>
				<h2><?=$title_h2?></h2>
				<p><?=$text_1?></p>
				<p style="color:#c2c2c2 !important;"><?=$text_2?></p>
			</section>
			<aside>
				<div id="main_our_masters">
					<p class="title">Наши мастера</p>
					<a href="/masters" class="link">Все мастера</a>
					<?for($i=0;$i<count($masters);$i++){
						if($i==0){
							$active = 'active';
						}else{
							$active = '';
						}

						$model_images = json_decode($masters[$i]->images);
						$BImages = BImages::findOne($model_images[0]);
						if($BImages->path && file_exists(Yii::getAlias('@webroot/'.$BImages->path))){
							$image = Yii::$app->image->load(Yii::getAlias('@webroot/'.$BImages->path));
							$image->resize(280, 200);
							$image->save(Yii::getAlias('@webroot/assets/'.$BImages->name.'.'.$BImages->extension));?>
							<a href="/masters/<?=$masters[$i]->translate?>" class="master_link <?=$active?>">
								<img src="<?='/assets/'.$BImages->name.'.'.$BImages->extension?>" alt="">
								<p class="name"><?=$masters[$i]->name?></p>
							</a>
						<?}else{?>
								<a href="/masters/<?=$masters[$i]->translate?>" class="master_link <?=$active?>">
								<img src="/images/default_master.png" alt="">
								<p class="name"><?=$masters[$i]->name?></p>
							</a>					
						<?}?>
					<?}?>

				</div>
				<div id="main_actions">
					<p class="title">Акции</p>
					<a href="/actions" class="link all_list">Все акции</a>
					<p class="description"><?=strip_tags($actions->text)?></p>
				</div>
				<div id="main_responses">
					<p class="title">Отзывы</p>
					<a href="/reviews" class="link all_list">Все отзывы</a>
					<div class="some_reviews">
						<p class="reviews_name">Андрей</p>
						<div class="review_background">
							<p class="review_text">Отличный салон!</p>
							<?/*<a>Читать далее</a>*/?>
						</div>
					</div>
				</div>
				<div id="main_sertificates">
					<p class="title"><?=$sertificate->title?></p>
					<?$model_images = json_decode($sertificate->images);
					$BImages = BImages::findOne($model_images[0]);
					if($BImages->path && file_exists(Yii::getAlias('@webroot/'.$BImages->path))){
						$image = Yii::$app->image->load(Yii::getAlias('@webroot/'.$BImages->path));
						$image->resize(280, 200);
						$image->save(Yii::getAlias('@webroot/assets/'.$BImages->name.'.'.$BImages->extension));?>
						<a class="zoomimage" href="<?=$BImages->path?>">
							<img src="<?='/assets/'.$BImages->name.'.'.$BImages->extension?>" alt="">
						</a>
					<?}?>
				</div>
			</aside>
		</div>
		<!--Content-->
