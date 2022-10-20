<?php


namespace App\Services;


use App\Models\Presence;
use DateTime;

class DifferenceTimeService
{

    public function sum($id)
    {
        $row = Presence::where('id', $id)->first();
        $enter = $row->enter;
        $exit = $row->exit;
        if ($exit and $enter) {
            $start_datetime = new DateTime($enter);
            $diff = $start_datetime->diff(new DateTime($exit));
            $total_minutes = ($diff->h * 60);
            $total_minutes += $diff->i;
            $row->update(['sum' => $total_minutes]);
        }
    }


}
