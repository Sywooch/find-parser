<?php

namespace frontend\models;

use Yii;
use yii\db\ActiveRecord;
use \common\models\User;

/**
 * Class Parse
 * @property string $product
 * @property string $price
 * @property string $url
 * @property string $magazine
 * @property integer $user_id
 * @package frontend\models
 *
 */
class Parse extends ActiveRecord
{
//    private $table = "{{%parse}}";

    public function rules()
    {
        return [
            [['product', 'price', 'url', 'user_id', 'magazine'], 'required'],
            [['product', 'price', 'url'], 'string'],
            [['user_id'], 'integer'],
        ];
    }

    public function attributeLabels()
    {
        return [
        ];
    }

    /**
     * Парсинг olx и сохранение результата в базу
     * @return bool
     */
    public static function saveParse(){

        $xml = file_get_contents('http://zaporozhe.zap.olx.ua/elektronika/telefony/mobilnye-telefony/q-iphone5s/rss/');
        $movies = new \SimpleXMLElement($xml, LIBXML_NOCDATA);
        foreach($movies->channel->item as $item){
            preg_match("/Цена:\s\d(.*?)\sгрн/", $item->description, $m);
            if(isset($m[0])){
                preg_match_all("/\d/", str_replace(" ", "", $m[0]), $prices);
                foreach($prices as $price) {
                    $model = new self();
                    $model->product = (string)$item->title;
                    $model->price = implode('', $price);
                    $model->url = (string)$item->link;
                    $model->magazine = 'Olx';
                    $model->user_id = Yii::$app->user->id;
//                    print_r((string)$item->title);
                    $model->save();
                }
            }
        }
    }

    /**
     * Пользователь, пославший запрос
     * @return \yii\db\ActiveQuery
     */
    public function getUser(){
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }
}