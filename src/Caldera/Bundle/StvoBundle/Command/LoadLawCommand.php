<?php

namespace Caldera\Bundle\StvoBundle\Command;

use Caldera\Bundle\StvoBundle\Entity\Law;
use Caldera\Bundle\StvoBundle\Entity\Paragraph;
use Caldera\Bundle\StvoBundle\Entity\Version;
use DirectoryIterator;
use Doctrine\ORM\EntityManager;
use PHPGit\Git;
use SplFileInfo;
use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;

class LoadLawCommand extends ContainerAwareCommand
{
    protected function configure()
    {
        $this
            ->setName('stvo:law:load')
            ->setDescription('Load law')
            ->addArgument(
                'law',
                InputArgument::REQUIRED
            )
            ->addArgument(
                'version',
                InputArgument::REQUIRED
            )
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $lawSlug = $input->getArgument('law');
        $versionSlug = $input->getArgument('version');

        $varDirectory = $this->getContainer()->getParameter('kernel.root_dir') . '../var/tmp/';
        $gitDirectory = $varDirectory . 'law/' . $lawSlug . '/' . $versionSlug;

        /* @TODO Git stuff goes here */

        /** @var EntityManager $entityManager */
        $entityManager = $this->getContainer()->get('doctrine')->getManager();

        $law = $entityManager->getRepository('CalderaStvoBundle:Law')->findOneBySlug($lawSlug);
        $version = $entityManager->getRepository('CalderaStvoBundle:Version')->findOneBySlug($versionSlug);

        $this->createOrUpdateParagraphs($input, $output, $gitDirectory, $law, $version);

        $entityManager->flush();
    }

    protected function createOrUpdateParagraphs(
        InputInterface $input,
        OutputInterface $output,
        string $directory,
        Law $law,
        Version $version
    )
    {
        $dir = new DirectoryIterator($directory);

        foreach ($dir as $fileinfo) {
            if ($fileinfo->isFile()) {
                $this->createOrUpdateParagraph($input, $output, $fileinfo, $law, $version);
            }
        }
    }

    protected function createOrUpdateParagraph(
        InputInterface $input,
        OutputInterface $output,
        SplFileInfo $fileInfo,
        Law $law,
        Version $version
    )
    {
        $filename = $fileInfo->getFilename();

        preg_match('/(.{1,3}) (.*).html/', $filename, $matches);

        $number = $matches[1];
        $title = $matches[2];
        $text = file_get_contents($fileInfo->getPathname());

        /** @var EntityManager $entityManager */
        $entityManager = $this->getContainer()->get('doctrine')->getManager();

        $paragraph = $entityManager->getRepository('CalderaStvoBundle:Paragraph')->findOneByLawVersionNumber(
            $law,
            $version,
            $number
        );

        if (!$paragraph) {
            $paragraph = new Paragraph();

            $paragraph->setNumber($number);
        }

        $paragraph
            ->setTitle($title)
            ->setText($text)
            ->setLaw($law)
            ->setVersion($version)
        ;

        $entityManager->persist($paragraph);
    }
}
