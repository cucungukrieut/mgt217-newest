<?php

namespace MuliaLestari\CatalogML\Controller\Adminhtml\ProdukMulia;

use Magento\Backend\App\Action;
use Magento\TestFramework\ErrorLog\Logger;


/**
 * Class Delete
 * @package MuliaLestari\CatalogML\Controller\Adminhtml\ProdukMulia
 */
class Delete extends \Magento\Backend\App\Action
{

    /**
     * {@inheritdoc}
     */
    /*protected function _isAllowed()
    {
        return $this->_authorization->isAllowed('MuliaLestari_CatalogML::atachment_delete');
    }*/

    /**
     * Delete action
     *
     * @return \Magento\Framework\Controller\ResultInterface
     */
    public function execute()
    {
        $id = $this->getRequest()->getParam('grouping_id');
        /** @var \Magento\Backend\Model\View\Result\Redirect $resultRedirect */
        $resultRedirect = $this->resultRedirectFactory->create();
        if ($id) {
            try {
                $model = $this->_objectManager->create('MuliaLestari\CatalogML\Model\ProdukML');
                $model->load($id);
                $model->delete();
                $this->messageManager->addSuccessMessage(__('Produk telah di hapus.'));
                return $resultRedirect->setPath('*/*/');
            } catch (\Exception $e) {
                $this->messageManager->addErrorMessage($e->getMessage());
                return $resultRedirect->setPath('*/*/edit', ['grouping_id' => $id]);
            }
        }
        $this->messageManager->addErrorMessage(__('Tidak ada produk untuk dihapus.'));
        return $resultRedirect->setPath('*/*/');
    }
}
