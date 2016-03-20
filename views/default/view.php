<?php
/**
 * @var $this \yii\web\View
 * @var $model \common\models\Page
 */
$this->title = $model->name;
?>
<div class="content">
    <h1><?php echo $model->name ?></h1>
    <?php echo $model->text ?>
</div>