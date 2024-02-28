<?php
declare(strict_types=1);

namespace Yarco\FastGster;

use Symfony\Component\ExpressionLanguage\ExpressionLanguage;

#[\Attribute(\Attribute::TARGET_PROPERTY)]
final class Set implements IGuard
{
    private ?string $_guard;

    public function __construct(?string $guard = null)
    {
        $this->_guard = $guard;
    }

    public function validate($key, $value): void
    {
        if (!$this->_guard) return;

        if (is_string($this->_guard)) { // expr
            $this->validateAsExpr($key, $value);
        }
    }

    private function validateAsExpr($key, $value)
    {
        $expr = new ExpressionLanguage();
        if (!$expr->evaluate($this->_guard, [$key => $value])) { // false
            throw new ValidationFailedException("Guard validation failed, expect {$this->_guard}");
        }
    }
}