<?php
$this->title = 'Вакансии - Мужской спа-салон «Барон»';
$this->registerMetaTag([
    'name' => 'keywords',
    'content' => $keywords
]);
$this->registerMetaTag([
    'name' => 'description',
    'content' => $description
]);
?>
<div id="content" class="clearfix">
	<div id="vacancy_page">
		<h1><?=$title?></h1>
		<p><?=strip_tags($text)?></p>
		<div class="appeal">
			<p>Хочешь работать у нас? Звони <a href='tel: +7 (3435) 42-06-06'>(3435) 42-06-06</a></p>
		</div>	
	</div>
</div>