<?php

/**
 * Abstract controller
 *
 * @author Rob Caiger <rob@clocal.co.uk>
 */
namespace Application\Controller;

use Zend\Mvc\Controller\AbstractRestfulController;
use Zend\View\Model\JsonModel;
use Zend\Http\Response;

/**
 * Abstract controller
 *
 * @author Rob Caiger <rob@clocal.co.uk>
 */
abstract class AbstractController extends AbstractRestfulController
{
    /**
     * Respond
     *
     * @param $data
     * @return mixed|void
     */
    public function respond($data, $status = Response::STATUS_CODE_200)
    {
        return $this->getResponse()->setStatusCode($status)->setContent(json_encode($data));
    }

    /**
     * Return the postcode from the route
     *
     * @return string
     */
    protected function getPostcode()
    {
        return $this->params()->fromRoute('postcode');
    }

    /**
     * Return an instance of address service
     *
     * @return \Application\Service\Address
     */
    protected function getAddressService()
    {
        return $this->getServiceLocator()->get('entity.service')->create('address');
    }
}
