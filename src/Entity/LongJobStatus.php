<?php

namespace App\Entity;

enum LongJobStatus: string
{
    case started = 'started';
    case completed = 'completed';
    case cancelled = 'cancelled';
}