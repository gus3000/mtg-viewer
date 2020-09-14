<?php

namespace Acme {
    class ObjectOuter
    {
        private $inner;
        private $releasedAt;

        public function getInner()
        {
            return $this->inner;
        }

        public function setInner(ObjectInner $inner)
        {
            $this->inner = $inner;
        }

        public function setReleasedAt(\DateTimeInterface $releasedAt): self
        {
            $this->releasedAt = $releasedAt;
            return $this;
        }

        public function getReleasedAt(): ?\DateTimeInterface
        {
            return $this->releasedAt;
        }
    }


    class ObjectInner
    {
        public $foo;
        public $bar;
    }
}

namespace App\Command {

    use App\Entity\Card;
    use App\Normalizer\CardNormalizer;
    use Symfony\Component\Console\Command\Command;
    use Symfony\Component\Console\Input\InputInterface;
    use Symfony\Component\Console\Output\OutputInterface;
    use Symfony\Component\PropertyInfo\Extractor\ReflectionExtractor;
    use Symfony\Component\Serializer\Normalizer\DateTimeNormalizer;
    use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
    use Symfony\Component\Serializer\Serializer;

    class DeserializationTest extends Command
    {
        protected static $defaultName = "app:testDes";

        protected function configure()
        {
            $this
                // the short description shown while running "php bin/console list"
                ->setDescription('Test Deserialization')

                // the full command description shown when running the command with
                // the "--help" option
                ->setHelp('Test command');
        }

        protected function execute(InputInterface $input, OutputInterface $output)
        {
            $normalizer = new CardNormalizer(new ObjectNormalizer(null, null, null, new ReflectionExtractor()));

            $serializer = new Serializer([new DateTimeNormalizer(), $normalizer]);

            $obj = $serializer->denormalize(
                ['inner' => ['foo' => 'foo', 'bar' => 'bar'], 'released_at' => '1988/01/21'],
                "Acme\ObjectOuter"
            );

            dump($obj->getInner()->foo); // 'foo'
            dump($obj->getInner()->bar); // 'bar'
            dump($obj->getReleasedAt()->format('Y-m-d')); // '1988-01-21'

            return Command::SUCCESS;
        }


    }
}