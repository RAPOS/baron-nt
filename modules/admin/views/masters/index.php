<?php
use yii\helpers\Html;
use yii\grid\GridView;

$this->title = 'Мастера';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="bmasters-index" style="width: 700px;">
    <p>
        <?= Html::a('Добавить мастера', ['create'], ['class' => 'btn btn-success']) ?>
        <?= Html::a('Описание страницы', ['description'], ['class' => 'btn btn-primary']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
		'tBodyAttr' => 'id="sortable"',
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            'id_master',
			[
				'attribute' => 'name',
				'contentOptions' => ['style' => 'width: 380px;'],
			],
			[
				'attribute' => 'new',
				'format' => 'html',
				'contentOptions' => ['style' => 'text-align: center;'],
				'value' => function ($model, $key, $index, $column){
					if($model['new']){
						return '<img src="/images/panel/checkmark.png" width="32"/>';
					} else {
						return '<img src="/images/panel/cancel.png" width="32"/>';
					}
				},
			],
			[
				'attribute' => 'tour',
				'format' => 'html',
				'contentOptions' => ['style' => 'text-align: center;'],
				'value' => function ($model, $key, $index, $column){
					if($model['tour']){
						return '<img src="/images/panel/checkmark.png" width="32"/>';
					} else {
						return '<img src="/images/panel/cancel.png" width="32"/>';
					}
				},
			],
            [
				'class' => 'yii\grid\ActionColumn',
				'buttons' => ['view' => function ($url, $model, $key) {return false;}]
			],
        ],
    ]); ?>
</div>
<script>page = {name: 'masters', files_count: 3};</script>