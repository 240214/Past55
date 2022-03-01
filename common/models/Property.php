<?php

namespace common\models;

use Yii;
use yii\data\ActiveDataProvider;
use yii\helpers\ArrayHelper;
use yii\helpers\VarDumper;
use common\models\search\SearchProperty;
use yii\db\ActiveRecord;
use kartik\file\FileInput;
use yii\web\UploadedFile;
use yii\helpers\FileHelper;
use yii\image\drivers\Image;
use yii\helpers\Json;

/**
 * This is the model class for table "{{%properties}}".
 * @property integer $id
 * @property integer $user_id
 * @property integer $property_of
 * @property integer $list_for
 * @property string $title
 * @property string $slug
 * @property string $description
 * @property integer $display_contact_widget
 * @property string $contact_widget_title
 * @property string $contacts
 * @property string $contact_phone
 * @property string $contact_email
 * @property string $contact_website
 * @property string $contact_address
 * @property integer $display_office_hours_widget
 * @property string $office_hours
 * @property string $pet_policy
 * @property string $type
 * @property integer $category_id
 * @property string $sub_category
 * @property string $features
 * @property string $price
 * @property string $price_negotiable
 * @property string $availability
 * @property string $possession_by
 * @property string $ownership
 * @property string $bedrooms
 * @property string $bathrooms
 * @property string $parking
 * @property string $garden
 * @property string $size
 * @property string $image
 * @property string $screenshot
 * @property string $floorplan
 * @property string $location
 * @property string $prop_number
 * @property string $address
 * @property string $city
 * @property string $state
 * @property string $country
 * @property integer $zipcode
 * @property string $address_lat
 * @property string $address_lng
 * @property integer $radius
 * @property string $active
 * @property string $sold
 * @property integer $likes
 * @property integer $views
 * @property string $created_at
 */
class Property extends ActiveRecord{
	
	public $canonical_url;
	public $liked;
	public $customer_addresses;
	public $preview;
	public $gallery;
	public $prop_types = [
		'residential' => 'Residential',
		'commercial' => 'Commercial'
	];
	public $property_of_types = [
		'owner' => 'Owner',
		'dealer' => 'Dealer',
		'builder' => 'Builder',
	];
	public $list_for_types = [
		'sell' => 'Sell',
		'rent' => 'Rent',
		'lease' => 'Lease',
		'pg' => 'PG'
	];
	public $availability_types = [
		'ready to use' => 'Ready to use',
		'under construction' => 'Under Construction',
	];
	public $possession_by_types = [
		'in one month' => 'In one month',
		'in three month' => 'in three month',
		'in six month' => 'in six month',
		'in one year' => 'in one year',
		'in two year' => 'in two year',
		'in three year' => 'in three year',
		'more than five year' => 'more than five year'
	];
	public $ownership_types = [
		'freehold' => 'Freehold',
		'leasehold' => 'Leasehold',
		'co-operative society' => 'Co-operative Ssociety',
		'power of attorney' => 'Power of Attorney'
	];
	public $office_hours_types = [
		'Monday'    => ['from' => '8:00', 'to' => '18:00'],
		'Tuesday'   => ['from' => '8:00', 'to' => '18:00'],
		'Wednesday' => ['from' => '8:00', 'to' => '18:00'],
		'Thursday'  => ['from' => '8:00', 'to' => '18:00'],
		'Friday'    => ['from' => '8:00', 'to' => '18:00'],
		'Saturday'  => ['from' => '9:00', 'to' => '16:00'],
		'Sunday'    => ['from' => '9:00', 'to' => '16:00'],
	];
	public $categories = [];
	public $category_links = [];
	public $prop_features = [];
	public $nearby_places;
	public $nearby_places_types;
	public $features_sections;
	
	/**
	 * @inheritdoc
	 */
	public static function tableName(){
		return '{{%properties}}';
	}
	
