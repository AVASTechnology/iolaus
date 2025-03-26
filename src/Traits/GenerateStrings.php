<?php

namespace Avastechnology\Iolaus\Traits;

use Random\RandomException;

/**
 * Trait GenerateStrings
 *
 * @package Avastechnology\Iolaus\Traits
 */
trait GenerateStrings
{
    /**
     * @todo Include multibyte strings
     * @param int $maxLength Max string length to use, larger values will generate excessively larger strings
     * @return \Generator
     * @throws RandomException
     */
    public function generateStrings(int $maxLength = 65_536): \Generator
    {
        // empty strings
        yield '' => 'Empty string with no content';
        yield '0' => 'Empty string with content of "0"';
        yield '1' => 'Non-empty string with content of "1"';
        yield '-1' => 'Non-empty string with content of "-1"';

        $basicStrings = [
            // booleans as strings
            'Boolean word "%s"' => [
                'true',
                'false',
            ],
            // Key sensitive strings
            'Sensitive string "%s"' => [
                '<?php',
                '?>',
                '\'',
                '"',
                '\\',
                '//',
                '#',
                '/* */',
                '`ls -al`',
            ],
            // Special Ascii Characters
            'Special Ascii character "%s"' => array_map(fn($code) => chr($code), range(0, 31)),
            'Special purpose strings' => [
                'http://example.com',
                'https://example.com',
                'me@example.com',
                '<div>HTML</div>',
                json_encode(['a' => 'json object', 'b' => null]),
                serialize(['a' => 'serialized array', 'b' => null]),
                serialize(new class {public $a = 'A'; protected $b = 'B'; private $c = 'C';}),
            ]
        ];

        foreach ($basicStrings as $formatedText => $stringGroup) {
            foreach ($stringGroup as $string) {
                yield $string => sprintf(
                    $formatedText,
                    $string
                );
            }
        }

        $randomString = base64_encode(random_bytes($maxLength));

        // strings of key lengths
        $lengths = [
            64            => 'DB name limit',
            128           => 'AES-128 Key',
            255           => 'DB Char/Varchar/binary practical limit',
            256           => 'AES-256 Key',
            65_536        => 'DB 2-byte text limit (blob/text)',
            16_777_216    => 'DB 3-byte text limit (mediumblob/mediumtext)',
            4_294_967_296 => 'DB 4-byte text limit (longblob/longtext)',
        ];

        foreach ($lengths as $length => $label) {
            if ($length >= $maxLength) {
                break;
            }

            yield substr($randomString, 0, $length) => sprintf(
                '%d characters - %s',
                $length,
                $label
            );
        }
    }
}
