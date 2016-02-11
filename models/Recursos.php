<?php

namespace app\models;

use Yii;
use app\models\TipoRecursos;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "recursos".
 *
 * @property integer $codigo
 * @property string $titulo
 * @property string $autor
 * @property integer $id_tipo_recurso
 * @property integer $total_existente
 */
class Recursos extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'recursos';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['titulo', 'autor', 'id_tipo_recurso', 'total_existente'], 'required','message'=>'Campo requerido'],
            [['id_tipo_recurso', 'total_existente'], 'integer'],
            [['titulo', 'autor'], 'string', 'max' => 500],
			['total_existente', 'match', 'pattern'=> '/^[0-9]+$/i', 'message'=>'Solo numeros'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'codigo' => 'Codigo',
            'titulo' => 'Titulo',
            'autor' => 'Autor',
            'id_tipo_recurso' => 'Tipo Recurso',
            'total_existente' => 'Total Existente',
        ];
    }
	
	public static function getListTipoRecurso(){
        $opciones = TipoRecursos::find()->asArray()->all();
        return ArrayHelper::map($opciones, 'id', 'tipo_recurso');
    }
	
	public function relations(){
         return array(
                    'tipoRecurso' => array(self::BELONGS_TO, 'TipoRecursos', 'id_tipo_recurso'),
					'prestamos' => array(self::HAS_MANY, 'Prestamos', 'codigo'),
					);
	}
	
	public function getTipoRecurso(){
		return $this->hasOne(TipoRecursos::className(),['id' =>'id_tipo_recurso']);
	}
	
	
	/*public static function getTotalDisponible(){		
		$prestamos = Prestamos::findBySql("SELECT id FROM prestamos WHERE codigo = " . $this->codigo . " and id_status = 3 ")->all();
		if($prestamos == null){
			$numPrestamos = 0;
		}else{
			$numPrestamos = count($prestamos);
		}
		$disponible = $this->total_existente - $numPrestamos;		 
		return $disponible;
    }*/
	
	public function updateDisponible(){
		Yii::$app->db
				->createCommand('UPDATE recursos a SET total_disponible = total_existente - ( SELECT count(*) FROM prestamos b WHERE b.codigo = a.codigo AND b.id_status = 3  ) ')
				->execute();		
	}
	
}
