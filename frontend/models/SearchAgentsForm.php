<?php

namespace frontend\models;

use common\models\Property;
use common\models\MySearch;
use yii\base\Model;
use common\models\User;

/**
 * SearchAgents form
 */
class SearchAgentsForm extends Model{
	public $input;
	public $role;
	public $location;
	public $agent_type;
	
	public $languages;
	public $price_min;
	public $price_max;
	
	
	/**
	 * @inheritdoc
	 */
	public function rules(){
		return [
			
			['input', 'required'],
			['input', 'string', 'min' => 3],
			
			['role', 'required'],
			['role', 'string', 'min' => 2],
			
			['location', 'required'],
			['location', 'string', 'min' => 2],
			
			['agent_type', 'required'],
			['agent_type', 'string', 'min' => 2],
			
			['languages', 'safe'],
			
			['price_min', 'safe'],
			['price_min', 'number', 'min' => 2],
			
			['price_max', 'safe'],
			['price_max', 'number', 'min' => 2],
		
		
		];
	}
	
	public function searchHome(){
		$query = Property::find()->where(['like', 'title', $this->input]);

		if($this->type)
			$query->andWhere(['type' => $this->type]);

		if($this->ownership)
			$query->andWhere(['property_of' => $this->ownership]);

		if($this->listfor)
			$query->andWhere(['list_for' => $this->listfor]);

		if($this->priceMin)
			$query->andWhere(['between', 'price', $this->priceMin, $this->priceMax]);

		if($this->bedroom)
			$query->andWhere(['bedrooms' => $this->bedroom]);

		if($this->bathroom)
			$query->andWhere(['bathrooms' => $this->bathroom]);
		
		
		//        ->andWhere(['property_of'=>$this->ownership])
		//            ->andWhere(['list_for'=>$this->listfor])
		//            ->andWhere(['between','price',$this->priceMin,$this->priceMax])
		//            ->andWhere(['bedrooms'=>$this->bedroom])
		//            ->andWhere(['bathrooms'=>$this->bathroom])
		//            ->andWhere(['title'=>$this->input]);
		
		
		$count = $query->count();

		if(!\Yii::$app->user->isGuest){
			MySearch::add($this);
		}
		
		if($count == 0){
			
			//loop first for city based result
			$query = Property::find()->where(['type' => $this->type])->andWhere(['property_of' => $this->ownership])->andWhere(['list_for' => $this->listfor])->andWhere(['between', 'price', $this->priceMin, $this->priceMax])->andWhere(['bedrooms' => $this->bedroom])->andWhere(['bathrooms' => $this->bathroom])->andWhere(['city' => $this->input]);
			$count = $query->count();
			if($count == 0){
				//loop second for state based result
				$query = Property::find()->where(['type' => $this->type])->andWhere(['property_of' => $this->ownership])->andWhere(['list_for' => $this->listfor])->andWhere(['between', 'price', $this->priceMin, $this->priceMax])->andWhere(['bedrooms' => $this->bedroom])->andWhere(['bathrooms' => $this->bathroom])->andWhere(['state' => $this->input]);
				$count = $query->count();
				if($count == 0){
					//loop second for zipcode based result
					$query = Property::find()->where(['type' => $this->type])->andWhere(['property_of' => $this->ownership])->andWhere(['list_for' => $this->listfor])->andWhere(['between', 'price', $this->priceMin, $this->priceMax])->andWhere(['bedrooms' => $this->bedroom])->andWhere(['bathrooms' => $this->bathroom])->andWhere(['zipcode' => $this->input]);
					$count = $query->count();
					if($count == 0){
						//loop second for address based result
						$query = Property::find()->where(['type' => $this->type])->andWhere(['property_of' => $this->ownership])->andWhere(['list_for' => $this->listfor])->andWhere(['between', 'price', $this->priceMin, $this->priceMax])->andWhere(['bedrooms' => $this->bedroom])->andWhere(['bathrooms' => $this->bathroom])->andWhere(['address' => $this->input]);
						$count = $query->count();
						if($count == 0){
							//loop second for id based result
							$query = Property::find()->where(['type' => $this->type])->andWhere(['property_of' => $this->ownership])->andWhere(['list_for' => $this->listfor])->andWhere(['between', 'price', $this->priceMin, $this->priceMax])->andWhere(['bedrooms' => $this->bedroom])->andWhere(['bathrooms' => $this->bathroom])->andWhere(['id' => $this->input]);
							$count = $query->count();
							if($count == 0){
								//loop second for null based result
								$result = null;
								
							}else{
								$result = $query->all();
							}
							
						}else{
							$result = $query->all();
						}
						
					}else{
						$result = $query->all();
					}
					
				}else{
					$result = $query->all();
				}
			}else{
				$result = $query->all();
			}
		}else{
			$result = $query->all();
		}
		//
		//            ->orWhere(['city'=>$this->input])
		//            ->orWhere(['state'=>$this->input])
		//            ->orWhere(['zipcode'=>$this->input])
		//            ->orWhere(['address'=>$this->input])
		//            ->orWhere(['id'=>$this->input])
		//            ->orWhere(['city'=>$this->input])
		//            ->all();
		
		
		return $result ? $result : null;
	}
	
}
