<?php

namespace Application\Mail;

use Laminas\Mail\Transport\Smtp as ZendSmtpTransport;
use Laminas\Mail\Transport\SmtpOptions;

class SmtpTransport extends ZendSmtpTransport
{
    public function __construct($username, $password)
    {
        $options = new SmtpOptions(array(
            'host'              => 'smtp.gmail.com',
            'name'              => 'smtp.gmail.com',
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
