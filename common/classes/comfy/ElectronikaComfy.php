<?php
namespace common\classes\comfy;

use common\models\Items;
use aayaresko\advancedhtmldom\AdvancedHtmlDom;

class ElectronikaComfy
{

    const PHONE = '0-800-303-505';
    /**
     * Проверка на уникальность записи
     * @param $url
     * @return bool
     */
    private static function productUnique($url)
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


    /**
     * Парсинг Comfy smartfon и сохранение результата в базу
     */
    private function saveParseComfyPlanshet()
    {
        set_time_limit(0);
        $file = 'http://comfy.ua/media/sitemap.xml';
        $links = [];

//    Формируем список урлов и сносим xml
        $xml = simplexml_load_file($file, "SimpleXMLElement", LIBXML_NOCDATA);
        $p_cnt = count($xml->url);
        for ($i = 0; $i < $p_cnt; $i++) {
            $item = $xml->url[$i];
            if (preg_match("/(http\:\/\/comfy\.ua\/planshetnyj\-komp\-juter)(.*?)(\.html)/", $item->loc)) {
                array_push($links, trim((string)$item->loc));
            }
            unset($item);
        }
        unset($xml);
        unset($p_cnt);

//    Проходим по списку урлов

        foreach ($links as $link) {

            if (self::productUnique($link)) {
                $page = new AdvancedHtmlDom();
                $page->load_file($link);
                $diagonal = null;
                $processor = null;
                $ozu = null;
                $not = $page->find('span[class=informerText]');
                if ($not->text()) {
                    $price = $page->find('span[class=price-value]')[0]->text();
                    $title = $page->find('h1[class=product-name]')[0]->text();
                    for ($i = 0; $i < $page->find('li.features__item dl')->count(); $i++) {
                        if (stripos($page->find('li.features__item dl')[$i]->text(), 'Диагональ')) {
                            $diagonal = $page->find('li.features__item dl')[$i]->text();
                        }
                        if (stripos($page->find('li.features__item dl')[$i]->text(), 'Количество ядер')) {
                            $processor = $page->find('li.features__item dl')[$i]->text();
                        }
                        if (stripos($page->find('li.features__item dl')[$i]->text(), 'Объем ОЗУ')) {
                            $ozu = $page->find('li.features__item dl')[$i]->text();
                        }
                    }
                    unset($page);
                    preg_match_all("/\-?\d+(\,\d{0,})?/", $diagonal, $diagonal);
                    preg_match_all("/\-?\d+(\,\d{0,})?/", $processor, $processor);
                    preg_match_all("/\-?\d+(\,\d{0,})?/", $ozu, $ozu);
                    if (isset($price) && isset($title) && $diagonal != null && $processor != null && $ozu != null) {
                        preg_match_all("/\d/", str_replace(" ", "", $price), $price);
                        $model = new Items();
                        $model->product = trim((string)$title);
                        $model->price = str_replace(",", ".", implode('', $price[0]));
                        $model->url = $link;
                        $model->store = 'Comfy';
                        $model->phone = self::PHONE;
                        $model->subcategory_id = 2;
                        $model->options = '{"type":"planshet","display":"' . implode('', $diagonal[0])
                            . '","processor":"' . implode('', $processor[0])
                            . '","ozu":"' . implode('', $ozu[0])
                            . '","b/u":"0"}';
                        $model->save();
                    }
                }
            }
        }
    }

