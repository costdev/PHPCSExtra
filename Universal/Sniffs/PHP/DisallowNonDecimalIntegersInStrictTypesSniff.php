<?php
/**
 * PHPCSExtra, a collection of sniffs and standards for use with PHP_CodeSniffer.
 *
 * @package   PHPCSExtra
 * @copyright 2020 PHPCSExtra Contributors
 * @license   https://opensource.org/licenses/LGPL-3.0 LGPL3
 * @link      https://github.com/PHPCSStandards/PHPCSExtra
 */

namespace PHPCSExtra\Universal\Sniffs\PHP;

use PHP_CodeSniffer\Files\File;
use PHP_CodeSniffer\Sniffs\Sniff;
use PHP_CodeSniffer\Util\Tokens;
use PHPCSUtils\Utils\Numbers;

/**
 * Forbids declaring strict_types with a non-decimal integer such as hexadecimal, octal, or binary.
 *
 * @since 4.x
 */
final class DisallowNonDecimalIntegersInStrictTypesSniff implements Sniff
{

    /**
     * Name of the metric.
     *
     * @since 4.x
     *
     * @var string
     */
    const METRIC_NAME = 'strict_types with a non-decimal integer';

    /**
     * Returns an array of tokens this test wants to listen for.
     *
     * @since 4.x
     *
     * @return array<int|string>
     */
    public function register()
    {
        return [\T_OPEN_TAG];
    }

    /**
     * Processes this test, when one of its tokens is encountered.
     *
     * @since 4.x
     *
     * @param \PHP_CodeSniffer\Files\File $phpcsFile The file being scanned.
     * @param int                         $stackPtr  The position of the current token
     *                                               in the stack passed in $tokens.
     *
     * @return void
     */
    public function process(File $phpcsFile, $stackPtr)
    {
        $tokens       = $phpcsFile->getTokens();
        $nextNonEmpty = $phpcsFile->findNext(Tokens::$emptyTokens, ($stackPtr + 1), null, true);
        if ($nextNonEmpty === false) {
            // Live coding. Do not flag (yet).
            $phpcsFile->recordMetric($stackPtr, self::METRIC_NAME, 'no');
            return;
        }

        if ($tokens[$nextNonEmpty]['code'] !== \T_DECLARE) {
            // No declare. Ignore.
            $phpcsFile->recordMetric($stackPtr, self::METRIC_NAME, 'no');
            return $phpcsFile->numTokens;
        }

        if (isset($tokens[$nextNonEmpty]['parenthesis_closer']) === false) {
            // Incomplete set of parentheses. Ignore.
            $phpcsFile->recordMetric($stackPtr, self::METRIC_NAME, 'no');
            return $phpcsFile->numTokens;
        }

        $opener = $nextNonEmpty;
        $closer = $tokens[$opener]['parenthesis_closer'];

        $directive = false;
        for ($i = $stackPtr; $i < $closer; ++$i) {
            $nextString = $phpcsFile->findNext(\T_STRING, $i, $closer);

            if ($nextString === false) {
                break;
            }

            if (\strtolower($tokens[$nextString]['content']) === 'strict_types') {
                $directive = $nextString;
                break;
            }
        }

        if ($directive === false) {
            $phpcsFile->recordMetric($stackPtr, self::METRIC_NAME, 'no');
            // strict_types isn't declared. Ignore.
            return $phpcsFile->numTokens;
        }

        $comma = $phpcsFile->findNext(\T_COMMA, $directive, $closer);
        if ($comma !== false) {
            // Avoid checking a later directive.
            $closer === $comma;
        }

        $equals = $phpcsFile->findNext(\T_EQUAL, $directive, $closer);
        if ($equals === false) {
            // Live coding. Ignore.
            $phpcsFile->recordMetric($stackPtr, self::METRIC_NAME, 'no');
            return $phpcsFile->numTokens;
        }

        $value = $phpcsFile->findNext(\T_LNUMBER, $equals, $closer);
        if ($value === false) {
            // Missing or invalid value. Ignore.
            $phpcsFile->recordMetric($stackPtr, self::METRIC_NAME, 'no');
            return $phpcsFile->numTokens;
        }

        if (Numbers::isDecimalInt($tokens[$value]['content'])) {
            // The value is already decimal. Ignore.
            $phpcsFile->recordMetric($stackPtr, self::METRIC_NAME, 'no');
            return $phpcsFile->numTokens;
        }

        $phpcsFile->recordMetric($stackPtr, self::METRIC_NAME, 'yes');

        $decimalValue = Numbers::getDecimalValue($tokens[$value]['content']);

        if ($decimalValue !== '0' && $decimalValue !== '1') {
            $phpcsFile->addError(
                'Only decimal integers can be used with strict_types. Found %s.',
                $value,
                'Found',
                [\strtolower(\ltrim($tokens[$value]['content'], '\\'))]
            );
        } else {
            $fix = $phpcsFile->addFixableError(
                'Only decimal integers can be used with strict_types. Found %s.',
                $value,
                'Found',
                [\strtolower(\ltrim($tokens[$value]['content'], '\\'))]
            );

            if ($fix === true) {
                $phpcsFile->fixer->beginChangeset();
                $phpcsFile->fixer->replaceToken($value, $decimalValue);
                $phpcsFile->fixer->endChangeset();
            }
        }
    }
}
