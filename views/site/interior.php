<?php
use app\modules\admin\models\BImages;
$this->title = 'Мужской спа-салон «Барон»';
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
			<p><?=$model->text?></p>
		</div>
		<h3>Отзывы</h3>
		<div id="reviews">
		<a href="#reviews_box" class="add_reviews zoomimage">Оставить отзыв</a>
			<?=$this->render('_reviews_form', [
				'section' => 'interior'
			]);?>
			<p class="reviews_name">Андрей</p>
			<div class="review_background">
				<p class="review_text">Отличный салон!</p>
				<a>Читать далее</a>
			</div>
		</div>				
	</div>
</div>