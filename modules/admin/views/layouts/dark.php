<?php

/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
use yii\widgets\Pjax;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\bootstrap\ButtonDropdown;
use yii\widgets\Breadcrumbs;
use app\assets\AppAsset;
use app\modules\admin\models\BAdmins;
use app\modules\admin\models\BSettings;

$BAdmins = BAdmins::findOne(Yii::$app->user->id);
$BSettings = BSettings::find()->where(['site' => 1])->one();
$this->title = 'Авторизация - '.$BSettings->title;

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body>
<?php $this->beginBody() ?>
<?php Pjax::begin(); ?>
<div class="wrap">
    <?php
    NavBar::begin([
        'brandLabel' => $BSettings->title,
        'brandUrl' => Yii::$app->homeUrl,
        'options' => [
            'class' => 'navbar-inverse navbar-fixed-top',
        ],
    ]);
	if(!Yii::$app->user->isGuest){
		echo ButtonDropdown::widget([
			'label' => $BAdmins->name,
			'options' => [
				'class' => 'btn-link',
				'style' => 'margin: 8px'
			],
			'dropdown' => [
				'items' => [
					['label' => 'Изменить данные', 'url' => '/admin/userchange'],
				],
			],
		]);
		echo Nav::widget([
			'options' => ['class' => 'navbar-nav navbar-right'],
			'items' => [
				[
					'label' => 'Выйти',
					'url' => ['/admin/logout'],
					'linkOptions' => ['data-method' => 'post']
				],
			],
		]);
	}
    NavBar::end();
    ?>
    <div class="container">
        <?= Breadcrumbs::widget([
            'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
        ]) ?>
		
        <?= $content ?>
		
    </div>
</div>
<?php Pjax::end(); ?>
<footer class="footer">
    <div class="container">
        <p class="pull-left">&copy; My Company <?= date('Y') ?></p>

        <p class="pull-right"><?= Yii::powered() ?></p>
    </div>
</footer>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
