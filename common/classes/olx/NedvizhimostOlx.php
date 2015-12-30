<?php

namespace common\classes\olx;

use common\models\Items;

class NedvizhimostOlx extends ParserOlx
{
    private static $nedvizhimost = [
        '18' => 'arenda-kvartir',
        '20' => 'arenda-komnat',
        '21' => 'arenda-domov',
        '19' => 'arenda-zemli',
        '22' => 'arenda-garazhey-stoyanok',
        '25' => 'prodazha-pomescheniy',
        '23' => 'prodazha-kvartir',
        '24' => 'prodazha-zemli',
        '26' => 'prodazha-garazhey-stoyanok',
        '71' => 'prodazha-domov',
    ];

    public static function saveParseOlxNedvizhimost()
    {
        foreach(self::$nedvizhimost as $id => $nedv) {
            foreach (parent::$cities as $city) {
                $xml = file_get_contents('http://olx.ua/nedvizhimost/' . $nedv . '/' . $city . '/rss/');
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