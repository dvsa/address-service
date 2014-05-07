<?php

/**
 * Simple Address controller
 *
 * Receives GET requests to return lists of addresses
 *
 * @author Rob Caiger <rob@clocal.co.uk>
 */
namespace Application\Controller;

use Zend\Http\Response;

/**
 * Simple Address controller
 *
 * Receives GET requests to return lists of addresses
 *
 * @author Rob Caiger <rob@clocal.co.uk>
 */
class SimpleAddressController extends AbstractController
{
    /**
     * Get simple addresses from uprn
     *
     * @return Response
     */
    public function get($id)
    {
        $addressService = $this->getAddressService();

        $address = $addressService->findSimpleAddressFromUprn($id);

        if (empty($address)) {
            return $this->notFoundAction();
        }

        return $this->respond($address);
    }

    /**
     * Search for addresses based on postcode
     *
     * @return mixed|void
     */
    public function getList()
    {
        $postcode = $this->getPostcode();

        $addressService = $this->getAddressService();

        $addresses = $addressService->findSimpleAddressesFromPostcode($postcode);

        return $this->respond($addresses);
    }
}
