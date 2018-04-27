<?php

namespace MuliaLestari\CatalogML\Controller\Adminhtml\ProdukMulia;

use Magento\Backend\App\Action;
use Magento\Backend\App\Action\Context;
use Magento\TestFramework\ErrorLog\Logger;


/**
 * Class Save
 * @package MuliaLestari\CatalogML\Controller\Adminhtml\ProdukMulia
 */
class Save extends \Magento\Backend\App\Action
{
    /**
     * @var \Magento\Backend\Helper\Js
     */
    protected $_jsHelper;

    /**
     * @var \MuliaLestari\CatalogML\Model\ResourceModel\ProdukML\CollectionFactory
     */
    protected $_cllectionFactory;

    /**
     * \Magento\Backend\Helper\Js $jsHelper
     * @param Action\Context $context
     */
    public function __construct(
        Context $context,
        \Magento\Backend\Helper\Js $jsHelper,
        \MuliaLestari\CatalogML\Model\ResourceModel\ProdukML\CollectionFactory $collectionFactory
    ) {
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
        $id = (int)$this->getRequest()->getParam('grouping_id');
        /** @var \Magento\Backend\Model\View\Result\Redirect $resultRedirect */
        $resultRedirect = $this->resultRedirectFactory->create();
        if ($data) {

            /** @var \MuliaLestari\CatalogML\Model\ProdukML $model */
            $model = $this->_objectManager->create('MuliaLestari\CatalogML\Model\ProdukML');


            if ($id) {
                $model->load($id);
            }

            $model->setData($data);

            //$model->setData($data);
            try {
                $model->save();
                $this->saveProducts($model, $data);

                $this->messageManager->addSuccessMessage(__('Anda telah menyimpan produk ini'));
                $this->_objectManager->get('Magento\Backend\Model\Session')->setFormData(false);
                if ($this->getRequest()->getParam('back')) {
                    return $resultRedirect->setPath('*/*/edit', ['grouping_id' => $model->getId(), '_current' => true]);
                }
                return $resultRedirect->setPath('*/*/');
            } catch (\Magento\Framework\Exception\LocalizedException $e) {
                $this->messageManager->addErrorMessage($e->getMessage());
            } catch (\RuntimeException $e) {
                $this->messageManager->addErrorMessage($e->getMessage());
            } catch (\Exception $e) {
                $this->messageManager->addExceptionMessage($e,__('Terjadi masalah ketika menyimpan produk. ') . $e->getMessage());
            }

            $this->_getSession()->setFormData($data);
            return $resultRedirect->setPath('*/*/edit', ['grouping_id' => $this->getRequest()->getParam('grouping_id')]);
        }
        return $resultRedirect->setPath('*/*/');
    }

    public function saveProducts($model, $post)
    {
        // Attach the attachments to contact
        if (isset($post['products'])) {
            $productIds = $this->_jsHelper->decodeGridSerializedInput($post['products']);
            try {
                $oldProducts = (array) $model->getProducts($model);
                $newProducts = (array) $productIds;

                $this->_resources = \Magento\Framework\App\ObjectManager::getInstance()->get('Magento\Framework\App\ResourceConnection');
                $connection = $this->_resources->getConnection();

                $table = $this->_resources->getTableName(\MuliaLestari\CatalogML\Model\ResourceModel\ProdukML::TBL_ATT_PRODUCT);
                $insert = array_diff($newProducts, $oldProducts);
                $delete = array_diff($oldProducts, $newProducts);

                if ($delete) {
                    $where = ['grouping_id = ?' => (int)$model->getId(), 'product_id IN (?)' => $delete];
                    $connection->delete($table, $where);
                }

                if ($insert) {
                    $data = [];
                    foreach ($insert as $product_id) {
                        $data[] = ['grouping_id' => (int)$model->getId(), 'product_id' => (int)$product_id];
                    }
                    $connection->insertMultiple($table, $data);
                }

                $data = $data;
            } catch (Exception $e) {
                $this->messageManager->addExceptionMessage($e, __('Terjadi masalah ketika menyimpan produk. ') . $e->getMessage());
            }
        }

    }
}
