<?php

namespace Application\Mail;

use Laminas\ServiceManager\FactoryInterface;
use Laminas\ServiceManager\ServiceLocatorInterface;

class SmtpTransportFactory implements FactoryInterface
{
    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        $fin = $serviceLocator->get('Config')['fin'];

        return new SmtpTransport($fin['from_mail'], $fin['from_password']);
    }
}
