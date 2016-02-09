<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Prestamos;
use app\models\Usuarios;
use app\models\Recursos;
use app\models\Status;
/**
 * PrestamosSearch represents the model behind the search form about `app\models\Prestamos`.
 */
class PrestamosSearch extends Prestamos
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'codigo', 'estatus'], 'integer'],
            [['cedula', 'fecha_prestamo', 'fecha_devolucion', 'fecha_entregado'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        $query = Prestamos::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        $query->andFilterWhere([
            'id' => $this->id,
            'codigo' => $this->codigo,
            //'fecha_prestamo' => $this->fecha_prestamo,
            //'fecha_devolucion' => $this->fecha_devolucion,
            'estatus' => $this->estatus,
			//'fecha_entregado' => $this->fecha_entregado,
        ]);

        $query->andFilterWhere(['like', 'cedula', $this->cedula]);

        return $dataProvider;
    }
	
	public function report($params){  
		/*$dataProvider = new SqlDataProvider([
			'sql' => 'SELECT a.id, a.codigo, c.nombre, c.tipo_recurso, ' . 
					 'a.cedula, b.nombre, b.email,  ' . 
					 'a.estatus  ' . 
					 'FROM prestamos a, usuarios b, recursos c ' .
					 'WHERE a.estatus = :estatus ' .
					 'and fecha_devolucion < DATE_FORMAT(NOW(),"Y-m-d") ',					
			'params' => [' :estatus' => '3'],
		]);		
        return $dataProvider;*/
		
		$query = Prestamos::find(); //::findBySql("SELECT id FROM prestamos WHERE codigo = " . $this->codigo . " and estatus = 3 ")->all();
		
        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        $query->andFilterWhere([
            'id' => $this->id,
            'codigo' => $this->codigo,
            //'fecha_prestamo' => $this->fecha_prestamo,
            //'fecha_devolucion' => $this->fecha_devolucion,
            'estatus' => 3,
			//'fecha_entregado' => $this->fecha_entregado,
        ]);

        $query->andFilterWhere(['like', 'cedula', $this->cedula]);

        return $dataProvider;
    }
	
}
