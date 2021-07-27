<?php

namespace frontend\models;

use common\models\Property;
use common\models\MySearch;
use yii\base\Model;
use common\models\User;

/**
 * Search form
 */
class SearchForm extends Model{
	public $input;
	public $type;
	public $listfor;
	public $priceMin;
	public $priceMax;
	public $areaMax;
	public $areaMin;
	public $bedroom;
	public $bathroom;
	public $ownership;
	public $category;
	public $features;
	
	
	/**
	 * @inheritdoc
	 */
	public function rules(){
		return [
			
			['input', 'required'],
			['input', 'string', 'min' => 3],
			
			['type', 'required'],
			['type', 'string', 'min' => 2],
			
			['listfor', 'required'],
			['listfor', 'string', 'min' => 2],
			
			['areaMax', 'required'],
			['areaMax', 'string', 'min' => 2],
			
			['areaMin', 'required'],
			['areaMin', 'string', 'min' => 2],
			
			['ownership', 'required'],
			['ownership', 'string', 'min' => 2],
			
			['bedroom', 'required'],
			['bedroom', 'string', 'min' => 2],
			
			
			['bathroom', 'required'],
			['bathroom', 'string', 'min' => 2],
			
			
			['priceMin', 'required'],
			['priceMin', 'number', 'min' => 1],
			
			['priceMax', 'required'],
			['priceMax', 'number', 'min' => 1],
			
			['category', 'required'],
			['category', 'string', 'min' => 1],
			
			['features', 'required'],
			['features', 'string', 'min' => 1],
		
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
		
		
		//
		//        ->andWhere(['property_of'=>$this->ownership])
		//            ->andWhere(['list_for'=>$this->listfor])
		//            ->andWhere(['between','price',$this->priceMin,$this->priceMax])
		//            ->andWhere(['bedrooms'=>$this->bedroom])
		//            ->andWhere(['bathrooms'=>$this->bathroom])
		//            ->andWhere(['title'=>$this->input]);
		
		
		$count = $query->count();
		//return true;
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
	
	public function searchHome2(){
		
		
		die($this->listfor);
		$query = Property::find()->where(['type' => $this->type])->andWhere(['property_of' => $this->ownership])->andWhere(['list_for' => $this->listfor])->andWhere(['between', 'price', $this->priceMin, $this->priceMax])->andWhere(['bedrooms' => $this->bedroom])->andWhere(['bathrooms' => $this->bathroom])->andWhere(['title' => $this->input]);
		
		
		$count = $query->count();
		//return true;
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
	
	public function searchAdvance(){
		die;
		$min      = $this->priceMin;
		$max      = $this->priceMax;
		$category = $this->category;
		$features = $this->features;
		
		$query = Property::find()->where(['type' => $this->type])->andWhere(['property_of' => $this->ownership])->andWhere(['list_for' => $this->listfor])->andWhere(['between', 'price', $this->priceMin, $this->priceMax])->andWhere(['bedroom' => $this->bedroom])->andWhere(['bathroom' => $this->bathroom])->all();
		
		
		$result = $query;
		var_dump($result);
		
		return $model = $result;
	}
}
