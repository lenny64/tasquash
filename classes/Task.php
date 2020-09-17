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

    public function getFromId() {
        global $db;
        if (!$this->id || $this->id == 0) {
            $this->errors[] = "I don't have an id";
            return False;
        }
        $results = Array();
        $query = "SELECT task.task_id, task.taskmaster, task.quasher, task.title, task.description, cat.name, task.status, task.datetime_creation FROM tasks task
                    JOIN categories cat USING(category_id) WHERE task.task_id = $this->id";
        if ($query_skills = $db->prepare($query)) {
            $query_skills->bind_result($task_id, $taskmaster, $quasher, $task_title, $task_description, $category_name, $status, $datetime_creation);
            $query_skills->execute();
            while ($query_skills->fetch()) {
                $this->title = $task_title;
                $this->taskmaster = $taskmaster;
                $this->quasher = $quasher;
                $this->description = $task_description;
                $this->category = $category_name;
                $this->status = $status;
                $this->datetime_creation = date('Y-m-d', strtotime($datetime_creation));
            }
        }
        else {
            return $db->error;
        }
        return $results;
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
        $query = "UPDATE tasks SET status = 'quasher_pending' WHERE task_id = ?";
        if ($query_accept_squash = $db->prepare($query)) {
            $query_accept_squash->bind_param('i', $this->id);
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

    public function getApplicantsOffers() {
        global $db;
        if (!$this->id || $this->id == 0) {
            $this->erreurs[] = "Je n'ai pas de tache";
            return False;
        }
        $offers_list = Array();
        $query = "SELECT off.id_offer, off.user_id, off.task_id, users.firstname, users.lastname, users.photo FROM applicants_offers off
                    JOIN users USING(user_id)
                    WHERE off.task_id = $this->id";
        if ($query_list_offers = $db->prepare($query)) {
            $query_list_offers->execute();
            $query_list_offers->bind_result($id_offer, $user_id, $task_id, $firstname, $lastname, $photo);
            while($query_list_offers->fetch()) {
                $offers_list[] = Array('id' => $id_offer, 'user_id' => $user_id, 'task_id' => $task_id, 'firstname' => $firstname, 'lastname' => $lastname, 'photo' => $photo);
            }
        }
        else {
            $this->erreurs[] = $db->error;
            return False;
        }
        $this->offers = $offers_list;
        return $offers_list;
    }

    public function acceptOffer() {
        global $db;
        if (!$this->id || $this->id == 0 || !$this->quasher || $this->quasher == 0) {
            $this->erreurs[] = "Je n'ai pas d'id ou quasher";
            return False;
        }
        $results = True;
        $query = "UPDATE tasks SET status = 'quasher_accepted', quasher = ?, datetime_hire = CURRENT_TIMESTAMP() WHERE task_id = ?";
        if ($query_update_task = $db->prepare($query)) {
            $query_update_task->bind_param('ii', $this->quasher, $this->id);
            if ($query_update_task->execute() === TRUE) {
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
        return $results;
    }
}

?>
