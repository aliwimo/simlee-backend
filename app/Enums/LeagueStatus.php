<?php

namespace App\Enums;

enum LeagueStatus: string
{
    case PENDING = 'pending';
    case ACTIVE = 'active';
    case ENDED = 'ended';
}
