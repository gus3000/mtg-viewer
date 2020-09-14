<?php


namespace App\Converter;


use Symfony\Component\Serializer\NameConverter\CamelCaseToSnakeCaseNameConverter;
use function substr;

class ScryfallFieldConverter extends CamelCaseToSnakeCaseNameConverter
{
//
//    public function normalize(string $propertyName)
//    {
////        if($propertyName === "id")
////            return "scryfallId";
//        return $propertyName;
//    }

    public function denormalize(string $propertyName)
    {
//        dump("$propertyName => " . parent::denormalize($propertyName));
        $propertyName = parent::denormalize($propertyName);
        if ($propertyName === "id")
            return "scryfallId";
        if(substr($propertyName,0,3) === "set")
            $propertyName  = "scryfallSet" . substr($propertyName,3);

        return $propertyName;
    }
}