<?php
/**
 * PHPCSExtra, a collection of sniffs and standards for use with PHP_CodeSniffer.
 *
 * @package   PHPCSExtra
 * @copyright 2020 PHPCSExtra Contributors
 * @license   https://opensource.org/licenses/LGPL-3.0 LGPL3
 * @link      https://github.com/PHPCSStandards/PHPCSExtra
 */

namespace PHPCSExtra\Universal\Tests\PHP;

use PHP_CodeSniffer\Tests\Standards\AbstractSniffTestCase;

/**
 * Unit test class for the DisallowNonDecimalIntegersInStrictTypes sniff.
 *
 * @covers PHPCSExtra\Universal\Sniffs\PHP\DisallowNonDecimalIntegersInStrictTypesSniff
 *
 * @since 1.5.0
 */
final class DisallowNonDecimalIntegersInStrictTypesUnitTest extends AbstractSniffTestCase
{

    /**
     * Get a list of all test files to check.
     *
     * These will have the same base as the sniff name but different extensions.
     * We ignore the .php file as it is the test class.
     *
     * @param string $testFileBase The base path that the unit tests files will have.
     *
     * @return string[]
     */
    protected function getTestFiles($testFileBase)
    {
        $testFileBase = __DIR__
            . \DIRECTORY_SEPARATOR
            . 'DisallowNonDecimalIntegersInStrictTypesUnitTest'
            . \DIRECTORY_SEPARATOR
            . basename($testFileBase);

        return parent::getTestFiles($testFileBase);
    }

