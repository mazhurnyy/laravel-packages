<?php
/**
 * Created by PhpStorm.
 * User: BBM
 * Date: 13.04.2017
 * Time: 16:38
 */

namespace Mazhurnyy\Services\SiteLog;

use Mazhurnyy\Models\LogDelete as Delete;
use Mazhurnyy\Models\LogDeleteData as DeleteData;
use Mazhurnyy\Models\Table;

/**
 * Trait LogDelete
 * @package Mazhurnyy\Services\SiteLog
 */
trait LogDelete
{
    private $delete;

    /**
     * Запись в лог удаленных записей в таблицах в таблицах
     * @param $delete
     */
    public function saveLogDelete($delete)
    {
        $log_delete      = [
            'user_id' => \Auth::id(),
            'table_id' => Table::where('title', $delete->getTable())->first()->id,
        ];
        $log_delete_new  = Delete::create($log_delete);
        $log_delete_data = [
            'value' => $delete->toJson(),
            'log_delete_id' => $log_delete_new->id,
        ];
        DeleteData::insert($log_delete_data);
    }

}