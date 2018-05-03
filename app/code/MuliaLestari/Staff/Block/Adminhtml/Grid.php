<?php
/**
 * Created by PhpStorm.
 * User: MULIA
 * Date: 02/05/2018
 * Time: 13:28
 */
namespace MuliaLestari\Staff\Block\Adminhtml;

class Grid extends \Magento\Backend\Block\Widget\Grid\Container
{
    protected function _construct()
    {
        $this->_controller = 'adminhtml_grid';
        $this->_blockGroup = 'MuliaLestari_Staff';
        $this->_headerText = __('Staffing Grid');

        parent::_construct();

        if ($this->_isAllowedAction('MuliaLestari_Staff::save')) {
            $this->buttonList->update('add', 'label', __('Add New Staff'));
        } else {
            $this->buttonList->remove('add');
        }
    }

    protected function _isAllowedAction($resourceId)
    {
        return $this->_authorization->isAllowed($resourceId);
    }
}