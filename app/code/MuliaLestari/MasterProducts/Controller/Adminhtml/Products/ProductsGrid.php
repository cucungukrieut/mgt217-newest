<?php

namespace MuliaLestari\MasterProducts\Controller\Adminhtml\Products;

use Magento\Backend\App\Action;
use Magento\TestFramework\ErrorLog\Logger;
use \Magento\Framework\View\Result\LayoutFactory;

class ProductsGrid extends Action
{

    /**
     * @var \Magento\Framework\View\Result\LayoutFactory
     */
    protected $_resultLayoutFactory;

    /**
     * @param \Magento\Framework\View\Result\LayoutFactory $resultLayoutFactory
     * @param Action\Context $context
     */
    public function __construct(Action\Context $context,LayoutFactory $resultLayoutFactory) {
        parent::__construct($context);
        $this->_resultLayoutFactory = $resultLayoutFactory;
    }

    /**
     * {@inheritdoc}
     */
    protected function _isAllowed()
    {
        return true;
    }

    /**
     * Save action
     *
     * @return \Magento\Framework\Controller\ResultInterface
     */
    public function execute()
    {
        $resultLayout = $this->_resultLayoutFactory->create();
        $resultLayout->getLayout()->getBlock('masterproduct.edit.tab.products')
                     ->setInBanner($this->getRequest()->getPost('contact_products', null));

        return $resultLayout;
    }

}
