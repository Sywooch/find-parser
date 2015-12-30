<?php
/* @var $this yii\web\View */
/* @var $subcat \common\models\Subcategory */
/* @var $cat \common\models\Category */
/* @var $basicModel \common\models\PaymentPlans */
/* @var $advancedModel \common\models\PaymentPlans */
/* @var $proModel \common\models\PaymentPlans */
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use common\models\Category;
use yii\widgets\Pjax;
$this->title = 'Добро пожаловать на портал SISHIK.NET';
$option = new \common\classes\rst\Option();
?>

<div class="bg header-block container-fluid">
    <div class="container">
                <div class="row">
                        <?php foreach ($cat as $category) { ?>
                        <div class="col-md-2">

                             <a href="#"
                               id="category<?= $category['id'] ?>"<?= $category['id'] == 1 ? 'onclick="hideShowDiv();"' : '' ?>>
                                <i class="fa fa-<?= Category::setIcon()[$category['id']] ?>"></i><br>
                                <?= $category['title'] ?>
                            </a>
                        </div>
                        <?php } ?>

                </div>
                <div class="row">
                    <div class="col-md-12 cat-forms">
                        <div id="slogan"><p>Сайт, который ищет</p>
<!--                            <div class="slogan-search">-->
<!--                                <form id="form-parse" class="form-inline" action="/search" method="get">-->
<!--                                    <input type="text" id="product_name" class="form-control" name="text" value="" required>-->
<!--                                    <button type="submit" class="btn btn-info"><i class="fa fa-search"></i> Искать</button>-->
<!--                                </form>-->
<!--                            </div>-->
                        </div>
                        <div class="form electronic ">
                            <div class="close electronic"><i class="fa fa-times"></i></div>
                            <?php
                            $title = 'form-electronic'/*.$category['id']*/;
                            $form = ActiveForm::begin(['id' => $title, 'action' => '/search', 'method' => 'get']) ?>
                            <div class="col-md-12">
                                <input type="hidden" name="category_id" value="1">
                                <input type="text" name="text" class="form-control" style="width: 100%; margin-bottom: 20px;" placeholder="Поиск элетронной техники">

                            </div>
                            <div class="col-md-6">

                                <div class="form-group form-inline">
                                    <label class="control-label left-50" for="price-from">Цена от, грн:</label>
                                    <label class="control-label left-50" for="price-to">Цена до, грн:</label>
                                    <input type="number" name="price-from" class="form-control left-50" style="margin-bottom: 20px">
                                    <input type="number" name="price-to" class="form-control left-50" style="margin-bottom: 20px">
                                </div>

                                <?= $form->field($subcat, 'title')->dropDownList(
                                    ArrayHelper::map(\common\models\Subcategory::find()->where(['category_id' => 1/*$category['id']*/])->all(), 'id', 'title'),
                                    ['prompt' => 'Выберете категорию', 'id' => 'sub_cat']
                                )->label(false); ?>
                                <?= $form->field($subcat,'category_id')->hiddenInput(['value'=>'1'])->label(false);; ?>
                                <!--    Phones                -->
                                <?= $form->field($subcat, "options[phone][type]")
                                    ->dropDownList(
                                        ['smartphone'=>'Смартфоны', 'mob_phone'=>'Мобильные Телефоны', 'Беспроводные телефоны', 'Проводные телефоны'],
                                        ['prompt' => 'Выберете тип', 'class' => 'phone phone-types form-control', 'onchange' => 'function()']
                                    )
                                    ->label('Тип:', ['class' => 'phone phone-types control-label control-label']) ?>

                                <?= $form->field($subcat, "options[phone][brand]")
                                    ->dropDownList(
                                        [   'HTC'=>'HTC', 'Apple'=>'Apple', 'Samsung'=>'Samsung', 'LG'=>'LG',
                                            'Lenovo'=>'Lenovo','Sony'=>'Sony','Acer'=>'Acer','Nokia'=>'Nokia',
                                            'Prestigio'=>'Prestigio','Gigabyte'=>'Gigabyte','Fly'=>'Fly','Huawei'=>'Huawei',
                                            'Caterpillar'=>'Caterpillar','BlackBerry'=>'BlackBerry'
                                        ],
                                        ['prompt' => 'Выберете бренд', 'class' => 'phone form-control', 'onchange' => 'function()']
                                    )
                                    ->label('Производитель:', ['class' => 'phone control-label']) ?>
                                <!--    Computers            -->
                                <?= $form->field($subcat, "options[comp][type]")
                                    ->dropDownList(
                                        [
                                            'noutbuk'=>'Ноутбуки', 'planshet'=>'Планшеты',
                                            'nast_comp'=>'Настольные компьютеры', 'monitors'=>'Мониторы',
                                            'complects'=>'Комплектующие', 'perefiries'=>'Компьютерная периферия',
                                            'acessories'=>'Аксессуары'

                                        ],
                                        ['prompt' => 'Выберете тип', 'class' => 'comp form-control', 'id' => 'comp-type']
                                    )
                                    ->label('Тип:', ['class' => 'comp control-label control-label']) ?>

                                <?= $form->field($subcat, "options[comp][brand]")
                                    ->dropDownList(
                                        [   'Asus'=>'Asus', 'Apple'=>'Apple', 'Acer'=>'Acer', 'Samsung'=>'Samsung',
                                            'Lenovo'=> 'Lenovo', 'Dell'=>'Dell', 'HP'=>'HP', 'MSI'=>'MSI','Fujitsu'=>'Fujitsu',
                                            'Assistant'=>'Assistant','Globex'=>'Globex','LG'=>'LG','Microsoft'=>'Microsoft',
                                            'Nomi'=>'Nomi','Pixus'=>'Pixus','PocketBook'=>'PocketBook','Prestigio'=>'Prestigio',
                                            'Reellex'=>'Reellex','Senkatel'=>'Senkatel'
                                        ],
                                        ['prompt' => 'Выберете бренд', 'class' => 'comp form-control']
                                    )
                                    ->label('Производитель:', ['class' => 'comp control-label']) ?>
                                <!--  Audio&video -->
                                <?= $form->field($subcat, "options[av][type]")
                                    ->dropDownList(
                                        ['headphones'=>'Наушники', 'mp3-player'=>'MP3-плееры','kinoteatr'=>'Домашние кинотеатры', 'media-player'=>'Медиаплееры'],
                                        ['prompt' => 'Выберете тип', 'class' => 'audio-video form-control', 'id' => 'av-type']
                                    )
                                    ->label('Тип:', ['class' => 'audio-video control-label control-label']) ?>

                                <?= $form->field($subcat, "options[av][brand]")
                                    ->dropDownList(
                                        ['LG'=>'LG','Apple'=>'Apple','AKG'=>'AKG', 'Asus'=>'Asus', 'Beats'=>'Beats', 'Ergo'=>'Ergo',
                                            'Philips'=>'Philips', 'Koss'=>'Koss', 'Sony'=>'Sony', 'Texet'=>'Texet','Transcend'=>'Transcend',
                                            'Samsung'=>'Samsung', 'Aura'=>'Aura', 'IconBit'=>'IconBit', 'Воля'=>'Воля'],
                                        ['prompt' => 'Выберете бренд', 'class' => 'audio-video form-control']
                                    )
                                    ->label('Производитель:', ['class' => 'audio-video control-label']) ?>
                                <!--  For home -->
                                <?= $form->field($subcat, "options[home][type]")
                                    ->dropDownList(
                                        ['fridges'=>'Холодильники', 'washers'=>'Стиральные машины', 'pilesosi'=>'Пылесосы', 'pliti'=>'Плиты', 'microwave'=>'Микроволновые печи'],
                                        ['prompt' => 'Выберете тип', 'class' => 'home form-control', 'id' => 'home-type']
                                    )
                                    ->label('Вид техники:', ['class' => 'home control-label control-label']) ?>

                                <?= $form->field($subcat, "options[home][brand]")
                                    ->dropDownList(
                                        [  'AEG'=>'AEG', 'Beko'=>'Beko', 'Bosch'=>'Bosch', 'Philips'=>'Philips', 'LG'=>'LG',
                                            'Samsung'=>'Samsung','Candy'=>'Candy','Electrolux'=>'Electrolux','Fresh'=>'Fresh',
                                            'Hansa'=>'Hansa','Indesit'=>'Indesit','Saturn'=>'Saturn','Siemens'=>'Siemens',
                                            'Whirlpool'=>'Whirlpool','Zanussi'=>'Zanussi','Днепр'=>'Днепр','Атлант'=>'Атлант',
                                            'Hotpoint-Ariston'=>'Hotpoint-Ariston','Hitachi'=>'Hitachi','Liebherr'=>'Liebherr',
                                            'Nord'=>'Nord','Panasonic'=>'Panasonic','Profycool'=>'Profycool','Snaige'=>'Snaige',
                                            'Snaige'=>'Snaige','Swizer'=>'Swizer','Vestfrost'=>'Vestfrost','Gefest'=>'Gefest',
                                            'Gorenje'=>'Gorenje','Greta'=>'Greta','Термія'=>'Термія','Zelmer'=>'Zelmer'
                                        ],
                                        ['prompt' => 'Выберете бренд', 'class' => 'home form-control']
                                    )
                                    ->label('Бренд:', ['class' => 'home control-label']) ?>
                                <!-- GAMES AND GAMES STATIONS -->
                                <?= $form->field($subcat, "options[game][type]")
                                    ->dropDownList(
                                        ['console'=>'Приставки'],
                                        ['class' => 'game form-control', 'id' => 'game-type']
                                    )
                                    ->label('Выберите рубрику', ['class' => 'game control-label']) ?>

                                <?= $form->field($subcat, "options[ps-type]")
                                    ->dropDownList(
                                        ['Nintendo DS', 'Nintendo Wii', 'Sony PlayStation', 'XBOX', 'Sony PSP'],
                                        ['prompt' => 'Все:', 'class' => 'ps-type form-control']
                                    )
                                    ->label('Тип приставки:', ['class' => 'ps-type']) ?>

                                <!-- care -->
                                <?= $form->field($subcat, "options[care]")
                                    ->dropDownList(
                                        ['Бритвы, эпиляторы, машинки для стрижки', 'Фены, укладка волос', 'Весы'],
                                        ['prompt' => 'Все:', 'class' => 'care form-control', 'id' => 'care-type']
                                    )
                                    ->label('Выберите рубрику', ['class' => 'care control-label']) ?>
                                <!-- tv -->
                               <?= $form->field($subcat, "options[tv-brand]")
                                    ->dropDownList(
                                        ['LG'=>'LG', 'Mystery'=>'Mystery', 'Philips'=>'Philips', 'Samsung'=>'Samsung', 'Saturn'=>'Saturn', 'Sony'=>'Sony'],
                                        ['prompt' => 'Выберете бренд', 'class' => 'tv-brand form-control']
                                    )
                                    ->label('Бренд:', ['class' => 'tv-brand control-label']) ?>
                               <!-- fototehnik -->
                               <?= $form->field($subcat, "options[foto][type]")
                                    ->dropDownList(
                                        [   'Фотокамеры и комплектующие'=>'Фотокамеры и комплектующие', 'Видеокамеры и аксессуары'=>'Видеокамеры и аксессуары',
                                            'Проекционное оборудование'=>'Проекционное оборудование','Аксессуары'=>'Аксессуары'
                                        ],
                                        ['class' => 'foto foto-type form-control']
                                    )
                                    ->label('Выберите тип:', ['class' => 'foto foto-type control-label']) ?>
                                <!-- climate -->
                                <?= $form->field($subcat, "options[climate][type]")
                                    ->dropDownList(

                                        [   'Водонагреватели'=>'Водонагреватели', 'Кондиционеры'=>'Кондиционеры',
                                            'Обогреватели и конвекторы'=>'Обогреватели и конвекторы'
                                        ],
                                        ['class' => 'climate climate-type form-control']
                                    )
                                    ->label('Выберите тип:', ['class' => 'climate climate-type control-label']) ?>
                                <label class="control-label proizv-climate climate" for="proizv-climate" style="display: block;">Выберете производителя</label>
                                <select class="form-control proizv-climate climate" id="proizv-climate"
                                        data-field="category" data-placeholder="Выберете производителя">
                                    <option value="0">Выберете производителя</option>
                                    <option value="1">Ariston</option>
                                    <option value="6">Atlantic</option>
                                    <option value="4">Bosch</option>
                                    <option value="2">Chaika</option>
                                    <option value="7">Electrolux</option>
                                    <option value="5">Garanterm(ATT)</option>
                                    <option value="3">Gorenje</option>
                                    <option value="8">Novatech</option>
                                    <option value="9">Perfezza</option>
                                    <option value="10">Zanussi</option>
                                    <option value="11">STADLER FORM</option>
                                    <option value="11">Saturn</option>
                                    <option value="11">UFO</option>
                                    <option value="11">Теплокерамик</option>
                                    <option value="11">Термія</option>
                                </select>
                            </div>
                            <div class="col-md-6">
                                <label class="control-label inuse" for="inuse" style="display: block;">Выберете состояние</label>
                                <label><input type="radio" name="inuse" value="10">Новое</label>
                                <label><input type="radio" name="inuse" value="1">Б.У.</label>
                                <label><input type="radio" name="inuse" value="0" checked="checked">Все</label>

                                <!--  Phones -->
                                <?= $form->field($subcat, "options[phone][display]")
                                    ->checkboxList(
                                        ['{"disp_from":"1","disp_to":"3"}'=>'менее 3"','{"disp_from":"3","disp_to":"4"}'=>'3" - 4"','{"disp_from":"4","disp_to":"5"}'=>'4" - 5"','{"disp_from":"5","disp_to":"9"}'=>'5" и более'],
                                        ['class' => 'phone phone-options']
                                    )
                                    ->label('Диагональ экрана:', ['class' => 'phone phone-options control-label']) ?>
                                <?= $form->field($subcat, "options[phone][processor]")
                                    ->checkboxList(
                                        ['1'=>'1 Ядро', '2'=>'2 Ядра', '4'=>'4 Ядра', '6'=>'6 Ядер',  '44'=> '4+4', '8'=>'8 Ядер'],
                                        ['class' => 'phone phone-options']
                                    )
                                    ->label('Количество ядер:', ['class' => 'phone phone-options control-label']) ?>
                                <?= $form->field($subcat, "options[phone][os]")
                                    ->checkboxList(
                                        ['Adroid'=>'Adroid', 'Apple IOS'=>'Apple IOS', 'Windows'=>'Windows','Symbian'=>'Symbian'],
                                        ['class' => 'phone phone-options']
                                    )
                                    ->label('Операционная система:', ['class' => 'phone phone-options control-label']) ?>

                                <?= $form->field($subcat, "options[phone][ozu]")
                                    ->checkboxList(
                                        ['1'=>'1 Гб', '2'=>'2 Гб', '4'=>'4 Гб'],
                                        ['class' => 'phone phone-options']
                                    )
                                    ->label('Оперативная память:', ['class' => 'phone phone-options control-label']) ?>

                                <!--    Computers              -->
                                <?= $form->field($subcat, "options[comp][os]")
                                    ->checkboxList(
                                        ['Adroid'=>'Adroid', 'Apple IOS'=>'Apple IOS', 'Windows'=>'Windows','Dos'=>'Dos','Linux'=>'Linux'],
                                        ['class' => 'comp comp-os']
                                    )
                                    ->label('Операционная система:', ['class' => 'comp comp-os control-label']) ?>

                                <?= $form->field($subcat, "options[comp][display]")
                                    ->checkboxList(
                                        ['{"disp_from":"7","disp_to":"8"}'=>'7" - 8"', '{"disp_from":"8","disp_to":"9"}'=>'8" - 9"',
                                            '{"disp_from":"9","disp_to":"10"}'=>'9" - 10"', '{"disp_from":"10","disp_to":"11"}'=>'10" - 11"',
                                            '{"disp_from":"12","disp_to":"13"}'=>'все 12"','{"disp_from":"14","disp_to":"15"}'=>'все 14"',
                                            '{"disp_from":"15","disp_to":"16"}'=>'15"-16"','{"disp_from":"10","disp_to":"17"}'=>'до 17"',
                                            '{"disp_from":"17","disp_to":"21"}'=>'17" и более'],
                                        ['class' => 'comp comp-display']
                                    )
                                    ->label('Диагональ экрана:', ['class' => 'comp comp-display control-label']) ?>

                                <?= $form->field($subcat, "options[comp][processor]")
                                    ->checkboxList(
                                        ['1'=>'1 Ядро', '2'=>'2 Ядра', '4'=>'4 Ядра'],
                                        ['class' => 'comp comp-processor']
                                    )
                                    ->label('Количество ядер:', ['class' => 'comp comp-processor control-label']) ?>

                                <?= $form->field($subcat, "options[comp][ozu]")
                                    ->checkboxList(
                                        ['2'=>'2 Гб', '4'=>'4 Гб', '8'=>'8 Гб', '16'=>'16 Гб', '32'=>'32 Гб'],
                                        ['class' => 'comp comp-ozu']
                                    )
                                    ->label('Оперативная память:', ['class' => 'comp comp-ozu control-label']) ?>
                                <!--  Audio&video -->
                                <!-- Headphones -->
                                <?= $form->field($subcat, "options[av][type_naushnikov]")
                                    ->checkboxList(
                                        ['Вкладыши'=>'Вкладыши', 'Накладные'=>'Накладные', 'Полноразмерные'=>'Полноразмерные', 'Внутриканальные (в ушной канал)'=>'Внутриканальные (в ушной канал)'],
                                        ['class' => 'audio-video type0']
                                    )
                                    ->label('Тип наушников:', ['class' => 'audio-video type0 control-label']) ?>
                                <!-- Mp3 -players -->
                                <?= $form->field($subcat, "options[av][memory]")
                                    ->checkboxList(
                                        ['1'=>'1 Гб', '2'=>'2 Гб', '4'=>'4 Гб', '8'=>'8 Гб', '16'=>'16 Гб', '32'=>'32 Гб'],
                                        ['class' => 'audio-video option1']
                                    )
                                    ->label('Оюъем памяти:', ['class' => 'audio-video option1 control-label']) ?>
                                <!-- Home cinema -->
                                <?= $form->field($subcat, "options[av][type_kinoteatra]")
                                    ->checkboxList(
                                        ['Напольный'=>'Напольный', 'Полочный'=>'Полочный', 'Звуковой проектор'=>'Звуковой проектор'],
                                        ['class' => 'audio-video type1']
                                    )
                                    ->label('Тип кинотеатра:', ['class' => 'audio-video type1 control-label']) ?>

                                <?= $form->field($subcat, "options[av][power]")
                                    ->checkboxList(
                                        ['200'=>'до 200Вт', '500'=>'до 500Вт', '501'=>'более 500Вт'],
                                        ['class' => 'audio-video type3']
                                    )
                                    ->label('Номинальная мощность:', ['class' => 'audio-video type3 control-label']) ?>
                                <!--    Mediaplayers        -->
                                <?= $form->field($subcat, "options[av][category]")
                                    ->checkboxList(
                                        ['HD-медиаплеер'=>'HD-медиаплеер', 'Стационарный медиаплеер'=>'Стационарный медиаплеер'],
                                        ['class' => 'audio-video type4']
                                    )
                                    ->label('Категория устройства:', ['class' => 'audio-video type4 control-label']) ?>

                                <!-- Home -->
                                <!--    fridges        -->
                                <?= $form->field($subcat, "options[home][type_fridges]")
                                    ->checkboxList(
                                        [   'С нижней морозильной камерой'=>'С нижней морозильной камерой', 'С верхней морозильной камерой'=>'С верхней морозильной камерой',
                                            'Однокамерные'=>'Однокамерные', 'Side-by-side'=>'Side-by-side', 'Встраиваемые'=>'Встраиваемые',
                                            'Винный шкаф'=>'Винный шкаф'
                                        ],
                                        ['class' => 'home fridge-type']
                                    )
                                    ->label('Тип холодильника:', ['class' => 'home fridge-type control-label']) ?>

                                <?= $form->field($subcat, "options[home][type_system]")
                                    ->checkboxList(
                                        [   'No Frost'=>'No Frost', 'Статическая система'=>'Статическая система',
                                            'Комбинированная система'=>'Комбинированная система'
                                        ],
                                        ['class' => 'home fridge-system']
                                    )
                                    ->label('Система охлаждения:', ['class' => 'home fridge-system control-label']) ?>
                                <!-- Washer -->
                                <?= $form->field($subcat, "options[home][type_washer]")
                                    ->checkboxList(
                                        [   'Фронтальная'=>'Фронтальная', 'Вертикальная'=>'Вертикальная', 'Полуавтомат'=>'Полуавтомат',
                                            'Встраиваемая'=>'Встраиваемая'
                                        ],
                                        ['class' => 'home washer-type']
                                    )
                                    ->label('Тип стиральной машины:', ['class' => 'home washer-type control-label']) ?>

                                <?= $form->field($subcat, "options[home][max_load]")
                                    ->checkboxList(
                                        ['5'=>'до 5 кг', '6'=>'до 6 кг', '6,1'=>'более 6 кг'],
                                        ['class' => 'home washer-system']
                                    )
                                    ->label('Максимальная загрузка:', ['class' => 'home washer-system control-label']) ?>

                                <!--    Cleaners -->
                                <?= $form->field($subcat, "options[home][type_pilesos]")
                                    ->checkboxList(
                                        [   'Для сухой уборки без мешка'=>'Для сухой уборки без мешка',
                                            'Для сухой уборки с аквафильтром'=>'Для сухой уборки с аквафильтром',
                                            'Для сухой уборки с мешком'=>'Для сухой уборки с мешком',
                                            'Моющий'=>'Моющий', 'Робот'=>'Робот'
                                        ],
                                        ['class' => 'home cleaner-type']
                                    )
                                    ->label('Тип пылесоса:', ['class' => 'home cleaner-type']) ?>

                                <?= $form->field($subcat, "options[home][power_pilesos]")
                                    ->checkboxList(
                                        ['до 50 Вт'=>'до 50 Вт', 'до 350 Вт'=>'до 350 Вт', '360 Вт и более'=>'360 Вт и более'],
                                        ['class' => 'home cleaner-power']
                                    )
                                    ->label('Мощность всасывания:', ['class' => 'home cleaner-power']) ?>
                                <!-- Plates -->
                                <?= $form->field($subcat, "options[home][type_pliti]")
                                    ->checkboxList(
                                        [   'Газовая'=>'Газовая', 'Электрическая'=>'Электрическая',
                                            'Настольная электрическая'=>'Настольная электрическая',
                                            'Настольная газовая'=>'Настольная газовая'
                                        ],
                                        ['class' => 'home plate']
                                    )
                                    ->label('Тип плиты:', ['class' => 'home plate control-label']) ?>

                                <?= $form->field($subcat, "options[home][type_shkafa]")
                                    ->checkboxList(
                                        ['Газовый'=>'Газовый', 'Электрический'=>'Электрический'],
                                        ['class' => 'home plate-type']
                                    )
                                    ->label('Тип духового шкафа:', ['class' => 'home plate-type control-label']) ?>

                                <?= $form->field($subcat, "options[home][type_panel]")
                                    ->checkboxList(
                                        [   'Газовая'=>'Газовая', 'Электрическая'=>'Электрическая',
                                            'Комбинированная'=>'Комбинированная',
                                            'Индукционная'=>'Индукционная'
                                        ],
                                        ['class' => 'home plate-system']
                                    )
                                    ->label('Тип варочной панели:', ['class' => 'home plate-system control-label']) ?>
                                <!-- microwave -->
                                <?= $form->field($subcat, "options[home][type_svch]")
                                    ->checkboxList(
                                        ['Гриль'=>'Гриль', 'Соло'=>'Соло', 'Конвекция'=>'Конвекция', 'СВЧ печь встраиваемая'=>'СВЧ печь встраиваемая'],
                                        ['class' => 'home microwave']
                                    )
                                    ->label('Тип СВЧ:', ['class' => 'home microwave control-label']) ?>

                                <?= $form->field($subcat, "options[home][type_control]")
                                    ->checkboxList(
                                        ['Электронное'=>'Электронное', 'Механическое'=>'Механическое'],
                                        ['class' => 'home microwave-type']
                                    )
                                    ->label('Тип управления:', ['class' => 'home microwave-type control-label']) ?>

                                <?= $form->field($subcat, "options[home][type_volume]")
                                    ->checkboxList(
                                        ['20'=>'до 20л', '25'=>'до 25л', '26'=>'26л и более'],
                                        ['class' => 'home microwave-system']
                                    )
                                    ->label('Объем камеры:', ['class' => 'home microwave-system control-label']) ?>
                                <!-- Care -->
                                <?= $form->field($subcat, "options[shave]")
                                    ->dropDownList(
                                        ['Бритвы', 'Эпиляторы', 'Машинки для стрижки'],
                                        ['prompt' => 'Все:', 'class' => 'care shave form-control', 'id' => 'shave-type']
                                    )
                                    ->label('Выберите устройство', ['class' => 'care shave control-label']) ?>


                                <?= $form->field($subcat, "options[shave-brand]")
                                    ->dropDownList(
                                        ['Braun', 'Panasonic', 'Bosch', 'Philips', 'Gorenje', 'Beurer', 'Scarlett', 'Saturn'],
                                        ['prompt' => 'Выберете бренд', 'class' => 'care shave-brand form-control']
                                    )
                                    ->label('Бренд:', ['class' => 'care shave-brand control-label']) ?>
                                <!-- tv -->
                                <?= $form->field($subcat, "options[tv][display]")
                                    ->checkboxList(
                                        ['{"disp_from":"15","disp_to":"27"}'=>'15" - 27"', '{"disp_from":"28","disp_to":"32"}'=>'28" - 32"', '{"disp_from":"37","disp_to":"43"}'=>'37" - 43"',
                                            '{"disp_from":"46","disp_to":"53"}'=>'46" - 53"','{"disp_from":"54","disp_to":"72"}'=>'54" и более'],
                                        ['class' => 'tv-disp']
                                    )
                                    ->label('Диагональ экрана:', ['class' => 'tv-disp control-label']) ?>

                                <select class="form-control photocam">
                                    <option>Фотокамеры компактные</option>
                                    <option>Фотокамеры зеркальные</option>
                                    <option>Фотокамеры беззеркальные </option>
                                    <option>Объективы </option>
                                    <option>Вспышки</option>
                                </select>
                                <select class="form-control videocam">
                                    <option>Портативные видеокамеры</option>
                                    <option>Экшн-камеры</option>
                                    <option>Крепления для экшн-камер</option>
                                    <option>Защитные боксы для экшн-камер</option>
                                    <option>Пульты ДУ для фото и экшн-камер</option>

                                </select>
                                <select class="form-control videoregister">
                                    <option>Видеорегистраторы</option>
                                    <option>GPS навигаторы</option>
                                    <option>Автохолодильники</option>
                                    <option>Радардетекторы</option>
                                    <option>FM-модуляторы</option>
                                </select>
                                <select class="form-control photoacc">
                                   <option>Карты памяти</option>
                                   <option>Сумки и чехлы</option>
                                   <option>Штативы</option>
                                   <option>Аккумуляторы и батарейки</option>
                                   <option>Зарядные устройства и аккумуляторы</option>
                                   <option>Фоторамки электронные</option>
                                   <option>Фотобумага</option>
                                   <option>Светофильтры</option>
                                   <option>Чистящие средства</option>
                                </select>
                            </div>
                            <div class="search col-md-6 col-md-offset-3">
                                <?= Html::submitButton('Подать заявку', ['class' => 'btn btn-primary btn-info btn-block', 'name' => 'electronic']) ?>
                            </div>
                            <?php ActiveForm::end(); ?>
                        </div>
