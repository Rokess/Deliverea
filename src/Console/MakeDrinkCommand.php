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
        $money = $input->getArgument('money');
        $sugars = $input->getArgument('sugars');
        $extraHot = $input->getOption('extra-hot');


        $output->writeln($this->makeDrinkService->makeDrinksChecks($drinkType, $money, $sugars, $extraHot));
    }
}
