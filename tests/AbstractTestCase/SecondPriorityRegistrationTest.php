<?php

namespace Tests\Magium\AbstractTestCase;

use Magium\AbstractTestCase;
use Magium\Util\TestCase\RegistrationCallbackInterface;

class SecondPriorityRegistrationTest extends AbstractTestCase
{

    protected $p1;
    protected $p2;

    protected function setUp()
    {
        $this->p1 = new SecondPriority();
        $this->p2 = new SecondPriority();

        self::addRegistrationCallback($this->p2, 0);
        self::addRegistrationCallback($this->p1, 10);
        parent::setUp();
    }

    public function testPriority()
    {
        self::assertGreaterThan($this->p1, $this->p2);
    }


}

abstract class SecondAbstractRegistrationCallback implements RegistrationCallbackInterface
{

    public $executedAt;

    public function register(AbstractTestCase $testCase)
    {
        $this->executedAt = microtime(true);
    }
}

class SecondPriority extends AbstractRegistrationCallback
{
}