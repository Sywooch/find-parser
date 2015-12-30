<?php
namespace common\classes\olx;
use Sunra\PhpSimple\HtmlDomParser;
use common\models\Items;

class ParserOlx
{
    const STORE = 'Olx';

    /**
     * Массив городов Olx
     * @var array
     */
    protected static $cities = [
        "vin",
        "vol",
        "dnp",
        "don",
        "zht",
        "zak",
        "zap",
        "if",
        "ko",
        "kir",
        "cri",
        "lug",
        "lv",
        "nik",
        "od",
        "pol",
        "rov",
        "sum",
        "ter",
        "kha",
        "khe",
        "khm",
        "chk",
        "chn",
        "chv",
    ];

    /**
     * Проверка на уникальность записи
     * @param $url
     * @return bool
     */
    protected static function productUnique($url)
    {
        $model = Items::find()->where([
            'url' => $url
        ])->all();
        if ($model) {
            return false;
        } else {
            return true;
        }
    }

    protected static function getPhoneNumber($url){
        $out = null;
        $parser = new HtmlDomParser();
        $dom = $parser->file_get_html($url);
        $uuid = $dom->find('div.rel ul.brbott-12 li');
        unset($dom);
        if(isset($uuid) && !empty($uuid)) {
            preg_match("/\'id\'\:\'(.*?)\'/", $uuid[0]->class, $uuid);
            $uuid = explode(':', $uuid[0]);
            $uuid = str_replace("'", "", $uuid[1]);
            if ($curl = curl_init()) {
                curl_setopt($curl, CURLOPT_URL, 'http://olx.ua/ajax/misc/contact/phone/' . $uuid . '/white/');
                curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
                curl_setopt($curl, CURLOPT_POST, true);
                curl_setopt($curl, CURLOPT_POSTFIELDS, "");
                $out = curl_exec($curl);
                curl_close($curl);
            }
            $phone = json_decode($out);
            if(isset($phone->value) && !empty($phone->value)) {
                if (preg_match("/<span\sclass=\"block\">(.*)<\/span\>/", $phone->value)) {
                    $ddom = $parser->str_get_html($phone->value);
                    $phone = $ddom->find('span[class=block]')[0]->innertext;
                    unset($ddom);
                    return $phone;
                } else {
                    return $phone->value;
                }
            } else {
                return false;
            }
        } else {
            return false;
        }
    }
}