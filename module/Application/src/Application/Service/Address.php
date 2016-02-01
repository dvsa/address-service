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
    const SQL_ADDRESS_LIST_FROM_POSTCODE = 'SELECT * FROM `gb_readable_vw` WHERE `postcode_trim` = :postcode UNION SELECT * FROM `ni_readable_vw` WHERE `postcode_trim` = :postcode';

    const SQL_ADDRESS_FROM_UPRN = 'SELECT  * FROM `gb_readable_vw` WHERE `uprn` = :uprn UNION SELECT * FROM `ni_readable_vw` WHERE `uprn` = :uprn LIMIT 1';

    /**
     * Find an address from uprn
     *
     * @param string $uprn
     */
    public function findAddressFromUprn($uprn)
    {
        return $this->getAddressFromUprn(self::SQL_ADDRESS_FROM_UPRN, $uprn);
    }

    /**
     * Get an address from the uprn
     *
     * @param string $query
     * @param string $uprn
     * @return array
     */
    private function getAddressFromUprn($query, $uprn)
    {
        $results = $this->getAdapter()->query(
            $query,
            array('uprn' => $uprn)
        );

        $array = $results->toArray();

        if (!empty($array)) {
            return $array[0];
        }

        return array();
    }

    /**
     * Get a list of addresses from a postcode
     *
     * @param string $postcode
     *
     * @return array
     */
    public function findAddressesFromPostcode($postcode)
    {
        return $this->getAddressesFromPostcode(self::SQL_ADDRESS_LIST_FROM_POSTCODE, $postcode);
    }

    /**
     * Get addresses from a postcode
     *
     * @param string $query
     * @param string $postcode
     *
     * @return array
     */
    private function getAddressesFromPostcode($query, $postcode)
    {
        $postcode = $this->formatPostcodeForLookup($postcode);

        $results = $this->getAdapter()->query(
            $query,
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
        return strtoupper(str_replace(' ', '', (string)$postcode));
    }
}
