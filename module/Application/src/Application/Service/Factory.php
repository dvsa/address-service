<?php

/**
 * Service factory
 *
 * @author Rob Caiger <rob@clocal.co.uk>
 */
namespace Application\Service;

use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

/**
 * Service factory
 *
 * @author Rob Caiger <rob@clocal.co.uk>
 */
class Factory implements FactoryInterface
{
    /**
     * Holds the serviceLocator
     *
     * @var ServiceLocatorInterface
     */
    private $serviceLocator;

    /**
     * Create service
     *
     * @param ServiceLocatorInterface $serviceLocator
     * @return mixed
     */
    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        $this->serviceLocator = $serviceLocator;

        return $this;
    }

    /**
     * Create a service
     *
     * @param string $service
     */
    public function create($service)
    {
        $service = ucwords($service);

        $serviceName = __NAMESPACE__ . '\\' . $service;

        if (class_exists($serviceName)) {

            $service = new $serviceName();

            $service->setAdapter($this->serviceLocator->get('db.adapter'));

            return $service;
        }

        throw new \Exception('Service not found: ' . $service);
    }
}