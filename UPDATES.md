## Fixes

#### Get customer IP Address

Magento's core method (`Mage_Core_Helper_Http::getRemoteAddr()`) does not handle comma separated IP's.

The `X-Forwarded-For` (XFF) HTTP header field is a de facto standard for identifying the originating IP address of a client connecting to a web server through an HTTP proxy or load balancer. This is an HTTP request header which was introduced by the Squid caching proxy server's developers. A standard has been proposed at the Internet Engineering Task Force (IETF) for standardizing the Forwarded HTTP header.

The general format of the field is:

```
X-Forwarded-For: originalclient, proxy1, proxy2
```

This fix will overwrite Magento's core helper method and return the first if multiple addresses are found.
