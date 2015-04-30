## Fixes

#### Get customer IP Address

Magento's core method (`Mage_Core_Helper_Http::getRemoteAddr()`) does not handle comma separated IP's.

The `X-Forwarded-For` (XFF) HTTP header field is a de facto standard for identifying the originating IP address of a client connecting to a web server through an HTTP proxy or load balancer. This is an HTTP request header which was introduced by the Squid caching proxy server's developers. A standard has been proposed at the Internet Engineering Task Force (IETF) for standardizing the Forwarded HTTP header.

The general format of the field is:

```
X-Forwarded-For: originalclient, proxy1, proxy2
```

This fix will overwrite Magento's core helper method and return the first if multiple addresses are found.


#### Indexer event ```delete``` on ```catalog_category``` entity

Magento does not index the ```delete``` event type on ```catalog_category``` entity, therefore it can not be used in indexers.

```
protected $_matchedEntities = array(
    Mage_Catalog_Model_Category::ENTITY => array(
        Mage_Index_Model_Event::TYPE_DELETE
    )
);
```


#### Dispatch missing ```before_reindex_process_{indexer_code}``` event before executing ```Mage_Index_Model_Process::reindexAll()```

There is an event ```after_reindex_process_{indexer_code}``` at the end of the ```Mage_Index_Model_Process::reindexAll()``` method. However the one at the beginning is missing.