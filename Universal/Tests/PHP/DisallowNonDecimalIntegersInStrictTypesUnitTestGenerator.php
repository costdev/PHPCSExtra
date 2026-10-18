<?php

$directory = __DIR__ . '/DisallowNonDecimalIntegersInStrictTypesUnitTest';
$filenameBase = $directory . '/DisallowNonDecimalIntegersInStrictTypesUnitTest.%d.inc';
$testBases = [
'declare in uppercase' => <<<TEST
<?php

// declare in uppercase.

// %TESTDESC%.
DECLARE(strict_types=%VALUE%);

TEST,

'strict_types in uppercase' => <<<TEST
<?php

// strict_types in uppercase.

// %TESTDESC%.
declare(STRICT_TYPES=%VALUE%);

TEST,

'No whitespace' => <<<TEST
<?php

// No whitespace.

// %TESTDESC%.
declare(strict_types=%VALUE%);

TEST,

'Whitespace before strict_types' => <<<TEST
<?php

// Whitespace before strict_types.

// %TESTDESC%.
declare( strict_types=%VALUE%);

TEST,

'Whitespace before the equals sign' => <<<TEST
<?php

// Whitespace before the equals sign.

// %TESTDESC%.
declare(strict_types =%VALUE%);

TEST,

'Whitespace before the value' => <<<TEST
<?php

// Whitespace before the value.

// %TESTDESC%.
declare(strict_types= %VALUE%);

TEST,

'Whitespace before the closer' => <<<TEST
<?php

// Whitespace before the closer.

// %TESTDESC%.
declare(strict_types=%VALUE% );

TEST,

'A comment before declare' => <<<TEST
<?php

// A comment before declare.

// %TESTDESC%.
/*comment*/declare(/*comment*/strict_types=%VALUE%);

TEST,

'A comment before strict_types' => <<<TEST
<?php

// A comment before strict_types.

// %TESTDESC%.
declare(/*comment*/strict_types=%VALUE%);

TEST,

'A comment before the equals sign' => <<<TEST
<?php

// A comment before the equals sign.

// %TESTDESC%.
declare(strict_types/*comment*/=%VALUE%);

TEST,

'A comment before the value' => <<<TEST
<?php

// A comment before the value.

// %TESTDESC%.
declare(strict_types=/*comment*/%VALUE%);

TEST,

'A comment before the closer' => <<<TEST
<?php

// A comment before the closer.

// %TESTDESC%.
declare(strict_types=%VALUE%/*comment*/);

TEST,

'Multiline with a comment and spaces' => <<<TEST
<?php

// Multiline with a comment and spaces.

// %TESTDESC%.
declare(
  // comment.
  strict_types = %VALUE%
);

TEST,

'Multiple directives with strict_types first' => <<<TEST
<?php

// Multiple directives with strict_types first.

// %TESTDESC%.
declare(strict_types=%VALUE%, ticks=0x00000001);

TEST,

'Multiple directives with strict_types last' => <<<TEST
<?php

// Multiple directives with strict_types first.

// %TESTDESC%.
declare(ticks=0x00000001, strict_types=%VALUE%);

TEST,

];

