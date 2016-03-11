<?php
/**
 * User: Alex Gusev <alex@flancer64.com>
 */
use Praxigento\Core\Lib\Context as Context;
use Praxigento_Warehouse_Config as Cfg;

/**
 * Init $installer for Magento app mode and for test unit mode.
 */
/** @var $installer Mage_Core_Model_Resource_Setup */
$installer = null;
if(get_class($this) == 'Mage_Core_Model_Resource_Setup') {
    /** Pre setup Mage routines in application mode. */
    $installer = $this;
} else {
    /** Pre setup Mage routines in PHPUnit mode. */
    $installer = Mage::getSingleton('core/resource_setup', Cfg::CFG_MOD_SETUP);
}

/** Pre setup Mage routines. */
$installer->startSetup();

/**
 * Module's DB structures installation.
 */
$moduleSchema = Context::instance()->getObjectManager()->get('Praxigento\Warehouse\Lib\Setup\Schema');
$moduleSchema->setup();

/**
 * Initial data installation.
 */
$moduleData = Context::instance()->getObjectManager()->get('Praxigento\Warehouse\Lib\Setup\Data');
$moduleData->install();

/** Post setup Mage routines. */
$installer->endSetup();