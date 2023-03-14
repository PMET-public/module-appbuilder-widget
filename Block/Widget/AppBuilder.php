<?php

namespace MagentoEse\AppBuilderWidget\Block\Widget;

use Magento\Framework\View\Element\Template;
use Magento\Widget\Block\BlockInterface;

class AppBuilder extends Template implements BlockInterface
{
    protected $_template = "widget/appbuilder.phtml";
}

