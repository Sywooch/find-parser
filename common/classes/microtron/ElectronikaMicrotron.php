<?php

namespace common\classes\microtron;

use common\models\Items;
use aayaresko\advancedhtmldom\AdvancedHtmlDom;
use wapmorgan\UnifiedArchive\UnifiedArchive;
use Yii;


class ElectronikaMicrotron
{

    const PHONE = '061-216-0008';

    public static function productUnique($url)
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

    public function genMicrotronData()
    {

        $url = "http://www.microtron.ua/price/mt1.zip";
        $path = Yii::$app->basePath . "/web/uploads/microtron/";
        $filename = $path . "mt1.zip";
        /* Download zip*/
        file_put_contents($filename, file_get_contents($url));
        /* Extract zip*/
        $res = UnifiedArchive::open($filename);
        $res->extractNode($path);
        /* Work with xls*/
        $xls = $path . $res->getFileNames()[0];
        $objReader = \PHPExcel_IOFactory::createReader(\PHPExcel_IOFactory::identify($xls));
        $objReader->setReadDataOnly(true);
        $objPHPExcelReader = $objReader->load($xls);
        $data = [];
        $sheet = $objPHPExcelReader->getSheet(0);
        $highestRow = $sheet->getHighestRow();
        $highestColumn = $sheet->getHighestColumn();
        for ($row = 1; $row <= $highestRow; $row++) {
            $data[] = $sheet->rangeToArray('A' . $row . ':' . $highestColumn . $row,
                NULL,
                TRUE,
                FALSE
            );
        }
        foreach ($data as &$item) {
            foreach ($item as &$sub) {
                $sub = array_filter($sub);
            }
            $item = array_filter($item);
        }
        $data = array_filter(array_slice($data, 8, count($data), true));
        foreach ($data as &$sub) {
            if (isset($sub[0])) {
                $sub = $sub[0];
                if (is_string($sub[0])) {
                    $sub = '';
                }
            } else {
                $sub = null;
            }
        }
        $data = array_filter($data);

        $response = [];

        foreach ($data as $item) {
            $response[] = array(
                "product" => $item[1],
                "price" => isset($item[7]) ? $item[7] : "",
                "url" => $item[10],
                "store" => "microtron"
            );
        }

        return $response;


    }

    public function saveMicrotronSmart($item)
    {
        if (self::productUnique($item['url'])) {
            $url = $item['url'];
            $params = explode(' ', $item['product']);
            $diagonal = null;
            $processor = null;
            $ozu = null;
            $price = $item['price'];
            $title = $item['product'];
            for ($i = 0; $i < count($params); $i++) {
                if (preg_match("/\"/", $params[$i])) {
                    $diagonal = $params[$i];
                }
                if (preg_match("/Ram/", $params[$i])) {
                    $ozu = $params[$i + 1];
                }

            }
            preg_match_all("/\-?\d+(\,\d{0,})?/", $diagonal, $diagonal);
            preg_match_all("/\-?\d+(\,\d{0,})?/", $processor, $processor);
            preg_match_all("/\-?\d+(\,\d{0,})?/", $ozu, $ozu);
            if (isset($price) && isset($title) && $diagonal != null && $processor != null && $ozu != null) {
                preg_match_all("/\d/", str_replace(" ", "", $price), $price);
                $model = new Items();
                $model->product = trim((string)$title);
                $model->price = implode('', $price[0]);
                $model->url = $url;
                $model->store = 'Microtron';
                $model->phone = self::PHONE;
                $model->subcategory_id = 1;
                $model->options = '{"type":"smartphone","display":"' . implode('', $diagonal[0])
                    . '","processor":"' . implode('', $processor[0])
                    . '","ozu":"' . implode('', $ozu[0])
                    . '","b/u":"0"}';
                $model->save();
            }
        }
    }


