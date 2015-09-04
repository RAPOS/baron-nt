<?php
use yii\helpers\Html;
use yii\grid\GridView;

$this->title = 'Отзывы';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="breviews-index" style="width: 700px;">
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            'id',
			[
				'attribute' => 'date',
				'format' => ['date', 'php:d.m.Y']
			],
			[
				'attribute' => 'email',
				'format' => 'email',
				'contentOptions' => ['style' => 'width: 190px;'],
			],
			[
				'attribute' => 'name',
				'contentOptions' => ['style' => 'width: 190px;'],
			],
			[
				'attribute' => 'moderate',
				'format' => 'html',
				'contentOptions' => ['style' => 'text-align: center;'],
				'value' => function ($model, $key, $index, $column){
					if($model['moderate']){
						return '<img src="/images/panel/checkmark.png" width="32"/>';
					} else {
						return '<img src="/images/panel/cancel.png" width="32"/>';
					}
				}
			],
            [
				'class' => 'yii\grid\ActionColumn',
				'buttons' => ['update' => function ($url, $model, $key) {return false;}]
			],
        ],
    ]); ?>
</div>
