<?php


namespace App\Command;


use App\Converter\ScryfallFieldConverter;
use App\Entity\Card;
use App\Entity\Color;
use App\Normalizer\CardNormalizer;
use App\Normalizer\ColorNormalizer;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ObjectRepository;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;
use Symfony\Component\PropertyInfo\Extractor\ReflectionExtractor;
use Symfony\Component\Routing\Router;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Encoder\XmlEncoder;
use Symfony\Component\Serializer\Normalizer\ArrayDenormalizer;
use Symfony\Component\Serializer\Normalizer\DateTimeNormalizer;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Serializer;
use function dump;
use function is_null;
use function var_export;

class ImportCards extends Command
{
    protected static $defaultName = "app:import-cards";

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
            ->setDescription('Imports cards from scryfall')

            // the full command description shown when running the command with
            // the "--help" option
            ->setHelp('This command tries to find a local file of cards to import, and puts it in the database');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $io = new SymfonyStyle($input,$output);

        $filename = "tmp/default-cards-20200901090341.json";
//        $filename = "tmp/cards_small.json";
        $output->writeln("Importing cards from $filename.");
        $cards = \JsonMachine\JsonMachine::fromFile($filename);

//        $encoders = [new XmlEncoder(), new JsonEncoder()];
        $normalizers = [new DateTimeNormalizer(), new ArrayDenormalizer(), new CardNormalizer(null, new ScryfallFieldConverter(), null, new ReflectionExtractor())];
//    $normalizers = [new CardNormalizer()];

        $serializer = new Serializer($normalizers);
        /** @var ObjectRepository $repo */
        $repo = $this->entityManager->getRepository(Color::class);
        $progressBar = $io->createProgressBar();
        $progressBar->minSecondsBetweenRedraws(0.5);
        $colors = [];
        foreach(Color::NAMES as $abbr => $name)
        {
            $colors[$abbr] = $repo->findOneBy(["abbr"=>$abbr]);
        }

        $i = 0;
        foreach ($cards as $card) {
            /** @var Card $cardObject */

            $cardObject = $serializer->denormalize(
                $card,
                Card::class
            );
//            if($cardObject->getName() === "Spirit")
//                dump($cardObject);
//            dump($obj->getColorIdentity());
//        dump($obj);
            foreach ($cardObject->getColorIdentity() as $c) {
                $cardObject->removeColorIdentity($c);
                /** @var Color $color */
//                $color = $repo->findOneBy(["abbr" => $c->getAbbr()]);
                $color = $colors[$c->getAbbr()];
//                if(is_null($color))
//                dump($obj->getColorIdentity());
                $cardObject->addColorIdentity($color);
            }
//            dump($obj);
            $progressBar->advance();
            $this->entityManager->persist($cardObject);

            $i++;
//            if($i > 1000)
//                break;
        }

        $progressBar->finish();
        $this->entityManager->flush();

//        $serializer = new Serializer($normalizers, $encoders);
//
//        foreach ($cards as $card)
//        {
////            $card["scryfall_id"] = $card["id"];
////            $card["id"] = null;
//            var_export($card);
//            $cardObject = $serializer->denormalize($card,Card::class);
//            $output->writeln($card);
//        }


        return Command::SUCCESS;
    }


}