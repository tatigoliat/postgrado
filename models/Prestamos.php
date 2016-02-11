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
 * @property integer $id_status
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
            [['codigo'], 'integer'],
            [['fecha_prestamo', 'fecha_devolucion', 'id_status'], 'safe'],
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
            'codigo' => 'Recurso ',
            'cedula' => 'Usuario ',
            'fecha_prestamo' => 'F. Prestamo',
            'fecha_devolucion' => 'F. Devolucion',
            'id_status' => ' Status',
			'fecha_entregado' => 'F. Entregado',			
        ];
    }
	
		public function relations(){
         return array(
                    'status' => array(self::BELONGS_TO, 'Status', 'id_status'),
					'usuarios' => array(self::BELONGS_TO, 'Usuarios', 'cedula'),
					'recursos' => array(self::BELONGS_TO, 'Prestamos', 'codigo'),
					);
	}
	
	public function existe_usuario_activo ($atributo, $params){
		$retorno = false;
		$usuario = Usuarios::findOne($this->cedula);
		if ($usuario == null){
			$this->addError($atributo, 'Usuario no existe');					
			$retorno = false;
		}else{
			$fechaprestamo = date("Y-m-d");			
			//$usuario->fecha_suspension = date ( 'Y-m-d' , $usuario->fecha_suspension );
		
			if($usuario->id_status == 2 ){				
				if($fechaprestamo >= $usuario->fecha_suspension){
					$retorno = true;
				}else{
					$this->addError($atributo, 'Usuario Suspendido'); 
					return false;
				}				
			}else{
				$retorno = true;
			}
		}
		return $retorno;		
    }
	
	public function esta_disponible($atributo, $params){
		$disponible = 0;		
		$recurso = Recursos::findOne($this->codigo);		
		
		if($recurso == null ){
			$this->addError($atributo, 'Recurso no existe'); 
			return false;
		}
		
		$prestamos = Prestamos::findBySql("SELECT id FROM prestamos WHERE codigo = " . $this->codigo . " and id_status = 3 ")->all();
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
	

	public function getStatus(){
		return $this->hasOne(Status::className(),['id' =>'id_status']);
	}
	
	public function getUsuario(){
		return $this->hasOne(Usuarios::className(),['cedula' =>'cedula']);
	}
	
	public function getRecurso(){
		return $this->hasOne(Recursos::className(),['codigo' =>'codigo']);
	}
}
