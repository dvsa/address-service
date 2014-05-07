<?php

/**
 * Test service factory
 *
 * @author Rob Caiger <rob@clocal.co.uk>
 */
namespace Test\Application\Service;

use Application\Service\Factory;
use PHPUnit_Framework_TestCase;

/**
 * Test service factory
 *
 * @author Rob Caiger <rob@clocal.co.uk>
 */
class FactoryTest extends PHPUnit_Framework_TestCase
{
    /**
     * test createService
     */
    public function testCreateService()
    {
        $mockServiceLocator = $this->getMock('\Zend\ServiceManager\ServiceManager', array());

        $factory = new Factory();

        $serviceFactory = $factory->createService($mockServiceLocator);

        $this->assertEquals($factory, $serviceFactory);
    }

    /**
     * test create
     */
    public function testCreate()
    {
        $mockAdapter = $this->getMockBuilder('\Zend\Db\Adapter\Adapter', array())
            ->disableOriginalConstructor()
            ->getMock();

        $mockServiceLocator = $this->getMock('\Zend\ServiceManager\ServiceManager', array('get'));

        $mockServiceLocator->expects($this->once())
            ->method('get')
            ->with('db.adapter')
            ->will($this->returnValue($mockAdapter));

        $factory = new Factory();

        $service = $factory->createService($mockServiceLocator)->create('address');

        $this->assertInstanceOf('\Application\Service\Address', $service);

        $this->assertEquals($mockAdapter, $service->getAdapter());
    }

    /**
     * test create with missing service
     *
     * @expectedException \Exception
     */
    public function testCreateWithMissingService()
    {
        $mockServiceLocator = $this->getMock('\Zend\ServiceManager\ServiceManager', array());

        $factory = new Factory();

        $service = $factory->createService($mockServiceLocator)->create('foo');
    }
}
