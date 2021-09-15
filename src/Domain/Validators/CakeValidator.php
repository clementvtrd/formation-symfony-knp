<?php

namespace App\Domain\Validators;

class CakeValidator {
    /**
     * Au moins 6 caractères
     * Pas de caractères spéciaux && Pas de chiffre
     * 20 caractères max
     */
    public function checkName(string $name): bool
    {
        return $this->maxLen($name, 20) && $this->minLen($name, 6) && $this->noSpecialChar($name);
    }

    public function maxLen(string $string, int $maxLen): bool
    {
        return strLen($string) <= $maxLen;
    }

    public function minLen(string $string, int $minLen): bool
    {
        return strLen($string) >= $minLen;
    }

    public function noSpecialChar(string $string): bool
    {
        $exp = "/^[\w ]+$/";
        return preg_match($exp, $string) === 1;
    }

    /**
     * max 100€
     */
    public function checkPrice(int $price): bool
    {
        return $price <= 100;
    }
}