    /**
     * Парсинг смартфонов comfy
     */
    private function saveParseComfySmart()
    {
        set_time_limit(0);
        $file = 'http://comfy.ua/media/sitemap.xml';
        $links = [];

//    Формируем список урлов и сносим xml
        $xml = simplexml_load_file($file, "SimpleXMLElement", LIBXML_NOCDATA);
        $p_cnt = count($xml->url);
        for ($i = 0; $i < $p_cnt; $i++) {
            $item = $xml->url[$i];
            if (preg_match("/(http\:\/\/comfy\.ua\/smartfon)(.*?)(\.html)/", $item->loc)) {
                array_push($links, trim((string)$item->loc));
            }
            unset($item);
        }
        unset($xml);
        unset($p_cnt);

//    Проходим по списку урлов

        foreach ($links as $link) {

            if (self::productUnique($link)) {
                $page = new AdvancedHtmlDom();
                $page->load_file($link);
                $diagonal = null;
                $processor = null;
                $ozu = null;
                $os = null;
                $not = $page->find('span[class=informerText]');
                if ($not->text()) {
                    $price = $page->find('span[class=price-value]')[0]->text();
                    $title = $page->find('h1[class=product-name]')[0]->text();
                    for ($i = 0; $i < $page->find('li.features__item dl')->count(); $i++) {
                        if (stripos($page->find('li.features__item dl')[$i]->text(), 'Диагональ дисплея')) {
                            $diagonal = $page->find('li.features__item dl')[$i]->text();
                        }
                        if (stripos($page->find('li.features__item dl')[$i]->text(), 'Количество ядер')) {
                            $processor = $page->find('li.features__item dl')[$i]->text();
                        }
                        if (stripos($page->find('li.features__item dl')[$i]->text(), 'Объем ОЗУ')) {
                            $ozu = $page->find('li.features__item dl')[$i]->text();
                        }
                        if (stripos($page->find('li.features__item dl')[$i]->text(), 'Операционная система')) {
                            $os = $page->find('li.features__item dl')[$i]->text();
                        }
                    }
                    unset($page);
                    preg_match_all("/\-?\d+(\,\d{0,})?/", $diagonal, $diagonal);
                    preg_match_all("/\-?\d+(\,\d{0,})?/", $processor, $processor);
                    preg_match_all("/\-?\d+(\,\d{0,})?/", $ozu, $ozu);
                    $os = split(":", $os);
                    if (isset($price) && isset($title) && $diagonal != null && $processor != null && $ozu != null && $os != null) {
                        preg_match_all("/\d/", str_replace(" ", "", $price), $price);
                        $model = new Items();
                        $model->product = trim((string)$title);
                        $model->price = str_replace(",", ".", implode('', $price[0]));
                        $model->url = $link;
                        $model->store = 'Comfy';
                        $model->phone = self::PHONE;
                        $model->subcategory_id = 1;
                        $model->options = '{"type":"smartphone","display":"' . implode('', $diagonal[0])
                            . '","processor":"' . implode('', $processor[0])
                            . '","ozu":"' . implode('', $ozu[0])
                            . '","os":"' . trim($os[1])
                            . '","b/u":"0"}';
                        $model->save();
                    }
                }
            }
        }
    }

    /**
     * Парсинг мобильных телефонов
     */
    private function saveParseComfyMob()
    {
        set_time_limit(0);
        $file = 'http://comfy.ua/media/sitemap.xml';
        $links = [];

//    Формируем список урлов и сносим xml
        $xml = simplexml_load_file($file, "SimpleXMLElement", LIBXML_NOCDATA);
        $p_cnt = count($xml->url);
        for ($i = 0; $i < $p_cnt; $i++) {
            $item = $xml->url[$i];
            if (preg_match("/(http\:\/\/comfy\.ua\/mobil\-nyj\-telefon)(.*?)(\.html)/", $item->loc)) {
                array_push($links, trim((string)$item->loc));
            }
            unset($item);
        }
        unset($xml);
        unset($p_cnt);

//    Проходим по списку урлов

        foreach ($links as $link) {

            if (self::productUnique($link)) {
                $page = new AdvancedHtmlDom();
                $page->load_file($link);
                $url = $link;
                $diagonal = null;
                $not = $page->find('span[class=informerText]');
                if ($not->text()) {
                    $price = $page->find('span[class=price-value]')[0]->text();
                    $title = $page->find('h1[class=product-name]')[0]->text();
                    for ($i = 0; $i < $page->find('li.features__item dl')->count(); $i++) {
                        if (stripos($page->find('li.features__item dl')[$i]->text(), 'Диагональ дисплея')) {
                            $diagonal = $page->find('li.features__item dl')[$i]->text();
                        }
                    }
                    unset($page);
                    preg_match_all("/\-?\d+(\,\d{0,})?/", $diagonal, $diagonal);
                    if (isset($price) && isset($title) && $diagonal != null) {
                        preg_match_all("/\d/", str_replace(" ", "", $price), $price);
                        $model = new Items();
                        $model->product = trim((string)$title);
                        $model->price = str_replace(",", ".", implode('', $price[0]));
                        $model->url = $url;
                        $model->store = 'Comfy';
                        $model->phone = self::PHONE;
                        $model->subcategory_id = 1;
                        $model->options = '{"type":"mob_phone","display":"' . implode('', $diagonal[0])  . '","b/u":"0"}';
                        $model->save();
                    }
                }
            }
        }
    }

