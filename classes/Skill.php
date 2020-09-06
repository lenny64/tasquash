<?php

class Skill {
    public function __construct() {
        $this->id = 0;
        $this->name = "";
        $this->node_path = "";
    }

    public function getAll() {
        global $db;
        $results = Array();
        $query = "SELECT category_id, name, node_path FROM categories ORDER BY name ASC";
        if ($query_all_skills = $db->prepare($query)) {
            $query_all_skills->bind_result($id, $name, $node_path);
            $query_all_skills->execute();
            while ($query_all_skills->fetch()) {
                $results[] = Array('id' => $id, 'name' => $name, 'node_path' => $node_path);
            }
        }
        else {
            return $db->error;
        }
        return $results;
    }

    public function removeUserSkill() {
        global $db;
        if (!$this->user_id || $this->user_id == 0 || !$this->category_id || $this->category_id == 0) {
            $this->erreurs[] = "Je n'ai pas d'user ou category";
            return False;
        }
        $query = "DELETE FROM user_skills WHERE user_id = ? AND category_id = ?";
        if ($query_remove_skill = $db->prepare($query)) {
            $query_remove_skill->bind_param('ii', $this->user_id, $this->category_id);
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
        }
        return True;
    }
}

?>
