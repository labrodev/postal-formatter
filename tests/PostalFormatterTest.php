<?php

use PHPUnit\Framework\TestCase;
use Labrodev\PostalFormatter\Utilities\PostalFormatter;
use Labrodev\PostalFormatter\Exceptions\InvalidCountryCode;

class PostalFormatterTest extends TestCase
{
    /**
     * @dataProvider provideFormattedPostalCodes
     * @throws InvalidCountryCode
     */
    public function test_format_postal_code(string $input, ?string $countryCode, string $expected): void
    {
        $this->assertSame($expected, PostalFormatter::format($input, $countryCode));
    }

    /**
     * @return array<int,array<int,string|null>>
     */
    public static function provideFormattedPostalCodes(): array
    {
        return [
            ['AD500', 'AD', 'AD500'],
            ['1000', 'AL', '1000'],
            ['1010', 'AT', '1010'],
            ['71000', 'BA', '71000'],
            ['1000', 'BE', '1000'],
            ['9000', 'BG', '9000'],
            ['8000', 'CH', '8000'],
            ['12345', 'CZ', '123 45'],
            ['10115', 'DE', '10115'],
            ['2100', 'DK', '2100'],
            ['10123', 'EE', '10123'],
            ['28013', 'ES', '28013'],
            ['00100', 'FI', '00100'],
            ['75008', 'FR', '75008'],
            ['sw1a1aa', 'GB', 'SW1A 1AA'],
            ['10558', 'GR', '10558'],
            ['10000', 'HR', '10000'],
            ['1051', 'HU', '1051'],
            ['a65f4e2', 'IE', 'A65 F4E2'],
            ['101', 'IS', '101'],
            ['00100', 'IT', '00100'],
            ['9490', 'LI', '9490'],
            ['01100', 'LT', '01100'],
            ['1331', 'LU', '1331'],
            ['1050', 'LV', 'LV-1050'],
            ['MC98000', 'MC', 'MC98000'],
            ['2045', 'MD', 'MD-2045'],
            ['81000', 'ME', '81000'],
            ['1000', 'MK', '1000'],
            ['mla1234', 'MT', 'MLA 1234'],
            ['1234AB', 'NL', '1234 AB'],
            ['0150', 'NO', '0150'],
            ['12345', 'PL', '12-345'],
            ['1234567', 'PT', '1234-567'],
            ['010011', 'RO', '010011'],
            ['11000', 'RS', '11000'],
            ['11455', 'SE', '114 55'],
            ['1000', 'SI', '1000'],
            ['98765', 'SK', '987 65'],
            ['47890', 'SM', '47890'],
            ['34000', 'TR', '34000'],
            ['65000', 'UA', '65000'],
            ['00120', 'VA', '00120'],
            ['12345', null, '12345'], // fallback to cleaned raw
        ];
    }

    /**
     * @return void
     * @throws InvalidCountryCode
     */
    public function test_invalid_country_code_throws_exception(): void
    {
        $this->expectException(InvalidCountryCode::class);
        PostalFormatter::format('12345', 'XX');
    }
}