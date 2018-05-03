<?php

namespace MuliaLestari\Staff\Block\Adminhtml\Grid;

use \Magento\Backend\Block\Widget\Form\Container;
use \Magento\Backend\Block\Widget\Context;
use \Magento\Framework\Registry;

class Edit extends Container
{
    /**
     * Core registry
     *
     * @var \Magento\Framework\Registry
     */
    protected $_coreRegistry = null;

    /**
     * @param \Magento\Backend\Block\Widget\Context $context
     * @param \Magento\Framework\Registry $registry
     * @param array $data
     */
    public function __construct(Context $context, Registry $registry, array $data = []) {
        $this->_coreRegistry = $registry;
        parent::__construct($context, $data);
    }

    /**
     *
     * @return void
     */
    protected function _construct()
    {
        $this->_objectId = 'staff_id';
        $this->_blockGroup = 'MuliaLestari_Staff';
        $this->_controller = 'adminhtml_grid';

        parent::_construct();

        $this->buttonList->update('save', 'label', __('Simpan Staff'));
        $this->buttonList->add(
            'saveandcontinue',
            [
                'label' => __('Simpan & Edit'),
                'class' => 'save',
                'data_attribute' => [
                    'mage-init' => [
                        'button' => ['event' => 'saveAndContinueEdit', 'target' => '#edit_form'],
                    ],
                ]
            ],
            -100
        );

        $this->buttonList->update('delete', 'label', __('Hapus Produk'));
    }

    /**
     * Check permission for passed action
     *
     * @param string $resourceId
     * @return bool
     */
    protected function _isAllowedAction($resourceId)
    {
        return $this->_authorization->isAllowed($resourceId);
    }

    /**
     * Getter of url for "Save and Continue" button
     * tab_id will be replaced by desired by JS later
     *
     * @return string
     */
    protected function _getSaveAndContinueUrl()
    {
        return $this->getUrl('staff/*/save', ['_current' => true, 'back' => 'edit', 'active_tab' => '']);
    }

}
