<?php

namespace App\Enums;

enum WeekQuery: string
{
    case ALL = 'all';
    case CURRENT = 'current';
    case NEXT = 'next';
    case PREVIOUS = 'previous';
    case UPCOMING = 'upcoming';
}
