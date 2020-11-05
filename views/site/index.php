<?php

/**
 * @var $this yii\web\View
 * @var $phones \app\models\Phones[]
 */
use yii\helpers\Url;

$this->title = 'My Yii Application';
?>
<div class="site-index">

    <div class="body-content">

<!--        <div class="row">-->
<!--            <div class="col-lg-12">-->
<!--                <table class="table">-->
<!--                    <tr>-->
<!--                        <th>id</th>-->
<!--                        <th>name</th>-->
<!--                        <th>prise</th>-->
<!--                        <th>about</th>-->
<!--                        <th>add</th>-->
<!--                        <th>edit</th>-->
<!--                        <th>dell</th>-->
<!--                    </tr>-->

                    <?php
                    /*
                    foreach ($phones AS $phone):
                        $urlDell = Url::toRoute(['delete', 'id'=> $phone->id]);
                        $urlEdit = Url::toRoute(['edit', 'id'=> $phone->id]);
                        $urlAdd  = Url::toRoute(['add']);
                        echo '<tr>';
                        echo '<td>' . $phone->id    . '</td>';
                        echo '<td>' . $phone->name  . '</td>';
                        echo '<td>' . $phone->prise . '</td>';
                        echo '<td>' . $phone->about . '</td>';
                        echo '<td><a href='. $urlAdd  .' class="btn btn-success" role="button">add</a></td>';
                        echo '<td><a href='. $urlEdit .' class="btn btn-success" role="button">edit</a></td>';
                        echo '<td><a href='. $urlDell .' class="btn btn-danger" role="button">dell</a></td>';
                        echo '</tr>';
                    endforeach;
                    */
                    ?>
<!---->
<!--                </table>-->
<!--            </div>-->
<!--        </div>-->

        <?php
            \yii\widgets\Pjax::begin(); // это для включения ajax!!!

            echo '<a href='. Url::toRoute(['add']) .' class="btn btn-success" role="button">Add new item</a>';
        ?>
        <?= \yii\grid\GridView::widget([
            'dataProvider' => $dataProvider,
            'filterModel' => $searchModel,
            'columns' => [
                ['class' => \yii\grid\SerialColumn::class],
                'id',
                'name',
                'prise',
                'about',
                [
                    'class' => \yii\grid\ActionColumn::class,
                    'template' => '{update} {delete}',
                    'urlCreator' => function($action, $model, $key, $index, $column) {
                        switch ($action) {
                            case 'update':
                                return Url::to(['edit', 'id' => $model->id]);
                            case 'delete':
                                return Url::to(['delete', 'id' => $model->id]);
                        }
                    }
                ],
            ]
        ]); ?>
        <?php \yii\widgets\Pjax::end(); ?>
    </div>
</div>
