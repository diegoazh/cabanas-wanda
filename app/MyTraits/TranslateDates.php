<?php

namespace App\MyTraits;

use Jenssegers\Date\Date as JDate;

trait TranslateDates
{
    public function getCreatedAtAttribute($date)
    {
        return new JDate($date);
    }

    public function getUpdatedAtAttribute($date)
    {
        return new JDate($date);
    }

    public function getDeletedAtAttribute($date)
    {
        return new JDate($date);
    }

    public function getDateOfBirthAttribute($date)
    {
        return new JDate($date);
    }
}

