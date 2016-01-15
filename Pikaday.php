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

    // bind the datepicker to a form field
    // if not set will be used options['id']
    public $field = null;

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

        if (!isset($this->clientOptions['field'])) {
            $this->clientOptions['field'] = (!is_null($this->field)) ? $this->field : $this->options['id']; 
            $this->clientOptions['field'] = "document.getElementById('" . $this->clientOptions['field'] . "')";
        }

        if ($this->varName == null)  {
            $this->varName = 'picker_' + $this->options['id'];
        }

        $options= Json::encode($this->clientOptions, JSON_NUMERIC_CHECK);

        $js = "var {$this->varName} = new Pikaday({$options})";
        
        $this->getView()->registerJs($js, \yii\web\View::POS_END);
    }
}