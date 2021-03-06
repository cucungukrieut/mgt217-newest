<?php

namespace MuliaLestari\ProductsGrid\Controller\Adminhtml\Products;

use Magento\Backend\App\Action;
use Magento\TestFramework\ErrorLog\Logger;

class Delete extends Action
{

    /**
     * {@inheritdoc}
     */
    /*protected function _isAllowed()
    {
        return true;
    }*/

    /**
     * Delete action
     *
     * @return \Magento\Framework\Controller\ResultInterface
     */
    public function execute()
    {
        $id = $this->getRequest()->getParam('staff_id');
        /** @var \Magento\Backend\Model\View\Result\Redirect $resultRedirect */
        $resultRedirect = $this->resultRedirectFactory->create();
        if ($id) {
            try {
                $model = $this->_objectManager->create('MuliaLestari\Staff\Model\Grid');
                $model->load($id);
                $model->delete();
                $this->messageManager->addSuccessMessage(__('Produk telah di hapus.'));
                return $resultRedirect->setPath('*/*/');
            } catch (\Exception $e) {
                $this->messageManager->addErrorMessage($e->getMessage());
                return $resultRedirect->setPath('*/*/edit', ['staff_id' => $id]);
            }
        }
        $this->messageManager->addErrorMessage(__('Tidak dapat menemukan produk untuk dihapus.'));
        return $resultRedirect->setPath('*/*/');
    }
}
