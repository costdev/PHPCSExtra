<?php

// Multiple directives with strict_types first.

// Explicit octal (uppercase) 0 (padded with two zeroes and underscores).
declare(ticks=0x00000001, strict_types=0O0_0_0);
