<?php


namespace App\Command;


use App\Converter\ScryfallFieldConverter;
use App\Entity\Card;
use App\Entity\Color;
use App\Normalizer\CardNormalizer;
use App\Normalizer\ColorNormalizer;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\PropertyInfo\Extractor\ReflectionExtractor;
use Symfony\Component\Serializer\Normalizer\ArrayDenormalizer;
use Symfony\Component\Serializer\Normalizer\DateTimeNormalizer;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Serializer;
use function dump;

class ImportColors extends \Symfony\Component\Console\Command\Command
{
    protected static $defaultName = "app:import-colors";

    /**
     * @var EntityManagerInterface
     */
    protected $entityManager;

    public function __construct(EntityManagerInterface $em, string $name = null)
    {
        parent::__construct($name);
        $this->entityManager = $em;
    }

    protected function configure()
    {
        $this
            // the short description shown while running "php bin/console list"
            ->setDescription('Imports mtg colors')

            // the full command description shown when running the command with
            // the "--help" option
            ->setHelp('This command tries to find a local file of colors to import, and puts it in the database');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $filename = "tmp/colors.json";
        $output->writeln("Importing colors from $filename.");
        $colors = \JsonMachine\JsonMachine::fromFile($filename);
        $normalizers = [new ObjectNormalizer()];

        $serializer = new Serializer($normalizers);
        foreach($colors as $color) {
            $obj = $serializer->denormalize(
                $color,
                Color::class
            );

            $this->entityManager->persist($obj);
        }
        $this->entityManager->flush();

        return Command::SUCCESS;
    }

}