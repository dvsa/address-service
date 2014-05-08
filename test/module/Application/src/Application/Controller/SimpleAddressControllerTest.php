<?php

/**
 * Test Simple Address controller
 *
 * @author Rob Caiger <rob@clocal.co.uk>
 */
namespace Test\Application\Controller;

use PHPUnit_Framework_TestCase;

/**
 * Test Simple Address controller
 *
 * @author Rob Caiger <rob@clocal.co.uk>
 */
class SimpleAddressControllerTest extends PHPUnit_Framework_TestCase
{

    /**
     * Test get
     */
    public function testGet()
    {
        $uprn = 1;

        $result = array('foo' => 'bar');

        $mockService = $this->getMock('\stdClass', array('findSimpleAddressFromUprn'));
        $mockService->expects($this->once())
            ->method('findSimpleAddressFromUprn')
            ->with($uprn)
            ->will($this->returnValue($result));

        $mockFactory = $this->getMock('\stdClass', array('create'));

        $mockFactory->expects($this->once())
            ->method('create')
            ->with('address')
            ->will($this->returnValue($mockService));

        $mockServiceLocator = $this->getMock('\stdClass', array('get'));

        $mockServiceLocator->expects($this->once())
            ->method('get')
            ->with('entity.service')
            ->will($this->returnValue($mockFactory));

        $controller = $this->getMock(
            '\Application\Controller\SimpleAddressController',
            array('getServiceLocator', 'respond')
        );

        $controller->expects($this->once())
            ->method('getServiceLocator')
            ->will($this->returnValue($mockServiceLocator));

        $controller->expects($this->once())
            ->method('respond')
            ->with($result)
            ->will($this->returnValue('RESPONSE'));

        $this->assertEquals('RESPONSE', $controller->get($uprn));
    }

    /**
     * Test get Without results
     */
    public function testGetWithoutResults()
    {
        $uprn = 1;

        $result = array();

        $mockService = $this->getMock('\stdClass', array('findSimpleAddressFromUprn'));
        $mockService->expects($this->once())
            ->method('findSimpleAddressFromUprn')
            ->with($uprn)
            ->will($this->returnValue($result));

        $mockFactory = $this->getMock('\stdClass', array('create'));

        $mockFactory->expects($this->once())
            ->method('create')
            ->with('address')
            ->will($this->returnValue($mockService));

        $mockServiceLocator = $this->getMock('\stdClass', array('get'));

        $mockServiceLocator->expects($this->once())
            ->method('get')
            ->with('entity.service')
            ->will($this->returnValue($mockFactory));

        $controller = $this->getMock(
            '\Application\Controller\SimpleAddressController',
            array('getServiceLocator', 'respond')
        );

        $controller->expects($this->once())
            ->method('getServiceLocator')
            ->will($this->returnValue($mockServiceLocator));

        $controller->expects($this->once())
            ->method('respond')
            ->will($this->returnValue('RESPONSE'));

        $this->assertEquals('RESPONSE', $controller->get($uprn));
    }

    /**
     * Test getList
     */
    public function testGetList()
    {
        $postcode = 'AB1 1AB';

        $result = array('foo' => 'bar');

        $mockParams = $this->getMock('\stdClass', array('fromRoute'));

        $mockParams->expects($this->once())
            ->method('fromRoute')
            ->with('postcode')
            ->will($this->returnValue($postcode));

        $mockService = $this->getMock('\stdClass', array('findSimpleAddressesFromPostcode'));
        $mockService->expects($this->once())
            ->method('findSimpleAddressesFromPostcode')
            ->with($postcode)
            ->will($this->returnValue($result));

        $mockFactory = $this->getMock('\stdClass', array('create'));

        $mockFactory->expects($this->once())
            ->method('create')
            ->with('address')
            ->will($this->returnValue($mockService));

        $mockServiceLocator = $this->getMock('\stdClass', array('get'));

        $mockServiceLocator->expects($this->once())
            ->method('get')
            ->with('entity.service')
            ->will($this->returnValue($mockFactory));

        $controller = $this->getMock(
            '\Application\Controller\SimpleAddressController',
            array('params', 'getServiceLocator', 'respond')
        );

        $controller->expects($this->once())
            ->method('params')
            ->will($this->returnValue($mockParams));

        $controller->expects($this->once())
            ->method('getServiceLocator')
            ->will($this->returnValue($mockServiceLocator));

        $controller->expects($this->once())
            ->method('respond')
            ->with($result)
            ->will($this->returnValue('RESPONSE'));

        $this->assertEquals('RESPONSE', $controller->getList());
    }
}
