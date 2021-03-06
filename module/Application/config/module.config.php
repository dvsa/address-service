<?php
/**
 * Zend Framework (http://framework.zend.com/)
 *
 * @link      http://github.com/zendframework/ZendSkeletonApplication for the canonical source repository
 * @copyright Copyright (c) 2005-2013 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

return array(
    'router' => array(
        'routes' => array(
            'postcode' => array(
                'type' => 'segment',
                'options' => array(
                    'route'    => '/address[/:postcode][/]',
                    'constraints' => array(
                        'postcode' => '[a-zA-Z][^\/]+'
                    ),
                    'defaults' => array(
                        'controller' => 'Address'
                    )
                )
            ),
            'uprn' => array(
                'type' => 'segment',
                'options' => array(
                    'route'    => '/address[/:id][/]',
                    'constraints' => array(
                        'id' => '[0-9]+'
                    ),
                    'defaults' => array(
                        'controller' => 'Address'
                    )
                )
            )
        )
    ),
    'service_manager' => array(
        'factories' => array(
            'entity.service' => 'Application\Service\Factory',
            'db.adapter' => 'Zend\Db\Adapter\AdapterServiceFactory'
        )
    ),
    'controllers' => array(
        'invokables' => array(
            'Address' => 'Application\Controller\AddressController'
        )
    ),
    'view_manager' => array(
        'display_not_found_reason' => true,
        'display_exceptions'       => true,
        'doctype'                  => 'HTML5',
        'not_found_template'       => 'error/404',
        'exception_template'       => 'error/index',
        'template_map' => array(
            'error/404'               => __DIR__ . '/../view/error/404.phtml',
            'error/index'             => __DIR__ . '/../view/error/index.phtml'
        ),
        'template_path_stack' => array(
            __DIR__ . '/../view'
        )
    )
);
