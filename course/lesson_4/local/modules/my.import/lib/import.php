<?php

namespace My\Import;

use Bitrix\Main\Localization\Loc;

/**
 * Class Import
 * @package Ylab\Import
 */
class Import
{
    private $moduleId = 'my.import';

    /**
     * @return string
     */
    public function getLimitImport(): string
    {
        return \COption::GetOptionString($this->moduleId, "limit_to_import", '0');
    }
    public function getPathDefault(): string
    {
        return \COption::GetOptionString($this->moduleId, "path_default", 'log');
    }
    public function getNameDefault(): string
    {
        return \COption::GetOptionString($this->moduleId, "name_default", 'file');
    }
}