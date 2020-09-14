<?php

namespace App\Command;


use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Filesystem\Filesystem;
use Symfony\Component\Finder\Finder;
use Symfony\Component\Finder\SplFileInfo;
use Symfony\Component\HttpClient\HttpClient;
use function array_map;
use function array_search;
use function in_array;
use function iterator_to_array;

class ImportImages extends Command
{
    protected static $defaultName = "app:import-images";

    protected const CATEGORIES = [
//        "png",
//        "border_crop",
//        "art_crop",
//        "large",
//        "normal",
        "small"
    ];

    protected const IMG_DIRECTORY = "public/Scryfall/img/";

    protected function configure()
    {
        $this->setDescription("Imports images from Scryfall");
        $this->setHelp("Imports images from Scryfall");
    }

    protected function createDirectories(bool $erase = false)
    {
        $filesystem = new Filesystem();
        $finder = new Finder();
        $finder->in(self::IMG_DIRECTORY)
            ->depth('== 0')
            ->directories();
        $existingDirectories = iterator_to_array($finder);

        $existingDirectoriesName = array_map(function ($dir) {
            return $dir->getFilename();
        }, $existingDirectories);
        dump($existingDirectoriesName);

        foreach (self::CATEGORIES as $dirToCreate) {
            $key = array_search($dirToCreate, $existingDirectoriesName);
            if ($key) {
//                dump($dirToCreate);
                if ($erase) {
                    $filesystem->remove($key);
                }
            } else {
                $filesystem->mkdir(self::IMG_DIRECTORY . $dirToCreate);
            }
        }
    }

    protected function getUrls()
    {

//        $client = HttpClient::create();
//        $client->request([
//            'GET',
//
//        ]);

    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $this->createDirectories();
//    $finder = new Finder();
//        $finder->
        return Command::SUCCESS;
    }
}