$tests = [
  // Hexadecimal (lowercase).
  'Hexadecimal (lowercase) 1 (unpadded)' => ['0x1', '1'],
  'Hexadecimal (lowercase) 0 (unpadded)' => ['0x0', '0'],
  'Hexadecimal (lowercase) 1 (padded with one zero)' => ['0x01', '1'],
  'Hexadecimal (lowercase) 0 (padded with one zero)' => ['0x00', '0'],
  'Hexadecimal (lowercase) 1 (padded with two zeroes)' => ['0x001', '1'],
  'Hexadecimal (lowercase) 0 (padded with two zeroes)' => ['0x000', '0'],
  'Hexadecimal (lowercase) 1 (padded with two zeroes and underscores)' => ['0x0_0_1', '1'],
  'Hexadecimal (lowercase) 0 (padded with two zeroes and underscores)' => ['0x0_0_0', '0'],
  'Hexadecimal (lowercase) 42 (padded with two zeroes and underscores)' => ['0x2_A', null],

  // Hexadecimal (uppercase).
  'Hexadecimal (uppercase) 1 (unpadded)' => ['0X1', '1'],
  'Hexadecimal (uppercase) 0 (unpadded)' => ['0X0', '0'],
  'Hexadecimal (uppercase) 1 (padded with one zero)' => ['0X01', '1'],
  'Hexadecimal (uppercase) 0 (padded with one zero)' => ['0X00', '0'],
  'Hexadecimal (uppercase) 1 (padded with two zeroes)' => ['0X001', '1'],
  'Hexadecimal (uppercase) 0 (padded with two zeroes)' => ['0X000', '0'],
  'Hexadecimal (uppercase) 1 (padded with two zeroes and underscores)' => ['0X0_0_1', '1'],
  'Hexadecimal (uppercase) 0 (padded with two zeroes and underscores)' => ['0X0_0_0', '0'],
  'Hexadecimal (uppercase) 42 (padded with two zeroes and underscores)' => ['0X2_A', null],

  // Implicit octal.
  'Implicit octal 1 (unpadded)' => ['01', '1'],
  'Implicit octal 0 (unpadded)' => ['00', '0'],
  'Implicit octal 1 (padded with one zero)' => ['001', '1'],
  'Implicit octal 0 (padded with one zero)' => ['000', '0'],
  'Implicit octal 1 (padded with two zeroes)' => ['0001', '1'],
  'Implicit octal 0 (padded with two zeroes)' => ['0000', '0'],
  'Implicit octal 1 (padded with two zeroes and underscores)' => ['00_0_1', '1'],
  'Implicit octal 0 (padded with two zeroes and underscores)' => ['00_0_0', '0'],
  'Implicit octal 42 (padded with two zeroes and underscores)' => ['05_2', null],

  // Explicit octal (lowercase).
  'Explicit octal (lowercase) 1 (unpadded)' => ['0o1', '1'],
  'Explicit octal (lowercase) 0 (unpadded)' => ['0o0', '0'],
  'Explicit octal (lowercase) 1 (padded with one zero)' => ['0o01', '1'],
  'Explicit octal (lowercase) 0 (padded with one zero)' => ['0o00', '0'],
  'Explicit octal (lowercase) 1 (padded with two zeroes)' => ['0o001', '1'],
  'Explicit octal (lowercase) 0 (padded with two zeroes)' => ['0o000', '0'],
  'Explicit octal (lowercase) 1 (padded with two zeroes and underscores)' => ['0o0_0_1', '1'],
  'Explicit octal (lowercase) 0 (padded with two zeroes and underscores)' => ['0o0_0_0', '0'],
  'Explicit octal (lowercase) 42 (padded with two zeroes and underscores)' => ['0o5_2', null],

  // Explicit octal (uppercase).
  'Explicit octal (uppercase) 1 (unpadded)' => ['0O1', '1'],
  'Explicit octal (uppercase) 0 (unpadded)' => ['0O0', '0'],
  'Explicit octal (uppercase) 1 (padded with one zero)' => ['0O01', '1'],
  'Explicit octal (uppercase) 0 (padded with one zero)' => ['0O00', '0'],
  'Explicit octal (uppercase) 1 (padded with two zeroes)' => ['0O001', '1'],
  'Explicit octal (uppercase) 0 (padded with two zeroes)' => ['0O000', '0'],
  'Explicit octal (uppercase) 1 (padded with two zeroes and underscores)' => ['0O0_0_1', '1'],
  'Explicit octal (uppercase) 0 (padded with two zeroes and underscores)' => ['0O0_0_0', '0'],
  'Explicit octal (uppercase) 42 (padded with two zeroes and underscores)' => ['0O5_2', null],

  // Binary (lowercase).
  'Binary (lowercase) 1 (unpadded)' => ['0b1', '1'],
  'Binary (lowercase) 0 (unpadded)' => ['0b0', '0'],
  'Binary (lowercase) 1 (padded with one zero)' => ['0b01', '1'],
  'Binary (lowercase) 0 (padded with one zero)' => ['0b00', '0'],
  'Binary (lowercase) 1 (padded with two zeroes)' => ['0b001', '1'],
  'Binary (lowercase) 0 (padded with two zeroes)' => ['0b000', '0'],
  'Binary (lowercase) 1 (padded with two zeroes and underscores)' => ['0b0_0_1', '1'],
  'Binary (lowercase) 0 (padded with two zeroes and underscores)' => ['0b0_0_0', '0'],

  // Binary (uppercase).
  'Binary (uppercase) 1 (unpadded)' => ['0B1', '1'],
  'Binary (uppercase) 0 (unpadded)' => ['0B0', '0'],
  'Binary (uppercase) 1 (padded with one zero)' => ['0B01', '1'],
  'Binary (uppercase) 0 (padded with one zero)' => ['0B00', '0'],
  'Binary (uppercase) 1 (padded with two zeroes)' => ['0B001', '1'],
  'Binary (uppercase) 0 (padded with two zeroes)' => ['0B000', '0'],
  'Binary (uppercase) 1 (padded with two zeroes and underscores)' => ['0B0_0_1', '1'],
  'Binary (uppercase) 0 (padded with two zeroes and underscores)' => ['0B0_0_0', '0'],
];

if ( ! file_exists( $directory ) ) {
  mkdir( $directory );
}

$i = 1;
foreach ($tests as $testDesc => $values) {
    list($badValue, $goodValue) = $values;

    foreach ( $testBases as $testBase ) {
      $testContent = str_replace(
        ['%TESTDESC%', '%VALUE%'],
        [$testDesc, $badValue],
        $testBase
      );

      $fixedContent = str_replace(
        ['%TESTDESC%', '%VALUE%'],
        [$testDesc, $goodValue],
        $testBase
      );

      $filename = sprintf($filenameBase, $i);
      file_put_contents($filename, $testContent);

      if ($goodValue !== null) {
        file_put_contents($filename . '.fixed', $fixedContent);
      }

      ++$i;
    }
}
