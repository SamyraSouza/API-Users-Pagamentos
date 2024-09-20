<?php

namespace App\Filters;

use DeepCopy\Exception\PropertyException;
use GuzzleHttp\Psr7\Request;
use PhpParser\Builder\Property;

class InvoiceFilter extends Filter
{
    protected array $allowedOperatorsField = [
        'value' => ['gt', 'eq', 'lt', 'gte', 'lte', 'ne'],
        'type' => ['eq', 'ne', 'in'],
        'paid' => ['eq', 'ne'],
        'payment_date' => ['gt', 'eq', 'lt', 'gte', 'lte', 'ne']
    ];

}
