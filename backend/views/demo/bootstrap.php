<?php
/**
 * Created by brook
 * Date: 4/2/16 11:40 AM
 */
/* @var $this \yii\web\View */
use \yii\helpers\Html;

$this->title = 'Bootstrap+';
$this->registerJsFile('@asset/lib/bootstrap+.js', ['depends' => ['yii\bootstrap\BootstrapPluginAsset']]);

$list = [
    ['id' => 1, 'word' => 'peach', 'definitions' => 'noun. a round fruit with soft red and yellow skin, yellow flesh and a large rough seed inside'],
    ['id' => 2, 'word' => 'impeach', 'definitions' => 'verb. impeach somebody (for something) (of a court or other official body, especially in the US) to charge an important public figure with a serious crime'],
    ['id' => 3, 'word' => 'impeachment', 'definitions' => ''],
];
?>

<table class="table-default">
    <thead>
    <tr>
        <th class="text-center"><label class="checkable" title="Toggle Check All"><input type="checkbox" data-toggle="checkAll"/><span></span></label></th>
        <th>Word</th>
        <th style="width: 70%">Definition</th>
        <th></th>
        <th class="text-center">Operations</th>
    </tr>
    </thead>
    <tbody>
    <?php foreach($list as $row): ?>
        <tr>
            <td class="text-center"><label class="checkable"><input name="id[]" type="checkbox" value="<?=$row['id']?>" /><span></span></label></td>
            <td><?=$row['word']?></td>
            <td><?=$row['definitions']?></td>
            <td></td>
            <td class="text-center">
                <a href="bootstrap-edit?id=<?=$row['id']?>" data-toggle="modal">Edit</a>
                <a class="space-before"
                   href="bootstrap-del" data-params="id=<?=$row['id']?>"
                   data-toggle="confirm" data-msg="Confirm to Delete?"
                   ><i class="icon i-trash"></i></a>
            </td>
        </tr>
    <?php endforeach;?>
    </tbody>
</table>
