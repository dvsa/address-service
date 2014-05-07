<?php

/**
 * Address service
 *
 * Interacts with the address entity
 *
 * @author Rob Caiger <rob@clocal.co.uk>
 */
namespace Application\Service;

/**
 * Address service
 *
 * Interacts with the address entity
 *
 * @author Rob Caiger <rob@clocal.co.uk>
 */
class Address extends AbstractService
{
    /**
     * Holds the SQL statements in constants (Helps with unit testing)
     */
    const SQL_ADDRESS_LIST_FROM_POSTCODE = 'SELECT * FROM `address_gb` WHERE `postcode` = :postcode';

    /**
     * Get a list of addresses from a postcode
     *
     * @param string $postcode
     */
    public function findAddressesFromPostcode($postcode)
    {
        $postcode = $this->formatPostcodeForLookup($postcode);

        $results = $this->getAdapter()->query(
            self::SQL_ADDRESS_LIST_FROM_POSTCODE,
            array('postcode' => $postcode)
        );

        return $results->toArray();
    }

    /**
     * Format a postcode for the lookup
     *
     * @param string $postcode
     * @return string
     */
    private function formatPostcodeForLookup($postcode)
    {
        return strtoupper(trim((string)$postcode));
    }
}