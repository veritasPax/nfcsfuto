<?php
class Install extends CI_Controller {

  function __construct() {
    parent::__construct();
    $this->load->dbforge();
  }

  function index() {
    $usersFields = array(
      'id' => array(
        'type' => 'INT',
        'constraint' => 10,
        'unsigned' => TRUE,
        'auto_increment' => TRUE
      ),
      'first_name' => array(
        'type' => 'VARCHAR',
        'constraint' => '15',
      ),
      'last_name' => array(
        'type' => 'VARCHAR',
        'constraint' => '15',
      ),
      'middle_name' => array(
        'type' => 'VARCHAR',
        'constraint' => '15',
        'null' => true,
      ),
      'email' => array(
        'type' =>'VARCHAR',
        'constraint' => '40',
      ),
      'phone' => array(
        'type' =>'VARCHAR',
        'constraint' => '11',
      ),
      'password' => array(
        'type' => 'TEXT',
      ),
      'dob' => array(
        'type' => 'DATE',
      ),
      'department' => array(
        'type' => 'INT',
        'constraint' => '2',
      ),
      'gender' => array(
        'type' => 'VARCHAR',
        'constraint' => '1',
      ),
      'solidarity' => array(
        'type' => 'INT',
        'constraint' => '2',
        'null' => true,
      ),
      'arm' => array(
        'type' => 'INT',
        'constraint' => '1',
        'null' => true,
      ),
      'profile_image' => array(
        'type' => 'VARCHAR',
        'constraint' => '10',
      ),
      'facebook' => array(
        'type' => 'VARCHAR',
        'constraint' => '30',
      ),
      'twitter' => array(
        'type' => 'VARCHAR',
        'constraint' => '30',
      ),
      'instagram' => array(
        'type' => 'VARCHAR',
        'constraint' => '30',
      ),
    );
    $solidaritiesFields = array(
      'id' => array(
        'type' => 'INT',
        'constraint' => 10,
        'unsigned' => TRUE,
        'auto_increment' => TRUE
      ),
      'name' => array(
        'type' => 'VARCHAR',
        'constraint' => '100',
      ),
      'meeting_days_1' => array(
        'type' => 'VARCHAR',
        'constraint' => '20',
        'null' => true
      ),
      'meeting_days_2' => array(
        'type' => 'VARCHAR',
        'constraint' => '20',
        'null' => true
      ),
      'meeting_days_3' => array(
        'type' => 'VARCHAR',
        'constraint' => '20',
        'null' => true
      ),
      'meeting_days_4' => array(
        'type' => 'VARCHAR',
        'constraint' => '20',
        'null' => true
      ),
      'meeting_days_5' => array(
        'type' => 'VARCHAR',
        'constraint' => '20',
        'null' => true
      ),
      'description' => array(
        'type' => 'VARCHAR',
        'constraint' => '140',
      ),
      'president' => array(
        'type' =>'INT',
        'constraint' => '15',
      ),
      'secretary' => array(
        'type' =>'INT',
        'constraint' => '15',
      ),
      'logo' => array(
        'type' => 'VARCHAR',
        'constraint' => '10',
      ),
    );
    $this->dbforge->add_field($usersFields);
    $this->dbforge->add_key("id", true);
    $this->dbforge->create_table("users");
    echo "Database SucessFully Installed<br/>";
  }

}
?>
