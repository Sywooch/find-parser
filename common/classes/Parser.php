<?php namespace common\classes;
use common\models\Items;
use Symfony\Component\CssSelector\CssSelectorConverter;
use yii\helpers\HtmlPurifier;

/**
 * Created by PhpStorm.
 * User: canary
 * Date: 17.12.2015
 * Time: 22:27
 */
class Parser
{

    public static $timeout = 0;

    public static function productUnique( $url ) {
        return !Items::find()->where(['url' => $url])->exists();
    }

    public static function getPage($url) {

        sleep(self::$timeout);
        self::$timeout = 2;

        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_RETURNTRANSFER => 1,
            CURLOPT_URL => $url,
            CURLOPT_USERAGENT => 'Mozilla/5.0 (Windows; U; Windows NT 5.1; en-US; rv:1.8.1.13) Gecko/20080311 Firefox/2.0.0.13'
        ));

        $htmlpurifier_config = \HTMLPurifier_Config::createDefault();
        $htmlpurifier_config->set('Attr.EnableID', true);
//        $htmlpurifier_config->set('Attr.EnableID', true);

        $purifier = new HtmlPurifier($htmlpurifier_config);

        return
            $purifier->process(
                curl_exec($curl)
            );
    }

    public static function find($page, $selector) {
        $selector = (new CssSelectorConverter())->toXPath($selector);

        $domDocument = new \DOMDocument();
        $domDocument->loadHTML($page);
        $xpath = new \DOMXPath($domDocument);

        return $xpath->query($selector);
    }

    public static function findByDoc($document, $selector, $contentnode = null) {
        $selector = (new CssSelectorConverter())->toXPath($selector);
        $xpath = new \DOMXPath($document);

        return $xpath->query($selector, $contentnode);
    }

    public static function logFile($filename, $content) {
        file_put_contents(\Yii::getAlias('@runtime') . DIRECTORY_SEPARATOR . 'logs' . DIRECTORY_SEPARATOR . $filename, $content);
    }

    public static function decode ($text) {
        return iconv("UTF-8", "ASCII//IGNORE", $text);
    }

}