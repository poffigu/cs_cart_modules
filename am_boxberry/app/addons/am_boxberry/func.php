<?php

use Tygh\Languages\Languages;
use Tygh\Languages\Values as LanguageValues;

if (!defined('BOOTSTRAP')) { die('Access denied'); }

function fn_am_boxberry_install() {
    // Добавляю в список служб доставки Boxberry
    $services = array(
        array(
            // Доставка до пункта выдачи
            'status' => 'A',
            'module' => 'am_boxberry',
            'code' => 'boxberry_self',
            'sp_file' => '',
            'description_code' => 'am_boxberry.boxberry_self',
        ),
        array(
            // Доставка до пункта выдачи (без наложенного платежа)
            'status' => 'A',
            'module' => 'am_boxberry',
            'code' => 'boxberry_self_prepaid',
            'sp_file' => '',
            'description_code' => 'am_boxberry.boxberry_self_prepaid',
        ),
        array(
            // Курьерская доставка
            'status' => 'A',
            'module' => 'am_boxberry',
            'code' => 'boxberry_courier',
            'sp_file' => '',
            'description_code' => 'am_boxberry.boxberry_courier',
        ),
        array(
            // Курьерская доставка (без наложенного платежа)
            'status' => 'A',
            'module' => 'am_boxberry',
            'code' => 'boxberry_courier_prepaid',
            'sp_file' => '',
            'description_code' => 'am_boxberry.boxberry_courier_prepaid',
        ),
    );
    foreach ($services as $service) {
        $service_id = db_get_field('SELECT service_id FROM ?:shipping_services WHERE module = ?s AND code = ?s', $service['module'], $service['code']);
        if (empty($service_id)) {
            $service_id = db_replace_into('shipping_services', $service);
            foreach (Languages::getAll() as $lang_code => $lang_data) {
                $description = LanguageValues::getLangVar($service['description_code'], $lang_code);
                $data = array(
                    'service_id' => $service_id,
                    'description' => $description,
                    'lang_code' => $lang_code
                );
                db_replace_into('shipping_service_descriptions', $data);
            }
        }
    }
}

function fn_am_boxberry_uninstall() {
    // Удаляю службу доставки Boxberry из списка
    $service_ids = db_get_fields('SELECT service_id FROM ?:shipping_services WHERE module = ?s', 'am_boxberry');
    db_query('DELETE FROM ?:shipping_services WHERE service_id IN (?a)', $service_ids);
    db_query('DELETE FROM ?:shipping_service_descriptions WHERE service_id IN (?a)', $service_ids);
}
