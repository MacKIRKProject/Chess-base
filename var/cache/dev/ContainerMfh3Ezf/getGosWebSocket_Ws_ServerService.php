<?php

use Symfony\Component\DependencyInjection\Argument\RewindableGenerator;
use Symfony\Component\DependencyInjection\Exception\RuntimeException;

// This file has been auto-generated by the Symfony Dependency Injection Component for internal use.
// Returns the private 'gos_web_socket.ws.server' shared service.

include_once $this->targetDirs[3].'/vendor/gos/web-socket-bundle/Server/App/Registry/OriginRegistry.php';
include_once $this->targetDirs[3].'/vendor/symfony/http-foundation/Session/Storage/Handler/AbstractSessionHandler.php';
include_once $this->targetDirs[3].'/vendor/symfony/http-foundation/Session/Storage/Handler/PdoSessionHandler.php';
include_once $this->targetDirs[3].'/vendor/gos/web-socket-bundle/Server/Type/ServerInterface.php';
include_once $this->targetDirs[3].'/vendor/gos/web-socket-bundle/Server/Type/WebSocketServer.php';
include_once $this->targetDirs[3].'/vendor/gos/web-socket-bundle/Server/App/Registry/PeriodicRegistry.php';
include_once $this->targetDirs[3].'/vendor/gos/web-socket-bundle/Pusher/ServerPushHandlerRegistry.php';

$a = ($this->privates['gos_web_socket_server.wamp_application'] ?? $this->load('getGosWebSocketServer_WampApplicationService.php'));

if (isset($this->privates['gos_web_socket.ws.server'])) {
    return $this->privates['gos_web_socket.ws.server'];
}

$this->privates['gos_web_socket.ws.server'] = $instance = new \Gos\Bundle\WebSocketBundle\Server\Type\WebSocketServer(($this->privates['gos_web_socket.server.event_loop'] ?? $this->load('getGosWebSocket_Server_EventLoopService.php')), ($this->services['event_dispatcher'] ?? $this->getEventDispatcherService()), ($this->privates['gos_web_socket.periodic.registry'] ?? $this->privates['gos_web_socket.periodic.registry'] = new \Gos\Bundle\WebSocketBundle\Server\App\Registry\PeriodicRegistry()), $a, new \Gos\Bundle\WebSocketBundle\Server\App\Registry\OriginRegistry(), false, ($this->privates['gos_web_socket.wamp.topic_manager'] ?? $this->load('getGosWebSocket_Wamp_TopicManagerService.php')), ($this->privates['gos_web_socket.server_push_handler.registry'] ?? $this->privates['gos_web_socket.server_push_handler.registry'] = new \Gos\Bundle\WebSocketBundle\Pusher\ServerPushHandlerRegistry()), ($this->services['monolog.logger.websocket'] ?? $this->load('getMonolog_Logger_WebsocketService.php')));

$instance->setSessionHandler(new \Symfony\Component\HttpFoundation\Session\Storage\Handler\PdoSessionHandler(($this->services['doctrine.dbal.default_connection'] ?? $this->load('getDoctrine_Dbal_DefaultConnectionService.php'))->getWrappedConnection(), array('lock_mode' => 0)));

return $instance;