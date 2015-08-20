<?php

	/* @var $this yii\web\View */

	$this->title = 'Мужской спа-салон «Барон»';

?>
		<!--Content-->
		<div id="content" class="clearfix">
			<section id="main_page">
				<h1><?=$title_h1?></h1>
				<div class="owl-container">
					<div class="owl-carousel owl-theme slideimage">
						<div class="item">
							<img src="/images/1.png" alt="">
						</div>
						<div class="item">
							<img src="/images/5.png" alt="">
						</div>
						<div class="item">
							<img src="/images/6.png" alt="">
						</div>			 
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
					<a href="/masters.php" class="link">Все мастера</a>
					<a href="/onemaster.php" class="master_link">
						<img src="/images/master-1.png" alt="">
						<p class="name">Василиса</p>
					</a>
				</div>
				<div id="main_actions">
					<p class="title">Акции</p>
					<a href="/actions.php" class="link all_list">Все акции</a>
					<p class="description">В дневное время скидка 20% на все программы, каждый день кроме выходных!</p>
					<a href="/actions.php" class="link all_text">Подробнее</a>
				</div>
				<div id="main_responses">
					<p class="title">Отзывы</p>
					<a href="/reviews.php" class="link all_list">Все отзывы</a>
					<div class="some_reviews">
						<p class="reviews_name">Андрей</p>
						<div class="review_background">
							<p class="review_text">Отличный салон!</p>
							<a>Читать далее</a>
						</div>
					</div>
				</div>
				<div id="main_sertificates">
					<p class="title">Подарочный сертификат</p>
					<a class="zoomimage" href="/images/3.png">
						<img src="/images/3.png" alt="">
					</a>		
				</div>
			</aside>
		</div>
		<!--Content-->
