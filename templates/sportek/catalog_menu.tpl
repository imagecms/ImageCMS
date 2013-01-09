

{if method_exists($model, 'getMainCategory')}
{$ids_string = $model->getMainCategory()}
{else:}
{$ids_string = $model}
{/if}

{if method_exists($ids_string, 'getFullPathIds')}
{$ids_array = unserialize($ids_string->getFullPathIds());}
{array_push($ids_array, $ids_string->getId());}
{/if}

<ul>
    <li class="m_m_1{if $ids_array && in_array('57', $ids_array)} active{/if}"><a href="{site_url('shop/category/turizm-i-otdyh')}">Туризм и отдых</a>
        <ul>
            <li><a href="{site_url('shop/category/turizm-i-otdyh/turisticheskoe-snariazhenie')}">Туристическое снаряжение</a>
                <ul>
                    <li><a href="{site_url('shop/category/turizm-i-otdyh/turisticheskoe-snariazhenie/palatki')}">Палатки</a></li>
                    <li><a href="{site_url('shop/category/turizm-i-otdyh/turisticheskoe-snariazhenie/piknikovye-nabory-i-korziny')}">Пикниковые наборы и корзины</a></li>
                    <li><a href="{site_url('shop/category/turizm-i-otdyh/turisticheskoe-snariazhenie/poleznye-melochi')}">Полезные мелочи</a></li>
                    <li><a href="{site_url('shop/category/turizm-i-otdyh/turisticheskoe-snariazhenie/spalnye-meshki')}">Спальные мешки</a></li>
                    <li><a href="{site_url('shop/category/turizm-i-otdyh/turisticheskoe-snariazhenie/sumki-turisticheskie')}">Сумки туристические</a></li>
                    <li><a href="{site_url('shop/category/turizm-i-otdyh/turisticheskoe-snariazhenie/kovriki')}">Коврики</a></li>
                    <li><a href="{site_url('shop/category/turizm-i-otdyh/turisticheskoe-snariazhenie/turisticheskaia-mebel')}">Туристическая мебель</a></li>
                    <li><a href="{site_url('shop/category/turizm-i-otdyh/turisticheskoe-snariazhenie/riukzaki')}">Рюкзаки</a></li>
                    <li><a href="{site_url('shop/category/turizm-i-otdyh/turisticheskoe-snariazhenie/turisticheskaia-posuda')}">Туристическая посуда</a></li>
                    <li><a href="{site_url('shop/category/turizm-i-otdyh/turisticheskoe-snariazhenie/fonari-i-svetilniki-turisticheskie')}">Фонари и светильники туристические</a></li>
                    <li><a href="{site_url('shop/category/turizm-i-otdyh/turisticheskoe-snariazhenie/palki-turisticheskie')}">Палки туристические</a></li>
                </ul>
            </li>
            <li><a href="{site_url('shop/category/turizm-i-otdyh/tovary-dlia-otdyha')}">Товары для отдыха</a>
                <ul>
                    <li><a href="{site_url('shop/category/turizm-i-otdyh/tovary-dlia-otdyha/basseiny')}">Бассейны</a>
                        <ul>
                            <li><a href="{site_url('shop/category/turizm-i-otdyh/tovary-dlia-otdyha/basseiny/basseiny-karkasnye')}">Бассейны каркасные</a></li>
                            <li><a href="{site_url('shop/category/turizm-i-otdyh/tovary-dlia-otdyha/basseiny/basseiny-naduvnye')}">Бассейны надувные</a></li>
                        </ul>
                    </li>
                    <li><a href="{site_url('shop/category/turizm-i-otdyh/tovary-dlia-otdyha/naduvnye-izdeliia')}">Надувные изделия</a>
                        <ul>
                            <li><a href="{site_url('shop/category/turizm-i-otdyh/tovary-dlia-otdyha/naduvnye-izdeliia/krugi-narukavniki')}">Круги, нарукавники</a></li>
                            <li><a href="{site_url('shop/category/turizm-i-otdyh/tovary-dlia-otdyha/naduvnye-izdeliia/naduvnye-lodki')}">Надувные лодки</a></li>
                            <li><a href="{site_url('shop/category/turizm-i-otdyh/tovary-dlia-otdyha/naduvnye-izdeliia/naduvnye-matrasy')}">Надувные матрасы</a></li>
                            <li><a href="{site_url('shop/category/turizm-i-otdyh/tovary-dlia-otdyha/naduvnye-izdeliia/nasosy')}">Насосы</a></li>
                            <li><a href="{site_url('shop/category/turizm-i-otdyh/tovary-dlia-otdyha/naduvnye-izdeliia/igry')}">Игры</a></li>
                        </ul>
                    </li>
                    <li><a href="{site_url('shop/category/turizm-i-otdyh/tovary-dlia-otdyha/brelki')}">Брелки</a></li>
                </ul>
            </li>
        </ul>
    </li>
    <li class="m_m_2"><a href="{site_url('shop/category/igrovye-vidy-sporta')}">Игровые виды спорта</a>
        <ul>
            <li><a href="{site_url('shop/category/igrovye-vidy-sporta/futbol')}">Футбол</a>
                <ul>
                    <li><a href="{site_url('shop/category/igrovye-vidy-sporta/futbol/shchitki-i-perchatki')}">Щитки и перчатки</a></li>
                    <li><a href="{site_url('shop/category/igrovye-vidy-sporta/futbol/miachi-futbolnye')}">Мячи футбольные</a></li>
                </ul>
            </li>
            <li>
                <a href="{site_url('shop/category/igrovye-vidy-sporta/basketbol')}">Баскетбол</a>
                <a href="{site_url('shop/category/igrovye-vidy-sporta/voleibol')}">Волейбол</a>
                <a href="{site_url('shop/category/igrovye-vidy-sporta/gandbol-regbi')}">Гандбол, регби</a>
            </li>                     
        </ul>
    </li>
    <li class="m_m_3"><a href="{site_url('shop/category/plavanie-i-daiving')}">Плавание и дайвинг</a>
        <ul>
            <li>
                <a href="{site_url('shop/category/plavanie-i-daiving/lasty-dlia-plavaniia-maski-trubki')}">Ласты для плавания, маски, трубки</a>
                <a href="{site_url('shop/category/plavanie-i-daiving/ochki-dlia-plavaniia')}">Очки для плавания</a>
                <a href="{site_url('shop/category/plavanie-i-daiving/shapochki-dlia-plavaniia')}">Шапочки для плавания</a>
                <a href="{site_url('shop/category/plavanie-i-daiving/aksessuary-dlia-plavaniia')}">Аксессуары для плавания</a>
            </li>
        </ul>
    </li>
    <li class="m_m_4"><a href="{site_url('shop/category/atletika-i-fizkultura')}">Атлетика и физкультура</a>
        <ul>
            <li>
                <a href="{site_url('shop/category/atletika-i-fizkultura/ganteli')}">Гантели</a>
                <a href="{site_url('shop/category/atletika-i-fizkultura/fitnes')}">Фитнес</a>
                <ul>
                    <li><a href="{site_url('shop/category/atletika-i-fizkultura/fitnes/gimnasticheskie-miachi')}">Гимнастические мячи</a></li>
                    <li><a href="{site_url('shop/category/atletika-i-fizkultura/fitnes/espandery')}">Эспандеры</a></li>
                    <li><a href="{site_url('shop/category/atletika-i-fizkultura/fitnes/aksessuary')}">Аксессуары</a></li>
                    <li><a href="{site_url('shop/category/atletika-i-fizkultura/fitnes/nabory')}">Наборы</a></li>
                    <li><a href="{site_url('shop/category/atletika-i-fizkultura/fitnes/shorty-dlia-pohudeniia')}">Шорты для похудения</a></li>
                </ul>
            </li>
        </ul>
    </li>
    <li class="m_m_5"><a href="{site_url('shop/category/raketochnye-vidy-sporta')}">Ракеточные виды спорта</a>
        <ul>
            <li>
                <a href="{site_url('shop/category/raketochnye-vidy-sporta/nastolnyi-tennis')}">Настольный теннис</a>
                <ul>
                    <li><a href="{site_url('shop/category/raketochnye-vidy-sporta/nastolnyi-tennis/miachiki')}">Мячики</a></li>
                    <li><a href="{site_url('shop/category/raketochnye-vidy-sporta/nastolnyi-tennis/nabory')}">Наборы</a></li>
                    <li><a href="{site_url('shop/category/raketochnye-vidy-sporta/nastolnyi-tennis/raketki')}">Ракетки</a></li>
                    <li><a href="{site_url('shop/category/raketochnye-vidy-sporta/nastolnyi-tennis/tennisnye-stoly-i-setki')}">Теннисные столы и сетки</a></li>
                    <li><a href="{site_url('shop/category/raketochnye-vidy-sporta/nastolnyi-tennis/chehly-i-sumki')}">Чехлы и сумки</a></li>
                </ul>
            </li>
            <li>
                <a href="{site_url('shop/category/raketochnye-vidy-sporta/badminton')}">Бадминтон</a>
                <ul>
                    <li><a href="{site_url('shop/category/raketochnye-vidy-sporta/badminton/raketki')}">Ракетки</a></li>
                    <li><a href="{site_url('shop/category/raketochnye-vidy-sporta/badminton/volany')}">Воланы</a></li>
                </ul>
            </li>
            <li>
                <a href="{site_url('shop/category/raketochnye-vidy-sporta/tennis')}">Теннис</a>
                <ul>
                    <li><a href="{site_url('shop/category/raketochnye-vidy-sporta/tennis/raketki')}">Ракетки</a></li>
                    <li><a href="{site_url('shop/category/raketochnye-vidy-sporta/tennis/miachi')}">Мячи</a></li>
                    <li><a href="{site_url('shop/category/raketochnye-vidy-sporta/tennis/akssesuary')}">Акссесуары</a></li>
                </ul>
            </li>
        </ul>
    </li>
    <li class="m_m_6"><a href="{site_url('shop/category/zimnie-vidy-sporta')}">Зимние виды спорта</a>
        <ul>
            <li>
                <a href="{site_url('shop/category/zimnie-vidy-sporta/konki')}">Коньки</a>
                <a href="{site_url('shop/category/zimnie-vidy-sporta/kliushki')}">Клюшки</a>
                <a href="{site_url('shop/category/zimnie-vidy-sporta/lyzhi')}">Лыжи</a>
                <a href="{site_url('shop/category/zimnie-vidy-sporta/sanki')}">Санки</a>
            </li>
        </ul>
    </li>
    <li class="m_m_7"><a href="{site_url('shop/category/boks-i-boevye-iskusstva')}">Бокс и боевые искусства</a>
        <ul>
            <li>
                <a href="{site_url('shop/category/boks-i-boevye-iskusstva/perchatki-trenirovochnye')}">Перчатки тренировочные</a>
                <a href="{site_url('shop/category/boks-i-boevye-iskusstva/meshki-i-grushi')}">Мешки и груши</a>
                <a href="{site_url('shop/category/boks-i-boevye-iskusstva/shlemy-i-zashchita')}">Шлемы и защита</a>
                <a href="{site_url('shop/category/boks-i-boevye-iskusstva/perchatki-boksrskie')}">Перчатки боксёрские</a>
            </li>
        </ul>
    </li>
    <li class="m_m_8"><a href="{site_url('shop/category/oborudovanie-dlia-sportzalov')}">Оборудование для спотзалов</a>
        <ul>
            <li>
                <a href="{site_url('shop/category/oborudovanie-dlia-sportzalov/atleticheskie-shvedskie-stenki-detskie-ugolki')}">Атлетические, шведские стенки, детские уголки</a>
                <a href="{site_url('shop/category/oborudovanie-dlia-sportzalov/silovye-trenazhery')}">Силовые тренажеры</a>
                <a href="{site_url('shop/category/oborudovanie-dlia-sportzalov/kardiotrenazhery')}">Кардиотренажеры</a>
                <a href="{site_url('shop/category/oborudovanie-dlia-sportzalov/turniki')}">Турники</a>
            </li>
        </ul>
    </li>
    <li class="m_m_9"><a href="{site_url('shop/category/hudozhestvennaia-gimnastika')}">Художественная гимнастика</a>
        <ul>
            <li>
                <a href="{site_url('shop/category/hudozhestvennaia-gimnastika/bulavy')}">Булавы</a>
                <a href="{site_url('shop/category/hudozhestvennaia-gimnastika/palochki-i-lentochki')}">Палочки и ленточки</a>
                <a href="{site_url('shop/category/hudozhestvennaia-gimnastika/miachi')}">Мячи</a>
                <a href="{site_url('shop/category/hudozhestvennaia-gimnastika/skakalki')}">Скакалки</a>
                <a href="{site_url('shop/category/hudozhestvennaia-gimnastika/odezhda')}">Одежда</a>
                <a href="{site_url('shop/category/hudozhestvennaia-gimnastika/obuv')}">Обувь</a>
                <a href="{site_url('shop/category/hudozhestvennaia-gimnastika/aksessuary')}">Аксессуары</a>
            </li>
        </ul>
    </li>
</ul>