	/**
	 * @inheritdoc
	 */
	public function rules(){
		
		return [
			[['user_id', 'title'], 'required'],
			[['user_id', 'zipcode', 'category_id', 'sub_category', 'radius', 'active', 'likes', 'views', 'display_contact_widget', 'display_office_hours_widget'], 'integer'],
			[['price_negotiable', 'sold', 'availability', 'possession_by', 'category_id', 'sub_category', 'features', 'categories', 'nearby_places'], 'safe'],
			
			[['bedrooms', 'bathrooms', 'size'], 'number'],
			[['slug', 'type', 'description', 'ownership', 'parking', 'garden', 'location', 'address', 'prop_number', 'contacts', 'pet_policy', 'office_hours', 'address_lat', 'address_lng', 'contact_widget_title', 'contact_phone', 'contact_email', 'contact_website', 'contact_address'], 'string'],
			[['title', 'city', 'state', 'country'], 'string', 'max' => 225],
			[['price'], 'string', 'max' => 20],
			[['preview', 'gallery'], 'image', 'skipOnEmpty' => true, 'extensions' => Yii::$app->params['image_exts'], 'maxFiles' => 500],
			#[['gallery'], 'image', 'skipOnEmpty' => true, 'extensions' => Yii::$app->params['image_exts'], 'maxFiles' => 500],
			[['floorplan'], 'file', 'skipOnEmpty' => true, 'extensions' => Yii::$app->params['image_exts'], 'maxFiles' => 500],
		];
	}
	
	/**
	 * @inheritdoc
	 */
	public function attributeLabels(){
		return [
			'id'                          => Yii::t('app', 'ID'),
			'user_id'                     => Yii::t('app', 'User ID'),
			'property_of'                 => Yii::t('app', 'Property Of'),
			'title'                       => Yii::t('app', 'Title'),
			'description'                 => Yii::t('app', 'Property item description'),
			'list_for'                    => Yii::t('app', 'List property for'),
			'type'                        => Yii::t('app', 'Type'),
			'category_id'                 => Yii::t('app', 'Category'),
			'sub_category'                => Yii::t('app', 'Sub Category'),
			'features'                    => Yii::t('app', 'Property Features'),
			'price'                       => Yii::t('app', 'Price'),
			'price_negotiable'            => Yii::t('app', 'Price Negotiable'),
			'availability'                => Yii::t('app', 'Availability'),
			'possession_by'               => Yii::t('app', 'Possession by'),
			'bedrooms'                    => Yii::t('app', 'Bedrooms'),
			'bathrooms'                   => Yii::t('app', 'Bathrooms'),
			'parking'                     => Yii::t('app', 'Parking'),
			'garden'                      => Yii::t('app', 'Garden'),
			'size'                        => Yii::t('app', 'Size (sq)'),
			'image'                       => Yii::t('app', 'Image'),
			'floorplan'                   => Yii::t('app', 'upload photo of floor plan'),
			'screenshot'                  => Yii::t('app', 'add some more photo of property'),
			'location'                    => Yii::t('app', 'Location'),
			'prop_number'                 => Yii::t('app', 'Number'),
			'address'                     => Yii::t('app', 'Address'),
			'city'                        => Yii::t('app', 'City'),
			'state'                       => Yii::t('app', 'State'),
			'country'                     => Yii::t('app', 'Country'),
			'zipcode'                     => Yii::t('app', 'Zipcode'),
			'address_lat'                 => Yii::t('app', 'Latitude'),
			'address_lng'                 => Yii::t('app', 'Longitude'),
			'active'                      => Yii::t('app', 'Active'),
			'categoryName'                => Yii::t('app', 'Category'),
			'mainImageThumb'              => Yii::t('app', 'Image'),
			'contacts'                    => Yii::t('app', 'Contacts additional info'),
			'pet_policy'                  => Yii::t('app', 'Pet policy description'),
			'radius'                      => Yii::t('app', 'Nearby places Radius'),
			'office_hours'                => Yii::t('app', 'Office hours'),
			'slug'                        => Yii::t('app', 'Slug'),
			'display_contact_widget'      => Yii::t('app', 'Display contact widget'),
			'contact_widget_title'        => Yii::t('app', 'Contact widget title'),
			'contact_phone'               => Yii::t('app', 'Contact phone'),
			'contact_email'               => Yii::t('app', 'Contact email'),
			'contact_website'             => Yii::t('app', 'Contact website'),
			'contact_address'             => Yii::t('app', 'Contact address'),
			'display_office_hours_widget' => Yii::t('app', 'Display office hours widget'),
		];
	}
	
