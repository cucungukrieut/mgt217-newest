<?php

namespace MuliaLestari\MasterProducts\Controller\Adminhtml\Products;

use Magento\Backend\App\Action;
use Magento\TestFramework\ErrorLog\Logger;
use \Magento\Backend\Helper\Js;
use \MuliaLestari\MasterProducts\Model\ResourceModel\Product\CollectionFactory;
use \Magento\Framework\Exception\LocalizedException;
use Magento\Framework\Controller\ResultFactory;

class Save extends Action
{
    /**
     * @var \Magento\Backend\Helper\Js
     */
    protected $_jsHelper;

    /**
     * @var \MuliaLestari\MasterProducts\Model\ResourceModel\Product\CollectionFactory
     */
    protected $_collectionFactory;

    /**
     * \Magento\Backend\Helper\Js $jsHelper
     * @param Action\Context $context
     * @param Js $jsHelper
     * @param CollectionFactory $collectionFactory
     */
    public function __construct(Action\Context $context,Js $jsHelper,CollectionFactory $collectionFactory) {
        $this->_jsHelper = $jsHelper;
        $this->_collectionFactory = $collectionFactory;
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
        //$resultRedirect = $this->resultRedirectFactory->create();
        $resultRedirect = $this->resultFactory->create(ResultFactory::TYPE_REDIRECT);
        if ($data) {

            /** @var \MuliaLestari\MasterProducts\Model\Product $model */
            $model = $this->_objectManager->create('MuliaLestari\MasterProducts\Model\Product');

            $id = $this->getRequest()->getParam('produk_id');
            if ($id) {
                $model->load($id);
            }

            $model->setData($data);

            try {
                $model->save();
                //temporary unavailable
                //$this->saveProducts($model, $data);

                $this->messageManager->addSuccessMessage(__('Anda telah menyimpan produk ini.'));

                $this->_objectManager->get('Magento\Backend\Model\Session')->setFormData(false);

                if ($this->getRequest()->getParam('back')) {
                    return $resultRedirect->setPath('*/*/edit', ['produk_id' => $model->getId(), '_current' => true]);
                }
                return $resultRedirect->setPath('*/*/');
            } catch (LocalizedException $e) {
                $this->messageManager->addErrorMessage($e->getMessage());
            } catch (\RuntimeException $e) {
                $this->messageManager->addErrorMessage($e->getMessage());
            } catch (\Exception $e) {
                $this->messageManager->addExceptionMessage($e, __('Terjadi kesalahan saat menyimpan produk.'));
            }

            $this->_getSession()->setFormData($data);
            return $resultRedirect->setPath('*/*/edit', ['produk_id' => $this->getRequest()->getParam('produk_id')]);
        }
        return $resultRedirect->setPath('*/*/');

    }
}
