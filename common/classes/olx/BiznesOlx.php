<?php
namespace common\classes\olx;

use common\models\Items;

class BiznesOlx extends ParserOlx
{
    private static $uslugi = [
        '33' => 'perevozki-arenda-transporta',
        '36' => 'stroitelstvo-otdelka-remont',
        '35' => 'yuridicheskie-uslugi',
        '34' => 'syre-materialy',
        '37' => 'reklama-marketing-pr',
        '38' => 'krasota-zdorove',
        '39' => 'turizm-immigratsiya',
        '41' => 'prokat-tovarov',
        '40' => 'obsluzhivanie-remont-tehniki',
        '45' => 'setevoy-marketing',
        '43' => 'nyani-sidelki',
        '42' => 'finansovye-uslugi',
        '44' => 'uslugi-perevodchikov-nabor-teksta',
    ];

    public static function saveParseOlxBiznes()
    {
        foreach(self::$uslugi as $id => $usluga) {
            foreach (parent::$cities as $city) {
                $xml = file_get_contents('http://olx.ua/uslugi/' . $usluga . '/' . $city . '/rss/');
                $movies = new \SimpleXMLElement($xml, LIBXML_NOCDATA);
                unset($xml);
                foreach ($movies->channel->item as $item) {
                    if (parent::productUnique(trim((string)$item->link))) {
                        $model = new Items();
                        $model->product = trim((string)$item->title);
                        $model->price = '0';
                        $model->url = trim((string)$item->link);
                        $model->store = self::STORE;
                        $model->phone = parent::getPhoneNumber(trim((string)$item->link));
                        $model->subcategory_id = $id;
                        $model->options = '{"b/u":"1","city":"' . $city . '"}';
                        $model->save();
                    }
                }
                unset($movies);
            }
        }
    }
}