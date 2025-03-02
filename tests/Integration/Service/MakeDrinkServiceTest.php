<?php

namespace Deliverea\CoffeeMachine\Tests\Integration\Service;

use Deliverea\CoffeeMachine\Service\MakeDrinkService;
use Deliverea\CoffeeMachine\Tests\Integration\IntegrationTestCase;
use Symfony\Component\Console\Tester\CommandTester;

class MakeDrinkServiceTest extends IntegrationTestCase
{
    public function testSuccessMakeDrinksChecks()
    {
        $drinkType = 'tea';
        $money = '0.4';
        $sugar = 0;
        $extraHot = 1;

        $makeDrinkService = new MakeDrinkService();
        $result = $makeDrinkService->makeDrinksChecks($drinkType, $money, $sugar, $extraHot);

        $this->assertEquals('You have ordered a tea extra hot', $result);
    }

    public function testInvalidDrinkType()
    {
        $drinkType = 'teas';
        $money = '0.4';
        $sugar = 0;
        $extraHot = 1;

        $makeDrinkService = new MakeDrinkService();
        $result = $makeDrinkService->makeDrinksChecks($drinkType, $money, $sugar, $extraHot);

        $this->assertEquals('The drink type should be tea, coffee or chocolate.', $result);
    }

    public function testInvalidSugarAmount()
    {
        $drinkType = 'tea';
        $money = '0.4';
        $sugar = '9';
        $extraHot = 1;

        $makeDrinkService = new MakeDrinkService();
        $result = $makeDrinkService->makeDrinksChecks($drinkType, $money, $sugar, $extraHot);

        $this->assertEquals('The number of sugars should be between 0 and 2.', $result);
    }
}
