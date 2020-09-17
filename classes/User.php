<?php

class User {
    public function __construct() {
        $this->id = 0;
        $this->pseudo = "";
        $this->firstname = "";
        $this->lastname = "";
        $this->email = "";
        $this->password = "";
        $this->latitude = 0;
        $this->longitude = 0;
        $this->profile_description = "";
    }

    public function getAll() {
        global $db;
        $results = Array();
        $query = "SELECT user_id, pseudo, firstname, lastname, email, password FROM users";
        if ($query_all_users = $db->prepare($query)) {
            $query_all_users->bind_result($id, $pseudo, $firstname, $lastname, $email, $password);
            $query_all_users->execute();
            while ($query_all_users->fetch()) {
                $results[] = Array('id' => $id, 'pseudo' => $pseudo, 'firstname' => $firstname, 'lastname' => $lastname, 'email' => $email, 'password' => $password);
            }
        }
        else {
            return $db->error;
        }
        return $results;
    }

    public function getFromId() {
        global $db;
        if (!$this->id || $this->id == 0) {
            $this->errors[] = "I don't have an id";
            return False;
        }
        $results = Array();
        $query = "SELECT user_id, pseudo, firstname, lastname, email, password, photo FROM users WHERE user_id = $this->id";
        if ($query_all_users = $db->prepare($query)) {
            $query_all_users->bind_result($id, $pseudo, $firstname, $lastname, $email, $password, $photo);
            $query_all_users->execute();
            while ($query_all_users->fetch()) {
                $this->pseudo = $pseudo;
                $this->firstname = $firstname;
                $this->lastname = $lastname;
                $this->email = $email;
                $this->photo = $photo;
            }
        }
        else {
            return $db->error;
        }
        return $results;
    }

    public function getSkills() {
        global $db;
        if (!$this->id || $this->id == 0) {
            return False;
        }
        $results = Array();
        $query = "SELECT category_id, cat.name, text FROM users user JOIN user_skills skill USING(user_id) JOIN categories cat USING(category_id) WHERE user_id = $this->id";
        if ($query_skills = $db->prepare($query)) {
            $query_skills->bind_result($id, $name, $text);
            $query_skills->execute();
            while ($query_skills->fetch()) {
                $results[] = Array('id' => $id, 'name' => $name, 'text' => $text);
            }
        }
        else {
            return $db->error;
        }
        return $results;
    }

    public function getTasks() {
        global $db;
        if (!$this->id || $this->id == 0) {
            return False;
        }
        $results = Array();
        $query = "SELECT task.task_id, task.quasher, task.title, task.description, cat.name, task.status, task.datetime_creation FROM tasks task
                    JOIN users user ON (task.taskmaster = user.user_id)
                    JOIN categories cat USING(category_id) WHERE user.user_id = $this->id";
        if ($query_skills = $db->prepare($query)) {
            $query_skills->bind_result($task_id, $task_quasher, $task_title, $task_description, $category_name, $status, $datetime_creation);
            $query_skills->execute();
            while ($query_skills->fetch()) {
                $results[] = Array('id' => $task_id, 'task_quasher' => $task_quasher, 'title' => $task_title, 'description' => $task_description, 'category' => $category_name, 'status' => $status, 'datetime_creation' => $datetime_creation);
            }
        }
        else {
            return $db->error;
        }
        return $results;
    }

    public function getPossibleSquashs() {
        global $db;
        if (!$this->id || $this->id == 0) {
            return False;
        }
        $results = Array();
        $query = "SELECT task.task_id, task.title, cat.name, task.description, task.taskmaster, task.status, task.datetime_creation FROM tasks task
                    JOIN categories cat USING(category_id)
                    JOIN user_skills skill USING(category_id)
                    JOIN users user USING(user_id)
                    WHERE user_id = $this->id AND task.taskmaster != $this->id";
        if ($query_skills = $db->prepare($query)) {
            $query_skills->bind_result($task_id, $task_title, $category_name, $task_description, $taskmaster, $status, $datetime_creation);
            $query_skills->execute();
            while ($query_skills->fetch()) {
                $results[] = Array('id' => $task_id, 'title' => $task_title, 'category' => $category_name, 'description' => $task_description, 'taskmaster' => $taskmaster, 'status' => $status, 'datetime_creation' => date('Y-m-d', strtotime($datetime_creation)));
            }
        }
        else {
            return $db->error;
        }
        return $results;
    }

    public function addUserSkill($Skill) {
        global $db;
        if (!$Skill || !$Skill->id || $Skill->id == 0) {
            $this->erreurs[] = "Je n'ai pas de skill";
            return False;
        }
        $query = "INSERT INTO user_skills (user_id, category_id, text) VALUES(?, ?, ?)";
        if ($query_add_skill = $db->prepare($query)) {
            $query_add_skill->bind_param('iis', $this->id, $Skill->id, $Skill->text);
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

    public function addUser() {
        global $db;
        if (!$this->pseudo || !$this->email || !$this->password || $this->pseudo == "" || $this->email == "" || $this->password == "") {
            $this->erreurs[] = "Je n'ai pas toutes les infos";
            return False;
        }
        $query = "INSERT INTO users (pseudo, firstname, lastname, email, password) VALUES(?, ?, ?, ?, ?)";
        if ($query_add_skill = $db->prepare($query)) {
            $query_add_skill->bind_param('sssss', $this->pseudo, $this->firstname, $this->lastname, $this->email, $this->password);
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
