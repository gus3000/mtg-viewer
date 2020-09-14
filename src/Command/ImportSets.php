<?php

namespace App\Command;


use App\Converter\ScryfallFieldConverter;
use App\Entity\MtgSet;
use App\Entity\SetType;
use App\Normalizer\CardNormalizer;
use App\Repository\MtgSetRepository;
use App\Repository\SetTypeRepository;
use Doctrine\ORM\EntityManagerInterface;
use JsonMachine\JsonMachine;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\PropertyInfo\Extractor\ReflectionExtractor;
use Symfony\Component\Serializer\Encoder\CsvEncoder;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Normalizer\ArrayDenormalizer;
use Symfony\Component\Serializer\Normalizer\DateTimeNormalizer;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Serializer;
use Symfony\Contracts\HttpClient\HttpClientInterface;
use function dump;
use function file_get_contents;
use function json_decode;

class ImportSets extends Command
{
    protected static $defaultName = "app:import-sets";
    /**
     * @var HttpClientInterface|null
     */
    private $client;
    /**
     * @var EntityManagerInterface|null
     */
    private $em;

    public function __construct(string $name = null, HttpClientInterface $client = null, EntityManagerInterface $em = null)
    {
        parent::__construct($name);
        $this->client = $client;
        $this->em = $em;
    }


    protected function configure()
    {
        $this->setDescription("Imports sets from Scryfall");
        $this->setHelp("Downloads the sets from scryfall and adds them to the sets database");
    }

    protected function importSetTypes()
    {
        $serializer = new Serializer([new ObjectNormalizer()], [new CsvEncoder()]);
//        dump(file_get_contents('public/Scryfall/csv/set_type.csv'));
        $setTypes = $serializer->decode(file_get_contents('public/Scryfall/csv/set_type.csv'), 'csv');
        /** @var SetTypeRepository $repository */
        $repository = $this->em->getRepository(SetType::class);
        foreach ($setTypes as $setType) {
            /** @var SetType $newSetType */
            $newSetType = $serializer->denormalize($setType, SetType::class);
//            dump($newSetType);
            $existingSet = $repository->findOneBy(['name' => $newSetType->getName()]);
            if (!$existingSet) {
                dump($newSetType);
                $this->em->persist($newSetType);
            }
        }
        $this->em->flush();
    }

    protected function importSets()
    {
        $serializer = new Serializer([new DateTimeNormalizer(), new ArrayDenormalizer(), new ObjectNormalizer(null,new ScryfallFieldConverter(),null, new ReflectionExtractor())]);
        /** @var MtgSetRepository $setRepository */
        $setRepository = $this->em->getRepository(MtgSet::class);
        /** @var SetTypeRepository $setTypeRepository */
        $setTypeRepository = $this->em->getRepository(SetType::class);
//        $sets = JsonMachine::fromString(file_get_contents("https://api.scryfall.com/sets"));
        $json = json_decode(file_get_contents("https://api.scryfall.com/sets"));
        $sets = $json->data;
        while($json->has_more)
        {
            $json = json_decode(file_get_contents($json->next_page));
            $sets = $sets + $json->data;
        }
        foreach ($sets as $setData) {
            /** @var MtgSet $set */
            $set = $serializer->denormalize($setData, MtgSet::class);
            $set->setSetType($setTypeRepository->findOneBy(["name"=>$setData->set_type]));
//            dump($setTypeRepository->findOneBy(["name"=>$setData->set_type]));
            $existingSet = $setRepository->findOneBy(["scryfallId"=> $set->getScryfallId()]);
            if(!$existingSet)
                $this->em->persist($set);
        }
        $this->em->flush();
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
//        $this->importSetTypes();
        $this->importSets();
//        $response = $this->client->request("GET", "https://api.scryfall.com/sets");
//        dump($response->getContent());
//        $data = $response->toArray()["data"];
//        $normalizers = [new DateTimeNormalizer(), new ArrayDenormalizer(), new SetNormalizer(null, new ScryfallFieldConverter(), null, new ReflectionExtractor())];

//        foreach($data as $setData)
//        {
//            dump($setData);
//            $output->writeln($setData['name']);

//        }

        return Command::SUCCESS;
    }
}