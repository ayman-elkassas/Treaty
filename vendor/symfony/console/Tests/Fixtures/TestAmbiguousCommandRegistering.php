<?php

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class TestAmbiguousCommandRegistering extends Command
{
    protected function configure()
    {
        $this
            ->setName('migrateSpec-ambiguous')
            ->setDescription('The migrateSpec-ambiguous command')
            ->setAliases(['test'])
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $output->write('migrateSpec-ambiguous');
    }
}
