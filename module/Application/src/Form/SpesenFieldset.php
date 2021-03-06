<?php

namespace Application\Form;

use Laminas\Form\Element;
use Laminas\Form\Fieldset;

class SpesenFieldset extends Fieldset
{
    public function __construct($name = null, $konten = [], array $options = [])
    {
        parent::__construct($name, $options);

        $datum = new Element\Text('datum');
        $datum
            ->setAttributes(array(
                'required'  => 'required',
                'class'     => 'datum form-control',
            ))
            ->setLabel('Datum')
            ->setLabelAttributes(array(
                'class' => 'col-sm-3 col-md-2 control-label'
            ));

        $konto = new Element\Select('konto');
        $konto
            ->setValueOptions($konten)
            ->setAttributes(array(
                'required'  => 'required',
                'class'     => 'konto form-control',
            ))
            ->setLabel('Konto')
            ->setLabelAttributes(array(
                'class' => 'col-sm-3 col-md-2 control-label'
            ))
            ->setOptions(array(
                'empty_option' => 'Konto wählen',
            ));

        $bezeichnung = new Element\Textarea('bezeichnung');
        $bezeichnung
            ->setAttributes(array(
                'required'  => 'required',
                'class'     => 'bezeichnung form-control',
                'rows'      => 4
            ))
            ->setLabel('Text')
            ->setLabelAttributes(array(
                'class' => 'col-sm-3 col-md-2 control-label'
            ));

        $betrag = new Element\Text('betrag');
        $betrag
            ->setAttributes(array(
                'required'  => 'required',
                'class'     => 'betrag form-control',
            ))
            ->setLabel('Betrag')
            ->setLabelAttributes(array(
                'class' => 'col-sm-3 col-md-2 control-label'
            ));

        $this->add($datum);
        $this->add($konto);
        $this->add($bezeichnung);
        $this->add($betrag);
    }
}
