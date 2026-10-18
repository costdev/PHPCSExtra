<?php

// Multiple directives with strict_types first.

// Explicit octal (uppercase) 42 (padded with two zeroes and underscores).
declare(ticks=0x00000001, strict_types=0O5_2);
