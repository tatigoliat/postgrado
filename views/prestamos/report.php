<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\PrestamosSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Prestamos';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="prestamos-report">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Registrar Prestamo', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchReportModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

			'id',
			'codigo',
			'cedula',
			/*[
			   'attribute' => 'codigo',
			   'options' => ['width' => '70']
			],
			[
			   'attribute' => 'cedula',
			   'options' => ['width' => '70']
			],*/
			[
			   'attribute' => 'fecha_prestamo',
				'format' =>  ['date', 'php:d/m/Y'],
			   'options' => ['width' => '70']
			],
			[
			   'attribute' => 'fecha_devolucion',
				'format' =>  ['date', 'php:d/m/Y'],
			   'options' => ['width' => '70']
			],
			[
			   'attribute' => 'fecha_entregado',
				'format' =>  ['date', 'php:d/m/Y'],
			   'options' => ['width' => '70']
			],
			[
			   'attribute' => 'estatus',
			   'options' => ['width' => '70']
			],
			
        ],
		
    ]); ?>

</div>
