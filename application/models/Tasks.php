<?php
/**
 * Created by PhpStorm.
 * User: lulu
 * Date: 2018-02-14
 * Time: 11:06 AM
 */

class Tasks extends XML_Model {

    private $CI;
    public function __construct()
    {
        //parent::__construct(APPPATH . '../data/tasks.csv', 'id');
        parent::__construct(APPPATH . '../data/tasks.xml', 'id');
        $this->CI = &get_instance();
    }

    protected function load() {
        if (($tasks = simplexml_load_file($this->_origin)) !== FALSE)
        {
            //if it is empty;
            if(empty($tasks)) {
                return;
            }

            foreach ($tasks->task as $one) {
                $record = new stdClass();
                $record->id = (int) $one->id;
                $record->task = (string) $one->desc;
                $record->priority = (int) $one->priority;
                $record->size = (int) $one->size;
                $record->group = (int) $one->group;
                $record->deadline = (string) $one->deadline;
                $record->status = (int) $one->status;
                $record->flag = (int) $one->flag;
                $this->_data[$record->id] = $record;
            }
        } else {
            exit('Failed to open the xml file.');
        }
        // rebuild the keys table
        $this->reindex();
        parent::load();
    }

    function getCategorizedTasks()
    {
        // extract the undone tasks
        foreach ($this->all() as $task)
        {
            if ($task->status != 2)
                $undone[] = $task;
        }

        // substitute the category name, for sorting
        foreach ($undone as $task)
            $task->group = $this->CI->app->group($task->group);

        // order them by category
        usort($undone, "orderByCategory");

        // convert the array of task objects into an array of associative objects
        foreach ($undone as $task)
            $converted[] = (array) $task;

        return $converted;
    }

    function getCompletedCount(){
        $count = 0;
        foreach ($this->all() as $task){
            if ($task->status == 2){
                $count++;
            }
        }
        return $count;
    }


    function getIncompleteCount() {
        $count = 0;
        foreach ($this->all() as $task){
            if ($task->status != 2){
                $count++;
            }
        }
        return $count;
    }

    // provide form validation rules
    public function rules()
    {
        $config = array(
            ['field' => 'task', 'label' => 'TODO task', 'rules' => 'alpha_numeric_spaces|max_length[64]'],
            ['field' => 'priority', 'label' => 'Priority', 'rules' => 'integer|less_than[4]'],
            ['field' => 'size', 'label' => 'Task size', 'rules' => 'integer|less_than[4]'],
            ['field' => 'group', 'label' => 'Task group', 'rules' => 'integer|less_than[5]'],
        );
        return $config;
    }
}

// return -1, 0, or 1 of $a's category name is earlier, equal to, or later than $b's
function orderByCategory($a, $b)
{
    if ($a->group < $b->group)
        return -1;
    elseif ($a->group > $b->group)
        return 1;
    else
        return 0;
}