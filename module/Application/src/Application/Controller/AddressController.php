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
     * Get addresses from uprn
     *
     * @return Response
     */
    public function get($id)
    {
        $addressService = $this->getAddressService();

        $address = $addressService->findAddressFromUprn($id);

        if (empty($address)) {
            return $this->notFoundAction();
        }

        return $this->respond($address);
    }

    /**
     * Search for addresses based on postcode
     *
     * @return Response
     */
    public function getList()
    {
        $postcode = $this->getPostcode();

        $addressService = $this->getAddressService();

        $addresses = $addressService->findAddressesFromPostcode($postcode);

        return $this->respond($addresses);
    }
}
