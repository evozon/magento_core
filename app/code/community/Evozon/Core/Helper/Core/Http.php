<?php

/**
 * Core Http Helper
 *
 * @package     Evozon_Core_Helper_Core_Http
 * @copyright   Copyright (c) Evozon Systems (http://www.evozon.com/)
 * @author      Constantin Bejenaru <constantin.bejenaru@evozon.com>
 */
class Evozon_Core_Helper_Core_Http extends Mage_Core_Helper_Http
{

    /**
     * Retrieve Client Remote Address
     *
     * NOTE:
     * Magento's core method does not handle comma separated IP's.
     * The `X-Forwarded-For` header can contain multiple comma+space
     * separated IP addresses.
     * If multiple addresses are found, we will return the first.
     *
     * @link http://en.wikipedia.org/wiki/X-Forwarded-For
     *
     * @param boolean $ipToLong converting IP to long format
     *
     * @return string IPv4|long
     */
    public function getRemoteAddr($ipToLong = false)
    {
        if (is_null($this->_remoteAddr)) {
            $headers = $this->getRemoteAddrHeaders();
            foreach ($headers as $var) {
                if ($this->_getRequest()->getServer($var, false)) {
                    $this->_remoteAddr = $_SERVER[$var];
                    break;
                }
            }

            if (!$this->_remoteAddr) {
                $this->_remoteAddr = $this->_getRequest()
                    ->getServer('REMOTE_ADDR');
            }

            $ips = array_filter(
                array_map(
                    'trim', explode(',', $this->_remoteAddr)
                )
            );
            $this->_remoteAddr = reset($ips);
        }

        if (!$this->_remoteAddr) {
            return false;
        }

        return $ipToLong ? ip2long($this->_remoteAddr) : $this->_remoteAddr;
    }
}
