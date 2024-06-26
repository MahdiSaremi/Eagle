<?php

namespace Rapid\Eagle;

use Illuminate\Contracts\Support\Htmlable;
use Illuminate\Support\Js;
use Illuminate\Support\Str;
use Rapid\Eagle\Type\ETBindAttr;
use Rapid\Eagle\Type\EagleJsHtmlable;

class EagleConverter
{

    public static function anyToHtml($value)
    {
        if ($value instanceof Htmlable)
        {
            return $value->toHtml();
        }

        return $value;
    }

    public static function viewToHtml($view)
    {
        if (is_string($view))
        {
            return e($view);
        }
        elseif (is_array($view))
        {
            return implode('', array_map(static::viewToHtml(...), $view));
        }
        elseif ($view === null)
        {
            return '';
        }
        elseif ($view instanceof Htmlable)
        {
            return $view->toHtml();
        }
        else
        {
            throw new \TypeError("View should be [".Htmlable::class."]");
        }
    }

    public static function attributesToHtml(array $attributes)
    {
        $result = '';
        foreach ($attributes as $key => $value)
        {
            $key = Str::kebab(str_replace('_', ':', $key));

            $value = value($value);

            if ($value instanceof ETBindAttr)
            {
                if ($value->hasDefault())
                {
                    $result .= " $key=\"" . e(static::anyToHtml($value->getDefault())) . "\"";
                }

                $result .= " :$key=\"" . e($value->toJsHtml()) . "\"";
                continue;
            }

            switch ($key)
            {
                case 'checked':
                case 'required':
                    if ($value)
                        $result .= " $key";
                    break;

                case 'class':
                    if (is_array($value))
                    {
                        $classes = [];
                        $bindClass = '';
                        foreach ($value as $key => $val)
                        {
                            if (is_int($key))
                            {
                                $classes[] = $val;
                            }
                            elseif ($val instanceof ETBindAttr)
                            {
                                $bindClass .= EagleConverter::valueToJsValue($key) . ": {$val->toJsHtml()}, ";
                            }
                            elseif (value($val))
                            {
                                $classes[] = $key;
                            }
                        }

                        if ($classes)
                            $result .= " class=\"" . e(implode(' ', $classes)) . "\"";

                        if ($bindClass)
                            $result .= " :class=\"{" . e(EagleConverter::valueToJsValue($bindClass)) . "}\"";
                    }
                    else
                    {
                        $result .= " class=\"" . e(EagleConverter::anyToHtml($value)) . "\"";
                    }
                    break;

                default:
                    $result .= " $key=\"" . e(EagleConverter::anyToHtml($value)) . "\"";
            }
        }

        return $result;
    }

    public static function valueToJsHtml($value)
    {
        if ($value instanceof EagleJsHtmlable)
        {
            return $value->toJsHtml();
        }
        elseif (is_string($value))
        {
            return $value;
        }
        elseif (is_numeric($value))
        {
            return '';
        }
        else
        {
            throw new \TypeError("Value should be [" . EagleJsHtmlable::class . "]");
        }
    }

    public static function valueToJsValue($value, bool $assoc = true)
    {
        if (!$assoc && is_array($value) && !$value)
        {
            return '[]';
        }

        return Js::encode($value);
    }

}