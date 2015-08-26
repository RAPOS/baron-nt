<?php
use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */
$this->title = 'Мастера';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="bmasters-index" style="width: 700px;">
    <p>
        <?= Html::a('Добавить мастера', ['create'], ['class' => 'btn btn-success']) ?>
        <?= Html::a('Описание', ['description'], ['class' => 'btn btn-primary']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            'id_master',
            'name',
            'translate',
            'age',
            'breast',
            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
<script>page = {name: 'masters', files_count: 3};</script>