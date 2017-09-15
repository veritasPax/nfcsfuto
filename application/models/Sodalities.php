<?php
class Sodalities extends CI_Model {
  function getSodalityName($id) {
    $query = $this->db->get_where("sodalities", array("id"=>$id));
    if ($query->num_rows() == 1) {
      return $query->result()[0]->name;
    }
    return "";
  }
  function getSodality($id) {
    $query = $this->db->get_where("sodalities", array("id"=>$id));
    if ($query->num_rows() == 1) {
      return $query->result_array()[0];
    }
    return null;
  }
}
?>
