<?php

namespace App\Http\Middleware;

use Closure;
use DateTimeZone;
use Illuminate\Http\Request;

class TimeZoneMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param Request $request
     * @param Closure $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        if (auth()->check()) {
            date_default_timezone_set($this->getTimeZoneFromIpAddress($request->ip()));
        }
        return $next($request);
    }
    private  function getTimeZoneFromIpAddress($clientsIpAddress){
        $clientInformation = unserialize(file_get_contents('http://www.geoplugin.net/php.gp?ip='.$clientsIpAddress), ['allowed_classes' => false]);

        $clientsLatitude = $clientInformation['geoplugin_latitude'];
        $clientsLongitude = $clientInformation['geoplugin_longitude'];
        $clientsCountryCode = $clientInformation['geoplugin_countryCode'];

        return $this->get_nearest_timezone($clientsLatitude, $clientsLongitude, $clientsCountryCode);

    }
    private function get_nearest_timezone($cur_lat, $cur_long, $country_code = '') {
        $timezone_ids = ($country_code) ? DateTimeZone::listIdentifiers(DateTimeZone::PER_COUNTRY, $country_code)
            : DateTimeZone::listIdentifiers();

        if($timezone_ids && is_array($timezone_ids) && isset($timezone_ids[0])) {

            $time_zone = '';
            $tz_distance = 0;

            //only one identifier?
            if (count($timezone_ids) === 1) {
                $time_zone = $timezone_ids[0];
            } else {
                foreach($timezone_ids as $timezone_id) {
                    $location = (new DateTimeZone($timezone_id))->getLocation();
                    $tz_lat   = $location['latitude'];
                    $tz_long  = $location['longitude'];

                    $theta    = $cur_long - $tz_long;
                    $distance = abs(rad2deg(acos((sin(deg2rad($cur_lat)) * sin(deg2rad($tz_lat)))
                        + (cos(deg2rad($cur_lat)) * cos(deg2rad($tz_lat)) * cos(deg2rad($theta))))));

                    if (!$time_zone || $tz_distance > $distance) {
                        $time_zone   = $timezone_id;
                        $tz_distance = $distance;
                    }

                }
            }
            return  $time_zone;
        }
        return 'UTC';
    }
}
