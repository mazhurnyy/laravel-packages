<?php
/**
 * Created by PhpStorm.
 * User: BBM
 * Date: 05.09.2017
 * Time: 23:03
 */

namespace Mazhurnyy\Http\Sections;

use AdminColumn;
use AdminColumnEditable;
use AdminColumnFilter;
use AdminDisplay;
use AdminDisplayFilter;
use AdminForm;
use AdminFormElement;
use Mazhurnyy\Models\ObjectType;
use SleepingOwl\Admin\Contracts\Display\DisplayInterface;
use SleepingOwl\Admin\Contracts\Form\FormInterface;
use SleepingOwl\Admin\Contracts\Initializable;
use SleepingOwl\Admin\Section;

/**
 * @see http://sleepingowladmin.ru/docs/model_configuration_section
 */
class Prefix extends Section implements Initializable
{
    /**
     * @see http://sleepingowladmin.ru/docs/model_configuration#ограничение-прав-доступа
     * @var bool
     */
    protected $checkAccess = true;

    /**
     * @var string
     */
    protected $title = 'Размеры изображений';

    /**
     * @var string
     */
    protected $alias = 'prefix';

    /**
     * Initialize class.
     */
    public function initialize()
    {
        app()->booted(
            function ()
                {
                $page = \AdminNavigation::getPages()->findById('service');
                $page->addPage($this->makePage(600)->setIcon('fa fa-check-square'));
                }
        );
    }

    /**
     * @return DisplayInterface
     */
    public function onDisplay()
    {
        $display = AdminDisplay::datatables();

        $display->setHtmlAttribute('class', 'table-bordered table-success table-hover');
        $display->setFilters(
            [
                AdminDisplayFilter::related('object_type_id')->setModel(ObjectType::class),
            ]
        );
        $display->setOrder([0, 'asc']);

        $display->setColumns(
            [
                AdminColumn::text('prefix', 'Префикс'),
                AdminColumn::text('objectType.type', 'Тип сущности')->append(AdminColumn::filter('object_type_id')),
                AdminColumn::text('quality', 'Качество %'),
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
                AdminFormElement::text('prefix', 'Префикс (width x height)')->required(),
                //            AdminFormElement::text('type', 'Тип сущности')->required()->unique(),
                AdminFormElement::select('object_type_id', 'Тип сущности (объекта)', ObjectType::class)
                    ->setDisplay('type')->required(),
                AdminFormElement::columns()->addColumn(
                    [
                        AdminFormElement::text('width', 'Ширина'),
                    ]
                )->addColumn(
                    [
                        AdminFormElement::text('height', 'Высота'),
                    ]
                )->addColumn(
                    [
                        AdminFormElement::text('quality', 'Качество %'),
                    ]
                ),

                AdminFormElement::columns()->addColumn(
                    [
                        AdminFormElement::text('created_at', 'Создано')->setReadOnly(true),
                    ]
                )->addColumn(
                    [
                        AdminFormElement::text('updated_at', 'Обновлено')->setReadOnly(true),
                    ]
                )->addColumn(
                    [
                        AdminFormElement::text('deleted_at', 'Удалено')->setReadOnly(true),
                    ]
                ),
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
