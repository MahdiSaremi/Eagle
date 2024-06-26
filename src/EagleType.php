<?php

namespace Rapid\Eagle;

use Illuminate\Support\Arr;

class EagleType
{

    public static function is($value, string|array $type)
    {
        if (is_string($type))
        {
            return match ($type)
            {
                'mixed'           => true,
                'string'          => is_string($value),
                'null'            => is_null($value),
                'bool', 'boolean' => is_bool($value),
                'int', 'integer'  => is_int($value),
                'float', 'double' => is_float($value),
                'array'           => is_array($value),
                default           => $value instanceof $type,
            };
        }
        else
        {
            if (count($type) == 0)
            {
                return is_array($value);
            }
            elseif (count($type) == 1)
            {
                if (!is_array($value))
                {
                    return false;
                }

                foreach ($value as $item)
                {
                    if (!static::is($item, $type[0]))
                    {
                        return false;
                    }
                }

                return true;
            }
            else
            {
                foreach ($type as $T)
                {
                    if (static::is($value, $T))
                    {
                        return true;
                    }
                }

                return false;
            }
        }
    }

    public static function getReadableType(string|array $type)
    {
        if (is_string($type))
        {
            return $type;
        }
        elseif (count($type) == 0)
        {
            return 'array';
        }
        elseif (count($type) == 1)
        {
            return 'array<' . $type[0] . '>';
        }
        else
        {
            return implode('|', array_map(static::getReadableType(...), $type));
        }
    }

}