<?php
declare(strict_types=1);


use PHPUnit\Framework\TestCase;

final class ClockTowerTest extends TestCase
{

    public function testBeforeNoon(): void
    {
        $clockTower = new ClockTower();

        $this->assertEquals(
            $clockTower->countBells('2:00', '3:00'),
            5
        );
    }

    public function testAfterNoonOnTheHours(): void
    {
        $clockTower = new ClockTower();

        $this->assertEquals(
            $clockTower->countBells('14:00', '15:00'),
            5
        );
    }

    public function testAfterNoonOffTheHours(): void
    {
        $clockTower = new ClockTower();

        $this->assertEquals(
            $clockTower->countBells('14:23', '15:42'),
            3
        );
    }

    public function testCrossMidnight(): void
    {
        $clockTower = new ClockTower();

        $this->assertEquals(
            $clockTower->countBells('23:00', '1:00'),
            24
        );
    }

    public function testCrossMidnightAndNoon(): void
    {
        $clockTower = new ClockTower();

        $this->assertEquals(
            $clockTower->countBells('23:00', '22:00'),
            156
        );
    }

    public function testFullTwentyFourHours(): void
    {
        $clockTower = new ClockTower();

        $this->assertEquals(
            $clockTower->countBells('2:00', '2:00'),
            158
        );
    }

    public function testInputValidity(): void
    {
        $this->assertEquals(
            isValidMilitaryTime('23:59'),
            true
        );

        $this->assertEquals(
            isValidMilitaryTime('1:00'),
            true
        );

        $this->assertEquals(
            isValidMilitaryTime('14:01'),
            true
        );

        $this->assertEquals(
            isValidMilitaryTime('asdf'),
            false
        );

        $this->assertEquals(
            isValidMilitaryTime('24:00'),
            false
        );

        $this->assertEquals(
            isValidMilitaryTime('29:30'),
            false
        );
    }
}
