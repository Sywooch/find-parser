<?php

namespace common\classes\olx;

use common\models\Items;

class ElectronikaOlx extends ParserOlx
{
    /**
     * Парсинг olx и сохранение результата в базу
     */
    public function saveParseOlxPhone()
    {
        foreach (parent::$cities as $city) {
            $xml = file_get_contents('http://olx.ua/elektronika/telefony/mobilnye-telefony/' . $city . '/rss/');
            $movies = new \SimpleXMLElement($xml, LIBXML_NOCDATA);
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
                            $model->store = 'Olx';
                            $model->phone = parent::getPhoneNumber(trim((string)$item->link));
                            $model->subcategory_id = 1;
                            $model->options = '{"b/u":"1","city":"'.$city.'"}';
                            $model->save();
                        }
                    }
                }
            }
        }
    }

    public function saveParseOlxNout()
    {
        foreach (parent::$cities as $city) {
            $xml = file_get_contents('http://olx.ua/elektronika/kompyutery/noutbuki/' . $city . '/rss/');
            $movies = new \SimpleXMLElement($xml, LIBXML_NOCDATA);
            foreach ($movies->channel->item as $item) {
                if (self::productUnique(trim((string)$item->link))) {
                    preg_match("/Цена:\s\d(.*?)\sгрн/", $item->description, $m);
                    if (isset($m[0])) {
                        preg_match_all("/\d/", str_replace(" ", "", $m[0]), $prices);
                        foreach ($prices as $price) {
                            $model = new Items();
                            $model->product = trim((string)$item->title);
                            $model->price = implode('', $price);
                            $model->url = trim((string)$item->link);
                            $model->store = 'Olx';
                            $model->phone = parent::getPhoneNumber(trim((string)$item->link));
                            $model->subcategory_id = 2;
                            $model->options = '{"type":"noutbuk","b/u":"1","city":"'.$city.'"}';
                            $model->save();
                        }
                    }
                }
            }
        }
    }

    public function saveParseOlxPlanshet()
    {
        foreach (parent::$cities as $city) {
            $xml = file_get_contents('http://olx.ua/elektronika/kompyutery/planshetnye-kompyutery/' . $city . '/rss/');
            $movies = new \SimpleXMLElement($xml, LIBXML_NOCDATA);
            foreach ($movies->channel->item as $item) {
                if (self::productUnique(trim((string)$item->link))) {
                    preg_match("/Цена:\s\d(.*?)\sгрн/", $item->description, $m);
                    if (isset($m[0])) {
                        preg_match_all("/\d/", str_replace(" ", "", $m[0]), $prices);
                        foreach ($prices as $price) {
                            $model = new Items();
                            $model->product = trim((string)$item->title);
                            $model->price = implode('', $price);
                            $model->url = trim((string)$item->link);
                            $model->store = 'Olx';
                            $model->phone = parent::getPhoneNumber(trim((string)$item->link));
                            $model->subcategory_id = 2;
                            $model->options = '{"type":"planshet","b/u":"1","city":"'.$city.'"}';
                            $model->save();
                        }
                    }
                }
            }
        }
    }

    public function saveParseOlxMediaPlayer()
    {
        foreach (parent::$cities as $city) {
            $xml = file_get_contents('http://olx.ua/elektronika/tv-videotehnika/dvd-pleery/' . $city . '/rss/');
            $movies = new \SimpleXMLElement($xml, LIBXML_NOCDATA);
            foreach ($movies->channel->item as $item) {
                if (self::productUnique(trim((string)$item->link))) {
                    preg_match("/Цена:\s\d(.*?)\sгрн/", $item->description, $m);
                    if (isset($m[0])) {
                        preg_match_all("/\d/", str_replace(" ", "", $m[0]), $prices);
                        foreach ($prices as $price) {
                            $model = new Items();
                            $model->product = trim((string)$item->title);
                            $model->price = implode('', $price);
                            $model->url = trim((string)$item->link);
                            $model->store = 'Olx';
                            $model->phone = parent::getPhoneNumber(trim((string)$item->link));
                            $model->subcategory_id = 3;
                            $model->options = '{"type":"media-player","b/u":"1","city":"'.$city.'"}';
                            $model->save();
                        }
                    }
                }
            }
        }
    }

    public function saveParseOlxMp3Player()
    {
        foreach (parent::$cities as $city) {
            $xml = file_get_contents('http://olx.ua/elektronika/audiotehnika/mp3-pleery/' . $city . '/rss/');
            $movies = new \SimpleXMLElement($xml, LIBXML_NOCDATA);
            foreach ($movies->channel->item as $item) {
                if (self::productUnique(trim((string)$item->link))) {
                    preg_match("/Цена:\s\d(.*?)\sгрн/", $item->description, $m);
                    if (isset($m[0])) {
                        preg_match_all("/\d/", str_replace(" ", "", $m[0]), $prices);
                        foreach ($prices as $price) {
                            $model = new Items();
                            $model->product = trim((string)$item->title);
                            $model->price = implode('', $price);
                            $model->url = trim((string)$item->link);
                            $model->store = 'Olx';
                            $model->phone = parent::getPhoneNumber(trim((string)$item->link));
                            $model->subcategory_id = 3;
                            $model->options = '{"type":"mp3-player","b/u":"1","city":"'.$city.'"}';
                            $model->save();
                        }
                    }
                }
            }
        }
    }

    public function saveParseOlxNaushniki()
    {
        foreach (parent::$cities as $city) {
            $xml = file_get_contents('http://olx.ua/elektronika/audiotehnika/naushniki/' . $city . '/rss/');
            $movies = new \SimpleXMLElement($xml, LIBXML_NOCDATA);
            foreach ($movies->channel->item as $item) {
                if (self::productUnique(trim((string)$item->link))) {
                    preg_match("/Цена:\s\d(.*?)\sгрн/", $item->description, $m);
                    if (isset($m[0])) {
                        preg_match_all("/\d/", str_replace(" ", "", $m[0]), $prices);
                        foreach ($prices as $price) {
                            $model = new Items();
                            $model->product = trim((string)$item->title);
                            $model->price = implode('', $price);
                            $model->url = trim((string)$item->link);
                            $model->store = 'Olx';
                            $model->phone = parent::getPhoneNumber(trim((string)$item->link));
                            $model->subcategory_id = 3;
                            $model->options = '{"type":"headphones","b/u":"1","city":"'.$city.'"}';
                            $model->save();
                        }
                    }
                }
            }
        }
    }

    public function saveParseOlxTV()
    {
        foreach (parent::$cities as $city) {
            $xml = file_get_contents('http://olx.ua/elektronika/tv-videotehnika/televizory/' . $city . '/rss/');
            $movies = new \SimpleXMLElement($xml, LIBXML_NOCDATA);
            foreach ($movies->channel->item as $item) {
                if (self::productUnique(trim((string)$item->link))) {
                    preg_match("/Цена:\s\d(.*?)\sгрн/", $item->description, $m);
                    if (isset($m[0])) {
                        preg_match_all("/\d/", str_replace(" ", "", $m[0]), $prices);
                        foreach ($prices as $price) {
                            $model = new Items();
                            $model->product = trim((string)$item->title);
                            $model->price = implode('', $price);
                            $model->url = trim((string)$item->link);
                            $model->store = 'Olx';
                            $model->phone = parent::getPhoneNumber(trim((string)$item->link));
                            $model->subcategory_id = 3;
                            $model->options = '{"type":"tv","b/u":"1","city":"'.$city.'"}';
                            $model->save();
                        }
                    }
                }
            }
        }
    }

    public function saveParseOlxWashers()
    {
        foreach (parent::$cities as $city) {
            $xml = file_get_contents('http://olx.ua/elektronika/tehnika-dlya-doma/stiralnye-mashiny/' . $city . '/rss/');
            $movies = new \SimpleXMLElement($xml, LIBXML_NOCDATA);
            foreach ($movies->channel->item as $item) {
                if (self::productUnique(trim((string)$item->link))) {
                    preg_match("/Цена:\s\d(.*?)\sгрн/", $item->description, $m);
                    if (isset($m[0])) {
                        preg_match_all("/\d/", str_replace(" ", "", $m[0]), $prices);
                        foreach ($prices as $price) {
                            $model = new Items();
                            $model->product = trim((string)$item->title);
                            $model->price = implode('', $price);
                            $model->url = trim((string)$item->link);
                            $model->store = 'Olx';
                            $model->phone = parent::getPhoneNumber(trim((string)$item->link));
                            $model->subcategory_id = 4;
                            $model->options = '{"type":"washer","b/u":"1","city":"'.$city.'"}';
                            $model->save();
                        }
                    }
                }
            }
        }
    }

    public function saveParseOlxGamesPrst()
    {
        foreach (parent::$cities as $city) {
            $xml = file_get_contents('http://olx.ua/elektronika/igry-i-igrovye-pristavki/pristavki/' . $city . '/rss/');
            $movies = new \SimpleXMLElement($xml, LIBXML_NOCDATA);
            foreach ($movies->channel->item as $item) {
                if (self::productUnique(trim((string)$item->link))) {
                    preg_match("/Цена:\s\d(.*?)\sгрн/", $item->description, $m);
                    if (isset($m[0])) {
                        preg_match_all("/\d/", str_replace(" ", "", $m[0]), $prices);
                        foreach ($prices as $price) {
                            $model = new Items();
                            $model->product = trim((string)$item->title);
                            $model->price = implode('', $price);
                            $model->url = trim((string)$item->link);
                            $model->store = 'Olx';
                            $model->phone = parent::getPhoneNumber(trim((string)$item->link));
                            $model->subcategory_id = 5;
                            $model->options = '{"b/u":"1","city":"'.$city.'"}';
                            $model->save();
                        }
                    }
                }
            }
        }
    }

    public function saveParseOlxAksesuari()
    {
        foreach (parent::$cities as $city) {
            $xml = file_get_contents('http://olx.ua/elektronika/aksessuary-i-komplektuyuschie/' . $city . '/rss/');
            $movies = new \SimpleXMLElement($xml, LIBXML_NOCDATA);
            unset($xml);
            foreach ($movies->channel->item as $item) {
                if (self::productUnique(trim((string)$item->link))) {
                    preg_match("/Цена:\s\d(.*?)\sгрн/", $item->description, $m);
                    if (isset($m[0])) {
                        preg_match_all("/\d/", str_replace(" ", "", $m[0]), $prices);
                        foreach ($prices as $price) {
                            $model = new Items();
                            $model->product = trim((string)$item->title);
                            $model->price = implode('', $price);
                            $model->url = trim((string)$item->link);
                            $model->store = 'Olx';
                            $model->phone = parent::getPhoneNumber(trim((string)$item->link));
                            $model->subcategory_id = 7;
                            $model->options = '{"b/u":"1","city":"'.$city.'"}';
                            $model->save();
                        }
                    }
                }
            }
        }
    }

    public function saveParseOlxProchee()
    {
        foreach (parent::$cities as $city) {
            $xml = file_get_contents('http://olx.ua/elektronika/prochaja-electronika/' . $city . '/rss/');
            $movies = new \SimpleXMLElement($xml, LIBXML_NOCDATA);
            unset($xml);
            foreach ($movies->channel->item as $item) {
                if (self::productUnique(trim((string)$item->link))) {
                    preg_match("/Цена:\s\d(.*?)\sгрн/", $item->description, $m);
                    if (isset($m[0])) {
                        preg_match_all("/\d/", str_replace(" ", "", $m[0]), $prices);
                        foreach ($prices as $price) {
                            $model = new Items();
                            $model->product = trim((string)$item->title);
                            $model->price = implode('', $price);
                            $model->url = trim((string)$item->link);
                            $model->store = 'Olx';
                            $model->phone = parent::getPhoneNumber(trim((string)$item->link));
                            $model->subcategory_id = 8;
                            $model->options = '{"b/u":"1","city":"'.$city.'"}';
                            $model->save();
                        }
                    }
                }
            }
        }
    }

    public function saveParseOlxPilesosi()
    {
        foreach (parent::$cities as $city) {
            $xml = file_get_contents('http://olx.ua/elektronika/tehnika-dlya-doma/pylesosy/' . $city . '/rss/');
            $movies = new \SimpleXMLElement($xml, LIBXML_NOCDATA);
            foreach ($movies->channel->item as $item) {
                if (self::productUnique(trim((string)$item->link))) {
                    preg_match("/Цена:\s\d(.*?)\sгрн/", $item->description, $m);
                    if (isset($m[0])) {
                        preg_match_all("/\d/", str_replace(" ", "", $m[0]), $prices);
                        foreach ($prices as $price) {
                            $model = new Items();
                            $model->product = trim((string)$item->title);
                            $model->price = implode('', $price);
                            $model->url = trim((string)$item->link);
                            $model->store = 'Olx';
                            $model->phone = parent::getPhoneNumber(trim((string)$item->link));
                            $model->subcategory_id = 4;
                            $model->options = '{"type":"pilesosi","b/u":"1","city":"'.$city.'"}';
                            $model->save();
                        }
                    }
                }
            }
        }
    }

    public function saveParseOlxPliti()
    {
        foreach (parent::$cities as $city) {
            $xml = file_get_contents('http://olx.ua/elektronika/tehnika-dlya-kuhni/plity-pechi/' . $city . '/rss/');
            $movies = new \SimpleXMLElement($xml, LIBXML_NOCDATA);
            foreach ($movies->channel->item as $item) {
                if (self::productUnique(trim((string)$item->link))) {
                    preg_match("/Цена:\s\d(.*?)\sгрн/", $item->description, $m);
                    if (isset($m[0])) {
                        preg_match_all("/\d/", str_replace(" ", "", $m[0]), $prices);
                        foreach ($prices as $price) {
                            $model = new Items();
                            $model->product = trim((string)$item->title);
                            $model->price = implode('', $price);
                            $model->url = trim((string)$item->link);
                            $model->store = 'Olx';
                            $model->phone = parent::getPhoneNumber(trim((string)$item->link));
                            $model->subcategory_id = 4;
                            $model->options = '{"type":"pliti","b/u":"1","city":"'.$city.'"}';
                            $model->save();
                        }
                    }
                }
            }
        }
    }

    public function saveParseOlxMicrowave()
    {
        foreach (parent::$cities as $city) {
            $xml = file_get_contents('http://olx.ua/elektronika/tehnika-dlya-kuhni/mikrovolnovye-pechi/' . $city . '/rss/');
            $movies = new \SimpleXMLElement($xml, LIBXML_NOCDATA);
            foreach ($movies->channel->item as $item) {
                if (self::productUnique(trim((string)$item->link))) {
                    preg_match("/Цена:\s\d(.*?)\sгрн/", $item->description, $m);
                    if (isset($m[0])) {
                        preg_match_all("/\d/", str_replace(" ", "", $m[0]), $prices);
                        foreach ($prices as $price) {
                            $model = new Items();
                            $model->product = trim((string)$item->title);
                            $model->price = implode('', $price);
                            $model->url = trim((string)$item->link);
                            $model->store = 'Olx';
                            $model->phone = parent::getPhoneNumber(trim((string)$item->link));
                            $model->subcategory_id = 4;
                            $model->options = '{"type":"microwave","b/u":"1","city":"'.$city.'"}';
                            $model->save();
                        }
                    }
                }
            }
        }
    }

    public function saveParseOlxFridges()
    {
        foreach (parent::$cities as $city) {
            $xml = file_get_contents('http://olx.ua/elektronika/tehnika-dlya-kuhni/holodilniki/' . $city . '/rss/');
            $movies = new \SimpleXMLElement($xml, LIBXML_NOCDATA);
            foreach ($movies->channel->item as $item) {
                if (self::productUnique(trim((string)$item->link))) {
                    preg_match("/Цена:\s\d(.*?)\sгрн/", $item->description, $m);
                    if (isset($m[0])) {
                        preg_match_all("/\d/", str_replace(" ", "", $m[0]), $prices);
                        foreach ($prices as $price) {
                            $model = new Items();
                            $model->product = trim((string)$item->title);
                            $model->price = implode('', $price);
                            $model->url = trim((string)$item->link);
                            $model->store = 'Olx';
                            $model->phone = parent::getPhoneNumber(trim((string)$item->link));
                            $model->subcategory_id = 4;
                            $model->options = '{"type":"fridges","b/u":"1","city":"'.$city.'"}';
                            $model->save();
                        }
                    }
                }
            }
        }
    }

    public function saveParseOlxKlimat()
    {
        foreach (parent::$cities as $city) {
            $xml = file_get_contents('http://olx.ua/elektronika/klimaticheskoe-oborudovanie/' . $city . '/rss/');
            $movies = new \SimpleXMLElement($xml, LIBXML_NOCDATA);
            foreach ($movies->channel->item as $item) {
                if (self::productUnique(trim((string)$item->link))) {
                    preg_match("/Цена:\s\d(.*?)\sгрн/", $item->description, $m);
                    if (isset($m[0])) {
                        preg_match_all("/\d/", str_replace(" ", "", $m[0]), $prices);
                        foreach ($prices as $price) {
                            $model = new Items();
                            $model->product = trim((string)$item->title);
                            $model->price = implode('', $price);
                            $model->url = trim((string)$item->link);
                            $model->store = 'Olx';
                            $model->phone = parent::getPhoneNumber(trim((string)$item->link));
                            $model->subcategory_id = 70;
                            $model->options = '{"b/u":"1","city":"'.$city.'"}';
                            $model->save();
                        }
                    }
                }
            }
        }
    }

    public function saveParseOlxPhoto()
    {
        foreach (parent::$cities as $city) {
            $xml = file_get_contents('http://olx.ua/elektronika/foto-video/tsifrovye-fotoapparaty/' . $city . '/rss/');
            $movies = new \SimpleXMLElement($xml, LIBXML_NOCDATA);
            foreach ($movies->channel->item as $item) {
                if (self::productUnique(trim((string)$item->link))) {
                    preg_match("/Цена:\s\d(.*?)\sгрн/", $item->description, $m);
                    if (isset($m[0])) {
                        preg_match_all("/\d/", str_replace(" ", "", $m[0]), $prices);
                        foreach ($prices as $price) {
                            $model = new Items();
                            $model->product = trim((string)$item->title);
                            $model->price = implode('', $price);
                            $model->url = trim((string)$item->link);
                            $model->store = 'Olx';
                            $model->phone = parent::getPhoneNumber(trim((string)$item->link));
                            $model->subcategory_id = 69;
                            $model->options = '{"type":"photo","b/u":"1","city":"'.$city.'"}';
                            $model->save();
                        }
                    }
                }
            }
        }
    }

    public function saveParseOlxVideo()
    {
        foreach (parent::$cities as $city) {
            $xml = file_get_contents('http://olx.ua/elektronika/foto-video/videokamery/' . $city . '/rss/');
            $movies = new \SimpleXMLElement($xml, LIBXML_NOCDATA);
            foreach ($movies->channel->item as $item) {
                if (self::productUnique(trim((string)$item->link))) {
                    preg_match("/Цена:\s\d(.*?)\sгрн/", $item->description, $m);
                    if (isset($m[0])) {
                        preg_match_all("/\d/", str_replace(" ", "", $m[0]), $prices);
                        foreach ($prices as $price) {
                            $model = new Items();
                            $model->product = trim((string)$item->title);
                            $model->price = implode('', $price);
                            $model->url = trim((string)$item->link);
                            $model->store = 'Olx';
                            $model->phone = parent::getPhoneNumber(trim((string)$item->link));
                            $model->subcategory_id = 69;
                            $model->options = '{"type":"video","b/u":"1","city":"'.$city.'"}';
                            $model->save();
                        }
                    }
                }
            }
        }
    }

    public function saveParseOlxObektivy()
    {
        foreach (parent::$cities as $city) {
            $xml = file_get_contents('http://olx.ua/elektronika/foto-video/obektivy/' . $city . '/rss/');
            $movies = new \SimpleXMLElement($xml, LIBXML_NOCDATA);
            foreach ($movies->channel->item as $item) {
                if (self::productUnique(trim((string)$item->link))) {
                    preg_match("/Цена:\s\d(.*?)\sгрн/", $item->description, $m);
                    if (isset($m[0])) {
                        preg_match_all("/\d/", str_replace(" ", "", $m[0]), $prices);
                        foreach ($prices as $price) {
                            $model = new Items();
                            $model->product = trim((string)$item->title);
                            $model->price = implode('', $price);
                            $model->url = trim((string)$item->link);
                            $model->store = 'Olx';
                            $model->phone = parent::getPhoneNumber(trim((string)$item->link));
                            $model->subcategory_id = 69;
                            $model->options = '{"type":"obektivy","b/u":"1","city":"'.$city.'"}';
                            $model->save();
                        }
                    }
                }
            }
        }
    }

    public function saveParseOlxFotovspyshki()
    {
        foreach (parent::$cities as $city) {
            $xml = file_get_contents('http://olx.ua/elektronika/foto-video/fotovspyshki/' . $city . '/rss/');
            $movies = new \SimpleXMLElement($xml, LIBXML_NOCDATA);
            foreach ($movies->channel->item as $item) {
                if (self::productUnique(trim((string)$item->link))) {
                    preg_match("/Цена:\s\d(.*?)\sгрн/", $item->description, $m);
                    if (isset($m[0])) {
                        preg_match_all("/\d/", str_replace(" ", "", $m[0]), $prices);
                        foreach ($prices as $price) {
                            $model = new Items();
                            $model->product = trim((string)$item->title);
                            $model->price = implode('', $price);
                            $model->url = trim((string)$item->link);
                            $model->store = 'Olx';
                            $model->phone = parent::getPhoneNumber(trim((string)$item->link));
                            $model->subcategory_id = 69;
                            $model->options = '{"type":"fotovspyshki","b/u":"1","city":"'.$city.'"}';
                            $model->save();
                        }
                    }
                }
            }
        }
    }

    public function saveParseOlxAksessuaryFotoVideokamer()
    {
        foreach (parent::$cities as $city) {
            $xml = file_get_contents('http://olx.ua/elektronika/foto-video/aksessuary-dlya-foto-videokamer/' . $city . '/rss/');
            $movies = new \SimpleXMLElement($xml, LIBXML_NOCDATA);
            unset($xml);
            foreach ($movies->channel->item as $item) {
                if (self::productUnique(trim((string)$item->link))) {
                    preg_match("/Цена:\s\d(.*?)\sгрн/", $item->description, $m);
                    if (isset($m[0])) {
                        preg_match_all("/\d/", str_replace(" ", "", $m[0]), $prices);
                        foreach ($prices as $price) {
                            $model = new Items();
                            $model->product = trim((string)$item->title);
                            $model->price = implode('', $price);
                            $model->url = trim((string)$item->link);
                            $model->store = 'Olx';
                            $model->phone = parent::getPhoneNumber(trim((string)$item->link));
                            $model->subcategory_id = 69;
                            $model->options = '{"type":"aksessuary-foto-videokamer","b/u":"1","city":"'.$city.'"}';
                            $model->save();
                        }
                    }
                }
            }
        }
    }

    public function saveParseOlxShtativyMonopody()
    {
        foreach (parent::$cities as $city) {
            $xml = file_get_contents('http://olx.ua/elektronika/foto-video/shtativy-monopody/' . $city . '/rss/');
            $movies = new \SimpleXMLElement($xml, LIBXML_NOCDATA);
            unset($xml);
            foreach ($movies->channel->item as $item) {
                if (self::productUnique(trim((string)$item->link))) {
                    preg_match("/Цена:\s\d(.*?)\sгрн/", $item->description, $m);
                    if (isset($m[0])) {
                        preg_match_all("/\d/", str_replace(" ", "", $m[0]), $prices);
                        foreach ($prices as $price) {
                            $model = new Items();
                            $model->product = trim((string)$item->title);
                            $model->price = implode('', $price);
                            $model->url = trim((string)$item->link);
                            $model->store = 'Olx';
                            $model->phone = parent::getPhoneNumber(trim((string)$item->link));
                            $model->subcategory_id = 69;
                            $model->options = '{"type":"shtativy-monopody","b/u":"1","city":"'.$city.'"}';
                            $model->save();
                        }
                    }
                }
            }
        }
    }

    public function saveParseOlxSvetofiltry()
    {
        foreach (parent::$cities as $city) {
            $xml = file_get_contents('http://olx.ua/elektronika/foto-video/aksessuary-dlya-foto-videokamer/svetofiltry/' . $city . '/rss/');
            $movies = new \SimpleXMLElement($xml, LIBXML_NOCDATA);
            unset($xml);
            foreach ($movies->channel->item as $item) {
                if (self::productUnique(trim((string)$item->link))) {
                    preg_match("/Цена:\s\d(.*?)\sгрн/", $item->description, $m);
                    if (isset($m[0])) {
                        preg_match_all("/\d/", str_replace(" ", "", $m[0]), $prices);
                        foreach ($prices as $price) {
                            $model = new Items();
                            $model->product = trim((string)$item->title);
                            $model->price = implode('', $price);
                            $model->url = trim((string)$item->link);
                            $model->store = 'Olx';
                            $model->phone = parent::getPhoneNumber(trim((string)$item->link));
                            $model->subcategory_id = 69;
                            $model->options = '{"type":"svetofiltry","b/u":"1","city":"'.$city.'"}';
                            $model->save();
                        }
                    }
                }
            }
        }
    }

    public function saveParseOlxZaryadnye()
    {
        foreach (parent::$cities as $city) {
            $xml = file_get_contents('http://olx.ua/elektronika/foto-video/aksessuary-dlya-foto-videokamer/zaryadnye-ustroystva-akkumulyatory/' . $city . '/rss/');
            $movies = new \SimpleXMLElement($xml, LIBXML_NOCDATA);
            unset($xml);
            foreach ($movies->channel->item as $item) {
                if (self::productUnique(trim((string)$item->link))) {
                    preg_match("/Цена:\s\d(.*?)\sгрн/", $item->description, $m);
                    if (isset($m[0])) {
                        preg_match_all("/\d/", str_replace(" ", "", $m[0]), $prices);
                        foreach ($prices as $price) {
                            $model = new Items();
                            $model->product = trim((string)$item->title);
                            $model->price = implode('', $price);
                            $model->url = trim((string)$item->link);
                            $model->store = 'Olx';
                            $model->phone = parent::getPhoneNumber(trim((string)$item->link));
                            $model->subcategory_id = 69;
                            $model->options = '{"type":"zaryadnye-photo","b/u":"1","city":"'.$city.'"}';
                            $model->save();
                        }
                    }
                }
            }
        }
    }
    public function saveParseOlxSumki()
    {
        foreach (parent::$cities as $city) {
            $xml = file_get_contents('http://olx.ua/elektronika/foto-video/aksessuary-dlya-foto-videokamer/sumki/' . $city . '/rss/');
            $movies = new \SimpleXMLElement($xml, LIBXML_NOCDATA);
            unset($xml);
            foreach ($movies->channel->item as $item) {
                if (self::productUnique(trim((string)$item->link))) {
                    preg_match("/Цена:\s\d(.*?)\sгрн/", $item->description, $m);
                    if (isset($m[0])) {
                        preg_match_all("/\d/", str_replace(" ", "", $m[0]), $prices);
                        foreach ($prices as $price) {
                            $model = new Items();
                            $model->product = trim((string)$item->title);
                            $model->price = implode('', $price);
                            $model->url = trim((string)$item->link);
                            $model->store = 'Olx';
                            $model->phone = parent::getPhoneNumber(trim((string)$item->link));
                            $model->subcategory_id = 69;
                            $model->options = '{"type":"sumki-photo","b/u":"1","city":"'.$city.'"}';
                            $model->save();
                        }
                    }
                }
            }
        }
    }
}