    /**
     * Парсинг ноутбуков comfy
     */
    private function saveParseComfyNout()
    {
        set_time_limit(0);
        $file = 'http://comfy.ua/media/sitemap.xml';
        $links = [];

//    Формируем список урлов и сносим xml
        $xml = simplexml_load_file($file, "SimpleXMLElement", LIBXML_NOCDATA);
        $p_cnt = count($xml->url);
        for ($i = 0; $i < $p_cnt; $i++) {
            $item = $xml->url[$i];
            if (preg_match("/(http\:\/\/comfy\.ua\/noutbuk)(.*?)(\.html)/", $item->loc)) {
                array_push($links, trim((string)$item->loc));
            }
            unset($item);
        }
        unset($xml);
        unset($p_cnt);

//    Проходим по списку урлов

        foreach ($links as $link) {

            if (self::productUnique($link)) {
                $page = new AdvancedHtmlDom();
                $page->load_file($link);
                $url = $link;
                $diagonal = null;
                $processor = null;
                $ozu = null;
                $os = null;
                $not = $page->find('span[class=informerText]');
                if ($not->text()) {
                    $price = $page->find('span[class=price-value]')[0]->text();
                    $title = $page->find('h1[class=product-name]')[0]->text();
                    for ($i = 0; $i < $page->find('li.features__item dl')->count(); $i++) {
                        if (stripos($page->find('li.features__item dl')[$i]->text(), 'Диагональ')) {
                            $diagonal = $page->find('li.features__item dl')[$i]->text();
                        }
                        if (stripos($page->find('li.features__item dl')[$i]->text(), 'Количество ядер')) {
                            $processor = $page->find('li.features__item dl')[$i]->text();
                        }
                        if (stripos($page->find('li.features__item dl')[$i]->text(), 'Объем ОЗУ')) {
                            $ozu = $page->find('li.features__item dl')[$i]->text();
                        }
                        if (stripos($page->find('li.features__item dl')[$i]->text(), 'Операционная система')) {
                            $os = $page->find('li.features__item dl')[$i]->text();
                        }
                    }
                    unset($page);
                    if (isset($price) && isset($title) && $diagonal != null && $processor != null && $ozu != null && $os != null) {
                        $os = split(":", $os);
                        preg_match("/\-?\d+(\,\d{0,})?/", $diagonal, $diagonal);
                        preg_match("/\-?\d+(\,\d{0,})?/", $processor, $processor);
                        preg_match_all("/\-?\d+(\,\d{0,})?/", $ozu, $ozu);
                        preg_match_all("/\d/", str_replace(" ", "", $price), $price);
                        $model = new Items();
                        $model->product = trim((string)$title);
                        $model->price = str_replace(",", ".", implode('', $price[0]));
                        $model->url = $url;
                        $model->store = 'Comfy';
                        $model->phone = self::PHONE;
                        $model->subcategory_id = 2;
                        $model->options = '{"type":"noutbuk","display":"' . $diagonal[0]
                            . '","processor":"' . $processor[0]
                            . '","ozu":"' . implode('', $ozu[0])
                            . '","os":"' . trim($os[1])
                            . '","b/u":"0"}';
                        $model->save();
                    }
                }
            }
        }
    }

    /**
     * Парсер наушников
     */
    private function saveParseComfyHeadphones()
    {
        set_time_limit(0);
        $file = 'http://comfy.ua/media/sitemap.xml';
        $links = [];

//    Формируем список урлов и сносим xml
        $xml = simplexml_load_file($file, "SimpleXMLElement", LIBXML_NOCDATA);
        $p_cnt = count($xml->url);
        for ($i = 0; $i < $p_cnt; $i++) {
            $item = $xml->url[$i];
            if (preg_match("/(http\:\/\/comfy\.ua\/naushniki)(.*?)(\.html)/", $item->loc)) {
                array_push($links, trim((string)$item->loc));
            }
            unset($item);
        }
        unset($xml);
        unset($p_cnt);

//    Проходим по списку урлов

        foreach ($links as $link) {

            if (self::productUnique($link)) {
                $page = new AdvancedHtmlDom();
                $page->load_file($link);
                $url = $link;
                $type_naushniki = null;
                $not = $page->find('span[class=informerText]');
                if ($not->text()) {
                    $price = $page->find('span[class=price-value]')[0]->text();
                    $title = $page->find('h1[class=product-name]')[0]->text();
                    for ($i = 0; $i < $page->find('li.features__item dl')->count(); $i++) {
                        if (stripos($page->find('li.features__item dl')[$i]->text(), 'Тип')) {
                            $type_naushniki = $page->find('li.features__item dl')[$i]->text();
                            break;
                        }
                    }
                    unset($page);
                    if (isset($price) && isset($title) && $type_naushniki != null) {
                        $type_naushniki = split(":", $type_naushniki);
                        preg_match_all("/\d/", str_replace(" ", "", $price), $price);
                        $model = new Items();
                        $model->product = trim((string)$title);
                        $model->price = str_replace(",", ".", implode('', $price[0]));
                        $model->url = $url;
                        $model->store = 'Comfy';
                        $model->phone = self::PHONE;
                        $model->subcategory_id = 3;
                        $model->options = '{"type":"headphones","type_naushnikov":"' . trim($type_naushniki[1]) . '","b/u":"0"}';
                        $model->save();
                    }
                }
            }
        }
    }

