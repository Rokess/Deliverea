#!/usr/bin/env php
<?php
// application.php

require __DIR__.'/vendor/autoload.php';

use Deliverea\CoffeeMachine\Console\MakeDrinkCommand;
use Deliverea\CoffeeMachine\Service\MakeDrinkService;
use Symfony\Component\Console\Application;

$application = new Application();
$makeDrinkService = new MakeDrinkService();

$application->add(new MakeDrinkCommand($makeDrinkService));

$application->run();
