<?php

// Multiple directives with strict_types first.

// Explicit octal (lowercase) 0 (padded with two zeroes and underscores).
declare(ticks=0x00000001, strict_types=0o0_0_0);
