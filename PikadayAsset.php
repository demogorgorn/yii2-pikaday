<?php
/**
 * @author Oleg Martemjanov <demogorgorn@gmail.com>
 * @since 2.0
 */

namespace demogorgorn\pikaday;

use yii\web\AssetBundle;

class PikadayAsset extends AssetBundle
{
    public $sourcePath = '@bower/pikaday/';
    public $css = ['css/pikaday.css'];
    public $js = ['pikaday.js'/*,'plugins/pikaday.jquery.js'*/];
    public $depends = [
        'demogorgorn\pikaday\MomentAsset',
    ];


}
