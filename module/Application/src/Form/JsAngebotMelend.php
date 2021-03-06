<?php

namespace Application\Form;

use Laminas\Form\Element;
use Laminas\Form\Form;
use Laminas\Session\Container;

class JsAngebotMelend extends Form
{
    public function __construct($name = null, array $options = [])
    {
        parent::__construct($name, $options);

        $pfadiname = new Element\Text('pfadiname');
        $pfadiname
            ->setAttributes(array(
                'class'     => 'pfadiname form-control',
                'size'      => '30',
            ))
            ->setLabel('Pfadiname')
            ->setLabelAttributes(array(
                'class' => 'col-sm-2 control-label'
            ));

        $vorname = new Element\Text('vorname');
        $vorname
            ->setAttributes(array(
                'required'  => 'required',
                'class'     => 'vorname form-control',
                'size'      => '30',
            ))
            ->setLabel('Vorname')
            ->setLabelAttributes(array(
                'class' => 'col-sm-2 control-label'
            ));

        $nachname = new Element\Text('nachname');
        $nachname
            ->setAttributes(array(
                'required'  => 'required',
                'class'     => 'nachname form-control',
                'size'      => '30',
            ))
            ->setLabel('Nachname')
            ->setLabelAttributes(array(
                'class' => 'col-sm-2 control-label'
            ));

        $mail = new Element\Email('mail');
        $mail
            ->setAttributes(array(
                'required'  => 'required',
                'class'     => 'mail form-control',
                'size'      => '30',
            ))
            ->setLabel('Mail')
            ->setLabelAttributes(array(
                'class' => 'col-sm-2 control-label'
            ));


        $bank = new Element\Text('bank');
        $bank
            ->setAttributes(array(
                'required'  => 'required',
                'class'     => 'bank form-control',
                'size'      => '30',
            ))
            ->setLabel('Bank')
            ->setLabelAttributes(array(
                'class' => 'col-sm-2 control-label'
            ));

        $iban = new Element\Text('iban');
        $iban
            ->setAttributes(array(
                'required'  => 'required',
                'class'     => 'iban form-control',
                'size'      => '30',
            ))
            ->setLabel('IBAN')
            ->setLabelAttributes(array(
                'class' => 'col-sm-2 control-label'
            ));

        $remember = new Element\Checkbox('remember');
        $remember
            ->setAttributes(array(
                'class'     => 'remember',
                'size'      => '30',
            ))
            ->setLabel('Daten merken')
            ->setLabelAttributes(array(
                'class' => 'control-label'
            ));
        $remember->setValue(true);



        $angebotNr = new Element\Text('angebot-nr');
        $angebotNr
            ->setAttributes(array(
                'required'  => 'required',
                'class'     => 'angebot-nr form-control',
                'size'      => '30',
            ))
            ->setLabel('Nr')
            ->setLabelAttributes(array(
                'class' => 'col-sm-2 control-label'
            ));

        $angebotPdf = new Element\File('angebot-pdf');
        $angebotPdf
            ->setAttributes(array(
                'required'  => 'required',
                'class'     => 'angebot-pdf form-control',
                'size'      => '30',
                'accept'    => 'application/pdf'

            ))
            ->setLabel('PDF')
            ->setLabelAttributes(array(
                'class' => 'col-sm-2 control-label'
            ));



        $clear = new Element\Button('clear');
        $clear
            ->setAttributes(array(
                'id' => $name . '-clear',
                'class' => 'btn btn-default',
                'size'  => '30',
                'value' => 'Reset',
            ))
            ->setLabel('Reset');

        $submit = new Element\Button('submit');
        $submit
            ->setAttributes(array(
                'id' => $name . '-submit',
                'class' => 'btn btn-success',
                'size'  => '30',
                'value' => 'Senden',
            ));

        $csrf = new Element\Csrf('csrf');



        $this->add($vorname);
        $this->add($nachname);
        $this->add($pfadiname);
        $this->add($mail);
        $this->add($bank);
        $this->add($iban);
        $this->add($remember);
        $this->add($angebotNr);
        $this->add($angebotPdf);
        $this->add($clear);
        $this->add($submit);
        $this->add($csrf);
    }

    public function loadData()
    {
        $container = new Container(__NAMESPACE__);

        $this->get('pfadiname')->setValue($container->pfadiname);
        $this->get('vorname')->setValue($container->vorname);
        $this->get('nachname')->setValue($container->nachname);
        $this->get('mail')->setValue($container->mail);
        $this->get('bank')->setValue($container->bank);
        $this->get('iban')->setValue($container->iban);
    }

    public function saveData()
    {
        $container = new Container(__NAMESPACE__);

        if ($this->get('remember')->getValue()) {
            $container->pfadiname = $this->get('pfadiname')->getValue();
            $container->vorname = $this->get('vorname')->getValue();
            $container->nachname = $this->get('nachname')->getValue();
            $container->mail = $this->get('mail')->getValue();
            $container->bank = $this->get('bank')->getValue();
            $container->iban = $this->get('iban')->getValue();
        }
    }
}
