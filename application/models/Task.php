<?php
/**
 * Created by PhpStorm.
 * User: lulu
 * Date: 2018-03-09
 * Time: 11:00 PM
 */

class Task extends Entity
{
    protected $id;
    protected $task;
    protected $priority;
    protected $size;
    protected $group;
    protected $deadline;
    protected $status;
    protected $flag;

    public function getPriority(){
        return $this->priority;
    }

    public function getGroup() {
        return $this->group;
    }

    public function getStatus() {
        return $this->status;
    }

    // insist that an ID be present
    public function setId($value) {
        $this->id = $value;
        return $this;
    }

    // insist that a task be present and no longer than 30 characters
    public function setTask($value) {
        $this->task = $value;
        return $this;
    }

    public function setPriority($value) {
        $this->priority = $value;
        return $this;
    }

    public function setSize($value) {
        $this->size = $value;
        return $this;
    }

    public function setGroup($value) {
        $this->group = $value;
        return $this;
    }

    public function setDeadline($value) {
        $this->deadline = $value;
        return $this;
    }

    public function setStatus($value) {
        $this->status = $value;
        return $this;
    }

    public function setFlag($value) {
        $this->flag = $value;
        return $this;
    }

}