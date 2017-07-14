<?php
class Install extends CI_Controller {

  function __construct() {
    parent::__construct();
    $this->load->dbforge();
  }

  function index() {
    echo "Installation Starting...<br/>";
    echo "Declaring Fields...<br/>";
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
        'type' => 'VARCHAR',
        'constraint' => '20',
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
      'years_paid' => array(
        'type' => 'INT',
        'constraint' => '1',
        'default' => 0,
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
    $sodalityFields = array(
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
    $departmentsFields = array(
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
      'code' => array(
        'type' => 'INT',
        'constraint' => '2',
        'null' => true
      ),
    );
    $announcementsFields = array(
      'id' => array(
        'type' => 'INT',
        'constraint' => 10,
        'unsigned' => TRUE,
        'auto_increment' => TRUE
      ),
      'parent' => array(
        'type' => 'INT',
        'constraint' => '2',
      ),
      'user_id' => array(
        'type' => 'INT',
        'constraint' => '15',
        'null' => true
      ),
      'message' => array(
        'type' => 'TEXT',
      ),
    );
    $ticketsFields = array(
      'id' => array(
        'type' => 'INT',
        'constraint' => 10,
        'unsigned' => TRUE,
        'auto_increment' => TRUE
      ),
      'code' => array(
        'type' => 'VARCHAR',
        'constraint' => '7',
      ),
      'user_id' => array(
        'type' => 'INT',
        'constraint' => '15',
        'null' => true
      ),
    );
    $sodalityMembershipFields = array(
      'id' => array(
        'type' => 'INT',
        'constraint' => 10,
        'unsigned' => TRUE,
        'auto_increment' => TRUE
      ),
      'sodality' => array(
        'type' => 'VARCHAR',
        'constraint' => '2',
      ),
      'user_id' => array(
        'type' => 'INT',
        'constraint' => '15',
        'null' => true
      ),
    );
    $meetingDaysFields = array(
      'id' => array(
        'type' => 'INT',
        'constraint' => 10,
        'unsigned' => TRUE,
        'auto_increment' => TRUE
      ),
      'value' => array(
        'type' => 'VARCHAR',
        'constraint' => '30',
      ),
    );
    echo "Done Declaring Fields...<br/>";
    echo "Creating Tables...<br/>";
    $this->dbforge->add_field($departmentsFields);
    $this->dbforge->add_field("id", true);
    $this->dbforge->create_table("departments", true);
    echo "Created departments Table.<br/>";
    $this->dbforge->add_field($meetingDaysFields);
    $this->dbforge->add_key("id", true);
    $this->dbforge->create_table("meeting_days", true);
    $this->dbforge->add_field($usersFields);
    $this->dbforge->add_key("id", true);
    $this->dbforge->add_field("FOREIGN KEY (department) REFERENCES departments(id)");
    $this->dbforge->create_table("users", true);
    echo "Created users Table.<br/>";
    $this->dbforge->add_field($sodalityFields);
    $this->dbforge->add_key("id", true);
    $this->dbforge->add_key("FOREIGN KEY (meeting_days_1) REFERENCES meeting_days(id)");
    $this->dbforge->add_key("FOREIGN KEY (meeting_days_2) REFERENCES meeting_days(id)");
    $this->dbforge->add_key("FOREIGN KEY (meeting_days_3) REFERENCES meeting_days(id)");
    $this->dbforge->add_key("FOREIGN KEY (meeting_days_4) REFERENCES meeting_days(id)");
    $this->dbforge->add_key("FOREIGN KEY (meeting_days_5) REFERENCES meeting_days(id)");
    $this->dbforge->add_key("FOREIGN KEY (president) REFERENCES users(id)");
    $this->dbforge->add_key("FOREIGN KEY (secretary) REFERENCES users(id)");
    $this->dbforge->create_table("sodality", true);
    echo "Created sodality Table.<br/>";
    $this->dbforge->add_field($announcementsFields);
    $this->dbforge->add_field("id", true);
    $this->dbforge->add_key("FOREIGN KEY (parent) REFERENCES users(id)");
    $this->dbforge->add_key("FOREIGN KEY (user_id) REFERENCES users(id)");
    $this->dbforge->create_table("announcements", true);
    echo "Created announcements Table.<br/>";
    $this->dbforge->add_field($ticketsFields);
    $this->dbforge->add_field("id", true);
    $this->dbforge->add_key("FOREIGN KEY (user_id) REFERENCES users(id)");
    $this->dbforge->create_table("tickets", true);
    echo "Created tickets Table.<br/>";
    $this->dbforge->add_field($sodalityMembershipFields);
    $this->dbforge->add_field("id", true);
    $this->dbforge->add_key("FOREIGN KEY (sodality) REFERENCES sodality(id)");
    $this->dbforge->add_key("FOREIGN KEY (user_id) REFERENCES users(id)");
    $this->dbforge->create_table("sodality_membership", true);
    echo "Created sodality_membership Table.<br/>";
    echo "Created meeting_days Table.<br/>";
    echo "Database SucessFully Installed<br/>";
  }

}
?>
