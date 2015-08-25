<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\modules\admin\models\BMasters */

$this->params['breadcrumbs'][] = ['label' => 'Мастера', 'url' => ['/admin/masters']];
$this->params['breadcrumbs'][] = $model->name;
?>
<div class="bmasters-view" style="width: 700px;">
    <p>
        <?= Html::a('Редактировать', ['update', 'id' => $model->id_master], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Удалить', ['delete', 'id' => $model->id_master], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Вы уверены, что хотите удлаить?',
                'method' => 'post',
            ],
        ]) ?>
    </p>
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id_master',
            'name',
            'translate',
            'description:ntext',
            'keywords',
            'images:ntext',
            'sort',
            'age',
            'growth',
            'weight',
            'breast',
            'new',
            'tour',
        ],
    ]) ?>
</div>
