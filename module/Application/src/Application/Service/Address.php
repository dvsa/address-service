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
    const SQL_SIMPLE_ADDRESS_LIST_FROM_POSTCODE = 'SELECT uprn, coalesce(
        organisation_name, concat(
            ifnull(sao_start_number, \'\'),
            ifnull(sao_start_prefix, \'\'),
            if (sao_end_number is null, \'\', concat(\'-\', sao_end_number)),
            ifnull(sao_end_suffix, \'\'),
            if (sao_start_number is not null and sao_text is not null, concat(\' \', sao_text), ifnull(sao_text,\'\'))
        )
    ) saon,
    coalesce(
        building_name, concat(
            ifnull(pao_start_number, \'\'),
            ifnull(pao_start_prefix, \'\'),
            if(pao_end_number is null, \'\', concat(\'-\', pao_end_number)),
            ifnull(pao_end_suffix, \'\'),
            if(pao_start_number is not null and pao_text is not null, concat(\' \', pao_text), ifnull(pao_text, \'\'))
        )
    ) paon, street_description, nullif(locality_name, \'\') locality, town_name, administritive_area,
    nullif(postcode, \'\') postcode
    FROM address_gb WHERE postcode = :postcode';

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
     * Get a list of simple addresses from a postcode
     *
     * @param string $postcode
     *
     * @return array
     */
    public function findSimpleAddressesFromPostcode($postcode)
    {
        return $this->getAddressesFromPostcode(self::SQL_SIMPLE_ADDRESS_LIST_FROM_POSTCODE, $postcode);
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
        return strtoupper(trim((string)$postcode));
    }
}