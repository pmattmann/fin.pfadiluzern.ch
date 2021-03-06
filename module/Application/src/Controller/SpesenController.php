<?php

namespace Application\Controller;

use Application\Form\SpesenMelden;
use Application\Mail\SmtpTransport;
use Laminas\Http\Request;
use Laminas\Mail\Message;
use Laminas\Mime\Mime;
use Laminas\Mime\Message as MimeMessage;
use Laminas\Mime\Part as MimePart;
use Laminas\Mvc\Controller\AbstractActionController;
use Laminas\View\Model\ViewModel;
use Laminas\View\Renderer\PhpRenderer;

class SpesenController extends AbstractActionController
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
        $konten = $this->fin['konten'];

        $form = new SpesenMelden('spesen', $konten);
        $form->loadData();

        /** @var Request $request */
        $request = $this->getRequest();
        if ($request->isPost()) {
            $data = $request->getPost();
            $files = $request->getFiles();
            $form->setData($data);

            if ($form->isValid()) {
                $form->saveData();

                $this->spesenMeldenMail($data, $files);

                $viewModel = new ViewModel();
                $viewModel->setTemplate('application/spesen/success');
                $viewModel->setVariables($data);
                $viewModel->setVariable('fin', $this->fin);

                return $viewModel;
            }
        }

        return ['form' => $form];
    }


    private function spesenMeldenMail($data = [], $files = [])
    {
        $htmlViewModel = new ViewModel();
        $htmlViewModel->setTemplate("application/spesen/mail");
        $htmlViewModel->setVariable("data", $data);

        $html = new MimePart($this->viewRenderer->render($htmlViewModel));
        $html->type = "text/html";

        $parts = array($html);

        foreach ($files as $file) {
            $att = new MimePart(fopen($file['tmp_name'], 'r'));
            $att->type = $file['type'];
            $att->filename = $file['name'];
            $att->encoding    = Mime::ENCODING_BASE64;
            $att->disposition = Mime::DISPOSITION_ATTACHMENT;

            $parts[] = $att;
        }

        $body = new MimeMessage();
        $body->setParts($parts);

        $message = new Message();
        $message->addFrom($this->fin['from_mail'], $this->fin['from_name']);
        $message->addTo($this->fin['to_mail'], $this->fin['to_name']);
        $message->setSubject('Spesen - ' . $data['vorname'] . ' ' . $data['nachname'] . ' / ' . $data['pfadiname']);
        $message->setBody($body);

        $this->smtpTransport->send($message);
    }
}
