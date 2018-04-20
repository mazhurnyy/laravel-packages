<?php

namespace Mazhurnyy\Http\Sections;

use AdminColumn;
use AdminColumnEditable;
use AdminColumnFilter;
use AdminDisplay;
use AdminForm;
use AdminFormElement;
use App\Models\Role;
use App\Models\User;
use SleepingOwl\Admin\Contracts\Display\DisplayInterface;
use SleepingOwl\Admin\Contracts\Form\FormInterface;
use SleepingOwl\Admin\Contracts\Initializable;
use SleepingOwl\Admin\Form\Buttons\Cancel;
use SleepingOwl\Admin\Section;

/**
 * Class User
 *
 * @property \App\Models\User $model
 * @see http://sleepingowladmin.ru/docs/model_configuration_section
 */
class UserList extends Section implements Initializable
{
    /**
     * @see http://sleepingowladmin.ru/docs/model_configuration#ограничение-прав-доступа
     * @var bool
     */
    protected $checkAccess = true;

    /**
     * @var string
     */
    protected $title = 'Список пользователей';

    /**
     * @var string
     */
    protected $alias = 'user-list';

    /**
     * Initialize class.
     */
    public function initialize()
    {
        $this->addToNavigation($priority = 2100);
    }

    /**
     * @return string
     */
    public function getIcon()
    {
        return 'fa fa-users';
    }

    /**
     * @return DisplayInterface
     */
    public function onDisplay()
    {
        // todo добавить отдел, должность

        $userInfo = AdminDisplay::datatablesAsync();

        $userInfo->setHtmlAttribute('class', 'table-bordered table-success table-hover');

        $userInfo->setColumns(
            [
                AdminColumn::link('email', 'E-Mail пользователя'),
                AdminColumn::text('name', 'Имя'),
                AdminColumn::text('role.name', 'Роль')->setWidth('150px'),
            ]
        );

        return $userInfo;
    }

    /**
     * @param int $id
     * @param bool $check
     *
     * @return mixed
     */
    public function onEdit($id, $check = false)
    {
        //todo добавить информацию
        $tabs = AdminDisplay::tabbed();

        $user = User::find($id) ?? null;

        if (isset($user->role)) {
            if (\Auth::user()->role->priority < $user->role->priority || \Auth::user()->id == $id) {
                $check = true;
            }
        } else {
            $check = true;
        }
        if ($check) {

            $form = AdminForm::panel()->addHeader(
                [
                    AdminFormElement::columns()->addColumn(
                        [
                            AdminFormElement::text('email', 'E-mail')->setReadOnly(true),
                        ]
                    )->addColumn([AdminFormElement::text('bought', 'Сумма покупок')->setReadOnly(true)]),
                    AdminFormElement::columns()->addColumn(
                        [
                            AdminFormElement::text('name', 'Имя пользователя')->required(),
                        ]
                    )->addColumn(
                        [
                            AdminFormElement::text('phone', 'Телефон, в международном формате +380 (хх) ххх хх хх)'),
                        ]
                    )->addColumn(
                        [
                            AdminFormElement::select('role_id', 'Роль пользователя', Role::class)
                                ->required()
                                ->setDisplay('name')
                                ->setLoadOptionsQueryPreparer(
                                    function ($element, $query) {
                                        return $query->where('priority', '>', \Auth::user()->role->priority)->orderBy(
                                            'priority', 'asc'
                                        );
                                    }
                                ),
                        ]
                    ),
                ]
            )->addFooter(
                AdminFormElement::columns()
                    ->addColumn(
                        [AdminFormElement::text('created_at')->setlabel('Создано')->setReadOnly(true)]
                    )
                    ->addColumn([AdminFormElement::text('updated_at')->setlabel('Обновлено')->setReadOnly(true)])
                    ->addColumn([AdminFormElement::text('visited_at')->setlabel('Визит')->setReadOnly(true)])
                    ->addColumn([AdminFormElement::text('bought_at')->setlabel('Покупка')->setReadOnly(true)])
            );

            $form->getButtons()->setSaveButtonText('Сохранить');

            $tabs->appendTab($form, 'Общая информация');

            $note = AdminForm::form()->setElements(
                [
                    AdminFormElement::ckeditor('note', 'Заметки'),
                ]
            );

            $tabs->appendTab($note, 'Заметки');

            return $tabs;
        } else {

            // todo текст придумай, если не нравится
            $form = AdminForm::form()->setElements(
                [
                    AdminFormElement::html(
                        '<h2>У Вас не достаточно прав для просмотра информации об этом пользователе!</h2>'
                    ),
                ]
            );
            $form->getButtons()->setButtons(['cancel' => new Cancel()]);

            return $form;
        }

    }

    /**
     * @return FormInterface
     */
    public function onCreate()
    {
        return $this->onEdit(null);
    }

}
