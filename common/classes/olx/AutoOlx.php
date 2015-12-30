<?php

namespace common\classes\olx;

use common\models\Items;

class AutoOlx extends ParserOlx
{
    private static $urls = [
        '9'     => 'legkovye-avtomobili',
        '10'    => 'gruzovye-avtomobili',
        '11'    => 'spetstehnika',
        '12'    => 'moto',
        '13'    => 'avtobusy',
        '14'    => 'pritsepy',
        '15'    => 'vodnyy-transport',
        '17'    => 'vozdushnyy-transport',
    ];

    public static function saveParseOlxAuto()
    {
        foreach(self::$urls as $id => $auto) {
            foreach (parent::$cities as $city) {
                $xml = file_get_contents('http://olx.ua/transport/' . $auto . '/' . $city . '/rss/');
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