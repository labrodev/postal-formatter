# PHP Postal Formatter

**Labrodev\PostalFormatter** is a strict PHP 8.1+ utility library that provides robust formatting for European postal codes, following official formatting standards country-by-country.


## Features

- Cleans and standardizes postal codes (removes spaces, symbols, lowercases)
- Supports most of the **European countries** (45+ ISO 3166-1 alpha-2 codes)
- Automatically formats codes to the standard of each country (e.g. `12345` → `123 45` for CZ, `sw1a1aa` → `SW1A 1AA` for GB)
- Ready-to-go static formatter
- Fully typed with strict mode (`declare(strict_types=1)`)
- Includes PHPUnit and PHPStan support for testing and analysis


## Installation

```
composer require labrodev/postal-formatter
```

## Usage

```php
use Labrodev\PostalFormatter\Utilities\PostalFormatter;

// Default usage: just clean and normalize
echo PostalFormatter::format(' 12345 '); // "12345"

// With country-specific formatting:
echo PostalFormatter::format('12345', 'CZ'); // "123 45"
echo PostalFormatter::format('sw1a1aa', 'GB'); // "SW1A 1AA"
echo PostalFormatter::format('1050', 'LV'); // "LV-1050"
```

List of available country codes you may find in CountryCode Enum (Labrodev/PostalFormatter/Enums/CountryCode).

## Testing

To run tests:

```
composer install
composer test
```


## Static Analysis

To run static analysis using PHPStan:

```
composer install
composer analyse
```

> Configuration is located in `phpstan.neon.dist`

## Security

If you discover a security vulnerability within this package, **please contact us immediately at [contact@labrodev.com](mailto:contact@labrodev.com)**. All security-related issues will be handled privately and promptly.

## Credits

This package is maintained by **Labrodev** — Laravel & PHP development studio.  
[https://github.com/labrodev](https://github.com/labrodev)

## Feedback

If you have any questions, suggestions, or have found an error — feel free to open an issue or contact us:  
📬 **contact@labrodev.com**

**License:** MIT