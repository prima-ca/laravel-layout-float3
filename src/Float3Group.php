<?php

namespace Cyrus\Nova\Layout;

use Illuminate\Http\Resources\MergeValue;
use _;

class Float3Group extends MergeValue
{
    # use Macroable, Metable, Makeable, HasHelpText;

    public function floatFieldLabelClasses($field)
    {
        return $field
            ->fieldClasses('sf-float-3 w-full py-4')
            ->labelClasses('sf-float-3 w-full pt-4');
    }

    // used when there is only 1 item
    public function float0($field)
    {
        return $this->floatFieldLabelClasses($field)->wrapperClasses('sf-float-0/3 flex flex-col w-1/3 flex-1 px-4 pl-8');
    }

    // first floating item
    public function float1($field)
    {
        return $this->floatFieldLabelClasses($field)->wrapperClasses('sf-float-1/3 flex flex-col w-1/3 float-left flex-1 px-4 pl-8');
    }

    // second floating item
    public function float2($field)
    {
        return $this->floatFieldLabelClasses($field)->wrapperClasses('sf-float-2/3 flex flex-col w-1/3 float-left flex-1 px-4');
    }

    // last floating item
    public function float3($field)
    {
        return $this->floatFieldLabelClasses($field)->wrapperClasses('sf-float-3/3 flex flex-col w-1/3 flex-1 px-4 pr-8');
    }

    public function __construct(...$fields)
    {
        parent::__construct(
            _\map($fields, function ($v, $k, $a) {
                if ((1 + $k) == count($a)) {
                    $k = $k % 3;
                    if ($k == 0) {
                        $k = 0;
                    } else {
                        $k = 3;
                    }
                } else {
                    $k = 1 + ($k % 3);
                }

                if (!method_exists($v, 'indexClasses'))
                    return $v;
                $fn = "float$k";
                return $this->$fn($v);
            })
        // ]
        );
    }
}
