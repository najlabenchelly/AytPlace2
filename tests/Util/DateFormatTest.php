<?php


namespace App\Tests\Util;


use App\Service\DateFormat;
use PHPUnit\Framework\TestCase;

class DateFormatTest extends TestCase
{
    public function testFrFormat()
    {
        $dateFormat = new DateFormat();

        $now = new \DateTime();
        $result = $dateFormat->frFormat($now);

        $this->assertEquals($now->format('d/m/y'), $result);
    }

    public function testEnFormat()
    {
        $dateFormat = new DateFormat();

        $now = new \DateTime();
        $result = $dateFormat->enFormat($now);

        $this->assertEquals($now->format('y/m/d'), $result);
    }

    public function testDatediffPositif()
    {
        $dateFormat = new DateFormat();
        $start = new \DateTime('2009-10-11');
        $end = new \DateTime('2009-10-13');

        $result = $dateFormat->dateDiff($start, $end);

        $this->assertEquals('+2', $result);
    }

    public function testDatediffNegatif()
    {
        $dateFormat = new DateFormat();
        $start = new \DateTime('2009-10-13');
        $end = new \DateTime('2009-10-11');

        $result = $dateFormat->dateDiff($start, $end);

        $this->assertEquals('-2', $result);
    }
}
