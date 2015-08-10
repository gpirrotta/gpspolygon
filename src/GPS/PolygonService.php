<?php

namespace GPS;


class PolygonService {


    public function isPointInsideThePolygon($latitude, $longitude, array $polygon)
    {

        $latArray = array();
        $lonArray = array();

        foreach($polygon as $coordinate) {
            if ($this->isAValidGPSPoint($coordinate[0], $coordinate[1])) {
                $latArray[] = $coordinate[0];
                $lonArray[] = $coordinate[1];
            }
        }

        $angle = 0;
        $n = count($latArray);

        for($i=0; $i<$n;$i++) {
            $point1Lat = $latArray[$i] - $latitude;
            $point1Lon = $lonArray[$i] - $longitude;
            $point2Lat = $latArray[($i+1)%$n] - $latitude;
            $point2Lon = $lonArray[($i+1)%$n] - $longitude;
            $angle+= $this->angle2D($point1Lat, $point1Lon, $point2Lat, $point2Lon);
        }

        if (abs($angle) < pi()) {
            return false;
        }

        return true;
    }

    public function  isAValidGPSPoint($latitude, $longitude)
    {
        if ($latitude > -90 && $latitude < 90 && $longitude >-180 && $longitude < 180) {
            return true;
        }

        return false;
    }

    private function angle2D($y1, $x1, $y2, $x2)
    {

        $theta1 = atan2($y1, $x1);
        $theta2 = atan2($y2, $x2);
        $dtheta = $theta2 - $theta1;

        while ($dtheta > pi()) {
            $dtheta-= 2*pi();
        }
        while ($dtheta < -pi()) {
            $dtheta+= 2*pi();
        }

        return $dtheta;

    }
}

