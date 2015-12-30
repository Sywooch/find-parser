<?php
namespace common\classes\olx;

use common\models\Items;

class OtdihSportOlx extends ParserOlx
{
    private static $items = [
        '27' => 'antikvariat-kollektsii',
        '28' => 'knigi-zhurnaly',
        '29' => 'muzykalnye-instrumenty',
        '30' => 'sport-otdyh',
        '31' => 'cd-dvd-plastinki',
        '32' => 'bilety',
    ];

    public static function saveParseOlxOtdihAndSport()
    {
        foreach(self::$items as $id => $prod) {
            foreach (parent::$cities as $city) {
                $xml = file_get_contents('http://olx.ua/hobbi-otdyh-i-sport/' . $prod . '/' . $city . '/rss/');
                $movies = new \SimpleXMLElement($xml, LIBXML_NOCDATA);
                unset($xml);
                foreach ($movies->channel->item as $item) {
                    if (parent::productUnique(trim((string)$item->link))) {
                        preg_match("/Цена:\s\d(.*?)\sгрн/", $item->description, $m);
                        if (isset($m[0])) {
                            preg_match_all("/\d/", str_replace(" ", "", $m[0]), $prices);
                            foreach ($prices as $price) {
                                $model = new Items();
                                $model->product = trim((string)$item->title);
                                $model->price = implode('', $price);
                                $model->url = trim((string)$item->link);
                                $model->store = self::STORE;
                                $model->phone = parent::getPhoneNumber(trim((string)$item->link));
                                $model->subcategory_id = $id;
                                $model->options = '{"b/u":"1","city":"' . $city . '"}';
                                $model->save();
                            }
                        }
                    }
                }
            }
        }
    }
}