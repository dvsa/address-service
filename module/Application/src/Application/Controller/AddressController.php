<?php

/**
 * Address controller
 *
 * Receives GET requests to return lists of addresses
 *
 * @author Rob Caiger <rob@clocal.co.uk>
 */
namespace Application\Controller;

use Zend\Http\Response;

/**
 * Address controller
 *
 * Receives GET requests to return lists of addresses
 *
 * @author Rob Caiger <rob@clocal.co.uk>
 */
class AddressController extends AbstractController
{
    /**
     * Search for addresses based on postcode
     *
     * @return mixed|void
     */
    public function getList()
    {
        $postcode = $this->getPostcode();

        $addressService = $this->getAddressService();

        $addresses = $addressService->findAddressesFromPostcode($postcode);

        return $this->respond($addresses);
    }
}