    /**
     * Returns the lines where errors should occur.
     *
     * @param string $testFile The name of the file being tested.
     *
     * @return array<int, int> Key is the line number, value is the number of expected errors.
     */
    public function getErrorList($testFile = '')
    {
        switch ($testFile) {
            // Multiline with a comment and spaces.
            case 'DisallowNonDecimalIntegersInStrictTypesUnitTest.13.inc':
            case 'DisallowNonDecimalIntegersInStrictTypesUnitTest.28.inc':
            case 'DisallowNonDecimalIntegersInStrictTypesUnitTest.43.inc':
            case 'DisallowNonDecimalIntegersInStrictTypesUnitTest.58.inc':
            case 'DisallowNonDecimalIntegersInStrictTypesUnitTest.73.inc':
            case 'DisallowNonDecimalIntegersInStrictTypesUnitTest.88.inc':
            case 'DisallowNonDecimalIntegersInStrictTypesUnitTest.103.inc':
            case 'DisallowNonDecimalIntegersInStrictTypesUnitTest.118.inc':
            case 'DisallowNonDecimalIntegersInStrictTypesUnitTest.133.inc':
            case 'DisallowNonDecimalIntegersInStrictTypesUnitTest.148.inc':
            case 'DisallowNonDecimalIntegersInStrictTypesUnitTest.163.inc':
            case 'DisallowNonDecimalIntegersInStrictTypesUnitTest.178.inc':
            case 'DisallowNonDecimalIntegersInStrictTypesUnitTest.193.inc':
            case 'DisallowNonDecimalIntegersInStrictTypesUnitTest.208.inc':
            case 'DisallowNonDecimalIntegersInStrictTypesUnitTest.223.inc':
            case 'DisallowNonDecimalIntegersInStrictTypesUnitTest.238.inc':
            case 'DisallowNonDecimalIntegersInStrictTypesUnitTest.253.inc':
            case 'DisallowNonDecimalIntegersInStrictTypesUnitTest.268.inc':
            case 'DisallowNonDecimalIntegersInStrictTypesUnitTest.283.inc':
            case 'DisallowNonDecimalIntegersInStrictTypesUnitTest.298.inc':
            case 'DisallowNonDecimalIntegersInStrictTypesUnitTest.313.inc':
            case 'DisallowNonDecimalIntegersInStrictTypesUnitTest.328.inc':
            case 'DisallowNonDecimalIntegersInStrictTypesUnitTest.343.inc':
            case 'DisallowNonDecimalIntegersInStrictTypesUnitTest.358.inc':
            case 'DisallowNonDecimalIntegersInStrictTypesUnitTest.373.inc':
            case 'DisallowNonDecimalIntegersInStrictTypesUnitTest.388.inc':
            case 'DisallowNonDecimalIntegersInStrictTypesUnitTest.403.inc':
            case 'DisallowNonDecimalIntegersInStrictTypesUnitTest.418.inc':
            case 'DisallowNonDecimalIntegersInStrictTypesUnitTest.433.inc':
            case 'DisallowNonDecimalIntegersInStrictTypesUnitTest.448.inc':
            case 'DisallowNonDecimalIntegersInStrictTypesUnitTest.463.inc':
            case 'DisallowNonDecimalIntegersInStrictTypesUnitTest.478.inc':
            case 'DisallowNonDecimalIntegersInStrictTypesUnitTest.493.inc':
            case 'DisallowNonDecimalIntegersInStrictTypesUnitTest.508.inc':
            case 'DisallowNonDecimalIntegersInStrictTypesUnitTest.523.inc':
            case 'DisallowNonDecimalIntegersInStrictTypesUnitTest.538.inc':
            case 'DisallowNonDecimalIntegersInStrictTypesUnitTest.553.inc':
            case 'DisallowNonDecimalIntegersInStrictTypesUnitTest.568.inc':
            case 'DisallowNonDecimalIntegersInStrictTypesUnitTest.583.inc':
            case 'DisallowNonDecimalIntegersInStrictTypesUnitTest.598.inc':
            case 'DisallowNonDecimalIntegersInStrictTypesUnitTest.613.inc':
            case 'DisallowNonDecimalIntegersInStrictTypesUnitTest.628.inc':
            case 'DisallowNonDecimalIntegersInStrictTypesUnitTest.643.inc':
            case 'DisallowNonDecimalIntegersInStrictTypesUnitTest.658.inc':
            case 'DisallowNonDecimalIntegersInStrictTypesUnitTest.673.inc':
            case 'DisallowNonDecimalIntegersInStrictTypesUnitTest.688.inc':
            case 'DisallowNonDecimalIntegersInStrictTypesUnitTest.703.inc':
            case 'DisallowNonDecimalIntegersInStrictTypesUnitTest.718.inc':
            case 'DisallowNonDecimalIntegersInStrictTypesUnitTest.733.inc':
            case 'DisallowNonDecimalIntegersInStrictTypesUnitTest.748.inc':
            case 'DisallowNonDecimalIntegersInStrictTypesUnitTest.763.inc':
            case 'DisallowNonDecimalIntegersInStrictTypesUnitTest.778.inc':
            case 'DisallowNonDecimalIntegersInStrictTypesUnitTest.793.inc':
            case 'DisallowNonDecimalIntegersInStrictTypesUnitTest.808.inc':
            case 'DisallowNonDecimalIntegersInStrictTypesUnitTest.823.inc':
            case 'DisallowNonDecimalIntegersInStrictTypesUnitTest.838.inc':
            case 'DisallowNonDecimalIntegersInStrictTypesUnitTest.853.inc':
            case 'DisallowNonDecimalIntegersInStrictTypesUnitTest.868.inc':
            case 'DisallowNonDecimalIntegersInStrictTypesUnitTest.883.inc':
            case 'DisallowNonDecimalIntegersInStrictTypesUnitTest.898.inc':
            case 'DisallowNonDecimalIntegersInStrictTypesUnitTest.913.inc':
                return [
                    8 => 1,
                ];

            default:
                return [
                    6 => 1,
                ];
        }
    }

    /**
     * Returns the lines where warnings should occur.
     *
     * @return array<int, int> Key is the line number, value is the number of expected warnings.
     */
    public function getWarningList()
    {
        return [];
    }
}
