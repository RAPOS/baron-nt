<?php
use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->params['breadcrumbs'][] = 'Мастера';
?>
<div class="bmasters-index" style="width: 700px;">
    <p>
        <?= Html::a('Добавить мастера', ['create'], ['class' => 'btn btn-success']) ?>
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
