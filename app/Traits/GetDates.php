<?php

namespace App\Traits;

trait GetDates
{
    public function getMondaysInRange($dateFromString, $dateToString,$day,$startTime,$endTime,$id=null)
    {
        $dateFrom = new \DateTime($dateFromString);
        $dateTo = new \DateTime($dateToString);
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
        if ($dateFrom > $dateTo) {
            return $dates;
        }

        if ($days[$day] != $dateFrom->format('N')) {
            $dateFrom->modify("next $day");
        }

        for ($i = 0;$dateFrom <= $dateTo;$i++) {
            $dates[$i]['start'] = $dateFrom->format("Y-m-d\T$startTime");
            $dates[$i]['end'] = $dateFrom->format("Y-m-d\T$endTime");
            if($id){
                $dates[$i]['url'] =  "/payments?start=" .$dates[$i]['start'] ."&end=" .$dates[$i]['end'];
                $dates[$i]['url'].="&teacher_id=$id";
            }
            $dateFrom->modify('+1 week');
        }

        return $dates;
    }
}
