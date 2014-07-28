<?php

namespace PUGX\Bot\UseCase;

use Packagist\Api\Client;
use PUGX\Bot\Package\ProviderInterface;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;

class PullPackagistList extends DispatcherUseCase
{
    private $packagistClient;
    private $provider;

    public function __construct(Client $packagistClient, ProviderInterface $provider, EventDispatcherInterface $dispatcher)
    {
        parent::__construct($dispatcher);
        $this->packagistClient = $packagistClient;
        $this->provider = $provider;
    }

    public function execute()
    {
        $packages = $this->packagistClient->all();

        return $this->provider->setAllPackages($packages);
    }
} 