<!--      Transport Form              -->
                        <div  class="form transport">
                            <div class="close transport"><i class="fa fa-times"></i></div>
                            <?php
                            $title = 'form-transport'/*.$category['id']*/;
                            $form = ActiveForm::begin(['id' => $title, 'action' => '/search', 'method' => 'get']) ?>
                            <div class="col-md-12">
                                <input type="text" name="text" class="form-control" style="width: 100%; margin-bottom: 20px;" placeholder="Поиск транспорта">
                            </div>
                            <div class="col-md-6">
                                <div class="form-group form-inline">
                                    <input type="hidden" name="category_id" value="2">
                                    <label class="control-label left-40" for="price-from">Цена от:</label>
                                    <label class="control-label left-40" for="price-to">Цена до:</label>
                                    <label class="control-label left-20" for="currency">Валюта</label>
                                    <input type="number" name="price-from" class="form-control left-40" style="margin-bottom: 20px">
                                    <input type="number" name="price-to" class="form-control left-40" style="margin-bottom: 20px">
                                    <select class="form-control left-20" name="currency">
                                        <option value="uah">грн.</option>
                                        <option value="usd">$</option>
                                    </select>
                                </div>
                                <?php
                                echo '<div class="form-group field-sub_cat has-success">
                                            <select id="region" class="form-control" name="region">';
                                echo '<option value>Выберете регион</option>';
                                foreach($option->cities as $key=>$value){
                                    echo '<option value="'.$value.'">'.$key.'</option>';
                                }
                                echo '    </select>
                                          </div>';
                                ?>
                                <div class="form-group field-sub_cat has-success">
                                    <select class="form-control" id="categories" name="car_category_id"
                                            data-field="category" data-placeholder="Выберете категорию">
                                        <option value="0">Выберете категорию</option>
                                        <option value="1">Легковые</option>
                                        <option value="6">Грузовики</option>
                                        <option value="4">Спецтехника</option>
                                        <option value="2">Мото</option>
                                        <option value="7">Автобусы</option>
                                        <option value="5">Прицепы</option>
                                        <option value="3">Водный транспорт</option>
                                        <option value="8">Автодома</option>
                                        <option value="9">Воздушный транспорт</option>
                                        <option value="10">Запчасти</option>
                                    </select>
                                </div>
                                <div class="cars">
                                    <div class="form-group field-sub_cat has-success">
                                        <select class="form-control" id="marks" name="car_marka_id" data-field="brand"
                                                data-placeholder="Марка ">
                                            <option value="0">Марка</option>
                                        </select>
                                    </div>
                                    <div class="form-group field-sub_cat has-success">
                                        <select class="form-control" id="models" name="car_model_id" data-field="model"
                                                data-placeholder="Модель">
                                            <option value="0">Модель</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group zapchasti">

                                    <select class="form-control">
                                        <option>Автозапчасти</option>
                                        <option>Аксессуары для авто</option>
                                        <option>Мото аксессуары</option>
                                        <option>Мотозапчасти</option>
                                        <option>Шины / диски</option>
                                        <option>Автозвук</option>
                                        <option>GPS-навигаторы / авторегистраторы</option>
                                        <option>Запчасти для спец / с.х. техники</option>
                                        <option>Транспорт на запчасти</option>
                                        <option>Прочие запчасти</option>
                                    </select>
                                </div>
                                <input type="hidden" name="category_id" value="2">

                            </div>
                            <div class="col-md-6">
                                <label class="control-label inuse" for="inuse" style="display: block;">Выберете состояние</label>
                                <label><input type="radio" name="inuse" value="10">Новое</label>
                                <label><input type="radio" name="inuse" value="1">Б.У.</label>
                                <label><input type="radio" name="inuse" value="0" checked="checked">Все</label>
                                <div class="cars">
                                    <label class="control-label " for="year-from" style="margin: 0">Год выпуска:</label>
                                    <select id="year-from" class="form-control left-50" name="year-from">
                                        <option value>от</option>
                                        <?php
                                        foreach($option->year as $value) {
                                            echo '<option value = "'.$value.'" >'.$value.'</option >';
                                        }
                                        ?>
                                    </select>
                                    <select id="year-to" class="form-control left-50" name="year-to">
                                        <option value>до</option>
                                        <?php
                                        foreach($option->year as $value) {
                                            echo '<option value = "'.$value.'" >'.$value.'</option >';
                                        }
                                        ?>
                                    </select>
                                    <div class="form-group field-sub_cat has-success">
                                        <select id="fuel" class="form-control" name="fuel">
                                            <option value>Тип топлива</option>

                                            <?php
                                            foreach($option->fuel as $value) {
                                                echo '<option value = "'.$value.'" >'.$value.'</option >';
                                            }
                                            ?>
                                        </select>
                                    </div>
                                    <div class="form-group field-sub_cat has-success">
                                        <select id="transmission" class="form-control" name="transmission">
                                            <option value>Коробка передач:</option>

                                            <?php
                                            foreach($option->transmission as $value) {
                                                echo '<option value = "'.$value.'" >'.$value.'</option >';
                                            }
                                            ?>
                                        </select>
                                    </div>

                                </div>
                            </div>
                            <div class="search col-md-6 col-md-offset-3">
                                <?= Html::submitButton('Подать заявку', ['class' => 'btn btn-primary btn-info btn-block', 'name' => 'create-transport']) ?>
                            </div>
                            <?php ActiveForm::end(); ?>
                        </div>
