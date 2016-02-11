<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\UsuariosSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Usuarios';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="usuarios-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Registrar Usuario', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            'cedula',
            'nombre',
			'email',						
			[
			   'attribute' => 'id_departamento',
			   'value'=>'departamento.descripcion',
			   'options' => ['width' => '70']
			],
            //'id_status',
			[
			   'attribute' => 'id_status',
			   'value'=>'status.descripcion_status',
			   'options' => ['width' => '100']
			],
            [
			   'attribute' => 'fecha_suspension',
				'format' =>  ['date', 'php:d/m/Y'],
			   'options' => ['width' => '70']
			],
			
            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
