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
}

?>
