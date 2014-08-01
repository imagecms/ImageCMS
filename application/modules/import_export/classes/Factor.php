<?php

namespace import_export\classes;

(defined('BASEPATH')) OR exit('No direct script access allowed');

/**
 * @author Kaero
 * @copyright ImageCMS (c) 2012, Kaero <dev@imagecms.net>
 */
class Factor {
    /** Message type. */

    const MessageTypeError = "error";

    /** Message type. */
    const MessageTypeSuccess = "success";

    /** Import type. */
    const ImportProducts = "products";
    const ImportCategories = "categories";

    /** Error messages for Export/Import */
    const ErrorFolderPermission = "Ошибка доступа к целевой папке.<br/>Продолжение невозможно. <a target='_blank' href='http://docs.imagecms.net/administrirovanie-imagecms-shop/nastroiki/import-eksport'>Подробнее</a><br/><br/>Error: EIx004";
    const ErrorFileReadError = "Ошибка чтения файла-источника.<br/>Продолжение невозможно. <a target='_blank' href='http://docs.imagecms.net/administrirovanie-imagecms-shop/nastroiki/import-eksport'>Подробнее</a><br/><br/>Error: EIx005";
    const ErrorEmptySlot = "Не загружен файл. Слот пуст <a target='_blank' href='http://http://docs.imagecms.net/administrirovanie-imagecms-shop/nastroiki/import-eksport'>Подробнее</a><br/><br/>Error: EIx005";
    const ErrorCategoryAttribute = "Атрибут 'Категория' не указан.<br/> Уточните данные импорта. <a target='_blank' href='http://docs.imagecms.net/administrirovanie-imagecms-shop/nastroiki/import-eksport'>Подробнее</a><br/><br/>Error: EIx008";
    const ErrorNumberAttribute = "Атрибут 'Артикул' не указан.<br/> Уточните данные импорта. <a target='_blank' href='http://docs.imagecms.net/administrirovanie-imagecms-shop/nastroiki/import-eksport'>Подробнее</a><br/><br/>Error: EIx009";
    const ErrorPossibleAttrValues = "Атрибутов указано больше чем столбцов в файле. <a target='_blank' href=''>Подробнее</a><br/><br/>Error: EIx003";
    const Error1 = " <a target='_blank' href=''>Подробнее</a><br/><br/>Error: EIx009";

    /** Success messages for Export/Import */
    const SuccessImportCompleted = 'Импорт завершен успешно<br/>Количество обновленных товаров: ';

}