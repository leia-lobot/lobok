<?php

namespace App\Reservation;

class State {
    const STATE_PENDING = 'STATE_PENDING';
    const STATE_ACCEPTED = 'STATE_ACCEPTED';
    const STATE_QUEUED = 'STATE_QUEUED';


    public static function getStateList()
    {
        return [
            self::STATE_PENDING => 'Pending',
            self::STATE_ACCEPTED => 'Accepted',
            self::STATE_QUEUED => 'Queued'
        ];
    }
}
