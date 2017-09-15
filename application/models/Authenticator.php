<?php
class Authenticator extends CI_Model {

  function authenticate() {
    // grab user input
    $login = $this->security->xss_clean($this->input->post('login'));
    $password = $this->security->xss_clean($this->input->post('password'));
    // Prep the user link.
    $this->db->where('email', $login);
    $this->db->or_where('phone', $login); // Can login with either username or password.
    // Run the query
    $query = $this->db->get('users');
    if($query->num_rows() == 1) {
      $row = $query->row();
      $hash = $row->password;
      if (password_verify($password, $hash)) {
        $data = array('id'=>$row->id, 'first_name'=>$row->first_name,
        'last_name'=>$row->last_name, 'middle_name'=>$row->middle_name,
        'email'=>$row->email, 'phone'=>$row->phone, 'validated'=>true);
        $this->session->set_userdata($data);
        return true;
      }
    }
    return false;
  }

}
?>
