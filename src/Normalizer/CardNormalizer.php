<?php


namespace App\Normalizer;


use App\Converter\ScryfallFieldConverter;
use App\Entity\Card;
use App\Entity\Color;
use Symfony\Component\PropertyAccess\PropertyAccessorInterface;
use Symfony\Component\PropertyInfo\Extractor\ReflectionExtractor;
use Symfony\Component\PropertyInfo\PropertyTypeExtractorInterface;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;
use Symfony\Component\Serializer\Mapping\ClassDiscriminatorResolverInterface;
use Symfony\Component\Serializer\Mapping\Factory\ClassMetadataFactoryInterface;
use Symfony\Component\Serializer\NameConverter\NameConverterInterface;
use Symfony\Component\Serializer\Normalizer\ArrayDenormalizer;
use Symfony\Component\Serializer\Normalizer\ContextAwareNormalizerInterface;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use function gettype;
use function is_array;
use function is_null;
use function key_exists;

class CardNormalizer extends ObjectNormalizer
{

    private $colorNormalizer;

    public function __construct(ClassMetadataFactoryInterface $classMetadataFactory = null, NameConverterInterface $nameConverter = null, PropertyAccessorInterface $propertyAccessor = null, PropertyTypeExtractorInterface $propertyTypeExtractor = null, ClassDiscriminatorResolverInterface $classDiscriminatorResolver = null, callable $objectClassResolver = null, array $defaultContext = [])
    {
        parent::__construct($classMetadataFactory, $nameConverter, $propertyAccessor, $propertyTypeExtractor, $classDiscriminatorResolver, $objectClassResolver, $defaultContext);
        $this->colorNormalizer = new ColorNormalizer();
    }

    public function normalize($card, string $format = null, array $context = [])
    {
        $data = parent::normalize($card, $format, $context);

        return $data;
    }

    public function denormalize($data, string $type, string $format = null, array $context = [])
    {
        $this->colorNormalizer->setSerializer($this->serializer);
        if (is_array($data)) {
            if (key_exists('cmc', $data))
                $data['cmc'] = (int)$data['cmc'];
            if(key_exists('loyalty',$data))
                $data['loyalty'] = (int)$data['cmc'];
        }
        if (key_exists('color_identity', $data)) {
            $colors = [];
//            $colors = $this->arrayDenormalizer->denormalize($data['color_identity'],"App\Entity\Color[]");
//            dump($colors);
//            $data['color_identity'] = null;
            foreach ($data['color_identity'] as $c) {
                $colors[] = [
                    "id" => -1,
                    "abbr" => $c,
                    "name" => Color::NAMES[$c]
                ];
            }
            $data['color_identity'] = $colors;
        }


        $card = parent::denormalize($data, $type, $format, $context);
//        dump($card);
        return $card;
    }


    public function supportsNormalization($data, string $format = null, array $context = [])
    {
        return $data instanceof Card;
    }
}
