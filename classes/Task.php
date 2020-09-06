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

    public function removeUserTask() {
        global $db;
        if (!$this->id || $this->id == 0) {
            $this->erreurs[] = "Pas d'id";
            return False;
        }
        $query = "DELETE FROM tasks WHERE task_id = ?";
        if ($query_remove_skill = $db->prepare($query)) {
            $query_remove_skill->bind_param('i', $this->id);
            if ($query_remove_skill->execute() === TRUE) {
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
        return True;
    }

    public function makeSquashApplication() {
        global $db;
        if (!$this->id || $this->id == 0 || !$this->quasher || $this->quasher == 0) {
            $this->erreurs[] = "Je n'ai pas d'id";
        }
        $query = "UPDATE tasks SET quasher = ?, status = 'quasher_pending' WHERE task_id = ?";
        if ($query_accept_squash = $db->prepare($query)) {
            $query_accept_squash->bind_param('ii', $this->quasher, $this->id);
            if ($query_accept_squash->execute() === TRUE) {
                $query_applicant = "INSERT INTO applicants_offers (task_id, user_id) VALUES(?, ?)";
                if ($query_new_applicant = $db->prepare($query_applicant)) {
                    $query_new_applicant->bind_param('ii', $this->id, $this->quasher);
                    if ($query_new_applicant->execute() === TRUE) {
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
