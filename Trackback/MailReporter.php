<?php

namespace Astina\Bundle\TradedoublerBundle\Trackback;

use Astina\Bundle\TradedoublerBundle\Model\Transaction;
use Symfony\Component\Finder\Finder;
use Symfony\Component\HttpFoundation\File\File;

class MailReporter implements ReporterInterface
{
    protected $mailer;

    protected $organization;

    protected $sender;

    protected $recipients;

    protected $dataFolder;

    protected $params = array();

    function __construct(\Swift_Mailer $mailer, $organization, $sender, $recipients, $dataFolder)
    {
        $this->mailer = $mailer;
        $this->organization = $organization;
        $this->sender = $sender;
        $this->recipients = $recipients;
        $this->dataFolder = $dataFolder;
    }

    public function sendReport($params = null)
    {
        if ($params) {
            $this->setReportParams($params);
        }

        $file = $this->createFile();

        $message = \Swift_Message::newInstance()
            ->setSubject('Tradedoubler Batch')
            ->setBody('')
            ->setFrom($this->sender)
            ->setTo($this->recipients)
            ->attach(\Swift_Attachment::fromPath($file))
        ;

        return $this->mailer->send($message);
    }

    protected function createFile()
    {
        $sequenceNumber = $this->getNextSequenceNumber();

        $file = sprintf('%s/pending_%s_%s.xml',
            $this->dataFolder,
            $this->organization,
            $sequenceNumber
        );

        $this->createXml()->asXML($file);

        return $file;
    }

    protected function createXml()
    {
        $root = new \SimpleXMLElement('<tradeDoublerPending></tradeDoublerPending>');
        $root->addChild('organizationId', $this->organization);
        $root->addChild('sequenceNumber', $this->getNextSequenceNumber());
        $root->addChild('numberOfTransactions', count($this->params['transactions']));
        foreach ($this->params as $name => $value) {
            if ($name == 'transactions') {
                $transactions = $value;
                $transactionsElem = $root->addChild('transactions');
                /** @var Transaction $transaction  */
                foreach ($transactions as $transaction) {
                    $transElem = $transactionsElem->addChild('transaction');
                    $transElem->addChild('eventId', $transaction->getEventId());
                    $transElem->addChild('orderNumber', $transaction->getOrderNumber());
                    $transElem->addChild('status', $transaction->getStatus());
                    $transElem->addChild('reasonId', $transaction->getReasonId());
                }
            } else {
                $root->addChild($name, $value);
            }

        }
        $root->addChild('sequenceNumber', $this->organization);

        return $root;
    }

    public function setReportParams(array $params)
    {
        $this->params = $params;
    }

    public function getReportParams()
    {
        return $this->params;
    }

    public function clearReportParams()
    {
        $this->params = array();
    }

    protected function getNextSequenceNumber()
    {
        $maxNumber = 0;

        $files = Finder::create()->in($this->dataFolder)->name('pending_*');

        /** @var File $file */
        foreach ($files as $file) {
            if (preg_match('/([0-9]+)\.xml$/', $file->getFilename(), $matches)) {
                $maxNumber = max($maxNumber, $matches[1]);
            }
        }

        return $maxNumber + 1;
    }
}