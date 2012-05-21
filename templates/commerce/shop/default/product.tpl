{# Variables
# @var model
# @var editProductUrl
# @var jsCode
#}

{$jsCode}

{$forCompareProducts = $CI->session->userdata('shopForCompare')}

<script type="text/javascript">
    var currentProductId = '{echo $model->getId()}';
</script>
<!-- BEGIN STAR RATING -->
<link rel="stylesheet" type="text/css" href="{$SHOP_THEME}js/rating/jquery.rating-min.css" />
<script src="{$SHOP_THEME}js/rating/jquery.rating-min.js"></script>
<script src="{$SHOP_THEME}js/rating/jquery.MetaData-min.js"></script>
<script src="{$SHOP_THEME}js/product.js"></script>

<!-- BEGIN LIGHTBOX -->
<script type="text/javascript" src="{$SHOP_THEME}js/lightbox/scripts/jquery.color.min.js"></script>
<script type="text/javascript" src="{$SHOP_THEME}js/lightbox/scripts/jquery.lightbox.min.js"></script>
<link type="text/css" rel="stylesheet" media="screen" href="{$SHOP_THEME}js/lightbox/styles/jquery.lightbox.min.css" />
<!-- END LIGHTBOX -->


<div class="content">
    <div class="center">
        <div class="tovar_frame clearfix">
            <div class="thumb_frame f_l">
                <span>
                    <a href="#" class="active">
                        <img src="images/temp/thumb_img.jpg"/>
                    </a>
                </span>
                <span>
                    <a href="#">
                        <img src="images/temp/thumb_img.jpg"/>
                    </a>
                </span>
                <span>
                    <a href="#">
                        <img src="images/temp/thumb_img.jpg"/>
                    </a>
                </span>
            </div>
            <div class="photo_block">
                <a href="#">
                    <img src="images/temp/big_img.jpg"/>
                </a>
            </div>
            <div class="func_description">
                <div class="crumbs">
                    {renderCategoryPath($model->getMainCategory())}
                </div>
                <h1>{echo ShopCore::encode($model->getName())}</h1>
                <div class="f-s_0">
                    <span class="code">Код: {echo $model->firstvariant->getNumber()}</span>
                    <div class="di_b star">
                        {$rating = $model->getRating()}
                        <input class="hover-star" type="radio" name="rating-1" value="1" {if $rating==1}checked="checked"{/if}/>
                        <input class="hover-star" type="radio" name="rating-1" value="2" {if $rating==2}checked="checked"{/if}/>
                        <input class="hover-star" type="radio" name="rating-1" value="3" {if $rating==3}checked="checked"{/if}/>
                        <input class="hover-star" type="radio" name="rating-1" value="4" {if $rating==4}checked="checked"{/if}/>
                        <input class="hover-star" type="radio" name="rating-1" value="5" {if $rating==5}checked="checked"{/if}/>
                    </div>
                    <a href="#" class="response">{echo $model->totalComments()} {echo SStringHelper::Pluralize($model->totalComments(), array('отзыв', 'отзывы', 'отзывов'))}</a>
                    <div class="social_small di_b">
                        <a href="#" class="facebook"></a>
                        <a href="#" class="vkontakte"></a>
                        <a href="#" class="twitter"></a>
                        <a href="#" class="mail"></a>
                    </div>
                </div>
                <div class="buy clearfix">
                    <div class="price f-s_26">{echo $model->firstVariant->toCurrency()}<sub> {$CS}</sub><span class="d_b">{echo $model->getOldPrice()}$</span></div>
                    <!--<div class="buttons button_big_green f_l">
                        <a href="#">Купить</a>
                        </div>-->
                    <!--<div class="buttons button_big_blue f_l">
                        <a href="#">Оформить заказ</a>
                        </div>-->
                    {if $model->firstvariant->getstock()== 0}
                        <div class="buttons button_big_green f_l">
                            <a id="send-request" href="">Сообщить о появлении</a>
                        </div>
                    {else:}
                        <div class="buttons button_big_green f_l">
                            <a href="" class="goBuy" data-prodid="{echo $model->getId()}" data-varid="{echo $model->firstVariant->getId()}" >Купить</a>
                        </div>
                    {/if}
                    <div class="f_l">
                        <span class="ajax_refer_marg">
                            {if $forCompareProducts && in_array($model->getId(), $forCompareProducts)}
                                <a href="{shop_url('compare')}" class="js gray">Сравнить</a>
                            {else:}
                                <a href="{shop_url('compare/add/'. $model->getId())}" data-prodid="{echo $model->getId()}" class="js gray toCompare">Добавить к сравнению</a>
                            {/if}
                        </span>
                        <a data-varid="{echo $model->firstVariant->getId()}" data-prodid="{echo $model->getId()}" href="#" class="js gray addToWList">Сохранить в список желаний</a>
                            
                    </div>
                </div>
                <p class="c_b">{echo $model->getShortDescription()}</p>
                <div><img src="images/temp/SOCIAL_like.png"/></div>
            </div>
        </div>
        <ul class="info_buy">
            <li>
                <img src="images/order_phone.png">
                <div>
                    <div class="title">Заказ по телефону:</div>
                    <span>(093) 000-20-00</span>
                    <span>(093) 000-08-00</span> 
                    <span>(093) 000-40-00</span>
                </div>
            </li>
            <li>
                <img src="images/buy.png">
                <div>
                    <div class="title">Оплата <span>(узнать больше)</span></div>
                    <span class="small_marker">Наличными при получении заказа</span>
                    <span class="small_marker">Переводом через Сбербанк РФ</span>
                    <span class="small_marker">Безналичным переводом </span>
                </div>
            </li>
            <li>
                <img src="images/deliver.png">
                <div>
                    <div class="title">Доставка <span>(узнать больше)</span></div>
                    <span class="small_marker">Транспортные компании</span>
                    <span class="small_marker">Укрпочта</span>
                    <span class="small_marker">Курьерская служба</span>
                </div>
            </li>
        </ul>
    </div>
    <div class="f-s_18 c_6 center">Акционное предложение</div>
    <div class="promotion carusel_frame">
        <div class="carusel">
            <ul>
                <li>
                    <div class="f_l smallest_item">
                        <div class="photo_block">
                            <a href="#">
                                <img src="images/temp/small_img.jpg"/>
                            </a>
                        </div>
                        <div class="func_description">
                            <a href="#" class="title">Asus X54C (X54C-SX006D) Black</a>
                            <div class="buy">
                                <div class="price f-s_14">4528 <sub>грн.</sub><span>859 $</span></div>
                            </div>
                        </div>
                    </div>
                    <div class="plus_eval">+</div>
                    <div class="f_l smallest_item">
                        <div class="photo_block">
                            <a href="#">
                                <img src="images/temp/small_img.jpg"/>
                                <span class="discount">-15%</span>
                            </a>
                        </div>
                        <div class="func_description">
                            <a href="#" class="title">Asus X54C (X54C-SX006D) Black</a>
                            <div class="buy">
                                <del class="price f-s_12 price-c_9">4528 <sub>грн.</sub><span>859 $</span></del>
                                <div class="price f-s_14 price-c_red">4528 <sub>грн.</sub><span>859 $</span></div>
                            </div>
                        </div>
                    </div>
                    <div class="plus_eval">+</div>
                    <div class="f_l smallest_item">
                        <div class="photo_block">
                            <a href="#">
                                <img src="images/temp/small_img.jpg"/>
                                <span class="discount">-15%</span>
                            </a>
                        </div>
                        <div class="func_description">
                            <a href="#" class="title">Asus X54C (X54C-SX006D) Black</a>
                            <div class="buy">
                                <div class="price f-s_14">4528 <sub>грн.</sub><span>859 $</span></div>
                            </div>
                        </div>
                    </div>
                    <div class="plus_eval">=</div>
                    <div class="button_block">
                        <div class="buy">
                            <del class="price f-s_14 price-c_9">4528 <sub>грн.</sub><span>859 $</span></del>
                            <div class="price f-s_18">4528 <sub>грн.</sub><span>859 $</span></div>
                        </div>
                        <div class="buttons button_middle_blue">
                            <a href="#">Оформить комплект</a>
                        </div>
                    </div>
                </li>
                <li>
                    <div class="f_l smallest_item">
                        <div class="photo_block">
                            <a href="#">
                                <img src="images/temp/small_img.jpg"/>
                            </a>
                        </div>
                        <div class="func_description">
                            <a href="#" class="title">Asus X54C (X54C-SX006D) Black</a>
                            <div class="buy">
                                <div class="price f-s_14">4528 <sub>грн.</sub><span>859 $</span></div>
                            </div>
                        </div>
                    </div>
                    <div class="plus_eval">+</div>
                    <div class="f_l smallest_item">
                        <div class="photo_block">
                            <a href="#">
                                <img src="images/temp/small_img.jpg"/>
                            </a>
                        </div>
                        <div class="func_description">
                            <a href="#" class="title">Asus X54C (X54C-SX006D) Black</a>
                            <div class="buy">
                                <del class="price f-s_12 price-c_9">4528 <sub>грн.</sub><span>859 $</span></del>
                                <div class="price f-s_14 price-c_red">4528 <sub>грн.</sub><span>859 $</span></div>
                            </div>
                        </div>
                    </div>
                    <div class="plus_eval">+</div>
                    <div class="f_l smallest_item">
                        <div class="photo_block">
                            <a href="#">
                                <img src="images/temp/small_img.jpg"/>
                            </a>
                        </div>
                        <div class="func_description">
                            <a href="#" class="title">Asus X54C (X54C-SX006D) Black</a>
                            <div class="buy">
                                <div class="price f-s_14">4528 <sub>грн.</sub><span>859 $</span></div>
                            </div>
                        </div>
                    </div>
                    <div class="plus_eval">=</div>
                    <div class="button_block">
                        <div class="buy">
                            <del class="price f-s_14 price-c_9">4528 <sub>грн.</sub><span>859 $</span></del>
                            <div class="price f-s_18">4528 <sub>грн.</sub><span>859 $</span></div>
                        </div>
                        <div class="buttons button_middle_blue">
                            <a href="#">Оформить комплект</a>
                        </div>
                    </div>
                </li>
            </ul>
        </div>
        <button class="prev"></button>
        <button class="next"></button>
    </div>
    <div class="center">
        <div class="tabs f_l w_770 info_tovar">
            <ul class="nav_tabs">
                <li><a href="#first">Информация</a></li>
                <li><a href="#second">Характеристики</a></li>
                <li><a href="#third">Аксессуары</a></li>
                <li><a href="#four">Отзывы(5)</a></li>
            </ul>
            <div id="first">
                <div class="info_text">
                    <p><b>Екран, блискучий в усіх відношеннях</b>
                        Бездоганний екран MacBook Pro зі світлодіодним підсвічуванням, широким кутом огляду і розширеної кольоровою гамою - це екран рівня настільного комп'ютера, тільки на ноутбуці. Тому коли ви дивитеся фільм або створюєте свій, ви працюєте на ідеальному екрані. Найтонше скляне покриття від краю до краю робить цей екран більш міцним і довговічним. Крім того, екран споживає менше енергії і не містить ртуті і миш'яку, тому він екологічніше, ніж його попередники.</p>
                    <p><b>Новий процесор Core i7</b>
                        Новий процесор Intel Core i7 забезпечує збільшення продуктивності до 50% в порівнянні з моделями попереднього покоління. Розроблено на основі новітнього технологічного процесу 32-нм від компанії Intel, цей сучасний двоядерний процесор встановлює нові стандарти для ноутбуків Mac.</p>
                    <p><b>Вбудований контролер пам'яті</b>
                        На відміну від систем, де модулі пам'яті підключені до процесора через окремий контролер, у новому MacBook Pro використовується інтегрований контролер пам'яті, з яких можна підключати пам'ять безпосередньо до процесора. Тепер робота відбувається без посередника. Завдяки більш швидкому доступу до пам'яті кожне ядро ​​відразу отримує доступ до даних, не чекаючи їх доставки, як раніше. Інтегрований контролер пам'яті з кешем третього рівня прискорює роботу MacBook Pro.</p>
                    <p><b>Графічна потужність нового покоління</b>
                        У даній моделі MacBook Pro встановлений новий дискретний графічний процесор ATI Radeon HD 6750M. Потужність цього графічного процесора ще вище, ніж у процесорів попереднього покоління. З метою ще більшої економії енергії в ноутбуках MacBook Pro також встановлена ​​інтегрована графічна плата Intel HD Graphics.
                        <br/>Оптимальна продуктивність. видатна ефективність</p>
                </div>
            </div>
            <div id="second">
                <table class="characteristics" cellspacing="0">
                    <colgroup span="1" width="240"></colgroup>
                    <colgroup span="1" width="530"></colgroup>
                    <tbody>
                        <tr>
                            <th>Бренд:</th>
                            <td>Apple</td>
                        </tr>
                        <tr>
                            <th>Тип процесора:</th>
                            <td>Intel Core i7</td>
                        </tr>
                        <tr>
                            <th>Чястота процесора:</th>
                            <td>2.2 ГГц</td>
                        </tr>
                        <tr>
                            <th>Дісплей:</th>
                            <td>15.6"</td>
                        </tr>
                        <tr>
                            <th>Розширення дісплея:</th>
                            <td>1440x900 WXGA+</td>
                        </tr>
                        <tr>
                            <th>Оперативна память:</th>
                            <td>8 Гб</td>
                        </tr>
                        <tr>
                            <th>Тип оперативної памяті:</th>
                            <td>DDR3</td>
                        </tr>
                        <tr>
                            <th>Чястота оперативної памяті:</th>
                            <td>1333 МГц</td>
                        </tr>
                        <tr>
                            <th>Жосткий диск:</th>
                            <td>500 Гб</td>
                        </tr>
                        <tr>
                            <th>Відеокарта:</th>
                            <td>Radeon HD 6750M</td>
                        </tr>
                        <tr>
                            <th>Память відеокарти:</th>
                            <td>512 Мб GDDR3</td>
                        </tr>
                        <tr>
                            <th>Оптичний накопичувач:</th>
                            <td>8-швидкісний SuperDrive з щілинним завантаженням (DVD±R DL/DVD±RW/CD-RW)</td>
                        </tr>
                        <tr>
                            <th>Мережева карта:</th>
                            <td>10 / 100 / 1000 Мбит/сек</td>
                        </tr>
                        <tr>
                            <th>Wifi:</th>
                            <td>802.11 (b/g/n)</td>
                        </tr>
                        <tr>
                            <th>BlueTooth:</th>
                            <td>2.1 + EDR</td>
                        </tr>
                        <tr>
                            <th>Вебкамера:</th>
                            <td>FaceTime HD (720 p)</td>
                        </tr>
                        <tr>
                            <th>Встановленна ОС:</th>
                            <td>Mac OS X Lion</td>
                        </tr>
                        <tr>
                            <th>Колір:</th>
                            <td>Серебристый</td>
                        </tr>
                        <tr>
                            <th>Роз'єми:</th>
                            <td>2 x USB 2.0, 1 x HDMI, 1 x FireWire (IEEE 1394), 1 x VGA</td>
                        </tr>
                        <tr>
                            <th>Комплект поставки:</th>
                            <td>Ноутбук, акумулятор, адаптер живлення, кабель живлення, диск з ПЗ</td>
                        </tr>
                        <tr>
                            <th>Розміри:</th>
                            <td>364 мм х 249 мм х 24 мм</td>
                        </tr>
                        <tr>
                            <th>Вага:</th>
                            <td>2.54 кг</td>
                        </tr>
                        <tr>
                            <th>Термін гарантії:</th>
                            <td>1 г с/ц</td>
                        </tr>
                        <tr>
                            <th>Сайт виробника:</th>
                            <td>www.apple.com</td>
                        </tr>
                        <tr>
                            <th>Код виробника:</th>
                            <td>MD318RS/A</td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div id="third">
                <ul class="accessories f-s_0">
                    <li>
                        <div class="small_item">
                            <a href="#" class="img"><span><img src="images/temp/item_5.jpg" alt="Apple MacBook Pro A1286" /></span></a>
                            <div class="info">
                                <a href="#" class="title">Apple MacBook Pro A1286 Apple MacBook Pro A1286 Apple</a>
                                <div class="buy">
                                    <div class="price f-s_16 f_l">4528 <sub>грн</sub><span class="d_b">859 $</span></div>
                                    <div class="button_gs buttons"><a href="#">Купить</a></div>
                                </div>
                            </div>
                        </div>
                    </li>
                    <li>
                        <div class="small_item">
                            <a href="#" class="img"><span><img src="images/temp/item_5.jpg" alt="Apple MacBook Pro A1286" /></span></a>
                            <div class="info">
                                <a href="#" class="title">Apple MacBook Pro A1286 Apple MacBook Pro A1286 Apple</a>
                                <div class="buy">
                                    <div class="price f-s_16 f_l">4528 <sub>грн</sub><span class="d_b">859 $</span></div>
                                    <div class="button_gs buttons"><a href="#">Купить</a></div>
                                </div>
                            </div>
                        </div>
                    </li>
                    <li>
                        <div class="small_item">
                            <a href="#" class="img"><span><img src="images/temp/item_5.jpg" alt="Apple MacBook Pro A1286" /></span></a>
                            <div class="info">
                                <a href="#" class="title">Apple MacBook Pro A1286 Apple MacBook Pro A1286 Apple</a>
                                <div class="buy">
                                    <div class="price f-s_16 f_l">4528 <sub>грн</sub><span class="d_b">859 $</span></div>
                                    <div class="button_gs buttons"><a href="#">Купить</a></div>
                                </div>
                            </div>
                        </div>
                    </li>
                    <li>
                        <div class="small_item">
                            <a href="#" class="img"><span><img src="images/temp/item_5.jpg" alt="Apple MacBook Pro A1286" /></span></a>
                            <div class="info">
                                <a href="#" class="title">Apple MacBook Pro A1286 Apple MacBook Pro A1286 Apple</a>
                                <div class="buy">
                                    <div class="price f-s_16 f_l">4528 <sub>грн</sub><span class="d_b">859 $</span></div>
                                    <div class="button_gs buttons"><a href="#">Купить</a></div>
                                </div>
                            </div>
                        </div>
                    </li>
                    <li>
                        <div class="small_item">
                            <a href="#" class="img"><span><img src="images/temp/item_5.jpg" alt="Apple MacBook Pro A1286" /></span></a>
                            <div class="info">
                                <a href="#" class="title">Apple MacBook Pro A1286 Apple MacBook Pro A1286 Apple</a>
                                <div class="buy">
                                    <div class="price f-s_16 f_l">4528 <sub>грн</sub><span class="d_b">859 $</span></div>
                                    <div class="button_gs buttons"><a href="#">Купить</a></div>
                                </div>
                            </div>
                        </div>
                    </li>
                    <li>
                        <div class="small_item">
                            <a href="#" class="img"><span><img src="images/temp/item_5.jpg" alt="Apple MacBook Pro A1286" /></span></a>
                            <div class="info">
                                <a href="#" class="title">Apple MacBook Pro A1286 Apple MacBook Pro A1286 Apple</a>
                                <div class="buy">
                                    <div class="price f-s_16 f_l">4528 <sub>грн</sub><span class="d_b">859 $</span></div>
                                    <div class="button_gs buttons"><a href="#">Купить</a></div>
                                </div>
                            </div>
                        </div>
                    </li>
                </ul>

            </div>
            <div id="four">
                <div class="di_b">
                    <span class="comment_ajax_refer b-r_4 visible">
                        <a href="#" class="t-d_n"><span class="js">Оставить отзыв</span><span class="blue_arrow"></span></a>
                        <span>Для того, чтобы оставить комментарий, Вы должны <a href="#" class="js red">авторизироваться</a> на сайте</span>
                    </span>
                </div>
                <form method="post" action="#" class="comment_form clearfix">
                    <label>
                        Ваше имя
                        <input type="text">
                    </label>
                    <label>
                        Комментарий
                        <textarea></textarea>
                    </label>
                    <label class="buttons button_middle_blue f_l">
                        <input type="submit" value="Оставить отзыв"/>
                    </label>
                </form>
                <ul class="comments">
                    <li>
                        <b>Артем Шиков:</b>
                        <div class="c_9 f-s_11">Оставлен 1 марта 2012</div>
                        <p>
                            Производительность толком оценить немогу, так как ничего тяжело в 3D не моделил и не рендерил, и HD видео не обрабатывал. Но 27 дюймов IPS матрицы для работы с графикой - одинг восторг. Безумно удобно работать под маковоской осью, все под рукой благодаря мультитачу. Работает бесшумно, иногда кряхтит жесткий, когда что-то соображает тяжело)), даже на не слабой загрузке греется терпимо. Эргономика принесена в жертву, об этом много писали, прочувствовал на себе. Теперь 15-дюймов ноута кажутся 10-ю дюймами. Шикарная машина.
                            Плюсы: качество сборки бесшумность произвоительность дизайн качество изображения
                            Минусы: неэргономичность пачкотливость стекла матрицы
                        </p>
                    </li>
                    <li>
                        <b>Артем Шиков:</b>
                        <div class="c_9 f-s_11">Оставлен 1 марта 2012</div>
                        <p>
                            Производительность толком оценить немогу, так как ничего тяжело в 3D не моделил и не рендерил, и HD видео не обрабатывал. Но 27 дюймов IPS матрицы для работы с графикой - одинг восторг. Безумно удобно работать под маковоской осью, все под рукой благодаря мультитачу. Работает бесшумно, иногда кряхтит жесткий, когда что-то соображает тяжело)), даже на не слабой загрузке греется терпимо. Эргономика принесена в жертву, об этом много писали, прочувствовал на себе. Теперь 15-дюймов ноута кажутся 10-ю дюймами. Шикарная машина.
                            Плюсы: качество сборки бесшумность произвоительность дизайн качество изображения
                            Минусы: неэргономичность пачкотливость стекла матрицы
                        </p>
                    </li>
                </ul>
            </div>
        </div>
        <div class="nowelty_auction m-t_29">
            <div class="box_title">
                <span>Новинки</span>
            </div>
            <ul>
                <li class="smallest_item">
                    <div class="photo_block">
                        <a href="#">
                            <img src="images/temp/small_img.jpg"/>
                        </a>
                    </div>
                    <div class="func_description">
                        <a href="#" class="title">Asus X54C (X54C-SX006D) Black</a>
                        <div class="buy">
                            <div class="price f-s_14">4528 <sub>грн.</sub><span>859 $</span></div>
                        </div>
                    </div>
                </li>
                <li class="smallest_item">
                    <div class="photo_block">
                        <a href="#">
                            <img src="images/temp/small_img.jpg"/>
                        </a>
                    </div>
                    <div class="func_description">
                        <a href="#" class="title">Asus X54C (X54C-SX006D) Black</a>
                        <div class="buy">
                            <div class="price f-s_14">4528 <sub>грн.</sub><span>859 $</span></div>
                        </div>
                    </div>
                </li>
                <li class="smallest_item">
                    <div class="photo_block">
                        <a href="#">
                            <img src="images/temp/small_img.jpg"/>
                        </a>
                    </div>
                    <div class="func_description">
                        <a href="#" class="title">Asus X54C (X54C-SX006D) Black</a>
                        <div class="buy">
                            <div class="price f-s_14">4528 <sub>грн.</sub><span>859 $</span></div>
                        </div>
                    </div>
                </li>
            </ul>
        </div>
    </div>
</div>