	/*public function afterFind(){
		parent::afterFind();

		#if(!empty($this->screenshot) && !is_array($this->screenshot))
			#$this->screenshot = explode(',', $this->screenshot);
		
		
		#$this->features = !empty($this->features) ? explode(',', $this->features) : [];
	}*/
	
	public function beforeSave($insert){
		
		if(!$insert){
			$property_id = intval(Yii::$app->request->get('id'));
			$this->saveImages($property_id, $insert);
		}
		
		return parent::beforeSave($insert);
	}
	
	public function afterSave($insert, $changedAttributes){
		parent::afterSave($insert, $changedAttributes);
		
		
		#VarDumper::dump($this->nearby_places, 10, 1); exit;
		if($insert){
			$this->saveImages($this->id, $insert);
		}
		
		if(!Yii::$app->request->isAjax){
			
			if(!empty($this->categories)){
				if(!$this->isNewRecord){
					CategoryLink::deleteAll(['property_id' => $this->id]);
				}
				foreach($this->categories as $category_id){
					$cl_model = new CategoryLink();
					$cl_model->category_id = $category_id;
					$cl_model->property_id = $this->id;
					$cl_model->save();
				}
			}
			
			#VarDumper::dump(Yii::$app->request->post(), 10, 1); exit;
			
			if(!empty($this->nearby_places)){
				if(!$this->isNewRecord){
					NearbyPlaces::deleteAll(['property_id' => $this->id]);
				}

				$this->nearby_places = Json::decode($this->nearby_places, true);
				if(!empty($this->nearby_places)){
					foreach($this->nearby_places as $nearby_places){
						$nearby_places['property_id'] = $this->id;
						$nearby_places['active'] = 1;
						$np_model = new NearbyPlaces($nearby_places);
						$np_model->save();
					}
				}
			}
			
		}
		
		$this->screenshot = (!empty($this->screenshot) && !is_array($this->screenshot)) ? explode(',', $this->screenshot) : [];
	}
	
	public function afterDelete(){
		parent::afterDelete();

		CategoryLink::deleteAll(['property_id' => $this->id]);
		NearbyPlaces::deleteAll(['property_id' => $this->id]);
	}
	
	private function saveImages($property_id = 0, $insert){
		if($property_id == 0) return;
		
		$dir = Yii::getAlias('@property_images').'/'.$property_id;
		
		if(!is_dir($dir)){
			FileHelper::createDirectory($dir, 0777);
			FileHelper::createDirectory($dir.'/thumbs', 0777);
		}
		
		if($file = UploadedFile::getInstance($this, 'preview')){
			
			if(file_exists($dir.'/'.$this->image) && is_file($dir.'/'.$this->image)){
				FileHelper::unlink($dir.'/'.$this->image);
			}
			if(file_exists($dir.'/thumbs/'.$this->image) && is_file($dir.'/thumbs/'.$this->image)){
				FileHelper::unlink($dir.'/thumbs/'.$this->image);
			}
			
			$this->image = $property_id.'_'.time().'_'.rand(137, 999).'.'.$file->extension;
			
			$file->saveAs($dir.'/'.$this->image);
			
			foreach(Yii::$app->params['image_sizes'] as $name => $size){
				$image = Yii::$app->image->load($dir.'/'.$this->image);
				$image->background('#fff', 0);
				$image->resize($size, null, Image::INVERSE);
				$image->save($dir.'/thumbs/'.str_replace('.'.$file->extension, '_'.$size.'.'.$file->extension, $this->image), 90);
			}
		}
		
		if(is_array($this->screenshot)){
			$this->screenshot = implode(",", $this->screenshot);
		}
		
		if($gallery_files = UploadedFile::getInstances($this, 'gallery')){
			#VarDumper::dump($this, 10, 1); exit;
			$gallery_images = [];
			foreach($gallery_files as $file){
				$gallery_image = $property_id.'_'.time().'_'.rand(137, 999).'.'.$file->extension;
				$file->saveAs($dir.'/'.$gallery_image);
				
				foreach(Yii::$app->params['image_sizes'] as $name => $size){
					$image = Yii::$app->image->load($dir.'/'.$gallery_image);
					$image->background('#fff', 0);
					$image->resize($size, null, Image::INVERSE);
					$image->save($dir.'/thumbs/'.str_replace('.'.$file->extension, '_'.$size.'.'.$file->extension, $gallery_image), 90);
					#$image->save($dir.'/thumbs/'.$gallery_image, 90);
				}
				$gallery_images[] = $gallery_image;
			}
			
			if(!empty($gallery_images)){
				if(!is_array($this->screenshot)){
					$this->screenshot = !empty($this->screenshot) ? explode(',', $this->screenshot) : [];
				}
				$this->screenshot = implode(",", array_merge($this->screenshot, $gallery_images));
			}
			
		}
		
		if($insert){
			$this->save();
		}
	}
	
