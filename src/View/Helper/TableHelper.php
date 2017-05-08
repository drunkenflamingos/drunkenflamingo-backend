<?php

namespace App\View\Helper;

use Cake\View\Helper;
use Cake\View\View;

/**
 * Table helper
 */
class TableHelper extends Helper
{

    /**
     * Default configuration.
     *
     * @var array
     */
    protected $_defaultConfig = [
        'separator' => '|',
        'whiteSpace' => true,
    ];

    public function actionSeparator()
    {
        if ($this->_defaultConfig['whiteSpace'] === true) {
            return sprintf(' %s ', $this->_defaultConfig['separator']);
        }

        return $this->_defaultConfig['separator'];
    }

    public function actions(array $actionLinks)
    {
        $html = '';

        end($actionLinks);
        $lastKey = key($actionLinks);

        foreach ($actionLinks as $i => $actionLink) {
            $html .= $actionLink;

            if ($lastKey !== $i) {
                $html .= $this->actionSeparator();
            }
        }

        return $html;
    }


}
