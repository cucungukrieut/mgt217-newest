<?php

namespace MuliaLestari\ProductsGrid\Model;

use Magento\Framework\DataObject\IdentityInterface;

class MasterProduct extends \Magento\Framework\Model\AbstractModel implements IdentityInterface
{

    /**
     * CMS page cache tag
     */
    const CACHE_TAG = 'ws_products_grid';

    /**
     * @var string
     */
    protected $_cacheTag = 'ws_products_grid';

    /**
     * Prefix of model events names
     *
     * @var string
     */
    protected $_eventPrefix = 'ws_products_grid';

    /**
     * Initialize resource model
     *
     * @return void
     */
    protected function _construct()
    {
        $this->_init('MuliaLestari\ProductsGrid\Model\ResourceModel\MasterProduct');
    }

    /**
     * Return unique ID(s) for each object in system
     *
     * @return array
     */
    public function getIdentities()
    {
        return [self::CACHE_TAG . '_' . $this->getId()];
    }

    /**
     * @param MasterProduct $object
     * @return array
     *
    public function getProducts(\MuliaLestari\ProductsGrid\Model\MasterProduct $object)
    {
        $tbl = $this->getResource()->getTable(\MuliaLestari\ProductsGrid\Model\ResourceModel\MasterProduct::TBL_ATT_PRODUCT);
        $select = $this->getResource()->getConnection()->select()->from($tbl, ['product_id'])
                ->where('produk_id = ?', (int)$object->getId()
        );
        return $this->getResource()->getConnection()->fetchCol($select);
    }*/
}
