<?php

namespace App\Command;


use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\ArrayInput;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class RebuildDatabase extends Command
{
    protected static $defaultName = "app:rebuild-database";
    /**
     * @var EntityManagerInterface|null
     */
    protected $entityManager;

    public function __construct(string $name = null, EntityManagerInterface $em = null)
    {
        parent::__construct($name);
        $this->entityManager = $em;
    }


    protected function configure()
    {
        $this->setDescription("TODO");
        $this->setHelp("TODO");
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        /*
            doctrine:database:drop --force
            doctrine:database:create
            doctrine:schema:update
         */
        $dropCommand = $this->getApplication()->find("doctrine:database:drop");
        $dropCommand->run(new ArrayInput([
            '--force' => true
        ]), $output);

        $createCommand = $this->getApplication()->find("doctrine:database:create");
        $createCommand->run($input,$output);

        $updateCommand = $this->getApplication()->find("doctrine:schema:update");
        $updateCommand->run(new ArrayInput([
            '--force' => true
        ]),$output);


//        $this->entityManager->
        return Command::SUCCESS;
    }
}