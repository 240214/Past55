<?php

namespace common\models;

use Yii;
use yii\db\Query;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "dates".
 * @property integer $idDate
 * @property string $fulldate
 * @property integer $year
 * @property integer $month
 * @property integer $day
 * @property integer $quarter
 * @property integer $week
 * @property integer $dayOfWeek
 * @property integer $weekend
 */
class Dates extends \yii\db\ActiveRecord{
	/**
	 * @inheritdoc
	 */
	public static function tableName(){
		return 'dates';
	}
	
	/**
	 * @inheritdoc
	 */
	
	public static function dateRange($range){
		if($range == "week"){
			$modelArray = Static::find()->
			select('DAYNAME(fulldate) as day')->
			where("fulldate BETWEEN '".date("Y-m-d", strtotime('-7 days', time()))."' AND '".date("Y-m-d", strtotime('0 days', time()))."'")->
			groupBy("DAY(fulldate)")->
			asArray()->
			all();
			
			//  $modelRange = ArrayHelper::map($modelArray,'id','title');
			foreach($modelArray as $date){
				$dates[] = $date['day'];
			}
			
			return $rangeData = "'".implode("', '", $dates)."'";
			
		}
		if($range == "month"){
			$model = Static::find()->select('DATE(fulldate) as day')->where("fulldate BETWEEN '".date("Y-m-d", strtotime('-7 days', time()))."' AND '".date("Y-m-d", strtotime('0 days', time()))."'")->groupBy("DATE(fulldate)")->asArray()->all();
			
			foreach($model as $date){
				$dates[] = $date['day'];
			}
			
			return implode(",", $dates);;
		}
		if($range == "year"){
			$model = Static::find()->select('MONTHNAME(fulldate) as day')->where("fulldate BETWEEN '".date("Y-m-d", strtotime('-7 days', time()))."' AND '".date("Y-m-d", strtotime('0 days', time()))."'")->groupBy("MONTHNAME(fulldate)")->asArray()->all();
			
			foreach($model as $date){
				$dates[] = $date['day'];
			}
			
			return $dates;
		}
		
	}
	
	
}
