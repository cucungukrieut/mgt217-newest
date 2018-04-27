<?php
namespace MuliaLestari\CatalogML\Helper;


/**
 * Class Data
 * @package MuliaLestari\CatalogML\Helper
 */
class Data extends \Magento\Framework\App\Helper\AbstractHelper
{

    /**
     * @var \Magento\Backend\Model\UrlInterface
     */
    protected $_backendUrl;

    /**
     * @var \Magento\Store\Model\StoreManagerInterface $storeManager
     */
    protected $storeManager;

    /**
     * @param \Magento\Framework\App\Helper\Context   $context
     * @param \Magento\Backend\Model\UrlInterface $backendUrl
     */
    public function __construct(
        \Magento\Framework\App\Helper\Context $context,
        \Magento\Backend\Model\UrlInterface $backendUrl,
        \Magento\Store\Model\StoreManagerInterface $storeManager
    ) {
        parent::__construct($context);
        $this->_backendUrl = $backendUrl;
        $this->storeManager = $storeManager;
    }

    /**
     * get products tab Url in admin
     * @return string
     */
    public function getProductsGridUrl()
    {
        //path from xml layout
        return $this->_backendUrl->getUrl('mlprodukgrid/*/products', ['_current' => true]);
    }
}