<!--       Property Form              -->
                        <div  class="form property">
                            <div class="close property"><i class="fa fa-times"></i></div>

                            <?php
                            $title = 'form-property'/*.$category['id']*/;
                            $form = ActiveForm::begin(['id' => $title, 'action' => '/search', 'method' => 'get']) ?>
                            <div class="col-md-12">
                                <input type="hidden" name="category_id" value="3">
                                <input type="text" name="text" class="form-control" style="width: 100%; margin-bottom: 20px;" placeholder="Поиск недвижимости">

                            </div>

                            <div class="col-md-6">

                                <div class="form-group form-inline">
                                    <input type="hidden" name="category_id" value="2">
                                    <label class="control-label left-40" for="price-from">Цена от:</label>
                                    <label class="control-label left-40" for="price-to">Цена до:</label>
                                    <label class="control-label left-20" for="currency">Валюта</label>
                                    <input type="number" name="price-from" class="form-control left-40" style="margin-bottom: 20px">
                                    <input type="number" name="price-to" class="form-control left-40" style="margin-bottom: 20px">
                                    <select class="form-control left-20" name="currency">
                                        <option value="uah">грн.</option>
                                        <option value="usd">$</option>
                                    </select>
                                </div>
                                <?php
                                echo '<div class="form-group field-sub_cat has-success">
                                            <select id="region" class="form-control" name="region">';
                                echo '<option value>Выберете регион</option>';
                                foreach($option->cities as $key=>$value){
                                    echo '<option value="'.$value.'">'.$key.'</option>';
                                }
                                echo '    </select>
                                          </div>';
                                ?>
                                <?= $form->field($subcat, 'title')->dropDownList(
                                    ArrayHelper::map(\common\models\Subcategory::find()->where(['category_id' => 3/*$category['id']*/])->all(), 'id', 'title'),
                                    ['prompt' => 'Выберете категорию', 'id' => 'sub_cat_prop']
                                )->label(false); ?>
                                <?= $form->field($subcat,'category_id')->hiddenInput(['value'=>'3'])->label(false); ?>
                                <select class="form-control commerce">
                                    <option>Выберете тип</option>
                                    <option>Аренда магазинов / салонов</option>
                                    <option>Аренда ресторанов / баров</option>
                                    <option>Аренда офисов</option>
                                    <option>Аренда складов</option>
                                    <option>Прочее</option>
                                </select>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group field-comnats">
                                    <label class="comnats control-label" for="comnats" style="display: block;">Количество комнат:</label>
                                    <input type="hidden" name="comnats" value=""><div id="comnats_type" class="comnats" style="display: block;">
                                        <label><input type="checkbox" name="comnats" value="1">1 комната</label>
                                        <label><input type="checkbox" name="comnats" value="2 IOS">2 комнаты</label>
                                        <label><input type="checkbox" name="comnats" value="3">3 комнаты</label>
                                        <label><input type="checkbox" name="comnats" value="4">4 комнаты</label>
                                        <label><input type="checkbox" name="comnats" value="5">5 комнат</label>
                                        <label><input type="checkbox" name="comnats" value="5">> 5 комнат</label>
                                    </div>

                                    <div class="help-block"></div>
                                </div>
                                <div class="form-group field-area">
                                    <div class="area">
                                        <label class="control-label left-50" for="price-from">Площадь от, м<sup>2</sup>:</label>
                                        <label class="control-label left-50" for="price-to">Площадь до, м<sup>2</sup>:</label>
                                        <input type="number" name="price-from_dol" class="form-control left-50" style="margin-bottom: 20px">
                                        <input type="number" name="price-to_dol" class="form-control left-50" style="margin-bottom: 20px">
                                    </div>
                                </div>

                            </div>
                            <div class="search col-md-6 col-md-offset-3">
                                <?= Html::submitButton('Подать заявку', ['class' => 'btn btn-primary btn-info btn-block', 'name' => 'property']) ?>
                            </div>
                            <?php ActiveForm::end(); ?>
                        </div>
