<?php

namespace Deliverea\CoffeeMachine\Console;

use Deliverea\CoffeeMachine\Service\MakeDrinkService;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;

final class MakeDrinkCommand extends Command
{
    private $makeDrinkService;

    public function __construct(MakeDrinkService $makeDrinkService) {
        $this->makeDrinkService = $makeDrinkService;
    }

    protected static $defaultName = 'app:order-drink';

    protected function configure()
    {
        $this->addArgument(
            'drink-type',
            InputArgument::REQUIRED,
            'The type of the drink. (Tea, Coffee or Chocolate)'
        );

        $this->addArgument(
            'money',
            InputArgument::REQUIRED,
            'The amount of money given by the user'
        );

        $this->addArgument(
            'sugars',
            InputArgument::OPTIONAL,
            'The number of sugars you want. (0, 1, 2)',
            0
        );

        $this->addOption(
            'extra-hot',
            'e',
            InputOption::VALUE_NONE,
            $description = 'If the user wants to make the drink extra hot'
        );
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $drinkType = strtolower($input->getArgument('drink-type'));

        if (!$this->makeDrinkService->checkDrinkSelected($drinkType)) {
            $output->writeln('The drink type should be tea, coffee or chocolate.');

            return;
        }

        $money = $input->getArgument('money');
        $checkDrink = $this->makeDrinkService->checkDrinkPrice($drinkType, $money);

        if (!$checkDrink) {
            $output->writeln($checkDrink);

            return;
        }

        $sugars = $input->getArgument('sugars');
        $extraHot = $input->getOption('extra-hot');

        if (!$this->makeDrinkService->checkSugarSelected($sugars)) {
            $output->writeln('The number of sugars should be between 0 and 2.');

            return;
        }

        $output->write('You have ordered a ' . $drinkType);

        if ($extraHot) {
            $output->write(' extra hot');
        }

        if ($sugars > 0) {
            $output->write(' with ' . $sugars . ' sugars (stick included)');
        }

        $output->writeln('');
    }
}
