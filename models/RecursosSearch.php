<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Recursos;

/**
 * RecursosSearch represents the model behind the search form about `app\models\Recursos`.
 */
class RecursosSearch extends Recursos
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['codigo',  'total_existente'], 'integer'],
            [['titulo', 'id_tipo_recurso', 'autor'], 'safe'],
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
        $query = Recursos::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

		$query->joinWith('tipoRecurso');
		
        $query->andFilterWhere([
            'codigo' => $this->codigo,
           // 'id_tipo_recurso' => $this->id_tipo_recurso,
            'total_existente' => $this->total_existente,
        ]);

        $query->andFilterWhere(['like', 'titulo', $this->titulo])
			->andFilterWhere(['like', 'tipo_recursos.tipo_recurso', $this->id_tipo_recurso])
            ->andFilterWhere(['like', 'autor', $this->autor]);

        return $dataProvider;
    }
}
