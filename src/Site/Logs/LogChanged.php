<?php

/**
 * Методы работы с суперлогом
 * Created by PhpStorm.
 * User: BBM
 * Date: 13.04.2017
 * Time: 12:45
 */

namespace App\Services\SiteLog;

use App\Models\LogChanged as Changed;
use App\Models\LogChangedData as ChangedData;
use App\Models\Table;

/**
 * Class LogChanged
 * @package App\Entities
 */
trait LogChanged
{

    /**
     * @var string имя ячейки с изменениями
     */
    private $key;
    /**
     * @var string новое значение в ячейке
     */
    private $value;
    /**
     *
     */
    private $logChanged;
    /**
     *
     */
    private $logChangedNew;
    /**
     * @var
     */
    private $logChangedData;
    /**
     * @var string старое значение ячейки
     */
    private $old;

    /**
     * Запись в лог изменений в таблицах
     *
     * @param $changed
     */
    public function saveLogChange($changed)
    {
        // имена строк, которые не пишем в лог
        $no_log = [
            'created_at',
            'updated_at',
            'visited_at',
            'used_at',
            'stopped_at',
            'id',
            'random',
            'count',
            'count_author',
            'сount_version'
        ];

        if ($changed->isDirty())
        {
            $this->logChanged = [
                'user_id' => \Auth::id(),
                'row' => $changed[$changed->getKeyName()],
                'table_id' => Table::where('title', $changed->getTable())
                    ->first()->id,
            ];
            foreach ($changed->getDirty() as $this->key => $this->value)
            {
                if (!in_array($this->key, $no_log) && !empty($this->value))
                {
                    if ($this->checkBoolean($changed))
                    {
                        $this->old = $changed->getOriginal($this->key);

                        $this->logChanged['name'] = $this->key;
                        $this->logChangedNew      = Changed::create($this->logChanged);
                        $this->logChangedData     = [
                            'new' => $this->value,
                            'old' => $this->old,
                            'log_changed_id' => $this->logChangedNew->id,
                        ];
                        ChangedData::insert($this->logChangedData);
                    }
                }
            }
        }
    }

    /**
     * приводим к boolean
     * @param $changed
     * @return bool
     */
    private function checkBoolean($changed)
    {
// todo - проверка boolean проблема известная после исправления убрать

        $original = $changed->getOriginal();
        if (isset($original[$this->key]))
        {
            if ($original[$this->key] == 0 && $this->value == false)
            {
                $change = false;
            } elseif ($original[$this->key] == 1 && $this->value == true)
            {
                $change = false;
            } else
            {
                $change = true;
            }
        } else
        {
            $change = true;
        }

        return $change;
    }


}