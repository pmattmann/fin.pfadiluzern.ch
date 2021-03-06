<?php

namespace Application\Mail;

use Laminas\Mail\Transport\Smtp as ZendSmtpTransport;
use Laminas\Mail\Transport\SmtpOptions;

class SmtpTransport extends ZendSmtpTransport
{
    public function __construct($username, $password)
    {
        $options = new SmtpOptions(array(
            'name'              => 'smtp.gmail.com',
            'host'              => 'smtp.gmail.com',
            'port'              => 587,
            'connection_class'  => 'login',
            'connection_config' => array(
                'username'  => $username,
                'password'  => $password,
                'ssl'       => 'tls'
            ),
        ));

        parent::__construct($options);
    }
}
