<?php
class ManualTests extends CI_Controller {

  function __construct() {
    parent::__construct();
    $this->load->model('Social');
  }

  function index() {
    print_r($this->Social->getChaplainBlogPostsByYear(2017));
  }

  private function println() {
    echo "<br/>";
  }

  private function simpleComments() {
    print_r($this->Social->getChaplainBlogComments(4));
  }

}
?>
