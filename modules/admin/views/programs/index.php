<?php
use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */
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
            'name',
            'exclusive',
            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
<script>page = {name: 'programs', files_count: 1};</script>