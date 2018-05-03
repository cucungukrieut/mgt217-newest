<?php
/**
 * Created by PhpStorm.
 * User: MULIA
 * Date: 02/05/2018
 * Time: 13:34
 */
namespace MuliaLestari\Staff\Model\ResourceModel;

use Magento\Framework\Model\AbstractModel;

/**
 * Staff grid mysql resource
 */
class Grid extends \Magento\Framework\Model\ResourceModel\Db\AbstractDb
{
    /**
     * Block grid entity table
     *
     * @var string
     */
    protected $_blockGridTable;

    /**
     * Construct
     *
     * @param \Magento\Framework\Model\ResourceModel\Db\Context $context
     * @param \Magento\Store\Model\StoreManagerInterface $storeManager
     * @param string|null $resourcePrefix
     */
    public function __construct(
        \Magento\Framework\Model\ResourceModel\Db\Context $context,
        $resourcePrefix = null
    ) {
        parent::__construct($context, $resourcePrefix);
    }

    /**
     * Initialize resource model
     *
     * @return void
     */
    protected function _construct()
    {
        $this->_init('mb_staff_grid', 'staff_id');
    }

}