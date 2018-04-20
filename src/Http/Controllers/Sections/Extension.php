<?php
/**
 * Created by PhpStorm.
 * User: BBM
 * Date: 15.01.2018
 * Time: 12:23
 */

namespace Mazhurnyy\Http\Sections;

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
 * Class Role
 *
 * @property \App\Models\Role $model
 * @see http://sleepingowladmin.ru/docs/model_configuration_section
 */
class Extension extends Section implements Initializable
{
    /**
     * @see http://sleepingowladmin.ru/docs/model_configuration#ограничение-прав-доступа
     * @var bool
     */
    protected $checkAccess = true;

    /**
     * @var string
     */
    protected $title = 'Расширения файлов';

    /**
     * @var string
     */
    protected $alias = 'extension';

    /**
     * Initialize class.
     */
    public function initialize()
    {
        app()->booted(function () {
            $page = \AdminNavigation::getPages()->findById('service');
            $page->addPage($this->makePage(3210)->setIcon('fa fa-check-square'));
        });
    }

    /**
     * @return DisplayInterface
     */
    public function onDisplay()
    {

        $display = AdminDisplay::table();

        $display->setHtmlAttribute('class', 'table-bordered table-success table-hover');

        $display->setApply(function ($query) {
            $query->orderBy('name', 'asc');
        });
        $display->setColumns([
            AdminColumn::link('name', 'Расширения файлов'),
            AdminColumn::text('note', 'Описание типа файла'),
        ]);

        $display->disablePagination();

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
            AdminFormElement::text('id', 'ID')->setReadOnly(true),
            AdminFormElement::text('name', 'Расширения файлов')->setReadOnly(true),
            AdminFormElement::text('note', 'Описание типа файла'),
        ]);

        return $form;
    }

    /**
     * @return FormInterface
     */
    public function onCreate()
    {
        $form = AdminForm::form()->setElements([
            AdminFormElement::text('name', 'Расширения файлов'),
            AdminFormElement::text('note', 'ООписание типа файла'),
        ]);

        return $form;
    }

}
