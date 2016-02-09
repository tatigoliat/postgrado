<?php

namespace app\controllers;


use Yii;

use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

use app\models\Prestamos;
use app\models\PrestamosSearch;
use app\models\Usuarios;

/**
 * PrestamosController implements the CRUD actions for Prestamos model.
 */
class PrestamosController extends Controller
{
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['post'],
                ],
            ],
        ];
    }

    /**
     * Lists all Prestamos models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new PrestamosSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Prestamos model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Prestamos model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate() {
        $model = new Prestamos();
		$model->fecha_prestamo = date("d-m-Y");		
		
		$nuevafecha = strtotime ( '+3 day' , strtotime ( $model->fecha_prestamo) ) ;
		$model->fecha_devolucion  = date ( 'd-m-Y' , $nuevafecha );
		
		$model->estatus = 3;
  
        if ($model->load(Yii::$app->request->post())){			
			if($model->validate()) {
				$nuevafecha = strtotime ( $model->fecha_prestamo)  ;
				$model->fecha_prestamo  = date ( 'Y-m-d' , $nuevafecha );
				
				$nuevafecha = strtotime ( $model->fecha_devolucion)  ;
				$model->fecha_devolucion  = date ( 'Y-m-d' , $nuevafecha );
				
				$model->save();
				return $this->redirect(['view', 'id' => $model->id]);
			} else {
				return $this->render('create', [
					'model' => $model,
				]);
			}
		}
		
		return $this->render('create', ['model' => $model,]);		
    }

    /**
     * Updates an existing Prestamos model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
		
		if ($model->load(Yii::$app->request->post())){			
			if($model->validate()) {
				
				$model->save();
				return $this->redirect(['view', 'id' => $model->id]);
			} else {
				return $this->render('update', [
					'model' => $model,
				]);
			}
		}

    }

    /**
     * Deletes an existing Prestamos model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }
	
	public function actionDevolucion($id)
    {
        $model = $this->findModel($id);
		$model->estatus = 4;
		$model->fecha_entregado = date('Y-m-d');
        if ($model->load(Yii::$app->request->post()) && $model->update()) {
			$interval = $model->fecha_devolucion->diff($model->fecha_entregado);

				$usuario =Usuarios::findByPk($model->cedula);
				$usuario->estatus= 2;
				$usuario->update();				
				
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('view', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Finds the Prestamos model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Prestamos the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Prestamos::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