    public function saveMicrotronMobile($item)
    {
        if (self::productUnique($item['url'])) {
            $url = $item['url'];
            $diagonal = null;
            $price = $item['price'];
            $title = $item['product'];
            $params = explode(' ', $item['product']);
            for ($i = 0; $i < count($params); $i++) {
                if (preg_match("/\"/", $params[$i])) {
                    $diagonal = $params[$i];
                }
            }
            preg_match_all("/([0-9,]|[0-9])/", $diagonal, $diagonal);
            if (isset($price) && isset($title) && $diagonal != null) {
                preg_match_all("/\d/", str_replace(" ", "", $price), $price);
                $model = new Items();
                $model->product = trim((string)$title);
                $model->price = implode('', $price[0]);
                $model->url = $url;
                $model->store = 'Microtron';
                $model->phone = self::PHONE;
                $model->subcategory_id = 1;
                $model->options = '{"type":"mob_phone","display":"' . implode('', $diagonal[0]) . '","b/u":"0"}';
                $model->save();
            }
        }

    }

    public function saveMicrotronNout($item)
    {
        if (self::productUnique($item['url'])) {
            $url = $item['url'];
            $diagonal = null;
            $processor = null;
            $ozu = null;
            $os = null;
            $price = $item['price'];
            $title = $item['product'];
            $params = explode(' ', $item['product']);
            for ($i = 0; $i < count($params); $i++) {
                if (preg_match("/\"/", $params[$i])) {
                    $diagonal = $params[$i];
                }
                if (preg_match("/DDR/", $params[$i])) {
                    $ozu = $params[$i + 1];
                }
            }
            preg_match_all("/\-?\d+(\,\d{0,})?/", $diagonal, $diagonal);
            preg_match_all("/\-?\d+(\,\d{0,})?/", $processor, $processor);
            preg_match_all("/\-?\d+(\,\d{0,})?/", $ozu, $ozu);
            if (isset($price) && isset($title) && $diagonal != null && $ozu != null) {
                preg_match_all("/\d/", str_replace(" ", "", $price), $price);
                $model = new Items();
                $model->product = trim((string)$title);
                $model->price = implode('', $price[0]);
                $model->url = $url;
                $model->store = 'Microtron';
                $model->phone = self::PHONE;
                $model->subcategory_id = 2;
                $model->options = '{"type":"noutbuk","display":"' . implode('', $diagonal[0])
                    . '","ozu":"' . implode('', $ozu[0])
                    . '","b/u":"0"}';
                $model->save();
            }
        }

    }

    public function saveMicrotronPlanshet($item)
    {
        if (self::productUnique($item['url'])) {
            $url = $item['url'];
            $diagonal = null;
            $processor = null;
            $ozu = null;
            $price = $item['price'];
            $title = $item['product'];
            $params = explode(' ', $item['product']);
            for ($i = 0; $i < count($params); $i++) {
                if (preg_match("/\"/", $params[$i])) {
                    $diagonal = $params[$i];
                }
                if (preg_match("/RAM/", $params[$i]) || preg_match("/ОЗУ/", $params[$i])) {
                    $ozu = $params[$i + 1];;
                }
            }
            preg_match_all("/\-?\d+(\,\d{0,})?/", $diagonal, $diagonal);
            preg_match_all("/\-?\d+(\,\d{0,})?/", $processor, $processor);
            preg_match_all("/\-?\d+(\,\d{0,})?/", $ozu, $ozu);
            if (isset($price) && isset($title) && $diagonal != null && $ozu != null) {
                preg_match_all("/\d/", str_replace(" ", "", $price), $price);
                $model = new Items();
                $model->product = trim((string)$title);
                $model->price = implode('', $price[0]);
                $model->url = $url;
                $model->store = 'Microtron';
                $model->phone = self::PHONE;
                $model->subcategory_id = 2;
                $model->options = '{"type":"planshet","display":"' . implode('', $diagonal[0])
                    . '","ozu":"' . implode('', $ozu[0])
                    . '","b/u":"0"}';
                $model->save();
            }
        }
    }

