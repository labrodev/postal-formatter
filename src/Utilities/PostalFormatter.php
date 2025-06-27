<?php

declare(strict_types=1);

namespace Labrodev\PostalFormatter\Utilities;

use Labrodev\PostalFormatter\Enums\CountryCode;
use Labrodev\PostalFormatter\Exceptions\InvalidCountryCode;

/**
 * Class PostalFormatter
 *
 * Provides a unified way to clean and format postal codes based on country-specific rules.
 *
 * This utility:
 * - Removes all non-alphanumeric characters from the input
 * - Converts the string to uppercase
 * - Applies formatting rules defined in the CountryCode enum, if a valid country code is provided
 * - Falls back to a cleaned version if the country is not recognized or null
 *
 * Example:
 * PostalFormatter::format('12345', 'CZ'); // returns '123 45'
 * PostalFormatter::format('sw1a1aa', 'GB'); // returns 'SW1A 1AA'
 *
 * @package Labrodev\PostalFormatter
 */
class PostalFormatter
{
    /**
     * Formats a raw postal code using the formatting logic associated with a given country code.
     *
     * @param string $postalCode The unformatted, user-supplied postal code
     * @param string|null $countryCode ISO 3166-1 alpha-2 country code (e.g., 'CZ', 'PL', 'GB'); optional
     * @return string Formatted postal code, or cleaned raw version if no match
     * @throws InvalidCountryCode If the provided country code is not recognized
     */
    public static function format(string $postalCode, ?string $countryCode = null): string
    {
        $cleaned = strtoupper(trim($postalCode));
        $cleaned = preg_replace('/[^A-Z0-9]/', '', $cleaned);
        $cleaned = is_string($cleaned) ? $cleaned : '';

        if ($countryCode === null) {
            return $cleaned;
        }

        $country = CountryCode::tryFrom($countryCode)
            ?? throw InvalidCountryCode::make($countryCode);

        return $country->formatPostalCode($cleaned);
    }
}