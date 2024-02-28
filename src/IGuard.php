<?php
declare(strict_types=1);

namespace Yarco\FastGster;

interface IGuard
{
    public function validate(string $key, mixed $value): void;
}