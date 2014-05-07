<?php

/**
 * Service interface
 *
 * @author Rob Caiger <rob@clocal.co.uk>
 */
namespace Application\Service;

use Zend\Db\Adapter\AdapterInterface;

/**
 * Service interface
 *
 * @author Rob Caiger <rob@clocal.co.uk>
 */
interface ServiceInterface
{
    /**
     * Setter for adapter
     *
     * @param AdapterInterface $adapter
     */
    public function setAdapter(AdapterInterface $adapter);

    /**
     * Getter for adapter
     *
     * @return AdapterInterface
     */
    public function getAdapter();
}