<!--       Otdyh i sport Form              -->
                        <div  class="form leisure">
                            <div class="close leisure"><i class="fa fa-times"></i></div>

                            <?php
                            $title = 'form-leisure'/*.$category['id']*/;
                            $form = ActiveForm::begin(['id' => $title, 'action' => '/search', 'method' => 'get']) ?>
                            <div class="col-md-12">
                                <input type="hidden" name="category_id" value="4">
                                <input required type="text" name="text" class="form-control" style="width: 100%; margin-bottom: 20px;" placeholder="Введите поисковый запрос">
                            </div>
                            <div class="col-md-6">
                                <div class="form-group form-inline">

                                    <label class="control-label left-50" for="price-from">Цена от, грн:</label>
                                    <label class="control-label left-50" for="price-to">Цена до, грн:</label>
                                    <input type="number" name="price-from" class="form-control left-50" style="margin-bottom: 20px">
                                    <input type="number" name="price-to" class="form-control left-50" style="margin-bottom: 20px">
                                </div>

                            </div>
                            <div class="col-md-6"></div>
                            <div class="search col-md-6 col-md-offset-3">
                                <?= Html::submitButton('Подать заявку', ['class' => 'btn btn-primary btn-info btn-block', 'name' => 'leisure']) ?>
                            </div>
                            <?php ActiveForm::end(); ?>
                        </div>
