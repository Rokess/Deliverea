<?php

declare(strict_types = 1);

namespace Deliverea\CoffeeMachine\Service;

final class MakeDrinkService
{
    private const DrinkType = ['tea', 'coffee', 'chocolate'];
    private const DrinkPrice = [
        'tea' => 0.4,
        'coffee' => 0.5,
        'chocolate' => 0.6
    ];

    public function checkDrinkSelected(string $drinkTypeSelected): bool
    {
        return in_array($drinkTypeSelected, self::DrinkType);
    }

    public function checkDrinkPrice(string $drinkTypeSelected, int $money): ?string
    {
        if ($money < self::DrinkPrice[$drinkTypeSelected]) {
            return $drinkTypeSelected.' costs '.self::DrinkPrice[$drinkTypeSelected];
        }

        return null;
    }
}