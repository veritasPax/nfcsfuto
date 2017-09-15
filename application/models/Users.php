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
  /**
   * [getReadableName gets the readable name of a user in the following pattern
   *                  FirstName LastName MiddleName.]
   * @param  [int] $id [id of user]
   * @return [string]  [the full name of user in the pattern specified above in
   *                   the description section.]
   */
  function getReadableName($id) {
    $this->db->select("first_name, last_name, middle_name");
    $query->$this->db->get_where("users", $id);
    if ($query->result_array() > 0) {
      $result = $query->result();
      return $result->first_name . " " . $result->last_name . " " . $result->middle_name;
    }
    return null;
  }
  /**
   * [createUser creates a user with the given array, Note, password field is
   * hashed for you.]
   * @param  [associative array] $user [associative array using keys matching
   *                                    the corresponding users table columns]
   * @return [boolean]       [returns true if successful or false if not.]
   */
  function createUser($user) {
    $user['password'] = password_hash($user['password'], PASSWORD_DEFAULT);
    return $this->db->insert("users", $user);
  }

}
?>
