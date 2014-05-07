<?php

/**
 * Test Address controller
 *
 * @author Rob Caiger <rob@clocal.co.uk>
 */
namespace Test\Application\Controller;

use PHPUnit_Framework_TestCase;

/**
 * Test Address controller
 *
 * @author Rob Caiger <rob@clocal.co.uk>
 */
class AddressControllerTest extends PHPUnit_Framework_TestCase
{
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

        $mockService = $this->getMock('\stdClass', array('findAddressesFromPostcode'));
        $mockService->expects($this->once())
            ->method('findAddressesFromPostcode')
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
            '\Application\Controller\AddressController',
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
