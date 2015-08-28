<?php
use yii\helpers\Html;
use yii\grid\GridView;
/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */
$this->title = 'Breviews';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="breviews-index" style="width: 700px;">
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            'id',
            'date',
            'email:email',
            'name',
            'moderate',
            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
