<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "status".
 *
 * @property integer $id
 * @property string $descripcion_status
 */
class Status extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'status';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['descripcion_status'], 'required'],
            [['descripcion_status'], 'string', 'max' => 100]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'descripcion_status' => 'Descripcion Status',
        ];
    }
	
	public function relations(){
        return array(
            'usuarios'=>array(self::HAS_MANY, 'Usuarios', 'id_status')
        );
    }

}
