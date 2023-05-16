<?php

use PHPUnit\Framework\TestSuite;
use Tests\DuskTestCase;

require_once __DIR__ . '/../Page/Front/LoginTest.php';
require_once __DIR__ . '/../Page/Front/RegisterTest.php';
class DuskTestSuite extends DuskTestCase
{
    public static function suite()
    {
        $suite = new TestSuite('Dusk Tests');

        $suite->addTestFile(__DIR__ . '/../Page/Front/LoginTest.php');
        $suite->addTestFile(__DIR__ . '/../Page/Front/RegisterTest.php');

        return $suite;
    }
}
