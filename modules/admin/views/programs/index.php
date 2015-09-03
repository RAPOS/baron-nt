<?php
use yii\helpers\Html;
use yii\grid\GridView;

$this->title = 'Программы';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="btypes-of-massage-index" style="width: 700px;">
    <p>
        <?= Html::a('Добавить программу', ['create'], ['class' => 'btn btn-success']) ?>
        <?= Html::a('Описание страницы', ['description'], ['class' => 'btn btn-primary']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
		'tBodyAttr' => 'id="sortable"',
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            'id_massage',
			[
				'attribute' => 'name',
				'contentOptions' => ['style' => 'width: 440px;'],
			],
			[
				'attribute' => 'exclusive',
				'format' => 'html',
				'contentOptions' => ['style' => 'text-align: center;'],
				'value' => function ($model, $key, $index, $column){
					if($model['exclusive']){
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
<script>page = {name: 'programs', files_count: 1};</script>