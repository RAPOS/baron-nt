<?php
use yii\widgets\LinkPager;
use app\modules\admin\models\BImages;
$this->title = 'Мужской спа-салон «Барон»';
?>
<div id="content" class="clearfix">
	<div id="masters_page">
		<h1>Мастера</h1>
		<div id="masters_image">
			<?foreach($model as $masters){
				$model_images = json_decode($masters->images);
				$BImages = BImages::findOne($model_images[0]);
				if($BImages->path && file_exists(Yii::getAlias('@webroot/'.$BImages->path))){
					$image = Yii::$app->image->load(Yii::getAlias('@webroot/'.$BImages->path));
					$image->resize(280, 200);
					$image->save(Yii::getAlias('@webroot/assets/'.$BImages->name.'.'.$BImages->extension));
					?>			
					<a href="/masters/<?=$masters->translate?>">
						<img src="<?='/assets/'.$BImages->name.'.'.$BImages->extension?>" alt="">
						<p><?=$masters->name?></p>						
					</a>
				<?} else {?>
					<a href="/masters/<?=$masters->translate?>">
						<img src="/images/default_master.png" width="280" height="200" alt="">
						<p><?=$masters->name?></p>
						<?if($masters->new){?>
							<div class="new_master"></div>						
						<?}else if($masters->tour){?>
							<div class="master_in_tour"></div>	
						<?}?>
					</a>
				<?}
			}?>
			<div class="paginate clearfix">
				<?echo LinkPager::widget([
					'pagination' => $page,
				]);?>
			</div>	
		</div>	
		<h2>Описание</h2>
		<div id="masters_text">
			<p><?=strip_tags($description)?></p>
		</div>			
	</div>
</div>