    public function saveMicrotronHeadphones($item)
    {
        if (self::productUnique($item['url'])) {
            $url = $item['url'];
            $price = $item['price'];
            $title = $item['product'];
            if (isset($price) && isset($title)) {
                preg_match_all("/\d/", str_replace(" ", "", $price), $price);
                $model = new Items();
                $model->product = trim((string)$title);
                $model->price = implode('', $price[0]);
                $model->url = $url;
                $model->store = 'Microtron';
                $model->phone = self::PHONE;
                $model->subcategory_id = 3;
                $model->options = '{"type":"headphones"}';
                $model->save();
            }
        }
    }

    public function saveMicrotronMp3Player($item)
    {
        if (self::productUnique($item['url'])) {
            $url = $item['url'];
            $price = $item['price'];
            $title = $item['product'];
            if (isset($price) && isset($title)) {
                preg_match_all("/\d/", str_replace(" ", "", $price), $price);
                $model = new Items();
                $model->product = trim((string)$title);
                $model->price = implode('', $price[0]);
                $model->url = $url;
                $model->store = 'Microtron';
                $model->phone = self::PHONE;
                $model->subcategory_id = 3;
                $model->options = '{"type":"mp3-player"}';
                $model->save();
            }
        }
    }

    public function saveMicrotronTv($item)
    {
        if (self::productUnique($item['url'])) {
            $url = $item['url'];
            $diagonal = null;
            $price = $item['price'];
            $title = $item['product'];
            $params = explode(' ', $item['product']);
            for ($i = 0; $i < count($params); $i++) {
                if (preg_match("/\"/", $params[$i])) {
                    $diagonal = $params[$i];
                }
            }
            preg_match_all("/\-?\d+(\,\d{0,})?/", $diagonal, $diagonal);
            if (isset($price) && isset($title) && $diagonal) {
                preg_match_all("/\d/", str_replace(" ", "", $price), $price);
                $model = new Items();
                $model->product = trim((string)$title);
                $model->price = implode('', $price[0]);
                $model->url = $url;
                $model->store = 'Microtron';
                $model->phone = self::PHONE;
                $model->subcategory_id = 3;
                $model->options = '{"type":"tv","display":"' . implode('', $diagonal[0]) . '","b/u":"0"}';
                $model->save();
            }
        }
    }

    public function saveMicrotronFridges($item)
    {
        if (self::productUnique($item['url'])) {
            $url = $item['url'];
            $price = $item['price'];
            $title = $item['product'];
            if (isset($price) && isset($title)) {
                preg_match_all("/\d/", str_replace(" ", "", $price), $price);
                $model = new Items();
                $model->product = trim((string)$title);
                $model->price = implode('', $price[0]);
                $model->url = $url;
                $model->store = 'Microtron';
                $model->phone = self::PHONE;
                $model->subcategory_id = 4;
                $model->options = '{"type":"fridges"}';
                $model->save();
            }
        }
    }

    public function saveMicrotronPilesosi($item)
    {
        if (self::productUnique($item['url'])) {
            $url = $item['url'];
            $price = $item['price'];
            $title = $item['product'];
            if (isset($price) && isset($title)) {
                preg_match_all("/\d/", str_replace(" ", "", $price), $price);
                $model = new Items();
                $model->product = trim((string)$title);
                $model->price = implode('', $price[0]);
                $model->url = $url;
                $model->store = 'Microtron';
                $model->phone = self::PHONE;
                $model->subcategory_id = 4;
                $model->options = '{"type":"pilesosi"}';
                $model->save();
            }
        }
    }

    public function saveMicrotronPliti($item)
    {
        if (self::productUnique($item['url'])) {
            $url = $item['url'];
            $price = $item['price'];
            $title = $item['product'];
            if (isset($price) && isset($title)) {
                preg_match_all("/\d/", str_replace(" ", "", $price), $price);
                $model = new Items();
                $model->product = trim((string)$title);
                $model->price = implode('', $price[0]);
                $model->url = $url;
                $model->store = 'Microtron';
                $model->phone = self::PHONE;
                $model->subcategory_id = 4;
                $model->options = '{"type":"pliti"}';
                $model->save();
            }
        }
    }

