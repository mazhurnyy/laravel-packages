<?php

namespace App\Http\Sections;

use AdminColumn;
use AdminColumnFilter;
use AdminDisplay;
use AdminForm;
use AdminFormElement;
use SleepingOwl\Admin\Contracts\Display\DisplayInterface;
use SleepingOwl\Admin\Contracts\Form\FormInterface;
use SleepingOwl\Admin\Contracts\Initializable;
use SleepingOwl\Admin\Section;

/**
 * Список таблиц
 * Class Table
 *
 * @property \App\Models\Table $model
 *
 * @see http://sleepingowladmin.ru/docs/model_configuration_section
 */
class Table extends Section implements Initializable
{
    /**
     * @see http://sleepingowladmin.ru/docs/model_configuration#ограничение-прав-доступа
     *
     * @var bool
     */
    protected $checkAccess = true;

    /**
     * @var string
     */
    protected $title = 'Таблицы БД';

    /**
     * @var string
     */
    protected $alias = 'table';

    /**
     * Initialize class.
     */
    public function initialize()
    {
        app()->booted(function () {
            $page = \AdminNavigation::getPages()
                ->findById('service');
            $page->addPage($this->makePage(410)
                               ->setIcon('fa fa-check-square'));
        });
    }

    /**
     * @return DisplayInterface
     */
    public function onDisplay()
    {
        return AdminDisplay::datatables()
            ->setColumns([AdminColumn::link('title', 'Название таблицы'),
                          AdminColumn::text('note', 'Описание таблицы'),])
            ->disablePagination();
    }

    /**
     * @param int $id
     *
     * @return FormInterface
     */
    public function onEdit($id)
    {
        $form = AdminForm::form()
            ->setElements([AdminFormElement::text('title', 'Название таблицы')
                               ->required()
                               ->unique(),
                           AdminFormElement::text('note', 'Описание таблицы'),]);

        return $form;
    }

    /**
     * @return FormInterface
     */
    public function onCreate()
    {
        return $this->onEdit(null);
    }
    /**
     * @return void
     */
    public function onDelete($id)
    {
//
    }

    /**
     * @return void
     */
    public function onRestore($id)
    {
//
    }
}
