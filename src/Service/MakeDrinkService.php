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
    private const DrinkTypeErrorMessage = 'The drink type should be tea, coffee or chocolate.';
    private const SugarErrorMessage = 'The number of sugars should be between 0 and 2.';

    private function checkDrinkSelected(string $drinkTypeSelected): bool
    {
        return array_key_exists($drinkTypeSelected, self::DrinkTypeWithPrice);
    }

    private function checkDrinkPrice(string $drinkTypeSelected, ?float $money): ?string
    {
        if ($money < self::DrinkTypeWithPrice[$drinkTypeSelected]) {
            return $drinkTypeSelected.' costs '.self::DrinkTypeWithPrice[$drinkTypeSelected];
        }

        return null;
    }

    private function checkSugarSelected(?int $sugarAmount): bool
    {
        return $sugarAmount >= 0 && $sugarAmount <= self::SugarMaximumCount;
    }

    private function setFinalMessage(string $drinkType, bool $extraHot, int $sugars): string
    {
        $finalMessage = 'You have ordered a ' . $drinkType;

        if ($extraHot) {
            $finalMessage .= ' extra hot';
        }

        if ($sugars > 0) {
            $finalMessage .=' with ' . $sugars . ' sugars (stick included)';
        }

        return $finalMessage;
    }

    public function makeDrinksChecks(string $drinkType, ?int $money, ?int $sugars, bool $extraHot): string
    {
        if (!$this->checkDrinkSelected($drinkType)) {
            return self::DrinkTypeErrorMessage;
        }

        $checkDrink = $this->checkDrinkPrice($drinkType, $money);

        if ($checkDrink) {
            return $checkDrink;
        }

        if (!$this->checkSugarSelected($sugars)) {
            return self::SugarErrorMessage;
        }

        return $this->setFinalMessage($drinkType, $extraHot, $sugars);
    }
}