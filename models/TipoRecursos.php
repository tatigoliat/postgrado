<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "tipo_recursos".
 *
 * @property integer $id
 * @property string $tipo_recurso
 */
class TipoRecursos extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tipo_recursos';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['tipo_recurso'], 'required'],
            [['tipo_recurso'], 'string', 'max' => 100]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'tipo_recurso' => 'Tipo Recurso',
        ];
    }
	
	public function relations(){
        return array(
            'recursos'=>array(self::HAS_MANY, 'Recursos', 'id_tipo_recurso')
        );
    }
}