    public function saveMicrotronWasher($item)
    {
        if (self::productUnique($item['url'])) {
            $url = $item['url'];
            $price = $item['price'];
            $title = $item['product'];
            if (isset($price) && isset($title)) {
                preg_match_all("/\d/", str_replace(" ", "", $price), $price);
                $model = new Items();
                $model->product = trim((string)$title);
                $model->price = implode('', $price[0]);
                $model->url = $url;
                $model->store = 'Microtron';
                $model->phone = self::PHONE;
                $model->subcategory_id = 4;
                $model->options = '{"type":"washer"}';
                $model->save();
            }
        }
    }

    public function saveMicrotronMicrowave($item)
    {
        if (self::productUnique($item['url'])) {
            $url = $item['url'];
            $price = $item['price'];
            $title = $item['product'];
            if (isset($price) && isset($title)) {
                preg_match_all("/\d/", str_replace(" ", "", $price), $price);
                $model = new Items();
                $model->product = trim((string)$title);
                $model->price = implode('', $price[0]);
                $model->url = $url;
                $model->store = 'Microtron';
                $model->phone = self::PHONE;
                $model->subcategory_id = 4;
                $model->options = '{"type":"microwave"}';
                $model->save();
            }
        }
    }

    public function saveMicrotronShit($item)
    {
        if (self::productUnique($item['url'])) {
            $url = $item['url'];
            $price = $item['price'];
            $title = $item['product'];
            if (isset($price) && isset($title)) {
                preg_match_all("/\d/", str_replace(" ", "", $price), $price);
                $model = new Items();
                $model->product = trim((string)$title);
                $model->price = implode('', $price[0]);
                $model->url = $url;
                $model->store = 'Microtron';
                $model->phone = self::PHONE;
                $model->subcategory_id = 8;
                $model->options = '-';
                $model->save();
            }
        }
    }

    public function saveParseMicrotron()
    {
        set_time_limit(0);
        $data = $this->genMicrotronData();
        foreach ($data as $item) {
            if (preg_match("/Смартфон/", $item['product'])) {
                $this->saveMicrotronSmart($item);
            }
            elseif (preg_match("/Мобильный телефон/", $item['product'])) {
                $this->saveMicrotronMobile($item);
            }
            elseif (preg_match("/Ноутбук/", $item['product'])) {
                $this->saveMicrotronNout($item);
            }
            elseif (preg_match("/Планшетный ПК/", $item['product']) || preg_match("/Tablet PC/", $item['product'])) {
                $this->saveMicrotronPlanshet($item);
            }
            elseif (preg_match("/Наушники/", $item['product']) || preg_match("/Гарнитура/", $item['product']) || preg_match("/Моногарнитура/", $item['product'])) {
                $this->saveMicrotronHeadphones($item);
            }
            elseif (preg_match("/MP3 плеер/", $item['product']) || preg_match("/Плеер MP3/", $item['product'])) {
                $this->saveMicrotronMp3Player($item);
            }
            elseif (preg_match("/Телевизор/", $item['product'])) {
                $this->saveMicrotronTv($item);
            }
            elseif (preg_match("/Холодильник/", $item['product'])) {
                $this->saveMicrotronFridges($item);
            }
            elseif (preg_match("/Пылесос/", $item['product'])) {
                $this->saveMicrotronPilesosi($item);
            }
            elseif (preg_match("/Электроплита/", $item['product'])) {
                $this->saveMicrotronPliti($item);
            }
            elseif (preg_match("/Стиральная машина/", $item['product'])) {
                $this->saveMicrotronWasher($item);
            } else {
                $this->saveMicrotronShit($item);
            }
        }
    }
}