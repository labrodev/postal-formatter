<?php

namespace Labrodev\PostalFormatter\Enums;

/**
 * Enum CountryCode
 *
 * Represents ISO 3166-1 alpha-2 codes for European countries supported by the postal formatter.
 * Each country defines its own formatting rule for postal codes, which is applied through
 * the `formatPostalCode()` method.
 *
 * This enum is used by the PostalFormatter utility to ensure consistent and country-aware
 * formatting of raw postal code input across Europe.
 *
 * Example usage:
 * $formatted = CountryCode::PL->formatPostalCode('12345'); // "12-345"
 *
 * @package Labrodev\PostalFormatter\Enums
 */
enum CountryCode: string
{
    case AD = 'AD'; // Andorra (AD###)
    case AL = 'AL'; // Albania (####)
    case AT = 'AT'; // Austria (####)
    case BA = 'BA'; // Bosnia & Herzegovina (#####)
    case BE = 'BE'; // Belgium (####)
    case BG = 'BG'; // Bulgaria (####)
    case CH = 'CH'; // Switzerland (####)
    case CZ = 'CZ'; // Czech Republic (123 45)
    case DE = 'DE'; // Germany (#####)
    case DK = 'DK'; // Denmark (####)
    case EE = 'EE'; // Estonia (####)
    case ES = 'ES'; // Spain (#####)
    case FI = 'FI'; // Finland (#####)
    case FR = 'FR'; // France (#####)
    case GB = 'GB'; // United Kingdom (SW1A 1AA)
    case GR = 'GR'; // Greece (#####)
    case HR = 'HR'; // Croatia (#####)
    case HU = 'HU'; // Hungary (####)
    case IE = 'IE'; // Ireland (A65 F4E2)
    case IS = 'IS'; // Iceland (###)
    case IT = 'IT'; // Italy (#####)
    case LI = 'LI'; // Liechtenstein (####)
    case LT = 'LT'; // Lithuania (#####)
    case LU = 'LU'; // Luxembourg (####)
    case LV = 'LV'; // Latvia (LV-####)
    case MC = 'MC'; // Monaco (MC#####)
    case MD = 'MD'; // Moldova (MD-####)
    case ME = 'ME'; // Montenegro (#####)
    case MK = 'MK'; // North Macedonia (####)
    case MT = 'MT'; // Malta (AAA NNNN)
    case NL = 'NL'; // Netherlands (1234 AB)
    case NO = 'NO'; // Norway (####)
    case PL = 'PL'; // Poland (12-345)
    case PT = 'PT'; // Portugal (1234-567)
    case RO = 'RO'; // Romania (######)
    case RS = 'RS'; // Serbia (#####)
    case SE = 'SE'; // Sweden (123 45)
    case SI = 'SI'; // Slovenia (####)
    case SK = 'SK'; // Slovakia (123 45)
    case SM = 'SM'; // San Marino (4789#)
    case TR = 'TR'; // Turkey (#####)
    case UA = 'UA'; // Ukraine (#####)
    case VA = 'VA'; // Vatican City (00120)

    /**
     * Format the given postal code according to the country's postal system rules.
     * Returns the normalized and formatted version of the code (e.g., "123 45", "12-345", etc.).
     *
     * @param string $raw The raw postal code (cleaned to alphanumeric before calling)
     * @return string The formatted postal code, or the cleaned input if no formatting rule applies
     */
    public function formatPostalCode(string $raw): string
    {
        $rawDigitsInString = preg_replace('/[^A-Z0-9]/', '', $raw);
        $code = strtoupper(is_string($rawDigitsInString) ? $rawDigitsInString : '');

        return match ($this) {
            // Alphanumeric with country prefix
            self::AD => preg_match('/^AD\d{3}$/', $code) ? $code : '',

            // Portugal: 1234-567
            self::PT => strlen($code) === 7
                ? substr($code, 0, 4) . '-' . substr($code, 4)
                : $code,

            // Format with space: 123 45
            self::CZ, self::SK, self::SE => strlen($code) === 5
                ? substr($code, 0, 3) . ' ' . substr($code, 3)
                : $code,

            // Poland: 12-345
            self::PL => strlen($code) === 5
                ? substr($code, 0, 2) . '-' . substr($code, 2)
                : $code,

            // Netherlands: 1234 AB
            self::NL => preg_match('/^(\d{4})([A-Z]{2})$/', $code, $m)
                ? $m[1] . ' ' . $m[2]
                : $code,

            // UK: SW1A 1AA
            self::GB => preg_match('/^([A-Z]{1,2}\d[A-Z\d]?)(\d[A-Z]{2})$/', $code, $m)
                ? $m[1] . ' ' . $m[2]
                : $code,

            // Ireland: A65 F4E2
            self::IE => strlen($code) === 7
                ? substr($code, 0, 3) . ' ' . substr($code, 3)
                : $code,

            // Malta: AAA 1234
            self::MT => preg_match('/^([A-Z]{3})(\d{4})$/', $code, $m)
                ? $m[1] . ' ' . $m[2]
                : $code,

            // Latvia: always return LV-1234
            self::LV => preg_match('/^(\d{4})$/', $code, $m)
                ? 'LV-' . $m[1]
                : $code,

            // Moldova: always return MD-1234
            self::MD => preg_match('/^(\d{4})$/', $code, $m)
                ? 'MD-' . $m[1]
                : $code,

            default => $code,
        };
    }
}