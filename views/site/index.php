<?php
/* @var $this yii\web\View */
use app\modules\admin\models\BImages;
use app\modules\admin\models\BSettings;
$this->title = 'Мужской спа-салон «Барон»';
$settings = BSettings::find()->where(['site' => 1])->one();
$this->registerMetaTag([
    'name' => 'keywords',
    'content' => $settings->keywords
]);
$this->registerMetaTag([
    'name' => 'description',
    'content' => $settings->description
]);
?>
<!--Content-->
<div id="content" class="clearfix">
	<section id="main_page">
		<a href="/masters/"><h1>Наши мастера</h1></a>
		<div class="owl-container"  style="margin-bottom:-15px;">
			<div class="owl-carousel owl-theme slideimage">
				<img src="/images/521953.png" alt="">									 
				<img src="/images/main1.png" alt="">									 
				<img src="/images/main2.png" alt="">									 
			</div>
			<div class="owl-prev"></div>
			<div class="owl-next"></div>
		</div>
		<a href="/interior/"><h1>Интерьер</h1></a>
		<div class="main_interior_block">
			<div id="ca-container2" class="ca-container">
				<div class="ca-wrapper">
				<?
				$model_images = json_decode($images);
				for($i=0;$i<count($model_images);$i++){
					$BImages = BImages::findOne($model_images[$i]);
					if($BImages->path && file_exists(Yii::getAlias('@webroot/'.$BImages->path))){
						$image = Yii::$app->image->load(Yii::getAlias('@webroot/'.$BImages->path));
						$image->resize(280, 200);
					$image->save(Yii::getAlias('@webroot/assets/'.$BImages->name.'.'.$BImages->extension));
					?>
					<div class="ca-item  ca-item-<?=$i+1?>">
						<a class="zoomimage ca-item-main" rel="interior" href="<?=$BImages->path?>">
							<img width="165" height="110" src="<?='/assets/'.$BImages->name.'.'.$BImages->extension?>" alt="">
						</a>
					</div>	<?						
					}
				}
				?>	
				</div>
			</div>				
		</div>
		<a href="/programs/"><h1>Программы</h1></a>
		<div class="main_interior_block">
			<div id="ca-container" class="ca-container">
				<div class="ca-wrapper">
					<div class="ca-item ca-item-1">
						<a class="ca-item-main" href="/programs/">
							<img width="165" height="110" src="/images/klubnika.jpg" alt="">	
						</a>
					</div>
					<div class="ca-item ca-item-2">
						<a class="ca-item-main" href="/programs/">
							<img width="165" height="110" src="/images/chocolate.jpg" alt="">	
						</a>
					</div>
					<div class="ca-item ca-item-3">
						<a class="ca-item-main" href="/programs/">
							<img width="165" height="110" src="/images/citrus.jpg" alt="">	
						</a>
					</div>					
				</div>
			</div>		
		</div><br>	
		<h2><?=$title_h2?></h2>
		<p><?=strip_tags($text_1)?></p>
		<p style="color:#c2c2c2 !important; font-size:14px; line-height:14px; font-style:italic; margin-bottom:30px;"><?=strip_tags($text_2)?></p>
		<p style="color:#c2c2c2 !important; font-size:14px; line-height:14px; font-style:italic; margin-bottom:30px; margin-top:-15px;">Все указанные услуги предоставляются в рамках шоу программ, салон Барон услуг медицинского массажа не оказывает. При употреблении слова "массаж" следует руководствоваться исключительно художественным описанием шоу программ.</p>
	</section>
	<aside>
		<div id="main_our_masters">
			<a class="title" href="/mastersforwomen/">Для женщин</a>
			<div class="owl-container">
				<div class="owl-carousel owl-theme slideimage">
				<?foreach($mastersforwomen as $masters){
					$model_images = json_decode($masters->images);
					$BImages = BImages::findOne($model_images[0]);
					if($BImages->path && file_exists(Yii::getAlias('@webroot/'.$BImages->path))){
						$image = Yii::$app->image->load(Yii::getAlias('@webroot/'.$BImages->path));
						$image->resize(280, 200);
						$image->save(Yii::getAlias('@webroot/assets/'.$BImages->name.'.'.$BImages->extension));
						?>			
						<img width="330" src="<?='/assets/'.$BImages->name.'.'.$BImages->extension?>" alt="">				
				<?}
				}?>			
				</div>
				<div class="owl-prev"></div>
				<div class="owl-next"></div>
			</div>
			<p>Запись на программы для милых дам осуществляется предварительно!</p>
		</div>
		<div id="main_actions">
			<a href="/actions"><p class="title">Акции</p></a>
			<p class="description"><?=strip_tags($actions->text)?></p>
		</div>
		<div id="main_sertificates">
			<a href="/sertificate"><p class="title"><?=$sertificate->title?></p></a>
			<?$model_images = json_decode($sertificate->images);
			$BImages = BImages::findOne($model_images[0]);
			if($BImages->path && file_exists(Yii::getAlias('@webroot/'.$BImages->path))){
				$image = Yii::$app->image->load(Yii::getAlias('@webroot/'.$BImages->path));
				$image->resize(280, 200);
				$image->save(Yii::getAlias('@webroot/assets/'.$BImages->name.'.'.$BImages->extension));?>
				<a href="/sertificate/">
					<?/*<img src="<?='/assets/'.$BImages->name.'.'.$BImages->extension?>" alt="">*/?>
					<img src="/images/sertif.png" alt="">
				</a>
			<?}?>
		</div>		
		<?if($reviews){?>
			<div id="main_responses">
				<a href="/reviews"><p class="title">Отзывы</p></a>
					<?for($i=0;$i<count($reviews);$i++){
						if($i==0){
							$active = 'active';
						}else{
							$active = '';
						}
					?>
					<div class="some_reviews <?=$active?>">
						<p class="reviews_name"><?=$reviews[$i]->name?></p>
						<div class="review_background">
							<p class="review_text"><?=$reviews[$i]->text?></p>
						</div>
					</div>
				<?}?>
			</div>
		<?}?>

	</aside>
</div>
<!--Content-->