<?php

namespace Application\Controller;

use Application\Mail\SmtpTransport;
use Laminas\ServiceManager\FactoryInterface;
use Laminas\ServiceManager\ServiceLocatorInterface;

class SpesenControllerFactory implements FactoryInterface
{
    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        $phpRenderer = $serviceLocator->getServiceLocator()->get('ViewRenderer');
        $smtpTransport = $serviceLocator->getServiceLocator()->get(SmtpTransport::class);
        $fin = $serviceLocator->getServiceLocator()->get('Config')['fin'];
        return new SpesenController($phpRenderer, $smtpTransport, $fin);
    }
}
