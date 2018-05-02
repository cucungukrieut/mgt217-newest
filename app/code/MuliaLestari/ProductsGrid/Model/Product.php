<?php

namespace MuliaLestari\ProductsGrid\Model;

use Magento\Framework\DataObject\IdentityInterface;
use \Magento\Framework\Model\AbstractModel;

class Product extends AbstractModel implements IdentityInterface
{

    /**
     * CMS page cache tag
     */
    const CACHE_TAG = 'ml_products_grid';

    /**
     * @var string
     */
    protected $_cacheTag = 'ml_products_grid';

    /**
     * Prefix of model events names
     *
     * @var string
     */
    protected $_eventPrefix = 'ml_products_grid';

    /**
     * Initialize resource model
     *
     * @return void
     */
    protected function _construct()
    {
        $this->_init('MuliaLestari\ProductsGrid\Model\ResourceModel\Product');
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

    public function getProducts(\MuliaLestari\ProductsGrid\Model\Product $object)
    {
        $tbl = $this->getResource()->getTable(\MuliaLestari\ProductsGrid\Model\ResourceModel\Product::TBL_ATT_PRODUCT);
        $select = $this->getResource()->getConnection()->select()->from(
            $tbl,
            ['product_id']
        )
        ->where(
            'produk_id = ?',
            (int)$object->getId()
        );
        return $this->getResource()->getConnection()->fetchCol($select);
    }
}
