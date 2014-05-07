<?php

/**
 * Integration Test Address controller
 *
 * @author Rob Caiger <rob@clocal.co.uk>
 */
namespace ApplicationTest\Controller;

use Application\Controller\AddressController;
use Test\Bootstrap;
use Zend\Mvc\Router\Http\TreeRouteStack as HttpRouter;
use Application\Controller\IndexController;
use Zend\Http\Request;
use Zend\Http\Response;
use Zend\Mvc\MvcEvent;
use Zend\Mvc\Router\RouteMatch;
use PHPUnit_Framework_TestCase;

/**
 * Integration Test Address controller
 *
 * @author Rob Caiger <rob@clocal.co.uk>
 */
class AddressControllerIntegrationTest extends PHPUnit_Framework_TestCase
{
    protected $controller;
    protected $request;
    protected $response;
    protected $routeMatch;
    protected $event;

    /**
     * Setup the controller with a variable postcode
     *
     * @param string $postcode
     */
    protected function setUpWithPostcode($postcode)
    {
        $serviceManager = Bootstrap::getServiceManager();
        $this->controller = new AddressController();
        $this->request    = new Request();
        $this->routeMatch = new RouteMatch(array('controller' => 'address', 'postcode' => $postcode));
        $this->event      = new MvcEvent();
        $config = $serviceManager->get('Config');
        $routerConfig = isset($config['router']) ? $config['router'] : array();
        $router = HttpRouter::factory($routerConfig);

        $this->event->setRouter($router);
        $this->event->setRouteMatch($this->routeMatch);
        $this->controller->setEvent($this->event);
        $this->controller->setServiceLocator($serviceManager);
    }

    /**
     * Test getList
     *
     * @dataProvider dataProvider
     */
    public function testGetList($postcode, $hasResults)
    {
        $this->setUpWithPostcode($postcode);

        $response = $this->controller->getList();

        $this->assertEquals(Response::STATUS_CODE_200, $response->getStatusCode());

        $results = json_decode($response->getContent());

        $this->assertEquals($hasResults, !empty($results));
    }

    public function dataProvider()
    {
        return array(
            array('ls9 6hb', true),
            array('a', false)
        );
    }
}