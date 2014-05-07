<?php

/**
 * Test Address service
 *
 * @author Rob Caiger <rob@clocal.co.uk>
 */
namespace Test\Application\Service;

use Application\Service\Address;
use PHPUnit_Framework_TestCase;

/**
 * Test Address service
 *
 * @author Rob Caiger <rob@clocal.co.uk>
 */
class AddressTest extends PHPUnit_Framework_TestCase
{
    /**
     * test findAddressesFromPostcode
     */
    public function testFindAddressesFromPostcode()
    {
        $postcode = 'AB1 1ab  ';

        $result = array(
            'foo' => 'bar'
        );

        $mockResult = $this->getMock('\stdClass', array('toArray'));

        $mockResult->expects($this->once())
            ->method('toArray')
            ->will($this->returnValue($result));

        $mockAdapter = $this->getMockBuilder('\Zend\Db\Adapter\Adapter', array('query'))
            ->disableOriginalConstructor()
            ->getMock();

        $mockAdapter->expects($this->once())
            ->method('query')
            ->with(Address::SQL_ADDRESS_LIST_FROM_POSTCODE, array('postcode' => 'AB1 1AB'))
            ->will($this->returnValue($mockResult));

        $service = new Address();
        $service->setAdapter($mockAdapter);

        $this->assertEquals($mockAdapter, $service->getAdapter());

        $this->assertEquals($result, $service->findAddressesFromPostcode($postcode));
    }

    /**
     * test findSimpleAddressesFromPostcode
     */
    public function testFindSimpleAddressesFromPostcode()
    {
        $postcode = 'AB1 1ab  ';

        $result = array(
            'foo' => 'bar'
        );

        $mockResult = $this->getMock('\stdClass', array('toArray'));

        $mockResult->expects($this->once())
            ->method('toArray')
            ->will($this->returnValue($result));

        $mockAdapter = $this->getMockBuilder('\Zend\Db\Adapter\Adapter', array('query'))
            ->disableOriginalConstructor()
            ->getMock();

        $mockAdapter->expects($this->once())
            ->method('query')
            ->with(Address::SQL_SIMPLE_ADDRESS_LIST_FROM_POSTCODE, array('postcode' => 'AB1 1AB'))
            ->will($this->returnValue($mockResult));

        $service = new Address();
        $service->setAdapter($mockAdapter);

        $this->assertEquals($mockAdapter, $service->getAdapter());

        $this->assertEquals($result, $service->findSimpleAddressesFromPostcode($postcode));
    }

    /**
     * test findAddressFromUprn
     */
    public function testFindAddressFromUprn()
    {
        $uprn = '1';

        $result = array(
            array(
                'foo' => 'bar'
            )
        );

        $mockResult = $this->getMock('\stdClass', array('toArray'));

        $mockResult->expects($this->once())
            ->method('toArray')
            ->will($this->returnValue($result));

        $mockAdapter = $this->getMockBuilder('\Zend\Db\Adapter\Adapter', array('query'))
            ->disableOriginalConstructor()
            ->getMock();

        $mockAdapter->expects($this->once())
            ->method('query')
            ->with(Address::SQL_ADDRESS_FROM_UPRN, array('uprn' => $uprn))
            ->will($this->returnValue($mockResult));

        $service = new Address();
        $service->setAdapter($mockAdapter);

        $this->assertEquals($mockAdapter, $service->getAdapter());

        $this->assertEquals($result[0], $service->findAddressFromUprn($uprn));
    }

    /**
     * test findSimpleAddressFromUprn
     */
    public function testFindSimpleAddressFromUprn()
    {
        $uprn = '1';

        $result = array(
            array(
                'foo' => 'bar'
            )
        );

        $mockResult = $this->getMock('\stdClass', array('toArray'));

        $mockResult->expects($this->once())
            ->method('toArray')
            ->will($this->returnValue($result));

        $mockAdapter = $this->getMockBuilder('\Zend\Db\Adapter\Adapter', array('query'))
            ->disableOriginalConstructor()
            ->getMock();

        $mockAdapter->expects($this->once())
            ->method('query')
            ->with(Address::SQL_SIMPLE_ADDRESS_FROM_UPRN, array('uprn' => $uprn))
            ->will($this->returnValue($mockResult));

        $service = new Address();
        $service->setAdapter($mockAdapter);

        $this->assertEquals($mockAdapter, $service->getAdapter());

        $this->assertEquals($result[0], $service->findSimpleAddressFromUprn($uprn));
    }
}
