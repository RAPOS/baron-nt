<?
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
	<div id="onemaster_page" class="clearfix">
		<h1><?=$model->name?></h1>
		<div class="master_images">
			<div class="main_image">					
				<a class="zoomimage" rel="master" href="/images/master.png">
				<?$model_images = json_decode($model->images);
					$BImages = BImages::findOne($model_images[0]);
					if($BImages->path && file_exists(Yii::getAlias('@webroot/'.$BImages->path))){
						$image = Yii::$app->image->load(Yii::getAlias('@webroot/'.$BImages->path));
						$image->resize(280, 200);
						$image->save(Yii::getAlias('@webroot/assets/'.$BImages->name.'.'.$BImages->extension));
						?>			
						<img src="<?='/assets/'.$BImages->name.'.'.$BImages->extension?>" alt="">
					<?} else {?>
						<a href="/programs/<?=$masters->translate?>">
							<img src="/images/default_master.png" width="280" height="200" alt="">					
						</a>
					<?}?>
				</a>						
				<div class="image-prev" onclick="image_prev($(this));"></div>
				<div class="image-next" onclick="image_next($(this));"></div>
			</div>
			<div class="preview_image">
				<img onclick="change_image($(this));" src="/images/master.png" alt="">
				<img onclick="change_image($(this));" src="/images/master.png" alt="">
				<img onclick="change_image($(this));" src="/images/master.png" alt="">
			</div>
		</div>
		<div class="info">			
			<p>Возраст: <span><?=$model->age?></span> </p>
			<p>Грудь: <span><?=$model->breast?></span></p>
			<p>Рост: <span><?=$model->growth?></span></p>	
			<p>Вес: <span><?=$model->weight?></span></p>	
			<p>Описание:</p>	
			<p><span><?=strip_tags($model->description)?></span></p>	
			<script type="text/javascript" src="//yastatic.net/share/share.js" charset="utf-8"></script>
			<div class="yashare-auto-init" data-yashareL10n="ru" data-yashareType="small" data-yashareQuickServices="vkontakte,facebook,twitter,odnoklassniki,moimir" data-yashareTheme="counter"></div>				
		</div>
		<div class="prev-link"><span><</span>Предыдущий мастер</div>
		<div class="next-link">Следующий мастер<span>></span></div>
	</div>
	<h2 class="reviews_title">Отзывы</h2>
	<div id="reviews">
		<a href="#reviews_box" class="add_reviews zoomimage">Оставить отзыв</a>
		<?=$this->render('_reviews_form', [
			'section' => 'masters',
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