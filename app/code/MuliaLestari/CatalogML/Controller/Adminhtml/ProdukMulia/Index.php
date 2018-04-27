<?php

namespace MuliaLestari\CatalogML\Controller\Adminhtml\ProdukMulia;

use Magento\Backend\App\Action\Context;
use Magento\Framework\View\Result\PageFactory;


/**
 * Class Index
 * @package MuliaLestari\CatalogML\Controller\Adminhtml\ProdukMulia
 */
class Index extends \Magento\Backend\App\Action
{

    /**
     * @var PageFactory
     */
    protected $resultPageFactory;

    /**
     * @param Context $context
     * @param PageFactory $resultPageFactory
     */
    public function __construct(
        Context $context,
        PageFactory $resultPageFactory
    ) {
        parent::__construct($context);
        $this->resultPageFactory = $resultPageFactory;
    }

    /**
     * Index action
     *
     * @return \Magento\Backend\Model\View\Result\Page
     */
    public function execute()
    {
        /** @var \Magento\Backend\Model\View\Result\Page $resultPage */
        $resultPage = $this->resultPageFactory->create();
        $resultPage->addBreadcrumb(__('List Grouping Product'),__('List Grouping Product'));
        $resultPage->getConfig()->getTitle()->prepend(__('Grouping Product'));
        $resultPage->getConfig()->getTitle()->prepend(__('List Grouping Product'));

        return $resultPage;
    }

    /**
     * Is the user allowed to view the attachment grid.
     *
     * @return bool
     */
    /*protected function _isAllowed()
    {
        return $this->_authorization->isAllowed('Magento_CatalogML::ProdukMulia');
    }*/
}
