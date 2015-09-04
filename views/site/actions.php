<div id="content" class="clearfix">

	<div id="actions_page">

		<h1>Акции</h1>

		<?/*<div id="actions_filter">

			<p class="active">Действует</p>

			<p>Все</p>

		</div>*/?>

		<div class="actions_block">
			<?for($i=0;$i<count($actions);$i++){?>
				<div class="action">

					<div class="date"><?=Yii::$app->formatter->asDate($actions[$i]->date, 'd.MM.Y')?></div>
					<?if($actions[$i]->status == 1){
						$active = 'active';
						$status = 'Действует';
					}else{
						$active = '';
						$status = 'Не действует';
					}?>
					<div class="status <?=$active?>"><?=$status?></div>

					<div class="description"><?=strip_tags($actions[$i]->text)?></div>

				</div>	
			<?}?>
	</div>

</div>