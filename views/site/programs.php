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
			<?	} else {?>
					<a href="/programs/<?=$programs->translate?>">
						<img src="/images/default_massage.png" width="280" height="200" alt="">
						<p><?=$programs->name?></p>						
					</a>
				<?}
			}
			
			echo LinkPager::widget([
				'pagination' => $page,
			]);
		?>			
		</div>	
		<h2>Описание</h2>
		<div id="programs_text">
			<p>«Забыть о суете земной и вознестись на вершину блаженства возможно лишь тому, чей взор услаждают красавицы, слух ласкает музыка, а тело предстает как самая великая драгоценность». СПА салон Барон-это оазис удовольствия и покоя в мире полном суеты. Это окно в мир чувственности и блаженственности, удовольствия и безконечного наслаждения. Многим спа-салон представляется как храм блаженства: белоснежные полотенца, ароматические масла и чуткие руки мастера спа-массажа. Вы ощущаете, как нежные пальцы ласкают каждую Вашу клеточку, наполняя ее негой… СПА салон Барон ждет вас воплотить свои фантазии в реальность! Вы готовы пройти в мир блаженства? Соглашайтесь! Проведете свое время без забот и серых будней.</p>
		</div>
	</div>
</div>