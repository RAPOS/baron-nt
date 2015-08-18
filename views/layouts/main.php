<?php

/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use app\assets\AppAsset;

AppAsset::register($this);

?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html>
	<head>
		 <title><?= Html::encode($this->title) ?></title>
		
		<meta charset="<?= Yii::$app->charset ?>">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<meta name="keywords" content="">
		<meta name="description" content="">
		
		<link rel="icon" type="image/vnd.microsoft.icon" href="/favicon.ico">
		<link href="/css/jquery.fancybox.css" rel="stylesheet" type="text/css">
		<link href="/css/owl.carousel.css" rel="stylesheet" type="text/css">
		<link href="/css/owl.theme.css" rel="stylesheet" type="text/css">
		<link href="/css/component.css" rel="stylesheet" type="text/css">
		
		<script type="text/javascript" charset="utf-8" src="https://api-maps.yandex.ru/services/constructor/1.0/js/?sid=f44ArjT_bgjaocuFoKidIcDfxU1SqmBM&amp;width=550&amp;height=450&amp;id=map"></script>
		<?php $this->head() ?>
	</head>
	<body>
	<?php $this->beginBody() ?>
		<!--Header-->
		<header>
			<div class="crown"></div>
			<div class="frame"></div>
			<img src="/images/logobaron.png" alt="" style="">
			<div id="logowrap">
				<div id="logo">
					<p>Cпа-салон</p>
					<p>для мужчин</p>
					<p>Барон</p>
					<p class="age">18<span>+</span></p>
				</div>
				<div class="icons">
					<a href="">
						<img src="/images/vk.png" alt="">
					</a>
					<a href="">
						<img src="/images/fb.png" alt="">
					</a>
				</div>
			</div>			
			<div id="contactinfowrap">
				<div id="contactinfo">
					<p>Строителей, 4</p>
					<p>проспект</p>
					<p class="phone">(3435) <span>42-06-06</span></p>
					<p class="roundclock">круглосуточно</p>
				</div>
				<div class="icons">
					<a href="">
						<img class="cardicon" src="/images/card.png" alt="">
					</a>
					<a href="">
						<img class="wifiicon" src="/images/wi-fi.png" alt="">
					</a>
				</div>
			</div>
			<div class="circle"></div>
			<div class="lenta"></div>
			<nav id="menu" class="cl-effect-4">
				<div style="margin:0 auto; width:865px">
					<a href="/">Главная</a>
					<a href="/masters">Мастера</a>
					<a href="/interior">Интерьер</a>
					<a href="/programs">Программы</a>
					<a href="/rules">Правила</a>
					<a href="/vacancy">Вакансии</a>
					<a href="/contacts">Контакты</a>
				</div>
			</nav>
		</header>
		<!--Header-->
<?php $this->beginBody() ?>

			<?= $content ?>

		<!--Footer-->
		<footer>
			<div id="copyright">© <span>Cпа-салон Барон 2015</span></div>
		</footer>
		<!--Footer-->
		
<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
