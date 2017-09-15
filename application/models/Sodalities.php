<?php
class Sodalities extends CI_Model {
  /**
   * [getSodalityName gets the name of the sodality goven by the id.]
   * @param  [int] $id [id of the sodality.]
   * @return [string]  [the sodality name.]
   */
  function getSodalityName($id) {
    $query = $this->db->get_where("sodalities", array("id"=>$id));
    if ($query->num_rows() == 1) {
      return $query->result()[0]->name;
    }
    return "";
  }
  /**
   * [getSodality gets the sodality row from the database.]
   * @param  [int] $id [the id of the sodality.]
   * @return [array of associative arrays] [array of associative arrays of row
   *                                       contents]
   */
  function getSodality($id) {
    $query = $this->db->get_where("sodalities", array("id"=>$id));
    if ($query->num_rows() == 1) {
      return $query->result_array()[0];
    }
    return null;
  }
  /**
   * [getSodalityCategory gets the category of the sodality specified by the id.]
   * @param  [int] $sodalityId [the id of the sodality in question.]
   * @return [int]             [the category id of the sodality.]
   */
  function getSodalityCategory($sodalityId) {
    $query = $this->db->get_where("sodalities", array("id"=>$id));
    if ($query->num_rows() == 1) {
      return $query->result()[0]->category;
    }
    return -1;
  }
  /**
   * [interpreteCategory inteprets the sodality category id given to string
   * equivalents.]
   * @param  [int] $category [category id]
   * @return [string]        [returns Pious if 0 was given as category or
   *                         Service if 1.]
   */
  function interpreteCategory($category) {
    return $category == 0 ? "Pious" : "Service";
  }
}
?>