    /**
     * Парсер мп3 плееров
     */
    private function saveParseComfyMP3Player()
    {
        set_time_limit(0);
        $file = 'http://comfy.ua/media/sitemap.xml';
        $links = [];

//    Формируем список урлов и сносим xml
        $xml = simplexml_load_file($file, "SimpleXMLElement", LIBXML_NOCDATA);
        $p_cnt = count($xml->url);
        for ($i = 0; $i < $p_cnt; $i++) {
            $item = $xml->url[$i];
            if (preg_match("/(http\:\/\/comfy\.ua\/mp3\-pleer)(.*?)(\.html)/", $item->loc)) {
                array_push($links, trim((string)$item->loc));
            }
            unset($item);
        }
        unset($xml);
        unset($p_cnt);

//    Проходим по списку урлов

        foreach ($links as $link) {

            if (self::productUnique($link)) {
                $page = new AdvancedHtmlDom();
                $page->load_file($link);
                $url = $link;
                $memory = null;
                $not = $page->find('span[class=informerText]');
                if ($not->text()) {
                    $price = $page->find('span[class=price-value]')[0]->text();
                    $title = $page->find('h1[class=product-name]')[0]->text();
                    for ($i = 0; $i < $page->find('li.features__item dl')->count(); $i++) {
                        if (stripos($page->find('li.features__item dl')[$i]->text(), 'Объем встроенной памяти')) {
                            $memory = $page->find('li.features__item dl')[$i]->text();
                            break;
                        }
                    }
                    unset($page);
                    preg_match_all("/\-?\d+(\,\d{0,})?/", $memory, $memory);
                    if (isset($price) && isset($title) && $memory != null) {
                        preg_match_all("/\d/", str_replace(" ", "", $price), $price);
                        $model = new Items();
                        $model->product = trim((string)$title);
                        $model->price = str_replace(",", ".", implode('', $price[0]));
                        $model->url = $url;
                        $model->store = 'Comfy';
                        $model->phone = self::PHONE;
                        $model->subcategory_id = 3;
                        $model->options = '{"type":"mp3-player","memory":"' . implode('', $memory[0])  . '","b/u":"0"}';
                        $model->save();
                    }
                }
            }
        }
    }

    /**
     * Парсинг домашних кинотеатров
     */
    private function saveParseComfyKinoteatr()
    {
        set_time_limit(0);
        $file = 'http://comfy.ua/media/sitemap.xml';
        $links = [];

//    Формируем список урлов и сносим xml
        $xml = simplexml_load_file($file, "SimpleXMLElement", LIBXML_NOCDATA);
        $p_cnt = count($xml->url);
        for ($i = 0; $i < $p_cnt; $i++) {
            $item = $xml->url[$i];
            if (preg_match("/(http\:\/\/comfy\.ua\/domashnij\-kinoteatr)(.*?)(\.html)/", $item->loc)) {
                array_push($links, trim((string)$item->loc));
            }
            unset($item);
        }
        unset($xml);
        unset($p_cnt);

//    Проходим по списку урлов

        foreach ($links as $link) {

            if (self::productUnique($link)) {
                $page = new AdvancedHtmlDom();
                $page->load_file($link);
                $url = $link;
                $type = null;
                $power = null;
                $not = $page->find('span[class=informerText]');
                if ($not->text()) {
                    $price = $page->find('span[class=price-value]')[0]->text();
                    $title = $page->find('h1[class=product-name]')[0]->text();
                    for ($i = 0; $i < $page->find('li.features__item dl')->count(); $i++) {
                        if (stripos($page->find('li.features__item dl')[$i]->text(), 'Тип кинотеатра')) {
                            $type = $page->find('li.features__item dl')[$i]->text();
                        }
                        if (stripos($page->find('li.features__item dl')[$i]->text(), 'Номинальная мощность')) {
                            $power = $page->find('li.features__item dl')[$i]->text();
                        }
                        if (!empty($type) && !empty($power)) {
                            break;
                        }
                    }
                    unset($page);
                    preg_match_all("/\-?\d+(\,\d{0,})?/", $power, $power);
                    if (isset($price) && isset($title) && $type != null && $power != null) {
                        preg_match_all("/\d/", str_replace(" ", "", $price), $price);
                        $type = split(":", $type);
                        $model = new Items();
                        $model->product = trim((string)$title);
                        $model->price = str_replace(",", ".", implode('', $price[0]));
                        $model->url = $url;
                        $model->store = 'Comfy';
                        $model->phone = self::PHONE;
                        $model->subcategory_id = 3;
                        $model->options = '{"type":"kinoteatr","type_kinoteatra":"' . trim($type[1])
                            . '","power":"' . implode('', $power[0])
                            . '","b/u":"0"}';
                        $model->save();
                    }
                }
            }
        }
    }

