<?php

namespace App\Http\Sections;

use AdminColumn;
use AdminColumnFilter;
use AdminDisplay;
use AdminDisplayFilter;
use AdminForm;
use AdminFormElement;
use SleepingOwl\Admin\Contracts\Display\DisplayInterface;
use SleepingOwl\Admin\Contracts\Form\FormInterface;
use SleepingOwl\Admin\Contracts\Initializable;
use SleepingOwl\Admin\Section;


/**
 * Class StatusOrder
 *
 * @package App\Http\Sections
 */
class Status extends Section implements Initializable
{
    /**
     * @see http://sleepingowladmin.ru/docs/model_configuration#ограничение-прав-доступа
     * @var bool
     */
    protected $checkAccess = true;

    /**
     * @var string
     */
    protected $title = 'Возможные статусы';

    /**
     * @var string
     */
    protected $alias = 'status';

    /**
     * Initialize class.
     */
    public function initialize()
    {
        app()->booted(function () {
            $page = \AdminNavigation::getPages()->findById('status');
            $page->addPage($this->makePage(900)->setIcon('fa fa-check-square'));
        });
    }

    /*
    public function modifyQuery(\Illuminate\Database\Eloquent\Builder $query)
    {
        $query->whereHas('statusTranslation', function ($q) {
            return $q->whereLocale('ru')->orderBy('title', 'desc');
        });
    }
*/
    /**
     * @return DisplayInterface
     */
    public function onDisplay()
    {
        $display = AdminDisplay::datatables();

        $display->setHtmlAttribute('class', 'table-bordered table-success table-hover');
        $display->setOrder([0, 'asc']);
        $display->setColumns([
            AdminColumn::text('alias', 'Алиас'),
            AdminColumn::text('title:ru', 'Название статуса - ru'),
            AdminColumn::text('title:uk', 'Назва статусу - uk'),
        ])->disablePagination();

        return $display;
    }

    /**
     * @param int $id
     *
     * @return FormInterface
     */
    public function onEdit($id)
    {
        $form = AdminForm::form()->setElements([
            AdminFormElement::text('alias', 'Алиас название статуса, для подстаноски в запросы')->required()->unique(),
            AdminFormElement::text('title:ru', 'Название статуса на русском')->required(),
            AdminFormElement::text('title:uk', 'Назва статусу на украинском')->required(),
            AdminFormElement::text('note', 'Описание'),
            AdminFormElement::columns()->addColumn([
                AdminFormElement::text('created_at', 'Создано')->setReadOnly(true),
            ])->addColumn([
                AdminFormElement::text('updated_at', 'Обновлено')->setReadOnly(true),
            ])->addColumn([AdminFormElement::text('deleted_at', 'Удалено')->setReadOnly(true),]),
        ]);

        return $form;
    }

    /**
     * @return FormInterface
     */
    public function onCreate()
    {
        return $this->onEdit(null);
    }

    // todo добавить статус статей и каталога вместо сущности
}
