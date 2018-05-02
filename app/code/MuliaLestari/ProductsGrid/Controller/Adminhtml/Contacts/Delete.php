<?php

namespace MuliaLestari\ProductsGrid\Controller\Adminhtml\Contacts;

use Magento\Backend\App\Action;
use Magento\TestFramework\ErrorLog\Logger;

class Delete extends \Magento\Backend\App\Action
{

    /**
     * {@inheritdoc}
     */
    /*protected function _isAllowed()
    {
        return $this->_authorization->isAllowed('MuliaLestari_Contact::atachment_delete');
    }*/

    /**
     * Delete action
     *
     * @return \Magento\Framework\Controller\ResultInterface
     */
    public function execute()
    {
        $id = $this->getRequest()->getParam('produk_id');
        /** @var \Magento\Backend\Model\View\Result\Redirect $resultRedirect */
        $resultRedirect = $this->resultRedirectFactory->create();
        if ($id) {
            try {
                $model = $this->_objectManager->create('MuliaLestari\ProductsGrid\Model\Contact');
                $model->load($id);
                $model->delete();
                $this->messageManager->addSuccess(__('Produk telah di hapus.'));
                return $resultRedirect->setPath('*/*/');
            } catch (\Exception $e) {
                $this->messageManager->addError($e->getMessage());
                return $resultRedirect->setPath('*/*/edit', ['produk_id' => $id]);
            }
        }
        $this->messageManager->addError(__('Tidak dapat menemukan produk untuk dihapus.'));
        return $resultRedirect->setPath('*/*/');
    }
}
