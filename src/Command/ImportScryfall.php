<?php


namespace App\Command;


use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\HttpClient\HttpClient;
use Symfony\Contracts\HttpClient\HttpClientInterface;
use function dump;

class ImportScryfall extends \Symfony\Component\Console\Command\Command
{
    protected static $defaultName = "app:import-all";
    protected $client;

    public function __construct(string $name = null, HttpClientInterface $client = null)
    {
        parent::__construct($name);
        $this->client = $client;
    }


    protected function configure()
    {
        $this->setDescription("Imports everything from Scryfall (Cards for now)");
        $this->setHelp($this->getDescription());
    }


    protected function execute(InputInterface $input, OutputInterface $output)
    {
//        $response = $this->client->request("GET", "https://api.scryfall.com/bulk-data/e2ef41e3-5778-4bc2-af3f-78eca4dd9c23");
//        $statusCode = $response->getStatusCode();
//        dump($statusCode);
//        $contentType = $response->getHeaders()['content-type'][0];
//        dump($contentType);
//        $content = $response->getContent();
//        dump($content);
//        $content = $response->toArray();
//        dump($content);

//        $cards =

        // rebuild database
        $rebuildCommand = $this->getApplication()->find("app:rebuild-database");
        $rebuildCommand->run($input, $output);

        // import colors
        $importColors = $this->getApplication()->find("app:import-colors");
        $importColors->run($input, $output);

        // import cards
        $importCardsCommand = $this->getApplication()->find("app:import-cards");
        $importCardsCommand->run($input, $output);

        return Command::SUCCESS;
    }

}