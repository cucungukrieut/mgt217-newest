<?php

namespace MuliaLestari\MasterProducts\Block\Adminhtml\Product;

use \Magento\Backend\Block\Widget\Grid\Container;
/**
 * Adminhtml Product content block
 */
class Product extends Container
{

    protected $context;

    protected $data;
    /**
     * Block constructor
     *
     * @return void
     */
    protected function _construct()
    {
        parent::__construct($context, $data);
    }

    /**
     * Check permission for passed action
     *
     * @param string $resourceId
     * @return bool
     */
    protected function _isAllowedAction($resourceId)
    {
        return $this->_authorization->isAllowed($resourceId);
    }
}
