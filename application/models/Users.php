<?php
class Users extends CI_Model {

  /**
   * [getUser description]
   * @param  [type] $id [description]
   * @return [type]     [description]
   */
  function getUser($id) {
    $query = $this->db->get_where("users", $id);
    if ($query->num_rows() > 0) {
      return $query->result_array();
    }
    return null;
  }

  function getUserName($id) {
    $this->db->select("first_name, last_name, middle_name");
    $query->$this->db->get_where("users", $id);
    if ($query->result_array() > 0) {
      $result = $query->result();
      return $result->first_name . " " . $result->last_name . " " . $result->middle_name;
    }
    return null;
  }

  function createUser($user) {
    
  }

}
?>
