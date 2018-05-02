<?php

namespace MuliaLestari\ProductsGrid\Controller\Adminhtml\Products;

use \Magento\Backend\App\Action;
use \Magento\Backend\Model\View\Result\ForwardFactory;
/**
 * Class NewAction for edit action
 * @package MuliaLestari\ProductsGrid\Controller\Adminhtml\Products
 */
class NewAction extends Action
{
    /**
     * @var \Magento\Backend\Model\View\Result\Forward
     */
    protected $resultForwardFactory;

    /**
     * @param \Magento\Backend\App\Action\Context $context
     * @param \Magento\Backend\Model\View\Result\ForwardFactory $resultForwardFactory
     */
    public function __construct(Action\Context $context,ForwardFactory $resultForwardFactory) {
        $this->resultForwardFactory = $resultForwardFactory;
        parent::__construct($context);
    }

    /**
     * {@inheritdoc}
     */
    protected function _isAllowed()
    {
        return true;
        // return true;
    }

    /**
     * Forward to edit
     *
     * @return \Magento\Backend\Model\View\Result\Forward
     */
    public function execute()
    {
        /** @var \Magento\Backend\Model\View\Result\Forward $resultForward */
        $resultForward = $this->resultForwardFactory->create();
        return $resultForward->forward('edit');
    }
}
