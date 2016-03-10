<?php
/**
 * User: Alex Gusev <alex@flancer64.com>
 */
namespace Praxigento\Warehouse;

use Praxigento_Warehouse_Config as Cfg;

include_once(__DIR__ . '/../../phpunit_bootstrap.php');

class Install_0_1_0_ManualTest extends \Praxigento\Core\Lib\Test\BaseTestCase {

    public function test_install() {
        /** @var  $resource \Mage_Catalog_Model_Resource_Setup */
        $resource = \Mage::getSingleton('core/resource_setup', Cfg::CFG_MOD_SETUP);
        /** @var  $conn \Varien_Db_Adapter_Pdo_Mysql */
        $conn = \Mage::getSingleton('core/resource_setup', Cfg::CFG_MOD_SETUP)->getConnection();

        include_once(__DIR__ . '/../../../../src/app/code/community/Praxigento/Warehouse/sql/prxgt_wrhs_setup/mysql4-install-0.1.0.php');

    }
}