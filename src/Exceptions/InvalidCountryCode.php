<?php

declare(strict_types=1);

namespace Labrodev\PostalFormatter\Exceptions;

use Exception;

/**
 * Class InvalidCountryCode
 *
 * Exception thrown when an unrecognized or unsupported country code is provided
 * to the PostalFormatter. Ensures that only valid ISO 3166-1 alpha-2 country codes
 * are processed.
 *
 * Example:
 * throw InvalidCountryCode::make('ZZ'); // "Invalid country code: ZZ"
 *
 * @package LabroDev\PostalFormatter\Exceptions
 */
class InvalidCountryCode extends Exception
{
    /**
     * Create a new exception instance with a descriptive error message.
     *
     * @param string $code The unrecognized country code
     * @return self
     */
    public static function make(string $code): self
    {
        return new self("Invalid country code: $code");
    }
}