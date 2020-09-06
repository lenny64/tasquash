<?php

class Task {
    public function __construct() {
        $this->id = 0;
        $this->taskmaster = 0;
        $this->quasher = 0;
        $this->datetime_creation = 0;
        $this->status = "";
        $this->reward = 0;
        $this->latitude = 0;
        $this->longitude = 0;
        $this->distance = 0;
        $this->description = "";
        $this->documents = "";
        $this->category_id = 0;
        $this->title = "";
        $this->deadline = 0;
        $this->datetime_hire = 0;
    }

    public function addUserTask() {
        global $db;
        if (!$this->taskmaster || $this->taskmaster == 0 || !$this->description || $this->description == "" || !$this->category_id || $this->category_id == 0) {
            $this->erreurs[] = "Je n'ai pas de task";
            return False;
        }
        $query = "INSERT INTO tasks (taskmaster, description, category_id, title, deadline, distance) VALUES(?, ?, ?, ?, ?, ?)";
        if ($query_add_skill = $db->prepare($query)) {
            $query_add_skill->bind_param('isisii', $this->taskmaster, $this->description, $this->category_id, $this->title, strtotime($this->deadline), $this->distance);
            if ($query_add_skill->execute() === TRUE) {
                //
            }
            else {
                $this->erreurs[] = $db->error;
                return False;
            }
        }
        else {
            $this->erreurs[] = $db->error;
            return False;
        }
    }
}

?>
