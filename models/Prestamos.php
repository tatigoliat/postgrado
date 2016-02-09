<?php

namespace app\models;

use Yii;
use yii\db\Connection;
use yii\db\Command;
use yii\db\Query;
use yii\web\Controller;

use app\models\Recursos;
use app\models\Usuarios;
use yii\helpers\ArrayHelper;


/**
 * This is the model class for table "prestamos".
 *
 * @property integer $id
 * @property integer $codigo
 * @property string $cedula
 * @property string $fecha_prestamo
 * @property string $fecha_devolucion
 * @property integer $estatus
 */
class Prestamos extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'prestamos';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['codigo', 'cedula', 'fecha_prestamo', 'fecha_devolucion'], 'required'],
            [['codigo', 'estatus'], 'integer'],
            [['fecha_prestamo', 'fecha_devolucion'], 'safe'],
            [['cedula'], 'string', 'max' => 20],
			['cedula', 'existe_usuario_activo'],
			['codigo', 'esta_disponible']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'codigo' => 'Codigo',
            'cedula' => 'Cedula',
            'fecha_prestamo' => 'Fecha Prestamo',
            'fecha_devolucion' => 'Fecha Devolucion',
            'estatus' => 'Estatus',
			'fecha_entregado' => 'Fecha Entregado',
			
        ];
    }
	
	public function existe_usuario_activo ($atributo, $params){
		$usuario = Usuarios::findOne($this->cedula);
		if ($usuario == null){
			$this->addError($atributo, 'Usuario no existe');					
			return false;
		}else{
			if($usuario->estatus != 1 ){			
				$this->addError($atributo, 'Usuario Suspendido'); 
				return false;
			}else{
				return true;
			}
		}		
    }
	
	public function esta_disponible($atributo, $params){
		$disponible = 0;		
		$recurso = Recursos::findOne($this->codigo);		
		
		if($recurso == null ){
			$this->addError($atributo, 'Recurso no existe'); 
			return false;
		}
		
		$prestamos = Prestamos::findBySql("SELECT id FROM prestamos WHERE codigo = " . $this->codigo . " and estatus = 3 ")->all();
		if($prestamos == null){
			$numPrestamos = 0;
		}else{
			$numPrestamos = count($prestamos);
		}		
		
		$disponible = $recurso->total_existente - $numPrestamos;
		
		if($disponible>0){
			return true;
		}else{
			$this->addError($atributo, 'Recurso no disponible'); 
			return false;
		}
        					
    }
}
