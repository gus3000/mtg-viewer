<?php


namespace App\Normalizer;


use App\Entity\Color;
use Symfony\Component\PropertyAccess\PropertyAccessorInterface;
use Symfony\Component\PropertyInfo\PropertyTypeExtractorInterface;
use Symfony\Component\Serializer\Mapping\ClassDiscriminatorResolverInterface;
use Symfony\Component\Serializer\Mapping\Factory\ClassMetadataFactoryInterface;
use Symfony\Component\Serializer\NameConverter\NameConverterInterface;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;

class ColorNormalizer extends ObjectNormalizer
{
    const names = [
        "W" => "White",
        "U" => "Blue",
        "B" => "Black",
        "G" => "Green",
        "R" => "Red"
    ];

    public function __construct(ClassMetadataFactoryInterface $classMetadataFactory = null, NameConverterInterface $nameConverter = null, PropertyAccessorInterface $propertyAccessor = null, PropertyTypeExtractorInterface $propertyTypeExtractor = null, ClassDiscriminatorResolverInterface $classDiscriminatorResolver = null, callable $objectClassResolver = null, array $defaultContext = [])
    {
        parent::__construct($classMetadataFactory, $nameConverter, $propertyAccessor, $propertyTypeExtractor, $classDiscriminatorResolver, $objectClassResolver, $defaultContext);
    }

    public function normalize($card, string $format = null, array $context = [])
    {
        $data = parent::normalize($card, $format, $context);

        return $data;
    }

    public function denormalize($data, string $type, string $format = null, array $context = [])
    {
        $color = parent::denormalize($data, $type, $format, $context);
        dump($color);
        return $color;
    }

    public function supportsNormalization($data, string $format = null, array $context = [])
    {
        return $data instanceof Color;
    }
}