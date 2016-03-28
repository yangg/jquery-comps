<?php
/**
 * Created by brook
 * Date: 3/26/16 6:52 PM
 */
common\assets\lib\TabsSelectAsset::register($this);
?>
<ul class="item-list">
    <li class="item-search">
        <input type="text"/>
    </li>
</ul>
<?php $tabs = array('ABCDE', 'FGHIJ', 'KLMNO', 'PQRST', 'UVWXYZ'); ?>
<div class="search-box">
    <ul class="search-tab">
        <?php foreach ($tabs as $letters) { ?>
            <li class="<?php if ($letters === reset($tabs)) echo 'active'; ?>"
                data-letters="<?= $letters ?>"><?= $letters ?></li>
        <?php } ?>
    </ul>
    <div class="tab-content">
        <div class="tab-pane active">
            <?php $letters = '';
            foreach ($brandData as $letter => $letterData) {
                if (strpos($letters, $letter) === false) {
                    $letters = array_shift($tabs);
                }
                ?>
                <dl data-letters="<?= $letters ?>">
                    <dt><?= $letter ?></dt>
                    <dd>
                        <ul>
                            <?php foreach ($letterData as $k => $v) { ?>
                                <li data-id="<?php echo $v['brand_id'] ?>">
                                    <a class="text-overflow" href="javascript:"><?php echo $v['brand'] ?></a>
                                </li>
                            <?php } ?>
                        </ul>
                    </dd>
                </dl>
            <?php } ?>
        </div>
    </div>
</div>
