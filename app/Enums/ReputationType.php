<?php

namespace App\Enums;

enum ReputationType: string
{
    case POSITIVE = 'positive';
    case NEGATIVE = 'negative';
    case NEUTRAL = 'neutral';
}
