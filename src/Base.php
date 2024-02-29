<?php
declare(strict_types=1);

namespace Yarco\FastGster;

trait Base
{
    static private array $__meta = [];

    public function __call(string $name, array $arguments)
    {
        if (!(str_starts_with($name, 'get') || str_starts_with($name, 'set'))) {
            throw new UndefinedMethodException(sprintf("Call to undefined method %s[%s]", __CLASS__, $name));
        }

        if (!self::$__meta) { // fill meta info
            $reflectClass = new \ReflectionClass(__CLASS__);

            array_map(function($property) {
                if ($property->name === '__meta') return; // internal

                $name = ucfirst($property->name);

                $attributes = $property->getAttributes();
                foreach($attributes as $attribute) {
                    switch ($attribute->getName()) {
                        case Get::class:
                            self::$__meta["get{$name}"] = function ($that) use($property, $attribute) {
                                return $property->getValue($that);
                            };
                            break;
                        case Set::class:
                            self::$__meta["set{$name}"] = function ($that, $value) use($property, $attribute) {
                                $attribute->newInstance()->validate($property->name, $value);
                                $property->setValue($that, $value);
                            };
                            break;
                    }
                }

            }, $reflectClass->getProperties());
        }

        if (!isset(self::$__meta[$name])) {
            throw new UndefinedMethodException(sprintf("Call to undefined method %s[%s]", __CLASS__, $name));
        }

        // call
        return call_user_func_array(self::$__meta[$name], [$this, ...$arguments]);
    }
}