<!--       Business Form              -->
                        <div  class="form business">
                            <div class="close business"><i class="fa fa-times"></i></div>

                            <?php
                            $title = 'form-business'/*.$category['id']*/;
                            $form = ActiveForm::begin(['id' => $title, 'action' => '/search', 'method' => 'get']) ?>
                            <div class="col-md-12">
                                <input type="hidden" name="category_id" value="5">
                                <input required type="text" name="text" class="form-control" style="width: 100%; margin-bottom: 20px;" placeholder="Поиск услуг">

                            </div>
                            <div class="col-md-6">
                                <div class="form-group form-inline">
                                </div>
                                <?= $form->field($subcat, 'title')->dropDownList(
                                    ArrayHelper::map(\common\models\Subcategory::find()->where(['category_id' => 5/*$category['id']*/])->all(), 'id', 'title'),
                                    ['prompt' => 'Выберете категорию', 'id' => 'sub_cat']
                                )->label(false); ?>
                                <?= $form->field($subcat,'category_id')->hiddenInput(['value'=>'5'])->label(false); ?>
                                <?php
                                echo '<div class="form-group field-sub_cat has-success">
                                            <select id="region" class="form-control" name="region">';
                                echo '<option value>Выберете регион</option>';
                                foreach($option->cities as $key=>$value){
                                    echo '<option value="'.$value.'">'.$key.'</option>';
                                }
                                echo '    </select>
                                          </div>';
                                ?>
                            </div>
                            <div class="col-md-6"></div>
                            <div class="search col-md-6 col-md-offset-3">
                                <?= Html::submitButton('Подать заявку', ['class' => 'btn btn-primary btn-info btn-block', 'name' => 'business']) ?>
                            </div>
                            <?php ActiveForm::end(); ?>
                        </div>
