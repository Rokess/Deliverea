<?php

declare(strict_types = 1);

namespace Deliverea\CoffeeMachine\Service;

final class MakeDrinkService
{
    private const DrinkTypeWithPrice = [
        'tea' => 0.4,
        'coffee' => 0.5,
        'chocolate' => 0.6
    ];
    private const SugarMaximumCount = 2;

    public function checkDrinkSelected(string $drinkTypeSelected): bool
    {
        return array_key_exists($drinkTypeSelected, self::DrinkTypeWithPrice);
    }

    public function checkDrinkPrice(string $drinkTypeSelected, int $money): ?string
    {
        if ($money < self::DrinkTypeWithPrice[$drinkTypeSelected]) {
            return $drinkTypeSelected.' costs '.self::DrinkTypeWithPrice[$drinkTypeSelected];
        }

        return null;
    }

    public function checkSugarSelected(string $sugarAmount): bool
    {
        return $sugarAmount >= 0 && $sugarAmount <= self::SugarMaximumCount;
    }
}