    /**
     * Парсинг медиа-плееров
     */
    private function saveParseComfyMediaPlayer()
    {
        set_time_limit(0);
        $file = 'http://comfy.ua/media/sitemap.xml';
        $links = [];

//    Формируем список урлов и сносим xml
        $xml = simplexml_load_file($file, "SimpleXMLElement", LIBXML_NOCDATA);
        $p_cnt = count($xml->url);
        for ($i = 0; $i < $p_cnt; $i++) {
            $item = $xml->url[$i];
            if (preg_match("/(http\:\/\/comfy\.ua\/stacionarnyj\-mediapleer)(.*?)(\.html)/", $item->loc)) {
                array_push($links, trim((string)$item->loc));
            }
            unset($item);
        }
        unset($xml);
        unset($p_cnt);

//    Проходим по списку урлов

        foreach ($links as $link) {

            if (self::productUnique($link)) {
                $page = new AdvancedHtmlDom();
                $page->load_file($link);
                $url = $link;
                $category = null;
                $not = $page->find('span[class=informerText]');
                if ($not->text()) {
                    $price = $page->find('span[class=price-value]')[0]->text();
                    $title = $page->find('h1[class=product-name]')[0]->text();
                    for ($i = 0; $i < $page->find('li.features__item dl')->count(); $i++) {
                        if (stripos($page->find('li.features__item dl')[$i]->text(), 'Категория устройства')) {
                            $category = $page->find('li.features__item dl')[$i]->text();
                            break;
                        }
                    }
                    unset($page);
                    if (isset($price) && isset($title) && $category != null) {
                        $category = split(":", $category);
                        preg_match_all("/\d/", str_replace(" ", "", $price), $price);
                        $model = new Items();
                        $model->product = trim((string)$title);
                        $model->price = str_replace(",", ".", implode('', $price[0]));
                        $model->url = $url;
                        $model->store = 'Comfy';
                        $model->phone = self::PHONE;
                        $model->subcategory_id = 3;
                        $model->options = '{"type":"media-player","category":"' . trim($category[1]) . '","b/u":"0"}';
                        $model->save();
                    }
                }
            }
        }
    }

