<?php
use yii\widgets\LinkPager;
use app\modules\admin\models\BImages;
$this->title = 'Мужской спа-салон «Барон»';	
?>
<div id="content" class="clearfix">
	<div id="programs_page">
		<h1>Программы</h1>
		<div id="programs_image">		
			<?foreach($model as $programs){
				$model_images = json_decode($programs->images);
				$BImages = BImages::findOne($model_images[0]);
				if($BImages->path && file_exists(Yii::getAlias('@webroot/'.$BImages->path))){
					$image = Yii::$app->image->load(Yii::getAlias('@webroot/'.$BImages->path));
					$image->resize(280, 200);
					$image->save(Yii::getAlias('@webroot/assets/'.$BImages->name.'.'.$BImages->extension));
					?>			
					<a href="/programs/<?=$programs->translate?>">
						<img src="<?='/assets/'.$BImages->name.'.'.$BImages->extension?>" alt="">
						<p><?=$programs->name?></p>						
					</a>
				<?} else {?>
					<a href="/programs/<?=$programs->translate?>">
						<img src="/images/default_massage.png" width="280" height="200" alt="">
						<p><?=$programs->name?></p>						
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
		<div id="programs_text">
			<p><?=$description?></p>
		</div>
	</div>
</div>