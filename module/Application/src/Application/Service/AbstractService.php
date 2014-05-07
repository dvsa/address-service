<?php

/**
 * Abstract service
 *
 * @author Rob Caiger <rob@clocal.co.uk>
 */
namespace Application\Service;

use Zend\Db\Adapter\AdapterInterface;

/**
 * Abstract service
 *
 * @author Rob Caiger <rob@clocal.co.uk>
 */
abstract class AbstractService implements ServiceInterface
{
    /**
     * Holds the adapter
     *
     * @var AdapterInterface
     */
    private $adapter;

    /**
     * Setter for adapter
     *
     * @param AdapterInterface $adapter
     */
    public function setAdapter(AdapterInterface $adapter)
    {
        $this->adapter = $adapter;
    }

    /**
     * Getter for adapter
     *
     * @return AdapterInterface
     */
    public function getAdapter()
    {
        return $this->adapter;
    }
}