<?php
namespace common\classes\rst;

use common\models\Items;
use Sunra\PhpSimple\HtmlDomParser;

class Rst
{
    public $transmission = [
        "Ручная / Механика",
        "Автомат",
        "Типтроник",
        "Адаптивная",
        "Вариатор"
    ];

    public $fuel = [
        "Бензин",
        "Дизель",
        "Газ",
        "Газ/бензин",
        "Гибрид",
        "Электро",
        "Другое",
        "Газ метан",
        "Газ пропан-бутан"
    ];

    public $matches = [
        "legk" =>
            ["url" => 'http://rst.ua/oldcars/?task=newresults&make[]=0&year[]=0&year[]=0&price[]=0&price[]=0&engine[]=0&engine[]=0&gear=0&fuel=0&drive=0&condition=0&from=sform&body[]=10&body[]=6&body[]=1&body[]=3&body[]=2&body[]=5&body[]=11&body[]=4&body[]=27',
                "subcategory_id" => 9
            ],
        "gruz" =>
            ["url" => 'http://rst.ua/oldcars/?task=newresults&make[]=0&year[]=0&year[]=0&price[]=0&price[]=0&engine[]=0&engine[]=0&gear=0&fuel=0&drive=0&condition=0&from=sform&body[]=21&body[]=20&body[]=19',
                "subcategory_id" => 10
            ],
        "spec" =>
            ["url" => 'http://rst.ua/oldcars/?task=newresults&make[]=0&year[]=0&year[]=0&price[]=0&price[]=0&engine[]=0&engine[]=0&gear=0&fuel=0&drive=0&condition=0&from=sform&body[]=22',
                "subcategory_id" => 11
            ],
        "moto" =>
            ["url" => 'http://rst.ua/oldcars/?task=newresults&make[]=0&year[]=0&year[]=0&price[]=0&price[]=0&engine[]=0&engine[]=0&gear=0&fuel=0&drive=0&condition=0&from=sform&body[]=24',
                "subcategory_id" => 12
            ],
        "boos" =>
            ["url" => 'http://rst.ua/oldcars/?task=newresults&make[]=0&year[]=0&year[]=0&price[]=0&price[]=0&engine[]=0&engine[]=0&gear=0&fuel=0&drive=0&condition=0&from=sform&body[]=12&body[]=15&body[]=18',
                "subcategory_id" => 13
            ],
        "pricep" =>
            ["url" => 'http://rst.ua/oldcars/?task=newresults&make[]=0&year[]=0&year[]=0&price[]=0&price[]=0&engine[]=0&engine[]=0&gear=0&fuel=0&drive=0&condition=0&from=sform&body[]=23',
                "subcategory_id" => 14
            ],
        "water" =>
            ["url" => 'http://rst.ua/oldcars/?task=newresults&make[]=0&year[]=0&year[]=0&price[]=0&price[]=0&engine[]=0&engine[]=0&gear=0&fuel=0&drive=0&condition=0&from=sform&body[]=26',
                "subcategory_id" => 15
            ],
        "aero" =>
            ["url" => 'http://rst.ua/oldcars/?task=newresults&make[]=0&year[]=0&year[]=0&price[]=0&price[]=0&engine[]=0&engine[]=0&gear=0&fuel=0&drive=0&condition=0&from=sform&body[]=25',
                "subcategory_id" => 17
            ]
    ];

    /**
     * Проверка на уникальность записи
     * @param $url
     * @return bool
     */
    public function productUnique($url)
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

    public function init()
    {
        foreach ($this->matches as $item) {
            $this->saveParseRst($item['url'], $item['subcategory_id']);
        }
    }

    /**
     * @param $baseUrl
     * @param $subcategory
     */
    private function saveParseRst($baseUrl, $subcategory)
    {
        set_time_limit(0);
        error_reporting(E_ALL & ~E_NOTICE);
        $j = 1;
        while ($j <= 1000) {
            $url = $baseUrl . '&start=' . $j;
            $parser = new HtmlDomParser();
            $html = iconv('windows-1251', 'UTF-8//IGNORE', $parser->file_get_html($url));
            $dom = $parser->str_get_html($html);
            $year = null;
            $fuel = null;
            $price = null;
            $link = null;
            $product = null;
            $city = null;
            $phone = null;
            for ($i = 0; $i < count($dom->find('div[class=rst-ocb-i]')) - 1; $i++) {
                $dparser = new HtmlDomParser();
                $ddom = $dparser->str_get_html($dom->find('div[class=rst-ocb-i]')[$i]->innertext);
                $link = 'http://rst.ua' . $ddom->find('a.rst-ocb-i-a')[0]->href;
                preg_match("/(.*)/", $ddom->find('li[class=rst-ocb-i-d-l-i]')[1]->plaintext, $year);
                preg_match("/(.*)/", $ddom->find('li[class=rst-ocb-i-d-l-i]')[2]->plaintext, $fuel);
                preg_match("/(.*)/", $ddom->find('li[class=rst-ocb-i-d-l-j]')[0]->plaintext, $city);
                $product = $ddom->find('h3[class=rst-ocb-i-h]')[0]->plaintext;

                $phone_parser = $dparser->file_get_html($link);
                $phone = utf8_encode($phone_parser->find('p[class=rst-page-oldcars-item-option-block-container]')[0]->plaintext);
                if(isset($phone) && !empty($phone)){
                    preg_match("/\d+/", $phone, $phone);
                    $phone = $phone[0];
                } else {
                    $phone = utf8_encode($phone_parser->find('div.rst-page-oldcars-item-option-block-container td')[0]->plaintext);
                }
                unset($phone_parser);

                $price = str_replace("'", "", $ddom->find('span[class=rst-ocb-i-d-l-i-s rst-ocb-i-d-l-i-s-p]')[0]->plaintext);
                unset($dparser);
                if ($this->productUnique($link)) {
                    preg_match("/\((\d+).*?\)/", $year[0], $running);
                    preg_match("/\((.*?)\)/", $fuel[0], $transmission);
                    preg_match("/\d+/", $year[0], $year);
                    preg_match("/\d+/", $phone[0], $phone);
                    preg_match("/\-?\d+(\.\d{0,})?(.*?)\(/", $fuel[0], $fuel);
                    preg_match("/(\d+)/", $price, $price);
                    $city = explode(":", $city[0]);
                    $model = new Items();
                    $model->product = $product;
                    if (!empty($price)) {
                        $model->price = $price[0];
                    } else {
                        $model->options = "договорная";
                        $model->price = "0";
                    }
                    $model->url = $link;
                    $model->store = 'Rst';
                    $model->phone = $phone;
                    $model->subcategory_id = $subcategory;
                    $model->options .= '{"year":"' . trim($year[0])
                        . '","fuel":"' . trim($fuel[2])
                        . '","transmission":"' . trim($transmission[1])
                        . '","running":"' . trim($running[1])
                        . '","city":"' . trim($city[1])
                        . '","b/u":"1"}';
                    $model->save();
                }
            }
            $j++;
        }
    }
}