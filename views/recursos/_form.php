<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Recursos */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="recursos-form">

    <?php $form = ActiveForm::begin(['method' => 'post',
											'id' => 'crear-recurso-form',
											'enableClientValidation' => true, ]); ?>

    <?= $form->field($model, 'titulo')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'autor')->textInput(['maxlength' => true]) ?>

	<?= $form->field($model, 'tipo_recurso')->dropDownList($model->ListTipoRecurso, ['prompt' => 'Seleccione Uno' ]);?>

    <?= $form->field($model, 'total_existente')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Añadir' : 'Actualizar', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
