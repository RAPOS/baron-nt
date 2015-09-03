<?php
use yii\helpers\Html;
use yii\grid\GridView;

$this->title = 'Обратная связь';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="bfeedback-index" style="width: 700px;">
	<p>
		<?= Html::a('Описание страницы', ['description'], ['class' => 'btn btn-primary']) ?>
	</p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            [
				'class' => 'yii\grid\SerialColumn'
			],
            'id',
            'email:email',
            'name',
            'subject',
			[
				'attribute' => 'date',
				'format' => ['date', 'php:d.m.Y']
			],
            [
				'class' => 'yii\grid\ActionColumn',
				'buttons' => ['update' => function ($url, $model, $key) {return false;}]
			],
        ],
    ]); ?>
</div>
