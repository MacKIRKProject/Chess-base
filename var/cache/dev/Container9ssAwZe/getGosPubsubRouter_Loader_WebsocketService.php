<?php

use Symfony\Component\DependencyInjection\Argument\RewindableGenerator;
use Symfony\Component\DependencyInjection\Exception\RuntimeException;

// This file has been auto-generated by the Symfony Dependency Injection Component for internal use.
// Returns the public 'gos_pubsub_router.loader.websocket' shared service.

include_once $this->targetDirs[3].'/vendor/symfony/config/Loader/LoaderInterface.php';
include_once $this->targetDirs[3].'/vendor/symfony/config/Loader/Loader.php';
include_once $this->targetDirs[3].'/vendor/symfony/config/Loader/FileLoader.php';
include_once $this->targetDirs[3].'/vendor/gos/pubsub-router-bundle/Loader/AbstractRouteLoader.php';
include_once $this->targetDirs[3].'/vendor/gos/pubsub-router-bundle/Loader/YamlFileLoader.php';
include_once $this->targetDirs[3].'/vendor/gos/pubsub-router-bundle/Loader/RouteLoader.php';
include_once $this->targetDirs[3].'/vendor/gos/pubsub-router-bundle/Router/RouteCollection.php';
include_once $this->targetDirs[3].'/vendor/doctrine/cache/lib/Doctrine/Common/Cache/Cache.php';
include_once $this->targetDirs[3].'/vendor/gos/pubsub-router-bundle/Cache/PhpFileCacheDecorator.php';

$this->services['gos_pubsub_router.loader.websocket'] = $instance = new \Gos\Bundle\PubSubRouterBundle\Loader\RouteLoader(($this->privates['gos_pubsub_router.collection.websocket'] ?? $this->privates['gos_pubsub_router.collection.websocket'] = new \Gos\Bundle\PubSubRouterBundle\Router\RouteCollection()), ($this->privates['gos_pubsub_router.php_file.cache'] ?? $this->privates['gos_pubsub_router.php_file.cache'] = new \Gos\Bundle\PubSubRouterBundle\Cache\PhpFileCacheDecorator($this->targetDirs[0], true)), 'websocket');

$instance->addResource(($this->targetDirs[3].'/config/pubsub_routing.yml'));
$instance->addLoader(new \Gos\Bundle\PubSubRouterBundle\Loader\YamlFileLoader(($this->privates['file_locator'] ?? $this->privates['file_locator'] = new \Symfony\Component\HttpKernel\Config\FileLocator(($this->services['kernel'] ?? $this->get('kernel', 1)), ($this->targetDirs[3].'/src/Resources'), array(0 => ($this->targetDirs[3].'/src'))))));

return $instance;