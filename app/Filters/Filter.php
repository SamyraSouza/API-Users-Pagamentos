<?php

namespace App\Filters;

use DeepCopy\Exception\PropertyException;
use Exception;
use Illuminate\Support\Str;
use Illuminate\Http\Request;

abstract class Filter
{
    protected array $allowedOperatorsField = [];

    protected array $translateOperatorsFields = [
        'gt' => '>',
        'gte' => '>=',
        'lt' => '<',
        'lte' => '<=',
        'eq' => '=',
        'ne' => '!=',
        'in' => 'in'
    ];

    public function filter(Request $request){
        $where = [];
        $whereIn = [];

        if(empty($this->allowedOperatorsField)){
            throw new PropertyException("Property allowedOperatorsfields is empty");
        }
        
        foreach ($this->allowedOperatorsField as $param => $operators) {
            
            $queryOperator = $request->query($param);

            if($queryOperator){
                foreach ($queryOperator as $operator => $value) {

                    if(!in_array($operator, $operators)){
                        throw new Exception("{$param} does have {$operator} operator");
                    }

                    if(str_contains($value, '[')){
                        $whereIn[] = [
                            $param,
                            explode(',', Str::replace(['[',']'], ['', ''], $value)),
                            $value
                        ];
                    }else{
                        $where[] = [
                            $param,
                            $this->translateOperatorsFields[$operator],
                            $value
                        ];
                    }
                }                
            }
        }

        if(empty($where) && empty($whereIn)){
            return [];
        }
        
        return [
            'where' => $where,
            'whereIn' => $whereIn
        ];
    }
}
