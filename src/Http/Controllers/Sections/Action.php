<?php
/**
 * Created by PhpStorm.
 * User: BBM
 * Date: 04.01.2018
 * Time: 17:02
 */

namespace App\Http\Sections;

use AdminColumn;
use AdminColumnEditable;
use AdminColumnFilter;
use AdminDisplay;
use AdminForm;
use AdminFormElement;
use App\Models\User;
use App\Models\TypesJob;
use SleepingOwl\Admin\Contracts\Display\DisplayInterface;
use SleepingOwl\Admin\Contracts\Form\FormInterface;
use SleepingOwl\Admin\Contracts\Initializable;
use SleepingOwl\Admin\Section;

/**
 * Корпуса
 * Class Department
 *
 * @package App\Http\Sections
 */
class Action extends Section implements Initializable
{
    protected $checkAccess = true;

    /**
     * @var string
     */
    protected $title = 'Виды работ';

    /**
     * @var string
     */
    protected $alias = 'action';

    /**
     * Initialize class.
     */
    public function initialize()
    {
        app()->booted(function () {
            $page = \AdminNavigation::getPages()->findById('directory');

            $page->addPage($this->makePage(100)->setIcon('fa fa-bandcamp'));
        });
    }

    /**
     * @return DisplayInterface
     */
    public function onDisplay()
    {
        $display = AdminDisplay::table();

        $display->setHtmlAttribute('class', 'table-bordered table-success table-hover');
        $display->with('user')->with('typesJob');
        $display->setApply(function ($query) {
            $query->orderBy('title', 'asc');
        });

        $display->setColumns([
            AdminColumn::text('title', 'Вид работ'),
            AdminColumn::custom('Тип работы', function ($instance) {
                return $instance->typesJob->title;
            }),
            AdminColumn::custom('Ответственный', function ($instance) {
                return $instance->user->name;
            }),
            AdminColumn::custom('Обязательно', function ($instance) {
                return $instance->obligatory ? '<i class="fa fa-check"></i>' : '<i class="fa fa-minus"></i>';
            })->setWidth('50px')->setHtmlAttribute('class', 'text-center'),
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
            AdminFormElement::text('title', 'Вид работ')->required()->unique(),
            AdminFormElement::select('types_jobs_id', 'Тип робот', TypesJob::class)->setDisplay('title')->required(),
            AdminFormElement::select('governing', 'Ответственный', User::class)->setDisplay('name')->required(),
            AdminFormElement::checkbox('obligatory', 'Обязательно'),
            AdminFormElement::columns()->addColumn([AdminFormElement::text('created_at', 'Создан')->setReadOnly(true),])->addColumn([AdminFormElement::text('updated_at', 'Обновлен')->setReadOnly(true),])->addColumn([AdminFormElement::text('deleted_at', 'Удалена')->setReadOnly(true),]),

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

    /**
     * @return void
     */
    public function onDelete($id)
    {
    }

}
