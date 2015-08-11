GPSPolygon
=========
The **GPSPolygon** consists in a service library able to check if a point (latitude and longitude) is inside a polygon.
The library implements the [algorithm](http://www.eecs.umich.edu/courses/eecs380/HANDOUTS/PROJ2/InsidePoly.html) forwarded by Philippe Reverdy.
It computes the sum of the angles made between the test point and each pair of points making up the polygon.
If this sum is 2pi then the point is an interior point, if 0 then the point is an exterior point.

Installation
------------

Clone the github repo in your machine

``` bash
$ git clone https://github.com/gpirrotta/gpspolygon.git
$ cd gpspolygon
```

And run these two commands to install it:

``` bash
$ wget http://getcomposer.org/composer.phar
$ php composer.phar install
```

Now you can add the autoloader, and you will have access to the library:

``` php
<?php

require 'vendor/autoload.php';
```

You're done.

## Usage
The `PolygonService` class is the entry point of the library.

``` php
<?php

    use GPS\PolygonService;

    // Polygon area - Italy - Messina  viale Boccetta - Corso Cavour - Via Consolato del Mare - Via Garibaldi

    $polygon = array();
    $polygon[] = array(38.197344511074,15.556431412697);
    $polygon[] = array(38.197129504006,15.557370185852);
    $polygon[] = array(38.192909334811,15.55691421032);
    $polygon[] = array(38.193706168703,15.554140806198);
    $polygon[] = array(38.197344511074,15.556431412697);


    $service = new PolygonService();

    // The point is  Messina - Italy - piazza Unione Europea
    $service->isPointInsideThePolygon(38.19396, 15.55599, $polygon);



## Requirements

- >= PHP 5.3

## Running the Tests

``` bash
$ phpunit
```

## API Demo

* http://www.pirrotta.it/gps-polygon-api

## Credits

* Giovanni Pirrotta <giovanni.pirrotta@gmail.com>

## License

*gpspolygon* is released under the MIT License. See the bundled LICENSE file for
details.



