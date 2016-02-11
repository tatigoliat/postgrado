<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Usuarios;


/**
 * UsuariosSearch represents the model behind the search form about `app\models\Usuarios`.
 */
class UsuariosSearch extends Usuarios
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['cedula', 'nombre', 'email', 'fecha_suspension','id_status', 'id_departamento'], 'safe'],
            //[['id_status', 'id_departamento'], 'integer'],
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
        $query = Usuarios::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

		$query->joinWith('departamento');
		$query->joinWith('status');
		
        $query->andFilterWhere([
            //'id_status' => $this->id_status,
            //'id_departamento' => $this->id_departamento,
            'fecha_suspension' => $this->fecha_suspension,
        ]);

        $query->andFilterWhere(['like', 'cedula', $this->cedula])
            ->andFilterWhere(['like', 'nombre', $this->nombre])
			->andFilterWhere(['like', 'departamentos.descripcion', $this->id_departamento])
			->andFilterWhere(['like', 'status.descripcion_status', $this->id_status])
            ->andFilterWhere(['like', 'email', $this->email]);

        return $dataProvider;
    }
	


}
