<?php

/**
 * Index process model
 *
 * @package     Evozon_Core_Model_Index
 * @copyright   Copyright (c) Evozon Systems (http://www.evozon.com)
 * @author      Constantin Bejenaru <constantin.bejenaru@evozon.com>
 */
class Evozon_Core_Model_Index_Process extends Mage_Index_Model_Process
{

    /**
     * Reindex all data the process is responsible for
     *
     * Note: This method will just dispatch a missing
     *       "before_reindex_process_{indexer_code}" event
     *
     * @return Evozon_Core_Model_Index_Process
     */
    public function reindexAll()
    {
        if ($this->isLocked()) {
            Mage::throwException(
                Mage::helper('index')->__(
                    '%s Index process is working now. Please try run this process later.',
                    $this->getIndexer()->getName()
                )
            );
        }

        Mage::dispatchEvent(
            'before_reindex_process_' . $this->getIndexerCode(),
            array('process' => $this)
        );

        parent::reindexAll();

        return $this;
    }
}