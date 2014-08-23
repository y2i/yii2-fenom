<?php

namespace y2i\fenom;

use Yii;
use yii\base\View;
use yii\base\ViewRenderer as BaseViewRenderer;

class ViewRenderer extends BaseViewRenderer
{
    /**
     * @var string the directory, where stores templates.
     */
    public $templatePath = '@app/views';
    /**
     * @var string the directory, where stores compiled templates in PHP files.
     */
    public $compilePath = '@runtime/Fenom/compile';
    /**
     * @var int|array bit-mask or array of Fenom settings.
     * @see https://github.com/bzick/fenom/blob/master/docs/en/configuration.md#template-settings
     */
    public $options = 0;

    /**
     * @var \Fenom object that renders templates.
     */
    public $fenom;

    public function init()
    {
        $this->fenom = \Fenom::factory($this->templatePath, $this->compilePath, $this->options);
    }

    public function render($view, $file, $params)
    {
        $params['this'] = $view;
        return $this->fenom->fetch($file, $params);
    }
}
