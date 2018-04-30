<?php
namespace MuliaLestari\ProductsGrid\Model\ResourceModel\Contact;

use \Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection;

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
        $this->_init('MuliaLestari\ProductsGrid\Model\Contact', 'MuliaLestari\ProductsGrid\Model\ResourceModel\Contact');
    }
}
