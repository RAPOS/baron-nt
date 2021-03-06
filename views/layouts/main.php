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
		<meta name="viewport" content="width=1024">
		<?php $this->head() ?>
		<link href="/favicon.ico" rel="shortcut icon">
		<link href="/favicon.ico" rel="icon" type="image/x-icon">
		<link href="/css/jquery.fancybox.css" rel="stylesheet" type="text/css">
		<link href="/css/owl.carousel.css" rel="stylesheet" type="text/css">
		<link href="/css/owl.theme.css" rel="stylesheet" type="text/css">
		<link href="/css/component.css" rel="stylesheet" type="text/css">
		<link rel="stylesheet" type="text/css" href="/css/style.css" />
		<link rel="stylesheet" type="text/css" href="/css/jquery.jscrollpane.css" media="all" />
		
		<script type="text/javascript" charset="utf-8" src="https://api-maps.yandex.ru/services/constructor/1.0/js/?sid=f44ArjT_bgjaocuFoKidIcDfxU1SqmBM&amp;width=550&amp;height=495&amp;id=map"></script>

	</head>
	<body>
	<!-- Yandex.Metrika counter --><script type="text/javascript"> (function (d, w, c) { (w[c] = w[c] || []).push(function() { try { w.yaCounter32316554 = new Ya.Metrika({ id:32316554, clickmap:true, trackLinks:true, accurateTrackBounce:true, webvisor:true }); } catch(e) { } }); var n = d.getElementsByTagName("script")[0], s = d.createElement("script"), f = function () { n.parentNode.insertBefore(s, n); }; s.type = "text/javascript"; s.async = true; s.src = "https://mc.yandex.ru/metrika/watch.js"; if (w.opera == "[object Opera]") { d.addEventListener("DOMContentLoaded", f, false); } else { f(); } })(document, window, "yandex_metrika_callbacks");</script><noscript><div><img src="https://mc.yandex.ru/watch/32316554" style="position:absolute; left:-9999px;" alt="" /></div></noscript><!-- /Yandex.Metrika counter -->	
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
					<a rel="nofollow" href="https://vk.com/spasalonbaron">
						<img src="/images/vk.png" alt="">
					</a>
					<a rel="nofollow" href="">
						<img src="/images/fb.png" alt="">
					</a>
				</div>
			</div>			
			<div id="contactinfowrap">
				<div id="contactinfo">
					<p>Строителей, 4</p>
					<p>проспект</p>
					<a class="phone" href='tel: +7 (3435) 42-06-06'>(3435)<span>42-06-06</span></a>
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
					<a href="/masters/">Мастера</a>
					<a href="/interior/">Интерьер</a>
					<a href="/programs/">Программы</a>
					<a href="/rules/">Правила</a>
					<a href="/vacancy/">Вакансии</a>
					<a href="/contacts/">Контакты</a>
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
<!--Кнопка 1relax.ru-->
<a class="relaxlink" rel="nofollow" href="http://www.1relax.ru" title="Все салоны эротического массажа" target="_blank"><img src="http://www.1relax.ru/buttons/130x31.png" border="0" width="130" height="31" alt="Все салоны эротического массажа" /></a>
<!--/ Кнопка 1relax.ru-->
<!-- begin of Top100 code -->
<div class="counter">
	<script id="top100Counter" type="text/javascript" src="http://counter.rambler.ru/top100.jcn?3130409"></script>
	<noscript>
		<a rel="nofollow" href="http://top100.rambler.ru/navi/3130409/">
			<img src="http://counter.rambler.ru/top100.cnt?3130409" alt="Rambler's Top100" border="0" />
		</a>
	</noscript>
</div>
<!-- end of Top100 code -->

</body>
</html>
<?php $this->endPage() ?>
