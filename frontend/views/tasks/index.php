<?php

/* @var $this yii\web\View */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$this->title = 'Task List';
$this->params['breadcrumbs'][] = $this->title;
$totalTask = count($tasks);
?>
<section id="main__content">
    <div class="action-header-alt">
        <a class="action-header__item action-header__back" href="<?= \yii\helpers\Url::toRoute('dashboard/index') ?>">
            <i class="zmdi zmdi-long-arrow-left"></i> Back to Dashboard
        </a>

        <div class="action-header__item action-header__add">
            <a href="#new-task" data-toggle="modal" class="btn btn-danger btn-sm">New Task</a>
        </div>

        <div class="action-header__item action-header__item--sort d-none d-sm-block">
            <span class="action-header__small">Sort by :</span>
            <form id="sort" method="get">
                <select onchange="$('#sort').submit()" name="sort" class="select2">
                    <option  value="new">Newest to oldest</option>
                    <option value="old">Oldest to Newest</option>
                    <option value="priorityHigh">Priority highest</option>
                    <option value="priorityLow">Priority lowest</option>
                </select>
            </form>

        </div>
    </div>

    <div class="main__container">
        <header class="main__title">
            <h2>Tasks Lists</h2>
            <small>Donec idelit nonmi porta gravida at eget metus</small>
        </header>

        <div class="row">
            <div class="col-md-8">
                <div class="list-group list-group--block tasks-lists">
                    <div class="list-group__header text-start">
                        <span class="task-total"><?= $totalTask; ?> </span> Total Tasks Lists
                    </div>

                    <?php

                    if(!$tasks)
                    {
                        echo "<blockquote> There is no Task. Please create new task </blockquote>";
                    }
                    else
                    {
                        foreach ($tasks as $list)
                        {
                        ?>
                        <div class="list-group-item task<?= $list['id'] ?>">
                            <div class="checkbox checkbox--char">
                                <label>
                                    <input type="checkbox"  class="taskDone" data-ref="<?= \yii\helpers\Url::toRoute('tasks/complete/') ?>" task="<?= $list['id'] ?>">
                                    <span class="checkbox__helper">
                                        <i class="mdc-bg-amber-400">
                                            <?= substr($list['task'],0,1) ?>
                                        </i>
                                    </span>
                                    <span class="tasks-list__info">
                                        <?= $list['task'] ?>
                                        <small class="text-muted">
                                            on <?= date('d/m/Y ',  $list['created_at'] ) ?>
                                             - at <?= date(' h:s',  $list['created_at'] ) ?>
                                        </small>
                                    </span>
                                </label>
                            </div>

                            <div class="list-group__attrs">
                                <div>#<?= $list['category'] ?></div>
                                <div><?php for($x = 1;$x <= $list['priority'];$x++){ echo "!";} ;?></div>
                            </div>

                            <div class="actions list-group__actions">
                                <div class="dropdown">
                                    <a href="#" data-toggle="dropdown"><i class="zmdi zmdi-more-vert"></i></a>

                                    <ul class="dropdown-menu pull-right">
                                        <li><a href="javascript:void" class="taskDone" data-ref="<?= \yii\helpers\Url::toRoute('tasks/complete/') ?>" task="<?= $list['id'] ?>">Mark as done</a></li>
                                        <li><a href="javascript:void" class="taskDelete" data-ref="<?= \yii\helpers\Url::toRoute('tasks/delete/') ?>" task="<?= $list['id'] ?>" data-demo-action="delete-listing">Delete</a></li>
                                    </ul>

                                </div>
                            </div>
                        </div>
                        <?php
                        }
                    }
                    ?>
                </div>

                <div class="load-more">
                    <a href="#"><i class="zmdi zmdi-refresh-alt"></i> Load more tasks</a>
                </div>
            </div>

            <div class="col-md-4 d-none d-md-block">
                <div class="card">
                    <div class="card__header">
                        <h2>Labels</h2>
                        <small>Etiam porta malesuada magna mollis</small>
                    </div>

                    <div class="card__body tags-list">
                        <?php
                        foreach ($labels as $list)
                        {
                            ?>
                            <div class="tags-list__item">#<?= $list['label'] ?></div>

                            <?php
                        }
                        ?>

                        <div class="tags-list__item">#Others</div>
                    </div>
                    <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']
                    ]) ?>
                    <div class="card__footer card__footer--highlight">

                        <?= $form->field($newTaskLables, 'label', ['template'=>" {input}\n <i class='form-group__bar'></i> \n {hint} \n {error}"])->textInput(['autofocus' => false,'placeholder'=>'New Label']) ?>

                        <button type="submit" class="btn btn-sm btn-primary">Create Label</button>
                    </div>
                    <?php ActiveForm::end(); ?>

                </div>
            </div>
        </div>
    </div>
</section>

<!-- new Task Modal -->
<div class="modal fade" id="new-task" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">New Task</h4>
            </div>
            <div class="modal-body">
                <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]) ?>

                <?= $form->field($newTask, 'task', ['template'=>" {input}\n <i class='form-group__bar'></i> \n {hint} \n {error}"])->textInput(['autofocus' => false,'placeholder'=>'What do you want to do?']) ?>

                <?= $form->field($newTask, 'category')
                    ->dropDownList(\yii\helpers\ArrayHelper::map(common\models\TaskLabels::find()->all(),'label','label'),
                        [
                                'prompt'=>'Select Category',
                                'class'=>'select2'
                        ])
                ?>

                <div class="form-group">
                    <label>Set Priority</label>
                    <div class="btn-group btn-group-justified" data-toggle="buttons">
                        <label class="btn">
                            <input type="radio"  name="Tasks[priority]" value="1">!
                        </label>
                        <label class="btn active">
                            <input type="radio" name="Tasks[priority]" value="2" checked="">!!
                        </label>
                        <label class="btn">
                            <input type="radio" name="Tasks[priority]" value="3">!!!
                        </label>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-link" data-dismiss="modal">Dismiss</button>
                <button type="submit" class="btn btn-link">Create</button>
            </div>
            <?php ActiveForm::end(); ?>
        </div>
    </div>
</div>
