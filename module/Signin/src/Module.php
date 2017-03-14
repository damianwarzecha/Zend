<?php
namespace Signin;


use Zend\Mail\Transport\Smtp;
use Zend\Mail\Transport\SmtpOptions;
use Zend\ModuleManager\Feature\ConfigProviderInterface;
use Zend\Db\Adapter\AdapterInterface;
use Zend\Db\ResultSet\ResultSet;
use Zend\Db\TableGateway\TableGateway;
use Zend\ServiceManager\Factory\InvokableFactory;
use Zend\ServiceManager\ServiceManager;


class Module implements ConfigProviderInterface

{

	public function getConfig()

	{
		return include __DIR__ . '/../config/module.config.php';
	}

//	public function bootstrapSession($e)
//	{
//		$session = $e->getApplication()
//			->getServiceManager()
//			->get('Zend\Session\SessionManager');
//		$session->start();
//
//		$container = new Container('initialized');
//		if (!isset($container->init)) {
//			$serviceManager = $e->getApplication()->getServiceManager();
//			$request = $serviceManager->get('Request');
//
//			$session->regenerateId(true);
//			$container->init = 1;
//			$container->remoteAddr = $request->getServer()->get('REMOTE_ADDR');
//			$container->httpUserAgent = $request->getServer()->get('HTTP_USER_AGENT');
//
//			$config = $serviceManager->get('Config');
//			if (!isset($config['session'])) {
//				return;
//			}
//
//			$sessionConfig = $config['session'];
//			if (isset($sessionConfig['validators'])) {
//				$chain = $session->getValidatorChain();
//
//				foreach ($sessionConfig['validators'] as $validator) {
//					switch ($validator) {
//						case 'Zend\Session\Validator\HttpUserAgent':
//							$validator = new $validator($container->httpUserAgent);
//							break;
//						case 'Zend\Session\Validator\RemoteAddr':
//							$validator = new $validator($container->remoteAddr);
//							break;
//						default:
//							$validator = new $validator();
//					}
//
//					$chain->attach('session.validate', array($validator, 'isValid'));
//				}
//			}
//		}
//	}

    public function getServiceConfig()
    {
        return [
            'factories' => [
                Model\UserTable::class => function($container)
                {
                    $tableGateway = $container->get(Model\UserTableGateway::class);
                    return new Model\UserTable($tableGateway);
                },
                Model\UserTableGateway::class => function ($container)
                {
                    $dbAdapter = $container->get(AdapterInterface::class);
                    $resultSetPrototype = new ResultSet();
                    $resultSetPrototype->setArrayObjectPrototype(new Model\User());
                    return new TableGateway('z_users', $dbAdapter, null, $resultSetPrototype);
                },
                Model\DeckTable::class => function($container)
                {
                    $tableGateway = $container->get(Model\DeckTableGateway::class);
                    return new Model\DeckTable($tableGateway);
                },
                Model\DeckTableGateway::class => function ($container)
                {
                    $dbAdapter = $container->get(AdapterInterface::class);
                    $resultSetPrototype = new ResultSet();
                    $resultSetPrototype->setArrayObjectPrototype(new Model\Deck());
                    return new TableGateway('z_cards', $dbAdapter, null, $resultSetPrototype);
                },
//				'Zend\Session\SessionManager' => function ($sm) {
//					$config = $sm->get('config');
//					if (isset($config['session'])) {
//						$session = $config['session'];
//
//						$sessionConfig = null;
//						if (isset($session['config'])) {
//							$class = isset($session['config']['class']) ? $session['config']['class'] : 'Zend\Session\Config\SessionConfig';
//							$options = isset($session['config']['options']) ? $session['config']['options'] : array();
//							$sessionConfig = new $class();
//							$sessionConfig->setOptions($options);
//						}
//
//						$sessionStorage = null;
//						if (isset($session['storage'])) {
//							$class = $session['storage'];
//							$sessionStorage = new $class();
//						}
//
//						$sessionSaveHandler = null;
//
//						$sessionManager = new SessionManager($sessionConfig, $sessionStorage, $sessionSaveHandler);
//					} else {
//						$sessionManager = new SessionManager();
//					}
//					Container::setDefaultManager($sessionManager);
//					return $sessionManager;
//				},
				'mail.transport' => function (ServiceManager $serviceManager) {
					$config = $serviceManager->get('Config');
					$transport = new Smtp();
					$transport->setOptions(new SmtpOptions($config['mail']['transport']['options']));
					return $transport;
				},

            ],
        ];
    }

//	public function onBootstrap($evm)
//	{
//		$config = $evm->getApplication()
//			->getServiceManager()
//			->get('Configuration');
//
//		$sessionConfig = new SessionConfig();
//		$sessionConfig->setOptions($config['session']);
//		$sessionManager = new SessionManager($sessionConfig);
//		$sessionManager->start();
//
//		/**
//		 * Optional: If you later want to use namespaces, you can already store the
//		 * Manager in the shared (static) Container (=namespace) field
//		 */
//		Container::setDefaultManager($sessionManager);
//	}
//    public function onBootstrap($e)
//    {
//        $eventManager        = $e->getApplication()->getEventManager();
//        $moduleRouteListener = new ModuleRouteListener();
//        $moduleRouteListener->attach($eventManager);
//        $this->bootstrapSession($e);
//    }


	public function getControllerConfig()
	{
		return [
			'factories' => [
				Controller\SigninController::class => function($container)
				{
					return new Controller\SigninController(
						$container->get(Model\UserTable::class), $container->get('mail.transport')
					);
				},
                Controller\IndexController::class => function($container)
                {
                    return new Controller\IndexController(
                        $container->get(Model\UserTable::class)
                    );
                },
                Controller\ThousendController::class => function($container)
                {
                    return new Controller\ThousendController(
                        $container->get(Model\UserTable::class, Model\DeckTable::class)
                    );
                },



//                    InvokableFactory::class,
			],
		];
	}

}

