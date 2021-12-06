<?php

namespace App\Traits;

use App\UserRegisterWithTeacher;
use DateTime;
use Exception;
use Illuminate\Support\Facades\DB;

trait GetDates
{
    /**
     * @throws Exception
     */
    public function getMondaysInRange($dateFromString, $dateToString, $day, $startTime, $endTime, $id = null): array
    {
        $dateFrom = new DateTime($dateFromString);
        $dateTo = new DateTime($dateToString);
        $dates = [];
        $days = [
            'sunday' => 0,
            'monday' => 1,
            'tuesday' => 2,
            'wednesday' => 3,
            'thursday' => 4,
            'friday' => 5,
            'saturday' => 6
        ];

        if ($days[strtolower($day)] != $dateFrom->format('N')) {
            $dateFrom->modify("next $day");
        }
        DB::enableQueryLog();
        for ($i = 0; $dateFrom <= $dateTo; $i++) {
            if ($id) {
                $teacher = UserRegisterWithTeacher::where("scheduled_date", $dateFrom->format("Y-m-d $startTime"))->where('teacher_id', $id)->first();
                if ($teacher !== null) {
                    $dateFrom->modify('+1 week');
                    continue;
                }
            }
            $dates[$i]['start'] = $dateFrom->format("Y-m-d $startTime");
            $dates[$i]['end'] = $dateFrom->format("Y-m-d $endTime");
            if ($id) {
                $dates[$i]['url'] =  "/payments?start=" . $dates[$i]['start'] . "&end=" . $dates[$i]['end'];
                $dates[$i]['url'] .= "&teacher_id=$id";
            }
            $dateFrom->modify('+1 week');
        }
        return $dates;
    }

    /**
     * @throws Exception
     */
    public function getRescheduleDates($dateFromString, $dateToString, $day, $startTime, $endTime, $id = null, $teacher_id = null): array
    {
        $dateFrom = new DateTime($dateFromString);
        $dateTo = new DateTime($dateToString);
        $dates = [];
        $days = [
            'sunday' => 0,
            'monday' => 1,
            'tuesday' => 2,
            'wednesday' => 3,
            'thursday' => 4,
            'friday' => 5,
            'saturday' => 6
        ];


        if ($days[strtolower($day)] != $dateFrom->format('N')) {
            $dateFrom->modify("next $day");
        }

        for ($i = 0; $dateFrom <= $dateTo; $i++) {
            if ($id) {
                $teacher = UserRegisterWithTeacher::where("scheduled_date", $dateFrom->format("Y-m-d $startTime"))->where('teacher_id', $teacher_id)->first();
                if ($teacher !== null) {
                    $dateFrom->modify('+1 week');
                    continue;
                }
            }
            $dates[$i]['start'] = $dateFrom->format("Y-m-d $startTime");
            $dates[$i]['end'] = $dateFrom->format("Y-m-d $endTime");
            if ($id) {
                $dates[$i]['link'] =  "/lesson/reschedule/$id?start=" . $dates[$i]['start'] . "&end=" . $dates[$i]['end'];
                $dates[$i]['link'] .= "&teacher_id=$teacher_id";
            }
            $dateFrom->modify('+1 week');
        }

        return $dates;
    }
}