<!--       Jobs Form              -->
                        <div  class="form jobs">
                            <div class="close jobs"><i class="fa fa-times"></i></div>

                            <?php
                            $title = 'form-jobs'/*.$category['id']*/;
                            $form = ActiveForm::begin(['id' => $title, 'action' => '/search', 'method' => 'get']) ?>
                            <div class="col-md-12">
                                <div class="form-group form-inline">
                                    <input type="hidden" name="category_id" value="6">
                                    <input required type="text" name="text" class="form-control" style="width: 100%; margin-bottom: 20px;" placeholder="Поиск работы">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <?php
                                echo '<div class="form-group field-sub_cat has-success">
                                            <select id="region" class="form-control" name="region">';
                                echo '<option value>Выберете регион</option>';
                                foreach($option->cities as $key=>$value){
                                    echo '<option value="'.$value.'">'.$key.'</option>';
                                }
                                echo '    </select>
                                          </div>';
                                ?>
                                <?= $form->field($subcat, 'title')->dropDownList(
                                    ArrayHelper::map(\common\models\Subcategory::find()
                                        ->where(['category_id' => 6])
                                        ->all(), 'id', 'title'),
                                    ['prompt' => 'Выберете категорию', 'id' => 'sub_cat']
                                )->label(false); ?>
                                <?= $form->field($subcat,'category_id')->hiddenInput(['value'=>'6'])->label(false); ?>

                            </div>
                            <div class="col-md-6">
                                <label class="control-label left-50" for="price-from">Зарплата от:</label>
                                <label class="control-label left-50" for="price-to">Зарплата до:</label>
                                <input type="number" name="price-from_dol" class="form-control left-50" style="margin-bottom: 20px">
                                <input type="number" name="price-to_dol" class="form-control left-50" style="margin-bottom: 20px">
                            </div>
                            <div class="search col-md-6 col-md-offset-3">
                                <?= Html::submitButton('Подать заявку', ['class' => 'btn btn-primary btn-info btn-block', 'name' => 'jobs']) ?>
                            </div>
                            <?php ActiveForm::end(); ?>

                </div>
            </div>
        </div>
    </div>
