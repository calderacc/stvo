<?php

namespace Caldera\Bundle\StvoBundle\Command;

use Doctrine\ORM\EntityManager;
use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class LoadLawCommand extends ContainerAwareCommand
{
    protected function configure()
    {
        $this
            ->setName('stvo:load:law')
            ->setDescription('Load law');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        /** @var EntityManager $entityManager */
        $entityManager = $this->getContainer()->get('doctrine')->getManager();
    }
}
