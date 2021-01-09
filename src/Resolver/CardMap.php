<?php


namespace App\Resolver;


use Overblog\GraphQLBundle\Resolver\ResolverMap;
use GraphQL\Error\Error;
use GraphQL\Language\AST\StringValueNode;
use GraphQL\Type\Definition\ResolveInfo;
use Overblog\GraphQLBundle\Definition\ArgumentInterface;

class CardMap extends ResolverMap
{

    protected function map()
    {
        return [
            'Card' => [
                'id' => function ($a) {
                    return 14;
                }
            ]
        ];
    }
}