<?php
use Praxigento\Warehouse\Lib\Entity\Quantity;
use Praxigento_Warehouse_Config as Cfg;

/**
 * User: Alex Gusev <alex@flancer64.com>
 */
class Praxigento_Warehouse_Model_Own_Observer {
    const AS_TBL = 'pwq';
    const AS_FLD_QTY = 'qty';

    /**
     * Add quantity as summary for all lots/warehouses for products collection.
     *
     * SELECT
     * `e`.*,
     * ...
     * SUM(pwq.total) AS qty
     * FROM `catalog_product_entity` AS `e`
     * ...
     * JOIN prxgt_wrhs_quant pwq ON pwq.product_ref = e.entity_id
     * GROUP BY e.entity_id
     *
     * @param $eventData
     */
    public function eavCollectionAbstractLoadBefore($eventData) {
        if($eventData->getCollection() instanceof \Mage_Catalog_Model_Resource_Product_Collection) {
            /** @var  $collection \Mage_Catalog_Model_Resource_Product_Collection */
            $collection = $eventData->getCollection();
            $rsrc = $collection->getResource();
            $tblQuant = $rsrc->getTable(Quantity::ENTITY_NAME);
            $as = self::AS_TBL;
            $tbl = [ $as => $tblQuant ];
            $eid = Cfg::E_COMMON_A_ENTITY_ID;
            $on = Quantity::ATTR_PRODUCT_REF . '=' . $eid;
            $fields = [ self::AS_FLD_QTY => 'SUM(' . $as . '.' . Quantity::ATTR_TOTAL . ')' ];
            $collection->joinTable($tbl, $on, $fields, null, 'left');
            $collection->groupByAttribute($eid);
            // $sql = $collection->getSelectSql(true);
        }
    }
}