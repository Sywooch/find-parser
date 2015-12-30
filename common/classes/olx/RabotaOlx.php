<?php
namespace common\classes\olx;

use common\models\Items;
use Sunra\PhpSimple\HtmlDomParser;

class RabotaOlx extends ParserOlx
{
    /**
     * Массив категорий работы Olx
     * @var array
     */
    private static $category_work = [
        "47" => "roznichnaya-torgovlya-prodazhi",
        "48" => "bary-restorany-razvlecheniya",
        "49" => "domashniy-personal",
        "50" => "obrazovanie",
        "51" => "it-telekom-kompyutery",
        "52" => "proizvodstvo-energetika",
        "53" => "nachalo-karery-studenty",
        "54" => "transport-logistika",
        "55" => "yurisprudentsiya-i-buhgalteriya",
        "56" => "krasota-fitnes-sport",
        "57" => "kultura-iskusstvo",
        "58" => "nedvizhimost",
        "59" => "cekretariat-aho",
        "60" => "servis-i-byt",
        "61" => "stroitelstvo",
        "62" => "ohrana-bezopasnost",
        "63" => "turizm-otdyh-razvlecheniya",
        "64" => "meditsina-farmatsiya",
        "65" => "marketing-reklama-dizayn",
        "66" => "chastichnaya-zanyatost",
        "67" => "drugie-sfery-zanyatiy",
    ];

    public static function getPrice($url)
    {
        $parser = new HtmlDomParser();
        $dom = $parser->file_get_html($url);
        $price = $dom->find('div.pricelabel strong')[0]->plaintext;
        unset($dom);
        if(isset($price) && !empty($price)) {
            preg_match_all("/(\d+)/", str_replace(" ", "", $price), $price);
            if(isset($price[0]) && !empty($price[0])){
                return $price[0];
            } else {
                return "0";
            }
        } else {
            return "0";
        }
    }

    /**
     * Парсинг каталога работы Olx
     */
    public static function saveParseOlxWork()
    {
        foreach (self::$category_work as $id => $work) {
            foreach (parent::$cities as $city) {
                $xml = file_get_contents('http://olx.ua/rabota/' . $work . '/' . $city . '/rss/');
                $movies = new \SimpleXMLElement($xml, LIBXML_NOCDATA);
                unset($xml);
                foreach ($movies->channel->item as $item) {
                    if (parent::productUnique(trim((string)$item->link))) {
                        $model = new Items();
                        $model->product = trim((string)$item->title);
                        $model->price = self::getPrice(trim((string)$item->link))[0];
                        $model->url = trim((string)$item->link);
                        $model->store = self::STORE;
                        $model->phone = parent::getPhoneNumber(trim((string)$item->link));
                        $model->subcategory_id = $id;
                        $model->options = '{"city":"' . $city . '"}';
                        $model->save();
                    }
                }
            }
        }
    }
}