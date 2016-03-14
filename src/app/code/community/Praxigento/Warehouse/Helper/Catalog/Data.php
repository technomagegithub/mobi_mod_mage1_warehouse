<?php

/**
 * User: Alex Gusev <alex@flancer64.com>
 */
class Praxigento_Warehouse_Helper_Catalog_Data extends \Mage_Catalog_Helper_Data {

    public function isModuleEnabled($moduleName = null) {
        if($moduleName == 'Mage_CatalogInventory') {
            $result = false;
        } else {
            $result = parent::isModuleEnabled($moduleName);
        }
        return $result;
    }

}