<?php
use yii\widgets\LinkPager;
use app\modules\admin\models\BImages;
use app\modules\admin\models\BMainpageMassage;
$this->title = 'Мастера эротического массажа - Мужской спа-салон «Барон»';
$master = BMainpageMassage::find()->one();
$this->registerMetaTag(['keywords' => $keywords]);	
?>
<div id="content" class="clearfix">
	<div id="masters_page">
		<h1>Мастера для милых дам</h1>
		<p class="attention">Запись на программы осуществляется по предварительной записи!</p>
		<div id="masters_image">
			<?foreach($model as $masters){
				$model_images = json_decode($masters->images);
				$BImages = BImages::findOne($model_images[0]);
				if($BImages->path && file_exists(Yii::getAlias('@webroot/'.$BImages->path))){
					$image = Yii::$app->image->load(Yii::getAlias('@webroot/'.$BImages->path));
					$image->resize(280, 200);
					$image->save(Yii::getAlias('@webroot/assets/'.$BImages->name.'.'.$BImages->extension));
					?>			
					<a href="/mastersforwomen/<?=$masters->translate?>">
						<img src="<?='/assets/'.$BImages->name.'.'.$BImages->extension?>" alt="">
						<p><?=$masters->name?></p>	
						<?if($masters->new){?>
							<div class="new_master"></div>						
						<?}else if($masters->tour){?>
							<div class="master_in_tour"></div>	
						<?}?>						
					</a>
				<?} else {?>
					<a href="/mastersforwomen/<?=$masters->translate?>">
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
		</div>	
		<h2>Описание</h2>
		<div id="masters_text">
			<p><?=strip_tags($description)?></p>
		</div>			
	</div>
</div>