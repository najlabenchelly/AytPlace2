<?php


namespace App\Service;


class DateFormat
{
    public function frFormat(\DateTime $date)
    {
        return $date->format('d/m/y');
    }

    public function enFormat(\DateTime $date)
    {
        return $date->format('y/m/d');
    }

    public function dateDiff(\DateTime $start, \DateTime $end)
    {
        $interval = $start->diff($end);

        return $interval->format('%R%a');
    }
}
