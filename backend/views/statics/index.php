<?php
$this->title = 'Site statics';

?>
<div class="row">



    <div class="col-md-12">

        <div class="card ">
            <div class="header">
                <h4 class="title">user statics</h4>
                <p class="category">user/ visitor info</p>
            </div>
            <div class="content">
                <table class="table">
                    <tr>
                        <th>Visitor Os</th>
                        <th>Visitor Browser</th>
                        <th>Visitor System</th>
                        <th>Visitor patern</th>
                        <th>Visitor iP</th>
                        <th>Visitor City / Country</th>
                        <th>Refer Url</th>
                        <th>Page View</th>

                    </tr>
                    <?php
                    foreach($track as $list)
                    {
                        $agent = \common\models\Track::getBrowser($list['agent']);
                        ?>
                        <tr>

                            <td><?= $agent['platform'] ; ?></td>
                            <td><?= $agent['name'];; ?></td>
                            <td> <?= $list['system']; ?></td>
                            <td> <?= $agent['version']; ?></td>

                            <td> <?= $list['ip']; ?></td>
                            <td><?= $list['city']; ?> - <?= $list['country']; ?></td>
                            <td>
                                <a target="_blank" href="<?= $list['ref']; ?>">
                                    <?= $list['ref']; ?>
                                </a>
                            </td>
                            <td> <?= $list['page_view']; ?></td>
                        </tr>
                    <?php

                    }
                    ?>
                </table>
                <?php
                // display pagination
                echo \yii\widgets\LinkPager::widget([
                    'pagination' => $pages,
                ]);
                ?>

            </div>
        </div>
    </div>

</div>
