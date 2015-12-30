<?php

namespace common\models;

use common\classes\rst\Option;
use Yii;
use yii\db\ActiveRecord;
/**
 * Class Parse
 * @property string $product
 * @property string $price
 * @property string $url
 * @property string $store
 * @property string $phone
 * @property string $options
 * @property integer $subcategory_id
 * @property integer $created_at
 * @property integer $updated_at
 * @package frontend\models
 */
class Items extends ActiveRecord
{
    public function rules()
    {
        return [
            [['product', 'price', 'url', 'store', 'options', 'subcategory_id'], 'required'],
            [['product', 'price', 'url', 'store', 'options', 'phone'], 'string'],
            [['subcategory_id'], 'integer']
        ];
    }

    /**
     * Подсчет количества товаров после парсинга
     * @param $store
     * @return int|string
     */
    public static function getCol($store)
    {
        $model = self::find()->where([
            'store' => $store
        ])->count();
        if ($model) {
            return $model;
        } else {
            return '0';
        }
    }

    /**
     * Подсчет количества товаров после парсинга Olx
     * @param $store
     * @param $category
     * @return int|string
     */
    public static function getColOlx($store, $category)
    {
        $items = self::find()
            ->joinWith('subcategories')
            ->where(['subcategory.category_id' => $category])
            ->andWhere(['items.store' => $store])
            ->count();
        if ($items) {
            return $items;
        } else {
            return '0';
        }
    }

    /**
     * Последняя дата обновления
     * @param $store
     * @return mixed|string
     */
    public static function getDateUpdate($store)
    {
        $model = self::find()->where([
            'store' => $store
        ])->orderBy('id DESC')->one();
        if ($model) {
            return $model->created_at;
        } else {
            return 'не обновлялось';
        }
    }

