<?php

/**
 * Observer model for Index module
 *
 * @package     Evozon_Core_Model_Index
 * @copyright   Copyright (c) Evozon Systems (http://www.evozon.com)
 * @author      Constantin Bejenaru <constantin.bejenaru@evozon.com>
 */
class Evozon_Core_Model_Index_Observer
{

    /**
     * Register delete event on catalog category entity
     *
     * @event catalog_category_delete_before
     *
     * @param Varien_Event_Observer $observer
     */
    public function logCategoryEventDelete(Varien_Event_Observer $observer)
    {
        Mage::getSingleton('index/indexer')->logEvent(
            $observer->getEvent()->getDataObject(),
            Mage_Catalog_Model_Category::ENTITY,
            Mage_Index_Model_Event::TYPE_DELETE
        );
    }

    /**
     * Index delete event on catalog category entity
     *
     * @event catalog_category_delete_commit_after
     */
    public function indexCategoryEventDelete()
    {
        Mage::getSingleton('index/indexer')->indexEvents(
            Mage_Catalog_Model_Category::ENTITY,
            Mage_Index_Model_Event::TYPE_DELETE
        );
    }
}