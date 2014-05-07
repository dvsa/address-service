<?php

/**
 * Integration Test SimpleAddress controller
 *
 * @author Rob Caiger <rob@clocal.co.uk>
 */
namespace ApplicationTest\Controller;

use Application\Controller\SimpleAddressController;
use Test\Bootstrap;
use Zend\Mvc\Router\Http\TreeRouteStack as HttpRouter;
use Application\Controller\IndexController;
use Zend\Http\Request;
use Zend\Http\Response;
use Zend\Mvc\MvcEvent;
use Zend\Mvc\Router\RouteMatch;
use PHPUnit_Framework_TestCase;

/**
 * Integration Test SimpleAddress controller
 *
 * @author Rob Caiger <rob@clocal.co.uk>
 */
class SimpleAddressControllerIntegrationTest extends PHPUnit_Framework_TestCase
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
        $this->controller = new SimpleAddressController();
        $this->request    = new Request();
        $this->routeMatch = new RouteMatch(array('controller' => 'SimpleAddress', 'postcode' => $postcode));
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
     * Setup the controller with a variable uprn
     */
    protected function setUpWithUprn()
    {
        $serviceManager = Bootstrap::getServiceManager();
        $this->controller = new SimpleAddressController();
        $this->request    = new Request();
        $this->routeMatch = new RouteMatch(array('controller' => 'address'));
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
     * @dataProvider dataProviderPostcode
     */
    public function testGetList($postcode, $hasResults)
    {
        $this->setUpWithPostcode($postcode);

        $response = $this->controller->getList();

        $this->assertEquals(Response::STATUS_CODE_200, $response->getStatusCode());

        $results = json_decode($response->getContent());

        $this->assertEquals($hasResults, !empty($results));
    }

    public function dataProviderPostcode()
    {
        return array(
            array('ls9 6hb', true),
            array('a', false)
        );
    }

    /**
     * Test get
     *
     * @dataProvider dataProviderUprm
     */
    public function testGet($uprn, $hasResults, $statusCode)
    {
        $this->setUpWithUprn();

        $response = $this->controller->get($uprn);

        $this->assertEquals($statusCode, $response->getStatusCode());
    }

    public function dataProviderUprm()
    {
        return array(
            array('10006614932', true, Response::STATUS_CODE_200),
            array('a', false, Response::STATUS_CODE_404)
        );
    }
}