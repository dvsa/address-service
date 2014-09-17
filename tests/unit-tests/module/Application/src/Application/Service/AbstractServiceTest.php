<?php

/**
 * Test Abstract service
 *
 * @author Rob Caiger <rob@clocal.co.uk>
 */
namespace Test\Application\Service;

use PHPUnit_Framework_TestCase;

/**
 * Test Abstract service
 *
 * @author Rob Caiger <rob@clocal.co.uk>
 */
class AbstractServiceTest extends PHPUnit_Framework_TestCase
{
    /**
     * test adapter getter and setter
     */
    public function testGetAndSetAdapter()
    {
        $mockAdapter = $this->getMockBuilder('\Zend\Db\Adapter\Adapter', array('query'))
            ->disableOriginalConstructor()
            ->getMock();

        $service = $this->getMockForAbstractClass('\Application\Service\AbstractService');

        $service->setAdapter($mockAdapter);

        $this->assertEquals($mockAdapter, $service->getAdapter());
    }
}