	/**
	 * @return \yii\db\ActiveQuery
	 */
	public function getCategory(){
		return $this->hasOne(Category::className(), ['id' => 'category_id']);
	}
	
	public function getCategory_link(){
		return $this->hasMany(CategoryLink::className(), ['property_id' => 'id']);
	}
	
	public function getFilterCategories(){
		$cats = [];
		
		$results = Category::find()->all();
		
		foreach($results as $result){
			$cats[$result->name] = $result->name;
		}
		
		return $cats;
	}

	public function getPropertyTypes(){
		return $this->prop_types;
	}
	
	public function getPropertyOfTypes(){
		return $this->property_of_types;
	}
	
	public function getLiked(){
		#VarDumper::dump(Yii::$app->user->identity, 10, 1); exit;
		$uid = (Yii::$app->user->identity) ? Yii::$app->user->identity->getId() : 0;
		$sid = Yii::$app->session->id;
		
		if(Yii::$app->user->identity){
			$saved = FavoriteProperties::find()->where(['user_id' => $uid])->orWhere(['sid' => $sid])->andWhere(['property_id' => $this->id])->one();
		}else{
			$saved = FavoriteProperties::find()->where(['sid' => $sid])->andWhere(['property_id' => $this->id])->one();
		}
		return (bool) $saved;
	}
	
	public function getCategories(){
		if(empty($this->categories)){
			$listCategory = Category::find()->orderBy('type DESC', 'name ASC')->all();
			
			$this->categories = ArrayHelper::map($listCategory, 'id', 'name');
		}
		
		return $this->categories;
	}
	
	public function getCategoryLinks(){
		if(empty($this->category_links)){
			$listLinks = CategoryLink::find()->where(['property_id' => $this->id])->all();
			
			$this->category_links = ArrayHelper::map($listLinks, 'id', 'category_id');
		}
		
		return $this->category_links;
	}

	public function getAllPropertyFeatures(){
		if(empty($this->prop_features)){
			$listFeatures = PropertyFeatures::find()->orderBy(['name' => 'ASC'])->all();
			
			foreach($listFeatures as $feature){
				$this->prop_features[$feature->id] = ['name' => $feature->name, 'image' => $feature->image];
			}
		}
		
		return $this->prop_features;
	}
	
	public function getFeatures(){
		$features = [];
		
		if(!empty($this->features)){
			$features = explode(',', $this->features);
			
			#VarDumper::dump([$this->id, $this->features], 10, 1);
			
			if(is_array($features) && !empty($features)){
				$features = PropertyFeatures::find()
					->leftJoin('property_features_types', 'property_features_types.id = property_features.feature_type_id')
					->where(['IN', 'property_features.id', $features])
					->orderBy(['property_features_types.order' => 'ASC'])
					->all();
				
				#VarDumper::dump($features, 10, 1);
			}
		}
		
		return $features;
	}

