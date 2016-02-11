<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\PrestamosSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Bienvenido al Control de Prestamos';

?>
<div class="index-report">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>
	
	<div class="tabla" align="center">
		<h3>Prestamos fuera de tiempo</h3>

		<?= GridView::widget([
			'dataProvider' => $dataProvider,
			'columns' => [
				/*'id',
				'cedula',
				'codigo',
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
				   'attribute' => 'id_status',
				   'options' => ['width' => '70']
				],*/
				[
				   'attribute' => 'id',
				   'options' => ['width' => '30']
				],

				[
				   'attribute' => 'codigo',
				   'value'=>'recurso.titulo',
				],
				
				[
				   'label' => 'Usuario',
				   'attribute' => 'cedula',
				   'value'=>'usuario.nombre',
				],
				[
				   'attribute' => 'fecha_prestamo',
					'format' =>  ['date', 'php:d/m/Y'],
				   'options' => ['width' => '50']
				],
				[
				   'attribute' => 'fecha_devolucion',
					'format' =>  ['date', 'php:d/m/Y'],
				   'options' => ['width' => '50']
				],
				[
				   'attribute' => 'fecha_entregado',
					'format' =>  ['date', 'php:d/m/Y'],
				   'options' => ['width' => '50']
				],

				[
				   'attribute' => 'id_status',
				   'value'=>'status.descripcion_status',
				   'options' => ['width' => '120']
				],
			],
		]); ?>
	</div>

</div>