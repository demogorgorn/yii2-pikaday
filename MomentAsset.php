<?php

namespace demogorgorn\pikaday;

use yii\web\AssetBundle;

/**
 * @author Oleg Martemjanov <demogorgorn@gmail.com>
 * @since 2.0
 */
class MomentAsset extends AssetBundle
{

	public $sourcePath = '@bower/moment/min/';

    public $js = [ 'moment.min.js' ];

}
