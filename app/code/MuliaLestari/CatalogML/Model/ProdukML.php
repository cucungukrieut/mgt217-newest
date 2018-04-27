<?php

namespace MuliaLestari\CatalogML\Model;

use Magento\Framework\DataObject\IdentityInterface;

class ProdukML extends \Magento\Framework\Model\AbstractModel implements IdentityInterface
{

    /**
     * CMS page cache tag
     */
    const CACHE_TAG = 'ml_produk_grid';

    /**
     * @var string
     */
    protected $_cacheTag = 'ml_produk_grid';

    /**
     * Prefix of model events names
     *
     * @var string
     */
    protected $_eventPrefix = 'ml_produk_grid';

    /**
     * Initialize resource model
     *
     * @return void
     */
    protected function _construct()
    {
        $this->_init('MuliaLestari\CatalogML\Model\ResourceModel\ProdukML');
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
     * Get products from DB table
     * @param ProdukML $object
     * @return array
     */
    public function getProducts(\MuliaLestari\CatalogML\Model\ProdukML $object)
    {
        $tbl = $this->getResource()->getTable(\MuliaLestari\CatalogML\Model\ResourceModel\ProdukML::TBL_ATT_PRODUCT);
        $select = $this->getResource()->getConnection()
            ->select()->from($tbl, ['product_id'])
            ->where('grouping_id = ?', (int)$object->getId()
        );

        //$arrayproduk = $this->getResource()->getConnection()->fetchCol($select);
        return $this->getResource()->getConnection()->fetchCol($select);
    }
}
