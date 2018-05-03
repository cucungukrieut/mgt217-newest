<?php
/**
 * Created by PhpStorm.
 * User: MULIA
 * Date: 02/05/2018
 * Time: 13:27
 */
namespace MuliaLestari\Staff\Controller\Adminhtml\Grid;

use Magento\Backend\App\Action\Context;
use Magento\Framework\View\Result\PageFactory;

class Index extends \Magento\Backend\App\Action
{
    const ADMIN_RESOURCE = 'MuliaLestari_Staff::grid';

    /**
     * @var PageFactory
     */
    protected $resultPageFactory;

    /**
     * @param Context $context
     * @param PageFactory $resultPageFactory
     */
    public function __construct(Context $context,PageFactory $resultPageFactory) {
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
        $resultPage->setActiveMenu('MuliaLestari_Staff::grid');
        $resultPage->addBreadcrumb(__('Staff Grid'), __('Staff Grid'));
        $resultPage->addBreadcrumb(__('Staffing Grid'), __('Staffing Grid'));
        $resultPage->getConfig()->getTitle()->prepend(__('Staff Grid'));

        return $resultPage;
    }

    /**
     * {@inheritdoc}
     */
    protected function _isAllowed()
    {
        return $this->_authorization->isAllowed(self::ADMIN_RESOURCE);
    }
}