<?php
use Praxigento_Warehouse_Model_Own_Observer as Observer;

/**
 * User: Alex Gusev <alex@flancer64.com>
 */
class Praxigento_Warehouse_Block_Adminhtml_Catalog_Product_Grid extends \Mage_Adminhtml_Block_Catalog_Product_Grid {
    const COL_QTY = 'qty';
    const AS_QTY = Observer::AS_FLD_QTY;


    protected function _prepareColumns() {
        $this->addColumnAfter(
            self::COL_QTY,
            [
                'header' => Mage::helper('catalog')->__('Qty'),
                'width'  => '100px',
                'type'   => 'number',
                'index'  => self::AS_QTY,
            ],
            'price');
        $result = parent::_prepareColumns();
        return $result;
    }


}