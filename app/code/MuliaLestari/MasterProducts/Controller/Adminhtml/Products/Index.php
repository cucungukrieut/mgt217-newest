<?php

namespace MuliaLestari\MasterProducts\Controller\Adminhtml\Products;

use Magento\Backend\App\Action;
use Magento\Framework\View\Result\PageFactory;

class Index extends Action
{

    /**
     * @var PageFactory
     */
    protected $resultPageFactory;

    /**
     * @param Action\Context|Context $context
     * @param PageFactory $resultPageFactory
     */
    public function __construct(Action\Context $context, PageFactory $resultPageFactory) {
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
        $resultPage->getConfig()->getTitle()->prepend(__('Master Product'));
        $resultPage->addBreadcrumb(__('Master Product'), __('Master Product'));
        //$resultPage->getConfig()->
        return $resultPage;
    }

    /**
     * Is the user allowed to view the attachment grid.
     *
     * @return bool
     */
    /*protected function _isAllowed()
    {
        return true;
    }*/
}
