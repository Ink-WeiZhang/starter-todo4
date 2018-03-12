<?php
use PHPUnit\Framework\TestCase;

class TaskTest extends TestCase {

    function setUp() {
        $this->CI = &get_instance();
        $this->CI->load->model('task');
        $this->mTask = new Task();
        $this->mTask->setTask("Coding");
        $this->mTask->setPriority("high");
        $this->mTask->setGroup("small");
        $this->mTask->setStatus("in progress");
    }

    function testPriority() {
        $expected = "high";
        $this->mTask->priority = $expected;
        $this->assertEquals($expected, $this->mTask->getPriority());
    }

    function testGroup() {
        $expected = "small";
        $this->assertEquals($expected, $this->mTask->getGroup());
    }

    function testStatus() {
        $expected = "in progress";
        $this->assertEquals($expected, $this->mTask->getStatus());
    }
}