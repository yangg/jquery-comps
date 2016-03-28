<?php
/**
 * Created by brook
 * Date: 3/26/16 6:51 PM
 */

namespace common\widgets;


use yii\base\Widget;

class Brand extends Widget{
    public function run()
    {
        $brandData = [
            'A' => [
                ['brand_id' => 1, 'brand' => 'A3'],
                ['brand_id' => 2, 'brand' => 'A4'],
            ],
            'B' => [
                ['brand_id' => 11, 'brand' => 'X5'],
                ['brand_id' => 12, 'brand' => 'X6'],
            ],
            'D' => [
                ['brand_id' => 41, 'brand' => '这个名字很长只是占位的longer longer1这个名字很长只是占位的longer longer1这个名字很长只是占位的longer longer1'],
                ['brand_id' => 42, 'brand' => '这个名字很长只是占位的longer longer1'],
                ['brand_id' => 42, 'brand' => '这个名字很长只是占位的longer longer1'],
                ['brand_id' => 42, 'brand' => '这个名字很长只是占位的longer longer1'],
                ['brand_id' => 42, 'brand' => '这个名字很长只是占位的longer longer1'],
                ['brand_id' => 42, 'brand' => '这个名字很长只是占位的longer longer1'],
                ['brand_id' => 42, 'brand' => '这个名字很长只是占位的longer longer1'],
                ['brand_id' => 42, 'brand' => '这个名字很长只是占位的longer longer1'],
                ['brand_id' => 42, 'brand' => '这个名字很长只是占位的longer longer1'],
                ['brand_id' => 42, 'brand' => '这个名字很长只是占位的longer longer1'],
                ['brand_id' => 42, 'brand' => '这个名字很长只是占位的longer longer1'],
                ['brand_id' => 42, 'brand' => '这个名字很长只是占位的longer longer1'],
            ],
            'F' => [
                ['brand_id' => 71, 'brand' => 'California'],
                ['brand_id' => 72, 'brand' => 'LaFerrari'],
            ],
            'M' => [
                ['brand_id' => 101, 'brand' => 'Ghibli'],
                ['brand_id' => 102, 'brand' => 'Levante'],
            ],
        ];
        return $this->render('brand', compact('brandData'));
    }
}
