<?php

use Bitrix\Main\Localization\Loc;

Loc::loadMessages(__FILE__);

AddEventHandler('main', 'OnBuildGlobalMenu', 'MyImportModuleMenu');

if (!function_exists('MyImportModuleMenu')) {
    /**
     * Отображение меню
     * @param $adminMenu
     * @param $moduleMenu
     */
    function MyImportModuleMenu(&$adminMenu, &$moduleMenu)
    {
        $adminMenu['global_menu_services']['items'][] = [
            'section' => 'my-import-pages',
            'sort' => 110,
            'text' => Loc::getMessage('MY_IMPORT_TITLE_PAGE'),
            'items_id' => 'nlmk-hidden-pages',
            'items' => [
                [
                    'parent_menu' => 'my-import-pages',
                    'section' => 'my-import-pages-list',
                    'sort' => 500,
                    'url' => 'my.import_list.php?lang=' . LANG,
                    'text' => Loc::getMessage('MY_IMPORT_LIST_PAGE'),
                    'title' => Loc::getMessage('MY_IMPORT_LIST_PAGE'),
                    'icon' => 'form_menu_icon',
                    'page_icon' => 'form_page_icon',
                    'items_id' => 'my-import-pages-list'
                ],
                [
                    'parent_menu' => 'my-import-pages',
                    'section' => 'my-import-pages-start',
                    'sort' => 500,
                    'url' => 'my.import_start.php?lang=' . LANG,
                    'text' => Loc::getMessage('MY_IMPORT_START_PAGE'),
                    'title' => Loc::getMessage('MY_IMPORT_START_PAGE'),
                    'icon' => 'form_menu_icon',
                    'page_icon' => 'form_page_icon',
                    'items_id' => 'my-import-pages-start'
                ]
            ]
        ];
    }

}