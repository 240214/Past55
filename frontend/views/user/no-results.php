<?php
?>
<div id="content">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <blockquote>
                    <h3>
                        No Results Found
                    </h3>
                </blockquote>
                <h5>
                    We didn't find any agents according to your acceptation. please try again with new key word.
                </h5>
                <hr>
            </div>
            <?php
            foreach($agentsSuggestion as $list )
            {
                ?>
                <div class="col-lg-3 col-md-4 col-sm-12" align="center">
                    <img style="width: 150px;height: 150px;" src="<?= Yii::getAlias('@web') ?>/images/user/<?= $list['image'] ?> " class=" img-circle img-bordered-sm img-responsive">
                    <br>
                    <h4>
                        <?= $list['name']; ?>
                    </h4>
                    <h5>
                        <?= $list['city']; ?>,
                        <?= $list['deal_property_type']; ?>
                    </h5>

                </div>
                <?php
            }
            ?>
        </div>
    </div>
</div>

