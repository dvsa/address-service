<?php

/**
 * Test Abstract controller
 *
 * @author Rob Caiger <rob@clocal.co.uk>
 */
namespace Test\Application\Controller;

use PHPUnit_Framework_TestCase;
use Zend\Http\Response;

/**
 * Test Abstract controller
 *
 * @author Rob Caiger <rob@clocal.co.uk>
 */
class AbstractControllerTest extends PHPUnit_Framework_TestCase
{
    /**
     * Test respond
     */
    public function testRespond()
    {
        $data = array(
            'foo' => 'bar'
        );

        $controller = $this->getMockForAbstractClass('\Application\Controller\AbstractController');

        $response = $controller->respond($data);

        $this->assertInstanceOf('\Zend\Http\Response', $response, 'Response is not an instance of Response');

        $this->assertEquals(Response::STATUS_CODE_200, $response->getStatusCode(), 'Incorrect status code');

        $this->assertEquals(json_encode($data), $response->getContent(), 'Incorrect content');
    }

    /**
     * Test respond with custom status code
     */
    public function testRespondWithCustomStatusCode()
    {
        $data = array(
            'foo' => 'bar'
        );

        $controller = $this->getMockForAbstractClass('\Application\Controller\AbstractController');

        $response = $controller->respond($data, Response::STATUS_CODE_500);

        $this->assertInstanceOf('\Zend\Http\Response', $response, 'Response is not an instance of Response');

        $this->assertEquals(Response::STATUS_CODE_500, $response->getStatusCode(), 'Incorrect status code');

        $this->assertEquals(json_encode($data), $response->getContent(), 'Incorrect content');
    }
}
