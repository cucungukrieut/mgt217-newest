<?php

namespace MuliaLestari\ProductsGrid\Controller\Adminhtml\Contacts;

use Magento\Backend\App\Action;
use Magento\Backend\App\Action\Context;
use Magento\TestFramework\ErrorLog\Logger;

class Save extends \Magento\Backend\App\Action
{
    /**
     * @var \Magento\Backend\Helper\Js
     */
    protected $_jsHelper;

    /**
     * @var \MuliaLestari\ProductsGrid\Model\ResourceModel\Contact\CollectionFactory
     */
    protected $_contactCollectionFactory;

    /**
     * \Magento\Backend\Helper\Js $jsHelper
     * @param Action\Context $context
     */
    public function __construct(
        Context $context,
        \Magento\Backend\Helper\Js $jsHelper,
        \MuliaLestari\ProductsGrid\Model\ResourceModel\Contact\CollectionFactory $contactCollectionFactory
    ) {
        $this->_jsHelper = $jsHelper;
        $this->_contactCollectionFactory = $contactCollectionFactory;
        parent::__construct($context);
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
        $data = $this->getRequest()->getPostValue();

        /** @var \Magento\Backend\Model\View\Result\Redirect $resultRedirect */
        $resultRedirect = $this->resultRedirectFactory->create();
        if ($data) {

            /** @var \MuliaLestari\ProductsGrid\Model\Contact $model */
            $model = $this->_objectManager->create('MuliaLestari\ProductsGrid\Model\Contact');

            $id = $this->getRequest()->getParam('produk_id');
            if ($id) {
                $model->load($id);
            }

            $model->setData($data);

            try {
                $model->save();
                //temporary unavailable
                //$this->saveProducts($model, $data);

                $this->messageManager->addSuccess(__('Anda telah menyimpan produk ini.'));

                $this->_objectManager->get('Magento\Backend\Model\Session')->setFormData(false);

                if ($this->getRequest()->getParam('back')) {
                    return $resultRedirect->setPath('*/*/edit', ['produk_id' => $model->getId(), '_current' => true]);
                }
                return $resultRedirect->setPath('*/*/');
            } catch (\Magento\Framework\Exception\LocalizedException $e) {
                $this->messageManager->addError($e->getMessage());
            } catch (\RuntimeException $e) {
                $this->messageManager->addError($e->getMessage());
            } catch (\Exception $e) {
                $this->messageManager->addException($e, __('Terjadi kesalahan saat menyimpan produk.'));
            }

            $this->_getSession()->setFormData($data);
            return $resultRedirect->setPath('*/*/edit', ['produk_id' => $this->getRequest()->getParam('produk_id')]);
        }
        return $resultRedirect->setPath('*/*/');
    }
}
