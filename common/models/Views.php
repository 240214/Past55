<?php

namespace common\models;

use Yii;
use yii\db\Query;

/**
 * This is the model class for table "Views".
 *
 * @property integer $id
 * @property string $user_id
 * @property integer $property_id
 * @property integer $views
 * @property integer $view_time
 */
class Views extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'views';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['user_id','property_id', 'views','view_time'], 'required'],

        ];
    }


    public static function viewCount($from,$to,$today = false)
    {
        //$newQuery = "SELECT DAYNAME(view_time) AS date,COUNT(views) AS click,COUNT(DISTINCT(property_id)) AS property_id FROM views WHERE user_id = 1 and property_id = 4 and view_time BETWEEN '2018-01-12 15:43:02' AND '2018-01-17 23:59:59' GROUP BY DATE(view_time)";
        $uid = Yii::$app->user->identity->getId();

        if($today)
        {
            $from = date('Y-m-d',time())." 00:00:00";//'2018-01-01 00:00:00';


        }
        else
        {
            $from = date('Y-m-d H:i:s',$from);//'2018-01-01 00:00:00';

        }
        $to = date('Y-m-d H:i:s',$to);//($to != "")?$to:'2018-01-14 23:59:59';

        $select = 'DATE(view_time) AS date,
        COUNT(*) AS click,
        COUNT(DISTINCT(property_id)) AS property_id';

        $where = "view_time BETWEEN '$from' AND '$to'";



        $demoStatics = new Query();
        $demoStatics->select($select)->from('views')->where($where)->andWhere(['user_id'=>$uid])->groupBy("date")->orderBy("date");
        $demoStaticsResults = $demoStatics->createCommand();
        $statics = $demoStaticsResults->queryAll();
        return $statics;

//        print "<pre>";
//        print_r($statics);
//        print "</pre>";
    }

    public static function viewFromId($id,$period)
    {

        $uid = Yii::$app->user->identity->getId();


      //  $newAgain =  "SELECT DAYNAME(view_time) AS date,COUNT(views) AS click,COUNT(DISTINCT(property_id)) AS property_id FROM views WHERE user_id = 1 and property_id = 4 and  view_time BETWEEN (DATE(NOW()) - INTERVAL 7 DAY) AND DATE(NOW()) GROUP BY DATE(view_time)";

        // $newQuery = "SELECT DAYNAME(view_time) AS date,COUNT(views) AS click,COUNT(DISTINCT(property_id)) AS property_id FROM views WHERE user_id = 1 and property_id = 4 and view_time BETWEEN '2018-01-12 15:43:02' AND '2018-01-17 23:59:59' GROUP BY DATE(view_time)";

        //new query for view count : SELECT DATE(dates.fulldate) AS day,views.property_id, COUNT(views.views) AS view FROM
        // dates LEFT JOIN views ON DATE(views.view_time) = dates.fulldate AND views.property_id = 4  WHERE   dates.fulldate
        // BETWEEN '2018-01-20' AND '2018-01-29' GROUP BY DAY(dates.fulldate)

        if($period == "week")
        {
            $select = "DAYNAME(dates.fulldate) AS day,views.property_id, COUNT(views.views) AS view";

            $where = "dates.fulldate BETWEEN '".date("Y-m-d",strtotime('-7 days',time()))."' AND '".date("Y-m-d",strtotime('0 days',time()))."'";
           // $select = "DAYNAME(view_time) AS date,COUNT(views) AS click,COUNT(DISTINCT(property_id))AS property_id";

            $groupBy = "DAY(dates.fulldate)";


            $query = new Query();
            $query->select($select)->from('dates')
                ->join('left join','views','DATE(views.view_time) = dates.fulldate AND views.property_id='.$id)
                ->where($where)->groupBy($groupBy);
            $command = $query->createCommand();
            $statics = $command->queryAll();
            return $statics;
        }
        elseif ($period == "month")
        {
            $where = "view_time BETWEEN '".date("Y-m-d",strtotime('-30 days',time()))." 00:00:00' AND '".date("Y-m-d",strtotime('0 days',time()))." 00:00:00'";
            $select = "DAYNAME(view_time) AS day, DATE(view_time) AS date,COUNT(views) AS click,property_id AS property_id";
            $groupBy = "DATE(view_time)";
        }
        else
        {
            $where = "view_time BETWEEN '".date("Y-m-d",strtotime('-365 days',time()))." 00:00:00' AND '".date("Y-m-d",strtotime('-0 days',time()))." 00:00:00'";
            $select = " MONTHNAME(view_time) AS date,COUNT(views) AS click,property_id AS property_id";
            $groupBy = "MONTH(view_time)";
        }


        $demoStatics = new Query();
        $demoStatics->select($select)
            ->from('dates')
            ->where(['user_id'=>$uid])->andWhere(['property_id'=>$id])->andWhere($where)
            ->groupBy($groupBy);
        $demoStaticsResults = $demoStatics->createCommand();
        $statics = $demoStaticsResults->queryAll();
        return $statics;
    }

}
