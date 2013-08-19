<?php

namespace ZfrMailChimpBundle\Services;

use Symfony\Component\DependencyInjection\ContainerInterface;
use ZfrMailChimp\Client\MailChimpClient;
use Guzzle\Plugin\Async\AsyncPlugin;

class MailChimpHandler {

    /**
    * MailChimp API key set in app/config/config.yml
    * @var string 
    */
    private $apiKey;
    
    /**
    * Guzzle Async plugin on/off, set in app/config/config.yml
    * @var bool
    */
    private $async;

    /**
     * Initialize Handler
     *
     * @param string $apiKey injected via semantic config
     * @param boolean $async optional use of Guzzle Async plugin
     *
     * @return MailChimpHandler
     */
    public function __construct($apiKey, $async = false)
    {
        $this->apiKey = $apiKey;
        $this->async = $async;
    }

    /**
     * Create ZFRMailChimp Client
     *
     * @return MailChimpClient $client
     */
    public function getClient()
    {
        $client = new MailChimpClient($this->apiKey);

        if($this->async) {
            $client->addSubscriber(new AsyncPlugin());
        }

        return $client;
    }
}
