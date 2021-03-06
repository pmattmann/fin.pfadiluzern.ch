<?php

namespace Application\Controller;

use Application\Form\JsAngebotMelend;
use Application\Mail\SmtpTransport;
use Laminas\Http\Request;
use Laminas\Mail\Message;
use Laminas\Mime\Mime;
use Laminas\Mime\Message as MimeMessage;
use Laminas\Mime\Part as MimePart;
use Laminas\Mvc\Controller\AbstractActionController;
use Laminas\View\Model\ViewModel;
use Laminas\View\Renderer\PhpRenderer;

class JsAngebotController extends AbstractActionController
{
    /** @var PhpRenderer */
    private $viewRenderer;

    /** @var SmtpTransport */
    private $smtpTransport;

    /** @var array */
    private $fin;

    public function __construct($viewRenderer, $smtpTransport, $fin)
    {
        $this->viewRenderer = $viewRenderer;
        $this->smtpTransport = $smtpTransport;
        $this->fin = $fin;
    }


    public function indexAction()
    {
        $form = new JsAngebotMelend('js-angebot');
        $form->loadData();

        /** @var Request $request */
        $request = $this->getRequest();
        if ($request->isPost()) {
            $data = $request->getPost();
            $files = $request->getFiles();
            $form->setData($data);

            if ($form->isValid()) {
                $form->saveData();

                $this->jsAngebotMeldenMail($data, $files);

                $viewModel = new ViewModel();
                $viewModel->setTemplate('application/js-angebot/success');
                $viewModel->setVariables($data);

                return $viewModel;
            }
        }

        return ['form' => $form];
    }


    private function jsAngebotMeldenMail($data = [], $files = [])
    {
        $htmlViewModel = new ViewModel();
        $htmlViewModel->setTemplate("application/js-angebot/mail");
        $htmlViewModel->setVariable("data", $data);

        $html = new MimePart($this->viewRenderer->render($htmlViewModel));
        $html->type = "text/html";

        $pdf = new MimePart(fopen($files['angebot-pdf']['tmp_name'], 'r'));
        $pdf->type = $files['angebot-pdf']['type']; // "application/pdf";
        $pdf->filename = $files['angebot-pdf']['name'];
        $pdf->encoding    = Mime::ENCODING_BASE64;
        $pdf->disposition = Mime::DISPOSITION_ATTACHMENT;


        $body = new MimeMessage();
        $body->setParts(array($html, $pdf));

        $message = new Message();
        $message->addFrom($this->fin['from_mail'], $this->fin['from_name']);
        $message->addTo($this->fin['to_mail'], $this->fin['to_name']);
        $message->setSubject('J+S Angebot: ' . $data['angebot-nr']);
        $message->setBody($body);

        $this->smtpTransport->send($message);
    }
}