    /**
     * Парсинг пылесосов
     */
    private function saveParseComfyPilesosi()
    {
        set_time_limit(0);
        $file = 'http://comfy.ua/media/sitemap.xml';
        $links = [];

//    Формируем список урлов и сносим xml
        $xml = simplexml_load_file($file, "SimpleXMLElement", LIBXML_NOCDATA);
        $p_cnt = count($xml->url);
        for ($i = 0; $i < $p_cnt; $i++) {
            $item = $xml->url[$i];
            if (preg_match("/(http\:\/\/comfy\.ua\/pylesos\-dlja\-suhoj\-uborki)(.*?)(\.html)/", $item->loc)) {
                array_push($links, trim((string)$item->loc));
            }
            unset($item);
        }
        unset($xml);
        unset($p_cnt);

//    Проходим по списку урлов

        foreach ($links as $link) {

            if (self::productUnique($link)) {
                $page = new AdvancedHtmlDom();
                $page->load_file($link);
                $url = $link;
                $type_pilesos = null;
                $power_pilesos = null;
                $not = $page->find('span[class=informerText]');
                if ($not->text()) {
                    $price = $page->find('span[class=price-value]')[0]->text();
                    $title = $page->find('h1[class=product-name]')[0]->text();
                    for ($i = 0; $i < $page->find('li.features__item dl')->count(); $i++) {
                        if (stripos($page->find('li.features__item dl')[$i]->text(), 'Тип пылесоса')) {
                            $type_pilesos = $page->find('li.features__item dl')[$i]->text();
                        }
                        if (stripos($page->find('li.features__item dl')[$i]->text(), 'Мощность всасывания:')) {
                            $power_pilesos = $page->find('li.features__item dl')[$i]->text();
                        }
                        if (!empty($type_pilesos) && !empty($power_pilesos)) {
                            break;
                        }
                    }
                    unset($page);
                    if (isset($price) && isset($title) && $type_pilesos != null && $power_pilesos != null) {
                        $type_pilesos = split(":", $type_pilesos);
                        $power_pilesos = split(":", $power_pilesos);
                        preg_match_all("/\d/", str_replace(" ", "", $price), $price);
                        $model = new Items();
                        $model->product = trim((string)$title);
                        $model->price = str_replace(",", ".", implode('', $price[0]));
                        $model->url = $url;
                        $model->store = 'Comfy';
                        $model->phone = self::PHONE;
                        $model->subcategory_id = 4;
                        $model->options = '{"type":"pilesosi","type_pilesos":"' . trim($type_pilesos[1])
                            . '","power_pilesos":"' . trim($power_pilesos[1])
                            . '","b/u":"0"}';
                        $model->save();
                    }
                }
            }
        }
    }

    /**
     * Парсинг газовых плит
     */
    private function saveParseComfyPliti()
    {
        set_time_limit(0);
        $file = 'http://comfy.ua/media/sitemap.xml';
        $links = [];

//    Формируем список урлов и сносим xml
        $xml = simplexml_load_file($file, "SimpleXMLElement", LIBXML_NOCDATA);
        $p_cnt = count($xml->url);
        for ($i = 0; $i < $p_cnt; $i++) {
            $item = $xml->url[$i];
            if (preg_match("/(http\:\/\/comfy\.ua\/plita\-gazovaja)(.*?)(\.html)/", $item->loc)) {
                array_push($links, trim((string)$item->loc));
            }
            unset($item);
        }
        unset($xml);
        unset($p_cnt);

//    Проходим по списку урлов

        foreach ($links as $link) {

            if (self::productUnique($link)) {
                $page = new AdvancedHtmlDom();
                $page->load_file($link);
                $url = $link;
                $type_pliti = null;
                $type_shkafa = null;
                $type_panel = null;
                $not = $page->find('span[class=informerText]');
                if ($not->text()) {
                    $price = $page->find('span[class=price-value]')[0]->text();
                    $title = $page->find('h1[class=product-name]')[0]->text();
                    for ($i = 0; $i < $page->find('li.features__item dl')->count(); $i++) {
                        if (stripos($page->find('li.features__item dl')[$i]->text(), 'Тип плиты')) {
                            $type_pliti = $page->find('li.features__item dl')[$i]->text();
                        }
                        if (stripos($page->find('li.features__item dl')[$i]->text(), 'Тип духового шкафа')) {
                            $type_shkafa = $page->find('li.features__item dl')[$i]->text();
                        }
                        if (stripos($page->find('li.features__item dl')[$i]->text(), 'Тип варочной панели')) {
                            $type_panel = $page->find('li.features__item dl')[$i]->text();
                        }
                        if (!empty($type_pliti) && !empty($type_shkafa) && !empty($type_panel)) {
                            break;
                        }
                    }
                    unset($page);
                    if (isset($price) && isset($title) && $type_pliti != null && $type_shkafa != null
                        && $type_panel != null
                    ) {
                        $type_pliti = split(":", $type_pliti);
                        $type_shkafa = split(":", $type_shkafa);
                        $type_panel = split(":", $type_panel);
                        preg_match_all("/\d/", str_replace(" ", "", $price), $price);
                        $model = new Items();
                        $model->product = trim((string)$title);
                        $model->price = str_replace(",", ".", implode('', $price[0]));
                        $model->url = $url;
                        $model->store = 'Comfy';
                        $model->phone = self::PHONE;
                        $model->subcategory_id = 4;
                        $model->options = '{"type":"pliti","type_pliti":"' . trim($type_pliti[1])
                            . '","type_shkafa":"' . trim($type_shkafa[1])
                            . '","type_panel":"' . trim($type_panel[1])
                            . '","b/u":"0"}';
                        $model->save();
                    }
                }
            }
        }
    }

