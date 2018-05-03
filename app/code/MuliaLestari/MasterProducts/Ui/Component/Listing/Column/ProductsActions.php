<?php

namespace MuliaLestari\MasterProducts\Ui\Component\Listing\Column;

use Magento\Framework\View\Element\UiComponent\ContextInterface;
use Magento\Framework\View\Element\UiComponentFactory;
use Magento\Ui\Component\Listing\Columns\Column;
use Magento\Framework\UrlInterface;

class ProductsActions extends Column
{
    /** Url path */
    const PRODUCTS_URL_PATH_EDIT = 'masterproduct/products/edit';
    const PRODUCTS_URL_PATH_DELETE = 'masterproduct/products/delete';

    /** @var UrlInterface */
    protected $urlBuilder;

    /**
     * @var string
     */
    private $editUrl;

    /**
     * @param ContextInterface $context
     * @param UiComponentFactory $uiComponentFactory
     * @param UrlInterface $urlBuilder
     * @param array $components
     * @param array $data
     * @param string $editUrl
     */
    public function __construct(
        ContextInterface $context,
        UiComponentFactory $uiComponentFactory,
        UrlInterface $urlBuilder,
        array $components = [],
        array $data = [],
        $editUrl = self::PRODUCTS_URL_PATH_EDIT
    ) {
        $this->urlBuilder = $urlBuilder;
        $this->editUrl = $editUrl;
        parent::__construct($context, $uiComponentFactory, $components, $data);
    }

    /**
     * Prepare Data Source
     *
     * @param array $dataSource
     * @return array
     */
    public function prepareDataSource(array $dataSource)
    {
        if (isset($dataSource['data']['items'])) {
            foreach ($dataSource['data']['items'] as & $item) {
                $name = $this->getData('name');
                if (isset($item['produk_id'])) {
                    $item[$name]['edit'] = [
                        'href' => $this->urlBuilder->getUrl($this->editUrl, ['produk_id' => $item['produk_id']]),
                        'label' => __('Edit')
                    ];
                    $item[$name]['delete'] = [
                        'href' => $this->urlBuilder->getUrl(self::PRODUCTS_URL_PATH_DELETE, ['produk_id' => $item['produk_id']]),
                        'label' => __('Delete'),
                        'confirm' => [
                            'title' => __('Hapus "${ $.$data.nama }"'),
                            'message' => __('Anda yakin ingin menghapus "${ $.$data.nama }"?')
                        ]
                    ];
                }
            }
        }

        return $dataSource;
    }
}
