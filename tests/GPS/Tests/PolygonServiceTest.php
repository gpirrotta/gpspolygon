<?php

namespace GPS\Tests;

use GPS\PolygonService;

/**
 * @author Giovanni Pirrotta <giovanni.pirrotta@gmail.com>
 */
class PolygonServiceTest extends \PHPUnit_Framework_TestCase {

    public function test_points_are_valid_GPS_coordinates()
    {
        $service = new PolygonService();
        $this->assertTrue($service->isAValidGPSPoint(25, -82));
        $this->assertTrue($service->isAValidGPSPoint(-25, -82));
        $this->assertTrue($service->isAValidGPSPoint(25, 82));
        $this->assertTrue($service->isAValidGPSPoint(-25, 82));
        $this->assertTrue($service->isAValidGPSPoint(0, 0));
        $this->assertTrue($service->isAValidGPSPoint(89, 179));
        $this->assertTrue($service->isAValidGPSPoint(-89, -179));
        $this->assertTrue($service->isAValidGPSPoint(89.999, 179));
        $this->assertFalse($service->isAValidGPSPoint(200, 179));
        $this->assertFalse($service->isAValidGPSPoint(-91, 179));
        $this->assertFalse($service->isAValidGPSPoint(95, 185));
    }


    public function test_point_is_inside_the_polygon()
    {
        // Messina - viale Boccetta - Corso Cavour - Via Consolato del Mare - Via Garibaldi
        $polygon = array();
        $polygon[] = array(38.197344511074,15.556431412697);
        $polygon[] = array(38.197129504006,15.557370185852);
        $polygon[] = array(38.192909334811,15.55691421032);
        $polygon[] = array(38.193706168703,15.554140806198);
        $polygon[] = array(38.197344511074,15.556431412697);

        $service = new PolygonService();

        // Messina - piazza Unione Europea
        $this->assertTrue($service->isPointInsideThePolygon(38.19396, 15.55599, $polygon));
    }

    public function test_point_is_outside_the_polygon()
    {
        // Messina  viale Boccetta - Corso Cavour - Via Consolato del Mare - Via Garibaldi
        $polygon = array();
        $polygon[] = array(38.197344511074,15.556431412697);
        $polygon[] = array(38.197129504006,15.557370185852);
        $polygon[] = array(38.192909334811,15.55691421032);
        $polygon[] = array(38.193706168703,15.554140806198);
        $polygon[] = array(38.197344511074,15.556431412697);

        $service = new PolygonService();

        // Messina - piazza Duomo
        $this->assertFalse($service->isPointInsideThePolygon(38.19245, 15.55608, $polygon));
    }
}
