<?php
namespace common\models;

use Yii;
use yii\base\NotSupportedException;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;
use yii\web\IdentityInterface;

/**
 * property model
 *
 * @property integer $id
 * @property string $agent
 * @property string $ref
 * @property string $ip
 * @property string $system
 * @property string $city
 * @property string $country
 * @property string $page_view
 * @property integer $date
 */
class Track extends ActiveRecord
{


    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%track}}';
    }

    /**
     * @inheritdoc
     */

    public static function getCounty($ip_address)
    {
        //$ip_address= $_SERVER['REMOTE_ADDR'];
        $geopluginURL='http://www.geoplugin.net/php.gp?ip='.$ip_address;

        if(@fsockopen($geopluginURL, 80, $iErrno, $sErrStr, 5))
        {
            $addrDetailsArr = unserialize(file_get_contents($geopluginURL));

            $country = $addrDetailsArr['geoplugin_countryName'];
            if(!$country)
            {
                return $country='Not Define';
            }else
            {
                return $country;
            }
        }
        else
        {
            return  $country ='Not Define';
        }

    }
    public static function getCity($ip_address)
    {
        //$ip_address= $_SERVER['REMOTE_ADDR'];
        //$geopluginURL='http://www.geoplugin.net/php.gp';

        $geopluginURL='http://www.geoplugin.net/php.gp?ip='.$ip_address;

        if(@fsockopen($geopluginURL, 80, $iErrno, $sErrStr, 5))
        {
            $addrDetailsArr = unserialize(file_get_contents($geopluginURL));
            $city = $addrDetailsArr['geoplugin_city'];

            if(!$city)
            {
                return  $city='Not Define';
            }
            else
            {
                return $city;
            }
        }
        else
        {
            return  $city='Not Define';
        }


    }

    public static function getLocation()
    {
        $ip_address= $_SERVER['REMOTE_ADDR'];
        //$geopluginURL='http://www.geoplugin.net/php.gp';

        $geopluginURL='http://www.geoplugin.net/php.gp?ip='.$ip_address;

        if(@fsockopen($geopluginURL, 80, $iErrno, $sErrStr, 5))
        {
            $addrDetailsArr = unserialize(file_get_contents($geopluginURL));
            $city = $addrDetailsArr['geoplugin_city'];
            $country = $addrDetailsArr['geoplugin_countryName'];
            if(!$country)
            {
                return  $city='Not Define';
            }
            else
            {
                return $city.", ".$country;
            }
        }
        else
        {
            return  $city='Not Define';
        }
    }

    public static function  track($agent,$remoteadr,$refer)
    {
        $track = new Track();
        //$_SERVER['HTTP_CLIENT_IP']
        // $_SERVER['HTTP_USER_AGENT'],  $_SERVER['REMOTE_ADDR'], $_SERVER['HTTP_REFERER']
        $track->agent = $agent;
        $track->ip= isset($remoteadr) ?$remoteadr : '';
        $track->system = gethostbyaddr($remoteadr);
        $track->ref=isset($refer) ?$refer : '';
        $track->page_view = "0";
        $track->city= Track::getCity($remoteadr);
        $track->country= Track::getCounty($remoteadr);
        $track->date= time();


        $track->save(false);
    }

    public static function ExactBrowserName($ExactBrowserNameUA)
    {


        if (strpos(strtolower($ExactBrowserNameUA), "safari/") and strpos(strtolower($ExactBrowserNameUA), "opr/")) {
            // OPERA
            $ExactBrowserNameBR="Opera";
        } elseIf (strpos(strtolower($ExactBrowserNameUA), "safari/") and strpos(strtolower($ExactBrowserNameUA), "chrome/")) {
            // CHROME
            $ExactBrowserNameBR="Chrome";
        } elseIf (strpos(strtolower($ExactBrowserNameUA), "msie")) {
            // INTERNET EXPLORER
            $ExactBrowserNameBR="Internet Explorer";
        } elseIf (strpos(strtolower($ExactBrowserNameUA), "firefox/")) {
            // FIREFOX
            $ExactBrowserNameBR="Firefox";
        } elseIf (strpos(strtolower($ExactBrowserNameUA), "safari/") and strpos(strtolower($ExactBrowserNameUA), "opr/")==false and strpos(strtolower($ExactBrowserNameUA), "chrome/")==false) {
            // SAFARI
            $ExactBrowserNameBR="Safari";
        } else {
            // OUT OF DATA
            $ExactBrowserNameBR="OUT OF DATA";
        };

        return $ExactBrowserNameBR;
    }

    public static function ExactOs($ExactBrowserNameUA)
    {
        //return $ExactBrowserNameUA;
        $OSList = array
        (
// Match user agent string with operating systems
            'Windows 3.11' => 'Win16',
            'Windows 95' => '(Windows 95)|(Win95)|(Windows_95)',
            'Windows 98' => '(Windows 98)|(Win98)',
            'Windows 2000' => '(Windows NT 5.0)|(Windows 2000)',
            'Windows XP' => '(Windows NT 5.1)|(Windows XP)',
            'Windows Server 2003' => '(Windows NT 5.2)',
            'Windows Vista' => '(Windows NT 6.0)',
            'Windows 7' => '(Windows NT 7.0)',
            'Windows NT 4.0' => '(Windows NT 4.0)|(WinNT4.0)|(WinNT)|(Windows NT)',
            'Windows ME' => 'Windows ME',
            'Open BSD' => 'OpenBSD',
            'Sun OS' => 'SunOS',
            'Linux' => '(Linux)|(X11)',
            'Mac OS' => '(Mac_PowerPC)|(Macintosh)',
            'QNX' => 'QNX',
            'BeOS' => 'BeOS',
            'OS/2' => 'OS/2',
            'Search Bot'=>'(nuhk)|(Googlebot)|(Yammybot)|(Openbot)|(Slurp)|(MSNBot)|(Ask Jeeves/Teoma)|(ia_archiver)'
        );
// Loop through the array of user agents and matching operating systems
        foreach($OSList as $CurrOS=>$Match)
        {
// Find a match
            if (preg_match('/'.$Match.'/',$ExactBrowserNameUA))
            {
// We found the correct match
                break;
            }
        }
// You are using ...
        return $CurrOS;
    }

    public static function getBrowser($agent)
    {
        $u_agent = $agent;
        $bname = 'Unknown';
        $platform = 'Unknown';
        $version= "";

        //First get the platform?
        if (preg_match('/linux/i', $u_agent)) {
            $platform = 'linux';
        }
        elseif (preg_match('/macintosh|mac os x/i', $u_agent)) {
            $platform = 'mac';
        }
        elseif (preg_match('/windows|win32/i', $u_agent)) {
            $platform = 'windows';
        }

        // Next get the name of the useragent yes seperately and for good reason
        if(preg_match('/MSIE/i',$u_agent) && !preg_match('/Opera/i',$u_agent))
        {
            $bname = 'Internet Explorer';
            $ub = "MSIE";
        }
        elseif(preg_match('/Firefox/i',$u_agent))
        {
            $bname = 'Mozilla Firefox';
            $ub = "Firefox";
        }
        elseif(preg_match('/Chrome/i',$u_agent))
        {
            $bname = 'Google Chrome';
            $ub = "Chrome";
        }
        elseif(preg_match('/Safari/i',$u_agent))
        {
            $bname = 'Apple Safari';
            $ub = "Safari";
        }
        elseif(preg_match('/Opera/i',$u_agent))
        {
            $bname = 'Opera';
            $ub = "Opera";
        }
        elseif(preg_match('/Netscape/i',$u_agent))
        {
            $bname = 'Netscape';
            $ub = "Netscape";
        }

        // finally get the correct version number
        $known = array('Version', $ub, 'other');
        $pattern = '#(?<browser>' . join('|', $known) .
            ')[/ ]+(?<version>[0-9.|a-zA-Z.]*)#';
        if (!preg_match_all($pattern, $u_agent, $matches)) {
            // we have no matching number just continue
        }

        // see how many we have
        $i = count($matches['browser']);
        if ($i != 1) {
            //we will have two since we are not using 'other' argument yet
            //see if version is before or after the name
            if (strripos($u_agent,"Version") < strripos($u_agent,$ub)){
                $version= $matches['version'][0];
            }
            else {
                $version= $matches['version'][1];
            }
        }
        else {
            $version= $matches['version'][0];
        }

        // check if we have a number
        if ($version==null || $version=="") {$version="?";}

        return array(
            'userAgent' => $u_agent,
            'name'      => $bname,
            'version'   => $version,
            'platform'  => $platform,
            'pattern'    => $pattern
        );

// now try it

    }

    public static function getLocationInfoByIp(){
        $client  = @$_SERVER['HTTP_CLIENT_IP'];
        $forward = @$_SERVER['HTTP_X_FORWARDED_FOR'];
        $remote  = @$_SERVER['REMOTE_ADDR'];
        $result  = array('country'=>'', 'city'=>'');
        if(filter_var($client, FILTER_VALIDATE_IP)){
            $ip = $client;
        }elseif(filter_var($forward, FILTER_VALIDATE_IP)){
            $ip = $forward;
        }else{
            $ip = $remote;
        }
        $ip_data = @json_decode(file_get_contents("http://www.geoplugin.net/json.gp?ip=".$ip));
        if($ip_data && $ip_data->geoplugin_countryName != null){
            $result['code'] = $ip_data->geoplugin_countryCode;
            $result['country'] = $ip_data->geoplugin_countryName;
            $result['city'] = $ip_data->geoplugin_city;
            $result['lat'] = $ip_data->geoplugin_latitude;
            $result['long'] = $ip_data->geoplugin_longitude;
        }
        return $result;
    }

}
