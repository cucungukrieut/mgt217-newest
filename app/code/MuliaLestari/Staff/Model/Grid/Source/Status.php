<?php
/**
 * Created by PhpStorm.
 * User: MULIA
 * Date: 02/05/2018
 * Time: 13:36
 */
namespace MuliaLestari\Staff\Model\Grid\Source;

class Status implements \Magento\Framework\Data\OptionSourceInterface
{
    /**
     * @var \MuliaLestari\Staff\Model\Grid
     */
    protected $_grid;

    /**
     * Constructor
     *
     * @param \MuliaLestari\Staff\Model\Grid $grid
     */
    public function __construct(\MuliaLestari\Staff\Model\Grid $grid)
    {
        $this->_grid = $grid;
    }

    /**
     * Get options
     *
     * @return array
     */
    public function toOptionArray()
    {
        $options[] = ['label' => '', 'value' => ''];
        $availableOptions = $this->_grid->getAvailableStatuses();
        foreach ($availableOptions as $key => $value) {
            $options[] = [
                'label' => $value,
                'value' => $key,
            ];
        }
        return $options;
    }
}