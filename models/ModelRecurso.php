<?php

namespace app\models;

use Yii;
use yii\base\Model;


class ModelRecurso extends Model{
    public $codigo;
	public $titulo;
    public $autor;
    public $tipo_recurso;
    public $total_existente;

    /**
     * @return array the validation rules.
     */
    public function rules(){
        return [           
            [['titulo', 'autor', 'tipo_recurso','total_existente'], 'required', 'message'=>'Campo requerido'],
			['total_existente', 'match', 'pattern'=> '/^[0-9]+$/i', 'message'=>'Solo numeros'],
        ];
    }

    /**
     * @return array customized attribute labels
     */
    public function attributeLabels(){
        return [
            'titulo' => 'Titulo: ',
			'autor' => 'Autor: ',
			'tipo_recurso' => 'Tipo recurso: ',
			'total_existente' => 'Total cantidad existente: ',
        ];
    }
 
}