	public function getMainImage($size = '250'){
		$image = Yii::$app->urlManagerFrontend->baseUrl.'/images/property/nophoto.svg';
		
		if($this->image){
			$pathinfo = pathinfo($this->image);
			if($size == 'full' || $size == ''){
				$file_name = $pathinfo['filename'].'.'.$pathinfo['extension'];
				$file = $this->id.'/'.$file_name;
			}else{
				$file_name = $pathinfo['filename'].'_'.$size.'.'.$pathinfo['extension'];
				$file = $this->id.'/thumbs/'.$file_name;
			}
			
			if(file_exists(Yii::getAlias('@property_images').'/'.$file)){
				$image = Yii::$app->urlManagerFrontend->baseUrl.'/images/property/'.$file;
			}
		}
		
		return $image;
	}
	
	public function getImage($file_name, $size = '250'){
		$image = Yii::$app->urlManagerFrontend->baseUrl.'/images/property/nophoto.svg';
		
		if(!empty($file_name)){
			$pathinfo = pathinfo($file_name);
			if($size == 'full' || $size == ''){
				$file_name = $pathinfo['filename'].'.'.$pathinfo['extension'];
				$file = $this->id.'/'.$file_name;
			}else{
				$file_name = $pathinfo['filename'].'_'.$size.'.'.$pathinfo['extension'];
				$file = $this->id.'/thumbs/'.$file_name;
			}

			if(file_exists(Yii::getAlias('@property_images').'/'.$file)){
				$image = Yii::$app->urlManagerFrontend->baseUrl.'/images/property/'.$file;
			}
		}
		
		return $image;
	}
	
	public function getList(){
		$ret = [];
		
		$prop_model = self::find()->all();
		
		foreach($prop_model as $item){
			$ret[$item->id] = $item->title;
		}
		
		return $ret;
	}
	
	/*
	public function deleteImage($data){
		$this->image = '';
		
		if($ret = $this->save(false))
			$this->deleteImageFile($data);
		
		return $ret;
	}
	
	public function deleteGalleryImage($data){
		$ret = false;
		
		if(in_array($data['file'], $this->screenshot)){
			$screenshots = array_flip($this->screenshot);
			
			unset($screenshots[$data['file']]);
			
			$screenshots = !empty($screenshots) ? implode(',', array_flip($screenshots)) : '';
			
			$this->screenshot = $screenshots;
			
			if($ret = $this->save(false))
				$this->deleteImageFile($data);
		}
		
		return $ret;
	}
	
	private function deleteImageFile($data){
		$dir = Yii::getAlias('@property_images').'/';
		
		$files = [
			$dir.$data['id'].'/'.$data['file'],
			$dir.$data['id'].'/thumbs/'.$data['file']
		];
		
		foreach($files as $file)
			if(file_exists($file))
				FileHelper::unlink($file);
	}
	*/
	
	public function ScreenShot(){
		foreach($this->image as $file){
			$name     = rand(137, 999).time();
			$screen[] = $name.'.'.$file->extension;
			$file->saveAs(SCREENSHOT.$name.'.'.$file->extension);
		}
		
		return $ScreenChunk = implode(",", $screen);
		
	}
	
	public static function specification($id){
		$model = PropertyConfiguration::find()->where(['property_id' => $id])->all();
		if($model){
			foreach($model as $list){
				echo "<li>";
				echo "<span>".$list['name']."</span>";
				echo "<span>".$list['value']."</span>";
				echo "</li>";
				
			}
		}else{
			echo "<li>";
			?>
			<blockquote style="border-color: #99d962">
				No specification describe by Agent
			</blockquote>
			<?php
			echo "</li>";
		}
		
	}
	
	public function isJson($data=NULL) {
		if(!empty($data)){
			@json_decode($data);
			return (json_last_error() === JSON_ERROR_NONE);
		}
		
		return false;
	}
	
	public function get_file_ext($file_path){
		$base_name = basename($file_path);
		$a = explode('.', $base_name);
		$ext = end($a);
		
		return strtolower($ext);
	}
	
}
