<?php
use yii\helpers\Html;
use yii\bootstrap\Alert;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\modules\admin\models\BAdmins */
/* @var $form ActiveForm */
$this->params['breadcrumbs'][] = 'Изменить пароль';
?>
<div class="userchange" style="width: 700px;">
	<?if($success){
		echo Alert::widget([
			'options' => [
				'class' => 'alert-success'
			],
			'body' => '<b>Данные успешно изменены!</b>'
		]);
	}?>
    <?php $form = ActiveForm::begin(); ?>

        <?= $form->field($model, 'name')->input('text', ['value' => ''])->label('Введите новый логин:')?>
        <?= $form->field($model, 'password')->passwordInput(['value' => ''])->label('Введите новый пароль:')?>
    
        <div class="form-group">
            <?= Html::submitButton('Сохранить', ['class' => 'btn btn-success']) ?>
           <?= Html::a('Отменить', ['/admin'], ['class'=>'btn btn-primary']) ?>
        </div>
    <?php ActiveForm::end(); ?>

</div>