    /**
     * Парсинг микроволновок
     */
    private function saveParseComfyMicrowave()
    {
        set_time_limit(0);
        $file = 'http://comfy.ua/media/sitemap.xml';
        $links = [];

//    Формируем список урлов и сносим xml
        $xml = simplexml_load_file($file, "SimpleXMLElement", LIBXML_NOCDATA);
        $p_cnt = count($xml->url);
        for ($i = 0; $i < $p_cnt; $i++) {
            $item = $xml->url[$i];
            if (preg_match("/(http\:\/\/comfy\.ua\/svch\-pech)(.*?)(\.html)/", $item->loc)) {
                array_push($links, trim((string)$item->loc));
            }
            unset($item);
        }
        unset($xml);
        unset($p_cnt);

//    Проходим по списку урлов

        foreach ($links as $link) {

            if (self::productUnique($link)) {
                $page = new AdvancedHtmlDom();
                $page->load_file($link);
                $url = $link;
                $type_svch = null;
                $type_volume = null;
                $type_control = null;
                $not = $page->find('span[class=informerText]');
                if ($not->text()) {
                    $price = $page->find('span[class=price-value]')[0]->text();
                    $title = $page->find('h1[class=product-name]')[0]->text();
                    for ($i = 0; $i < $page->find('li.features__item dl')->count(); $i++) {
                        if (stripos($page->find('li.features__item dl')[$i]->text(), 'Тип СВЧ')) {
                            $type_svch = $page->find('li.features__item dl')[$i]->text();
                        }
                        if (stripos($page->find('li.features__item dl')[$i]->text(), 'Объем камеры')) {
                            $type_volume = $page->find('li.features__item dl')[$i]->text();
                        }
                        if (stripos($page->find('li.features__item dl')[$i]->text(), 'Тип управления')) {
                            $type_control = $page->find('li.features__item dl')[$i]->text();
                        }
                        if (!empty($type_svch) && !empty($type_volume) && !empty($type_control)) {
                            break;
                        }
                    }
                    unset($page);
                    if (isset($price) && isset($title) && $type_svch != null && $type_volume != null
                        && $type_control != null
                    ) {
                        $type_svch = split(":", $type_svch);
                        $type_volume = split(":", $type_volume);
                        $type_control = split(":", $type_control);
                        preg_match_all("/\d/", str_replace(" ", "", $price), $price);
                        $model = new Items();
                        $model->product = trim((string)$title);
                        $model->price = str_replace(",", ".", implode('', $price[0]));
                        $model->url = $url;
                        $model->store = 'Comfy';
                        $model->phone = self::PHONE;
                        $model->subcategory_id = 4;
                        $model->options = '{"type":"microwave","type_svch":"' . trim($type_svch[1])
                            . '","type_volume":"' . trim($type_volume[1])
                            . '","type_control":"' . trim($type_control[1])
                            . '","b/u":"0"}';
                        $model->save();
                    }
                }
            }
        }
    }

    /**
     * Парсинг холодильников
     */
    private function saveParseComfyFridges()
    {
        set_time_limit(0);
        $file = 'http://comfy.ua/media/sitemap.xml';
        $links = [];

//    Формируем список урлов и сносим xml
        $xml = simplexml_load_file($file, "SimpleXMLElement", LIBXML_NOCDATA);
        $p_cnt = count($xml->url);
        for ($i = 0; $i < $p_cnt; $i++) {
            $item = $xml->url[$i];
            if (preg_match("/(http\:\/\/comfy\.ua\/holodil\-nik)(.*?)(\.html)/", $item->loc)) {
                array_push($links, trim((string)$item->loc));
            }
            unset($item);
        }
        unset($xml);
        unset($p_cnt);

//    Проходим по списку урлов

        foreach ($links as $link) {

            if (self::productUnique($link)) {
                $page = new AdvancedHtmlDom();
                $page->load_file($link);
                $url = $link;
                $type_fridges = null;
                $type_system = null;
                $not = $page->find('span[class=informerText]');
                if ($not->text()) {
                    $price = $page->find('span[class=price-value]')[0]->text();
                    $title = $page->find('h1[class=product-name]')[0]->text();
                    for ($i = 0; $i < $page->find('li.features__item dl')->count(); $i++) {
                        if (stripos($page->find('li.features__item dl')[$i]->text(), 'Тип холодильника')) {
                            $type_fridges = $page->find('li.features__item dl')[$i]->text();
                        }
                        if (stripos($page->find('li.features__item dl')[$i]->text(), 'Система охлаждения холодильной камеры')) {
                            $type_system = $page->find('li.features__item dl')[$i]->text();
                        }
                        if (!empty($type_fridges) && !empty($type_system)) {
                            break;
                        }
                    }
                    unset($page);
                    if (isset($price) && isset($title) && $type_fridges != null && $type_system != null) {
                        $type_fridges = split(":", $type_fridges);
                        $type_system = split(":", $type_system);
                        preg_match_all("/\d/", str_replace(" ", "", $price), $price);
                        $model = new Items();
                        $model->product = trim((string)$title);
                        $model->price = str_replace(",", ".", implode('', $price[0]));
                        $model->url = $url;
                        $model->store = 'Comfy';
                        $model->phone = self::PHONE;
                        $model->subcategory_id = 4;
                        $model->options = '{"type":"fridges","type_fridges":"' . trim($type_fridges[1])
                            . '","type_system":"' . trim($type_system[1])
                            . '","b/u":"0"}';
                        $model->save();
                    }
                }
            }
        }
    }

