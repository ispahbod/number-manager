<?php

namespace Ispahbod\NumberManager;

class NumberManager
{
    public static function convertToEnglishNumerals(string $input): string
    {
        return strtr($input, ['۰' => '0', '۱' => '1', '۲' => '2', '۳' => '3', '۴' => '4', '۵' => '5', '۶' => '6', '۷' => '7', '۸' => '8', '۹' => '9']);
    }

    public static function convertToPersianNumerals(string $input): string
    {
        return strtr($input, ['0' => '۰', '1' => '۱', '2' => '۲', '3' => '۳', '4' => '۴', '5' => '۵', '6' => '۶', '7' => '۷', '8' => '۸', '9' => '۹']);
    }

    public static function isEven(int $input): bool
    {
        return ($input & 1) === 0;
    }

    public static function isNotEven(int $input): bool
    {
        return !self::isEven($input);
    }

    public static function isOdd(int $input): bool
    {
        return ($input & 1) === 1;
    }

    public static function isNotOdd(int $input): bool
    {
        return !self::isOdd($input);
    }

    public static function generateRandomInteger(int $numberOfDigits): int
    {
        if ($numberOfDigits <= 0) {
            return 0;
        }
        $min = pow(10, $numberOfDigits - 1);
        $max = pow(10, $numberOfDigits) - 1;
        return mt_rand($min, $max);
    }

    public static function isGreaterThan(int $input, int $number): bool
    {
        return $input > $number;
    }

    public static function isLessThan(int $input, int $number): bool
    {
        return $input < $number;
    }

    public static function isBetween(int $input, int $min, int $max): bool
    {
        return $input >= $min && $input <= $max;
    }

    public static function add(int $input, int $amount): int
    {
        return $input + $amount;
    }

    public static function subtract(int $input, int $amount): int
    {
        return $input - $amount;
    }

    public static function increment(int &$input): void
    {
        $input++;
    }

    public static function decrement(int &$input): void
    {
        $input--;
    }

    public static function sumOfDigits(int $input): int
    {
        return array_sum(str_split($input));
    }

    public static function multiply(int $input, int $multiplier): int
    {
        return $input * $multiplier;
    }

    public static function divide(int $input, int $divisor): float
    {
        if ($divisor === 0) {
            throw new \InvalidArgumentException("Divisor cannot be zero.");
        }
        return $input / $divisor;
    }

    public static function raiseToPower(int $input, int $exponent): int
    {
        return pow($input, $exponent);
    }

    public static function modulo(int $input, int $modulus): int
    {
        return $input % $modulus;
    }

    public static function absoluteValue(int $input): int
    {
        return abs($input);
    }

    public static function factorial(int $input): int
    {
        if ($input < 0) {
            throw new \InvalidArgumentException("Input must be a non-negative integer.");
        }
        $factorial = 1;
        for ($i = 2; $i <= $input; $i++) {
            $factorial *= $i;
        }
        return $factorial;
    }

    public static function abbreviate(int $number, int $precision = 1): string
    {
        if ($number >= 1000 && $number < 1000000) {
            return round($number / 1000, $precision) . 'K';
        } elseif ($number >= 1000000) {
            return round($number / 1000000, $precision) . 'M';
        }
        return (string)$number;
    }

    public static function clamp(int $number, int $min, int $max): int
    {
        return max($min, min($number, $max));
    }

    public static function currency(int $amount, string $currency = 'USD', string $locale = 'en'): string
    {
        $fmt = new \NumberFormatter($locale, \NumberFormatter::CURRENCY);
        return $fmt->formatCurrency($amount, $currency);
    }

    public static function fileSize(int $size, int $precision = 1): string
    {
        if ($size < 1024) {
            return $size . ' B';
        } elseif ($size < 1048576) {
            return round($size / 1024, $precision) . ' KB';
        } elseif ($size < 1073741824) {
            return round($size / 1048576, $precision) . ' MB';
        }
        return round($size / 1073741824, $precision) . ' GB';
    }

    public static function forHumans(int $number, int $precision = 1, string $locale = 'en'): string
    {
        // Implementation for English
        if ($locale === 'en') {
            if ($number >= 1000 && $number < 1000000) {
                return round($number / 1000, $precision) . ' thousand';
            } elseif ($number >= 1000000) {
                return round($number / 1000000, $precision) . ' million';
            }
        }
        // Add implementation for Persian or other locales as needed
        return (string)$number;
    }

    public static function format(int $number, int $precision = 0, string $locale = 'en'): string
    {
        $fmt = new \NumberFormatter($locale, \NumberFormatter::DECIMAL);
        $fmt->setAttribute(\NumberFormatter::MIN_FRACTION_DIGITS, $precision);
        return $fmt->format($number);
    }

    public static function ordinal(int $number): string
    {
        $formatter = new \NumberFormatter('en', \NumberFormatter::ORDINAL);
        return $formatter->format($number);
    }

    public static function percentage(float $number, int $precision = 0, string $locale = 'en'): string
    {
        $fmt = new \NumberFormatter($locale, \NumberFormatter::PERCENT);
        $fmt->setAttribute(\NumberFormatter::MIN_FRACTION_DIGITS, $precision);
        return $fmt->format($number / 100);
    }

    public static function spell(int $number, string $locale = 'en'): string
    {
        $fmt = new \NumberFormatter($locale, \NumberFormatter::SPELLOUT);
        return $fmt->format($number);
    }
}