<?php

/**
 * @copyright Copyright &copy; Oleg Martemjanov, foreign.by, 2016
 * @package yii2-pikaday
 * @version 1.0
 */

namespace demogorgorn\pikaday;

use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use yii\helpers\Json;

class Pikaday extends \yii\widgets\InputWidget
{
    public $options = [];
    
    public $clientOptions = [];

    public $varName = null;

    /**
     * Initializes the widget
     */
    public function init()
    {
        parent::init();

        if (!isset($this->options['id'])) 
            $this->options['id'] = $this->getId();
    }

    /**
     * Runs the widget
     *
     * @return string|void
     */
    public function run()
    {
        $this->registerAssets();

        if ($this->hasModel()) {
            echo Html::activeTextInput($this->model, $this->attribute, $this->options);
        } else {
            echo Html::textInput($this->name, $this->value, $this->options);
        }

    }

    /**
     * Register client assets
     */
    public function registerAssets()
    {
        $view = $this->getView();
        PikadayAsset::register($view);

        $options= Json::encode($this->clientOptions, JSON_NUMERIC_CHECK);

        $js = "$('#{$this->options['id']}').pikaday({$options});";

        if ($this->varName != null)
            $js = $this->varName . ' = ' . $js;
        
        $this->getView()->registerJs($js, \yii\web\View::POS_END);
    }
}