    /**
     * Парсинг Стиральных машин
     */
    private function saveParseComfyWasher()
    {
        set_time_limit(0);
        $file = 'http://comfy.ua/media/sitemap.xml';
        $links = [];

//    Формируем список урлов и сносим xml
        $xml = simplexml_load_file($file, "SimpleXMLElement", LIBXML_NOCDATA);
        $p_cnt = count($xml->url);
        for ($i = 0; $i < $p_cnt; $i++) {
            $item = $xml->url[$i];
            if (preg_match("/(http\:\/\/comfy\.ua\/stiral\-naja\-mashina)(.*?)(\.html)/", $item->loc)) {
                array_push($links, trim((string)$item->loc));
            }
            unset($item);
        }
        unset($xml);
        unset($p_cnt);

//    Проходим по списку урлов

        foreach ($links as $link) {

            if (self::productUnique($link)) {
                $page = new AdvancedHtmlDom();
                $page->load_file($link);
                $url = $link;
                $type_washer = null;
                $max_load = null;
                $not = $page->find('span[class=informerText]');
                if ($not->text()) {
                    $price = $page->find('span[class=price-value]')[0]->text();
                    $title = $page->find('h1[class=product-name]')[0]->text();
                    for ($i = 0; $i < $page->find('li.features__item dl')->count(); $i++) {
                        if (stripos($page->find('li.features__item dl')[$i]->text(), 'Тип стиральной машины')) {
                            $type_washer = $page->find('li.features__item dl')[$i]->text();
                        }
                        if (stripos($page->find('li.features__item dl')[$i]->text(), 'Макс. загрузка')) {
                            $max_load = $page->find('li.features__item dl')[$i]->text();
                        }
                        if (!empty($type_washer) && !empty($max_load)) {
                            break;
                        }
                    }
                    unset($page);
                    if (isset($price) && isset($title) && $type_washer != null && $max_load != null) {
                        $type_washer = split(":", $type_washer);
                        $max_load = split(":", $max_load);
                        preg_match_all("/\d/", str_replace(" ", "", $price), $price);
                        $model = new Items();
                        $model->product = trim((string)$title);
                        $model->price = str_replace(",", ".", implode('', $price[0]));
                        $model->url = $url;
                        $model->store = 'Comfy';
                        $model->phone = self::PHONE;
                        $model->subcategory_id = 4;
                        $model->options = '{"type":"washer","type_washer":"' . trim($type_washer[1])
                            . '","max_load":"' . trim($max_load[1])
                            . '","b/u":"0"}';
                        $model->save();
                    }
                }
            }
        }
    }

    /**
     * Парсинг по всем категориям
     */
    public function initComfy(){
        $this->saveParseComfySmart();
        $this->saveParseComfyMob();
        $this->saveParseComfyNout();
        $this->saveParseComfyPlanshet();
        $this->saveParseComfyHeadphones();
        $this->saveParseComfyMP3Player();
        $this->saveParseComfyKinoteatr();
        $this->saveParseComfyMediaPlayer();
        $this->saveParseComfyPilesosi();
        $this->saveParseComfyPliti();
        $this->saveParseComfyFridges();
        $this->saveParseComfyMicrowave();
        $this->saveParseComfyWasher();
    }
}