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
 * @property integer $tipo_recurso
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
            [['titulo', 'autor', 'tipo_recurso', 'total_existente'], 'required','message'=>'Campo requerido'],
            [['tipo_recurso', 'total_existente'], 'integer'],
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
            'tipo_recurso' => 'Tipo Recurso',
            'total_existente' => 'Total Existente',
        ];
    }
	
	public static function getListTipoRecurso(){
        $opciones = TipoRecursos::find()->asArray()->all();
        return ArrayHelper::map($opciones, 'id', 'tipo_recurso');
    }
	
	
}
