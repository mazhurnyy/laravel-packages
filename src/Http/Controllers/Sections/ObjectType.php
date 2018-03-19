<?php
/**
 * Created by PhpStorm.
 * User: BBM
 * Date: 05.09.2017
 * Time: 23:03
 */

namespace App\Http\Sections;

use AdminColumn;
use AdminColumnEditable;
use AdminColumnFilter;
use AdminDisplay;
use AdminForm;
use AdminFormElement;
use SleepingOwl\Admin\Contracts\Display\DisplayInterface;
use SleepingOwl\Admin\Contracts\Form\FormInterface;
use SleepingOwl\Admin\Contracts\Initializable;
use SleepingOwl\Admin\Section;

/**
 * @see http://sleepingowladmin.ru/docs/model_configuration_section
 */
class ObjectType extends Section implements Initializable
{
    /**
     * @see http://sleepingowladmin.ru/docs/model_configuration#ограничение-прав-доступа
     * @var bool
     */
    protected $checkAccess = true;

    /**
     * @var string
     */
    protected $title = 'Типы сущностей';

    /**
     * @var string
     */
    protected $alias = 'object_type';

    /**
     * Initialize class.
     */
    public function initialize()
    {
        app()->booted(
            function ()
                {
                $page = \AdminNavigation::getPages()->findById('service');
                $page->addPage($this->makePage(500)->setIcon('fa fa-check-square'));
                }
        );
    }

    /**
     * @return DisplayInterface
     */
    public function onDisplay()
    {
        $display = AdminDisplay::table();

        $display->setHtmlAttribute('class', 'table-bordered table-success table-hover');

        $display->setColumns(
            [
                AdminColumn::text('type', 'Тип сущности'),
                AdminColumn::text('model', 'Путь к модели'),
            ]
        )->disablePagination();

        return $display;
    }

    /**
     * @param int $id
     *
     * @return FormInterface
     */
    public function onEdit($id)
    {
        $form = AdminForm::panel()->addBody(
            [
                AdminFormElement::text('type', 'Тип сущности')->required()->unique(),
                AdminFormElement::text('model', 'Путь к модели')->required()->unique(),
                AdminFormElement::ckeditor('note', 'Описание типа сущности'),
            ]
        );

        return $form;
    }

    /**
     * @return FormInterface
     */
    public function onCreate()
    {
        return $this->onEdit(null);
    }

}
