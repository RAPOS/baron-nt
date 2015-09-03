<?php
use yii\helpers\Html;
use yii\grid\GridView;

$this->title = 'Акции';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="bactions-index" style="width: 700px;">
    <p>
        <?= Html::a('Добавить акцию', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            'id',
            'text',
			[
				'attribute' => 'date',
				'format' => ['date', 'php:d.m.Y']
			],
            'status',
            [
				'class' => 'yii\grid\ActionColumn',
				'buttons' => ['view' => function ($url, $model, $key) {return false;}]
			],
        ],
    ]); ?>
</div>