    public static function search($data){

        $query = self::find();
        $sub = new Subcategory;
        $request=[];
        if (isset($data['text']) && !empty($data['text'])) {
            $query = $query->andWhere(['like', 'product', $data['text']]);

        }
//        if (isset($data['price-from']) && !empty($data['price-from'])) {
//            $query = $query->andWhere(['>=', 'price', $data['price-from']]);
//        }
//        if (isset($data['price-to']) && !empty($data['price-to'])) {
//            $query = $query->andWhere(['<=', 'price', $data['price-to']]);
//        }
        if (isset($data['inuse']) && !empty($data['inuse'])) {

            if($data['inuse'] === "1") {
                $query = $query->andWhere(['like', 'options', '"b/u":"1"']);
            }
            if($data['inuse'] === "10") {
                $query = $query->andWhere(['not like', 'options', '"b/u":"1"']);
            }
        }
        if (isset($data['region']) && !empty($data['region'])) {
            $city = Option::getCity($data['region']);
            if($city!=null){
                $request = ['"city":"'.$city.'"','"city":"'.$data['region'].'"'];
                $query = $query->andWhere(['or like', 'options', $request]);
            }
        }
        if (isset($data['car_category_id']) && !empty($data['car_category_id'])){

            if($data['car_category_id'] == 1){
                $query = $query->andWhere(['subcategory_id' => 9]);
            }
            if($data['car_category_id'] == 6){
                $query = $query->andWhere(['subcategory_id' => 10]);
            }
            if($data['car_category_id'] == 4){
                $query = $query->andWhere(['subcategory_id' => 11]);
            }
            if($data['car_category_id'] == 2){
                $query = $query->andWhere(['subcategory_id' => 12]);
            }
            if($data['car_category_id'] == 7){
                $query = $query->andWhere(['subcategory_id' => 13]);
            }
            if($data['car_category_id'] == 5){
                $query = $query->andWhere(['subcategory_id' => 14]);
            }
            if($data['car_category_id'] == 3){
                $query = $query->andWhere(['subcategory_id' => 15]);
            }
            if($data['car_category_id'] == 8){
                $query = $query->andWhere(['subcategory_id' => 16]);
            }
            if($data['car_category_id'] == 9){
                $query = $query->andWhere(['subcategory_id' => 17]);
            }
            if($data['car_category_id'] == 10){
                $query = $query->andWhere(['subcategory_id' => 46]);
            }

            if (isset($data['car_marka_id']) && !empty($data['car_marka_id'])){
                $marks = json_decode(file_get_contents('http://api.auto.ria.com/categories/' . $data['car_category_id'] . '/marks'), true);
                $mark_request = '';
                foreach($marks as $mark){
                    if ($mark['value'] == $data['car_marka_id'])
                    {
                        $mark_request = $mark['name'];
                    }
                }
                $query = $query->andWhere(['like', 'product', $mark_request]);

                if (isset($data['car_model_id']) && !empty($data['car_model_id'])){
                    $models = json_decode(file_get_contents('http://api.auto.ria.com/categories/' . $data['car_category_id'] . '/marks/' . $data['car_marka_id'] . '/models'), true);
                    $car_model_request = '';
                    foreach($models as $model){
                        if ($model['value'] == $data['car_model_id'])
                        {
                            $car_model_request = $model['name'];
                        }
                    }
                    $query = $query->andWhere(['like', 'product', $car_model_request]);
                }
            }
        }
        if (isset($data['fuel']) && !empty($data['fuel'])) {
            $query = $query->andWhere(['like', 'options', '"fuel":"' . $data['fuel'] . '"']);
        }
        if (isset($data['transmission']) && !empty($data['transmission'])) {
            $query = $query->andWhere(['like', 'options', '"transmission":"' . $data['transmission'] . '"']);
        }
        if (isset($data['model']) && !empty($data['model'])) {
            $query = $query->andWhere(['like', 'product', $data['model']]);

        }
        if (isset($data['year-from']) && !empty($data['year-from']) && isset($data['year-to']) && !empty($data['year-to'])
            || isset($data['year-from']) && !empty($data['year-from']) || isset($data['year-to']) && !empty($data['year-to'])) {

            if (isset($data['year-from']) && !empty($data['year-from']) && isset($data['year-to']) && !empty($data['year-to'])) {

                $year_from = $data['year-from'];
                $year_to = $data['year-to'];

                for ($i = $year_from; $i <= $year_to; $i++) {
                    $request[] = '"year":"' . $year_from++ . '",';

                }

            }
            if(isset($data['year-from']) && !empty($data['year-from']) && isset($data['year-to']) && empty($data['year-to'])){

                $year_from = $data['year-from'];
                $year_to = 2016;

                for ($i = $year_from; $i <= $year_to; $i++) {
                    $request[] = '"year":"' . $year_from++ . '",';

                }
            }
            if(isset($data['year-to']) && !empty($data['year-to'])&& isset($data['year-from']) && empty($data['year-from'])){
                $year_from = 1910;
                $year_to = $data['year-to'];

                for ($i = $year_from; $i <= $year_to; $i++) {
                    $request[] = '"year":"' . $year_from++ . '",';

                }
            }
            $query = $query->andWhere(['or like', 'options', $request]);

        }
        if(isset($data['Subcategory']) && !empty($data['Subcategory'])) {

            $subcategory = $sub->categoryGet($data['Subcategory']);

//TODO костыль для Димы - передалть парсер микротрона и других
            if (isset($data['Subcategory']['title']) && !empty($data['Subcategory']['title'])) {
                if($data['Subcategory']['title'] === "68"){
                    $query = $query->andWhere(['like', 'options', '"type":"tv"']);
                    if (isset($data['Subcategory']['options']['tv']['display']) && !empty($data['Subcategory']['options']['tv']['display'])) {
                        foreach ($data['Subcategory']['options']['tv']['display'] as $display) {
                        $disp = json_decode($display, true);
                        $range = range($disp['disp_from'],$disp['disp_to'],0.1);
                            foreach($range as $value){
                                $request[]='"display":"' . $value . '"';
                            }
                        }
                        $query = $query->andWhere(['or like', 'options', $request]);
                    }
                    if (isset($data['Subcategory']['options']['tv-brand']) && !empty($data['Subcategory']['options']['tv-brand'])) {

                        $query = $query->andWhere(['like', 'product', $data['Subcategory']['options']['tv-brand']]);
                    }

                }
                else {
                    $query->andWhere(['subcategory_id' => $data['Subcategory']['title']]);
                }
            }
            else {
                foreach ($subcategory as $value) {
                    $request[] = $value->id;
                }
                $query = $query->andWhere(['subcategory_id' => $request]);
            }

            if (isset($data['Subcategory']['options']) && !empty($data['Subcategory']['options'])) {
                $phone_data = $data['Subcategory']['options']['phone'];
                $comp_data = $data['Subcategory']['options']['comp'];
                $av_data = $data['Subcategory']['options']['av'];
                $home_data = $data['Subcategory']['options']['home'];
                $game_data = $data['Subcategory']['options']['game'];
                $care_data = $data['Subcategory']['options']['care'];
                if ($phone_data['type'] != null) {
                    $query = $query->andWhere(['like', 'options', '"type":"' . $phone_data['type'] . '"']);
                }
                if ($phone_data['brand'] != null) {
                    $query = $query->andWhere(['like', 'product', $phone_data['brand']]);
                }
//                if ($phone_data['display'] != null) {
//
//                    foreach ($phone_data['display'] as $display) {
//                        $query = $query->andWhere(['subcategory_id' => '1'])
//                            ->andWhere(['like', 'options', '"display":"' . $display . '"'])
//                            ->orWhere(['like', 'options', '"display":"' . $display . ',1"'])
//                            ->orWhere(['like', 'options', '"display":"' . $display . ',2"'])
//                            ->orWhere(['like', 'options', '"display":"' . $display . ',3"'])
//                            ->orWhere(['like', 'options', '"display":"' . $display . ',4"'])
//                            ->orWhere(['like', 'options', '"display":"' . $display . ',5"'])
//                            ->orWhere(['like', 'options', '"display":"' . $display . ',6"'])
//                            ->orWhere(['like', 'options', '"display":"' . $display . ',7"'])
//                            ->orWhere(['like', 'options', '"display":"' . $display . ',8"'])
//                            ->orWhere(['like', 'options', '"display":"' . $display . ',9"']);
//                    }
//                }
                if (isset($phone_data['display']) && !empty($phone_data['display'])) {
                    foreach ($phone_data['display'] as $display) {
                        $disp = json_decode($display, true);
                        $range = range($disp['disp_from'],$disp['disp_to'],0.1);
                        foreach($range as $value){
                            $request[]='"display":"' . $value . '"';
                        }
                    }
                    $query = $query->andWhere(['or like', 'options', $request]);
                }
                if ($phone_data['processor'] != null) {
                    foreach ($phone_data['processor'] as $processor) {
                        $request[] = '"processor":"' . $processor . '"';
                    }
                    $query = $query->andWhere(['or like', 'options', $request]);
                }
                if ($phone_data['os'] != null) {
                    foreach ($phone_data['os'] as $os) {
                        $request[] = '"os":"' . $os . '"';
                    }
                    $query = $query->andWhere(['or like', 'options', $request]);
                }
                if ($phone_data['ozu'] != null) {
                    foreach ($phone_data['ozu'] as $ozu) {
                        $request[] = '"ozu":"' . $ozu . '"';
                    }
                    $query = $query->andWhere(['or like', 'options', $request]);
                }
                //computers
                if ($comp_data['type'] != null) {
                    $query = $query->andWhere(['like', 'options', '"type":"' . $comp_data['type'] . '"']);
                }
                if ($comp_data['brand'] != null) {
                    $query = $query->andWhere(['like', 'product', $comp_data['brand']]);
                }
//                if ($comp_data['display'] != null) {
//                    foreach ($comp_data['display'] as $display) {
//                        $query = $query->andWhere(['like', 'options', '"display":"' . $display . '"'])
//                            ->orWhere(['like', 'options', '"display":"' . $display . ',1"'])
//                            ->orWhere(['like', 'options', '"display":"' . $display . ',2"'])
//                            ->orWhere(['like', 'options', '"display":"' . $display . ',3"'])
//                            ->orWhere(['like', 'options', '"display":"' . $display . ',4"'])
//                            ->orWhere(['like', 'options', '"display":"' . $display . ',5"'])
//                            ->orWhere(['like', 'options', '"display":"' . $display . ',6"'])
//                            ->orWhere(['like', 'options', '"display":"' . $display . ',7"'])
//                            ->orWhere(['like', 'options', '"display":"' . $display . ',8"'])
//                            ->orWhere(['like', 'options', '"display":"' . $display . ',9"']);
//                    }
//                }
                $requests='';
                if (isset($comp_data['display']) && !empty($comp_data['display'])) {
                    foreach ($comp_data['display'] as $display) {
                        $disp = json_decode($display, true);
//                        $range = range($disp['disp_from'],$disp['disp_to'],0.1);
//                                                    $requests = implode('|','"display":"'.$range.'"');
//
////                        foreach($range as $value){
////                            $requests = implode('|','"display":"'.$value.'"');
////                            $requests .='"display":"'.$value.'"|';
//
////                        }
//                    }
//                    print_r($requests);

//                    $query = $query->andWhere(['REGEXP', 'options', $requests]);

                        $range = range($disp['disp_from'],$disp['disp_to'],0.1);
                        foreach($range as $value){
                            $request[]='"display":"' . $value . '"';
                        }
                    }
                    $query = $query->andWhere(['or like', 'options', $request]);
                }

                if ($comp_data['processor'] != null) {
                    foreach ($comp_data['processor'] as $processor) {
                        $request[] = '"processor":"' . $processor . '"';
                    }
                    $query = $query->andWhere(['or like', 'options', $request]);
                }
                if ($comp_data['os'] != null) {
                    foreach ($comp_data['os'] as $os) {
                        $request[] = '"os":"' . $os . '"';
                    }
                    $query = $query->andWhere(['or like', 'options', $request]);
                }
                if ($comp_data['ozu'] != null) {
                    foreach ($comp_data['ozu'] as $ozu) {
                        $request[] = '"ozu":"' . $ozu . '"';
                    }
                    $query = $query->andWhere(['or like', 'options', $request]);
                }
                //Audio & Video $av_data
                if ($av_data['type'] != null) {
                    $query = $query->andWhere(['like', 'options', '"type":"' . $av_data['type'] . '"']);
                }
                if ($av_data['brand'] != null) {
                    $query = $query->andWhere(['like', 'product', $av_data['brand']]);
                }
                if ($av_data['type_naushnikov'] != null) {
                    foreach ($av_data['type_naushnikov'] as $type_naushnikov) {
                        $request[] = '"type_naushnikov":"' . $type_naushnikov . '"';
                    }
                    $query = $query->andWhere(['or like', 'options', $request]);
                }
                if ($av_data['memory'] != null) {
                    foreach ($av_data['memory'] as $memory) {
                        $request[] = '"memory":"' . $memory . '"';
                    }
                    $query = $query->andWhere(['or like', 'options', $request]);
                }
                if ($av_data['type_kinoteatra'] != null) {
                    foreach ($av_data['type_kinoteatra'] as $type_kinoteatra) {
                        $request[] = '"type_kinoteatra":"' . $type_kinoteatra . '"';
                    }
                    $query = $query->andWhere(['or like', 'options', $request]);
                }
                if ($av_data['power'] != null) {
                    foreach ($av_data['power'] as $power) {
                        $request[] = '"power":"' . $power . '"';
                    }
                    $query = $query->andWhere(['or like', 'options', $request]);
                }
                if ($av_data['category'] != null) {
                    foreach ($av_data['category'] as $category) {
                        $request[] = '"category":"' . $category . '"';
                    }
                    $query = $query->andWhere(['or like', 'options', $request]);
                }
                // Home $home_data

                if ($home_data['type'] != null) {
                    $query = $query->andWhere(['like', 'options', '"type":"' . $home_data['type'] . '"']);
                }

                if ($home_data['brand'] != null) {
                    $query = $query->andWhere(['like', 'product', $home_data['brand']]);
                }
                if ($home_data['type_fridges'] != null) {
                    foreach ($home_data['type_fridges'] as $type_fridges) {
                        $request[] = '"type_fridges":"' . $type_fridges . '"';
                    }
                    $query = $query->andWhere(['or like', 'options', $request]);
                }
                if ($home_data['type_system'] != null) {
                    foreach ($home_data['type_system'] as $type_system) {
                        $request[] = '"type_system":"' . $type_system . '"';
                    }
                    $query = $query->andWhere(['or like', 'options', $request]);
                }
                if ($home_data['type_washer'] != null) {
                    foreach ($home_data['type_washer'] as $type_washer) {
                        $request[] = '"type_washer":"' . $type_washer . '"';
                    }
                    $query = $query->andWhere(['or like', 'options', $request]);
                }
                if ($home_data['max_load'] != null) {
                    foreach ($home_data['max_load'] as $max_load) {
                        $request[] = '"max_load":"' . $max_load . '"';
                    }
                    $query = $query->andWhere(['or like', 'options', $request]);
                }
                if ($home_data['type_pilesos'] != null) {
                    foreach ($home_data['type_pilesos'] as $type_pilesos) {
                        $request[] = '"type_pilesos":"' . $type_pilesos . '"';
                    }
                    $query = $query->andWhere(['or like', 'options', $request]);
                }
                if ($home_data['power_pilesos'] != null) {
                    foreach ($home_data['power_pilesos'] as $power_pilesos) {
                        $request[] = '"power_pilesos":"' . $power_pilesos . '"';
                    }
                    $query = $query->andWhere(['or like', 'options', $request]);
                }
                if ($home_data['type_pliti'] != null) {
                    foreach ($home_data['type_pliti'] as $type_pliti) {
                        $request[] = '"type_pliti":"' . $type_pliti . '"';
                    }
                    $query = $query->andWhere(['or like', 'options', $request]);
                }
                if ($home_data['type_shkafa'] != null) {
                    foreach ($home_data['type_shkafa'] as $type_shkafa) {
                        $request[] = '"type_shkafa":"' . $type_shkafa . '"';
                    }
                    $query = $query->andWhere(['or like', 'options', $request]);
                }
                if ($home_data['type_panel'] != null) {
                    foreach ($home_data['type_panel'] as $type_panel) {
                        $request[] = '"type_panel":"' . $type_panel . '"';
                    }
                    $query = $query->andWhere(['or like', 'options', $request]);
                }
                if ($home_data['type_svch'] != null) {
                    foreach ($home_data['type_svch'] as $type_svch) {
                        $request[] = '"type_svch":"' . $type_svch . '"';
                    }
                    $query = $query->andWhere(['or like', 'options', $request]);
                }
                if ($home_data['type_control'] != null) {
                    foreach ($home_data['type_control'] as $type_control) {
                        $request[] = '"type_control":"' . $type_control . '"';
                    }
                    $query = $query->andWhere(['or like', 'options', $request]);
                }
                if ($home_data['type_volume'] != null) {
                    foreach ($home_data['type_volume'] as $type_volume) {
                        $request[] = '"type_volume":"' . $type_volume . '"';
                    }
                    $query = $query->andWhere(['or like', 'options', $request]);
                }
                // Game $game_data
//                if ($game_data['type'] != null) {
//                    $query = $query->andWhere(['like', 'options', '"type":"' . $game_data['type'] . '"']);
//                }
            }
        }
        if (isset($data['exclude_id']) && $data['exclude_id'] != null){
            $query = $query->andWhere(['not in', 'id', $data['exclude_id']]);
        }
        return $query;
    }

    /**
     * Получить подкатегории
     * @return \yii\db\ActiveQuery
     */
    public function getSubcategories()
    {
        return $this->hasOne(Subcategory::className(), ['id' => 'subcategory_id']);
    }
}