</div>
<div class="text container-fluid">
    <div class="container">
        <div class="row">
            <h2>Что такое портал "Сыщик"?</h2>
            <p>
                SISHIK занимается поиском необходимых вам товаров и услуг по заданной цене. На сегодняшний день наши
                специалисты мониторят около 200 популярных сайтов. В данный момент над заказами наших клиентов
                работают свыше 80 человек,что позволяет быстро обеспечить желаемый результат.<br/><br/> Всего за первый месяц,
                наша молодая компания заслужила доверие более 4000 человек,которые являются нашими постоянными
                клиентами. Наша цель максимально быстро Подать заявку желаемое и сообщить об этом Вам.Доверьтесь
                профессиональным SISHIKам и результат не заставит себя ждать.
            </p>
        </div>
    </div>
</div>
    <div class="services container-fluid">
        <div class="container">
            <div class="row">
                <div class="col-md-12 center">
                    <h2>Какие услуги мы предоставляем своим клиентам?</h2>
                </div>
                <div class="col-md-3 col-md-offset-1 serv-desc">

                    <a href="#"><i class="fa fa-shopping-basket icon-fa"></i></a>

                    <p>Подбор товара или услуги по описанию</p>

                </div>
                <div class="col-md-3 serv-desc">
                    <a href="#"><i class="fa fa-usd icon-fa"></i></a>

                    <p>Подбор товара по заданному ценовому диапазону</p>
                </div>
                <div class="col-md-3 serv-desc">
                    <a href="#"><i class="fa fa-mobile icon-fa"></i></a>

                    <p>Моментальное извещение о появлении товара в наличии</p>
                </div>
            </div>
        </div>
    </div>
