<?php
namespace MuliaLestari\MasterProducts\Model\ResourceModel\Product;

use \Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection;

/**
 * Class Collection
 * @package MuliaLestari\MasterProducts\Model\ResourceModel\Product
 */
class Collection extends AbstractCollection
{
    /**
     * @var string
     */
    protected $_idFieldName = 'produk_id';

    /**
     * Define resource model
     *
     * @return void
     */
    protected function _construct()
    {
        $this->_init('MuliaLestari\MasterProducts\Model\Product', 'MuliaLestari\MasterProducts\Model\ResourceModel\Product');
    }
}