<div class="usage container-fluid">
        <div class="container">
            <div class="row">
                <div class="col-md-12 center">
                    <h2>Как пользоваться нашим сервисом?</h2>
            <p>Достаточно просто набрать название модели товара или услуги в соответствующей строке в форме поиска.
                Фильтры отбора по параметрам и датам сортировки позволят вам подобрать желаемое. </p>
                </div>
            </div>
        </div>
</div>
<div class="services container-fluid">
    <div class="container">
        <div class="row">
            <div class="col-md-12 center">
                <h2>Наши тарифные планы</h2>
            </div>
            <div class="col-md-3 col-md-offset-1 serv-desc">
                <a href="#"><i class="fa fa-envelope-o icon-fa"></i></i></a>

                <p>Стандартный</p>
                <h3>150 грн. в мес.</h3>
                <p>5 SMS в день</p>
            </div>
            <div class="col-md-3 serv-desc">
                <a href="#"><i class="fa fa-envelope icon-fa"></i></a>

                <p>Средний</p>
                <h3>300 грн. в мес.</h3>
                <p>10 SMS в день</p>

            </div>
            <div class="col-md-3 serv-desc">
                <a href="#"><i class="fa fa-envelope-o icon-fa"></i></a>
                <p>Максимальный</p>
                <h3>450 грн. в мес.</h3>
                <p>15 SMS в день</p>

            </div>
        </div>
    </div>
</div>
