<?php
class Chaplain extends CI_Controller {
    public function __construct() {
        parent::__construct();
        $this->load->model('social');
    }

    public function index() {
        date_default_timezone_set("Africa/Lagos");
        $data['posts'] = $this->social->getChaplainBlogPostsByMonth(date('n'));
        $data['title'] = "Chaplain's Corner";

        if (empty($data['posts'])) {
            $this->load->view('chaplain/empty');
        }

        $this->load->view('templates/header');
        $this->load->view('templates/chaplain_header');
        $this->load->view('templates/index');
        $this->load->view('templates/footer');
    }

    public function post($slug = NULL) {
        $data['post'] = $this->social->getChaplainBlogPost($slug);
        if (empty($data['post'])) {
            show_404();
        }

        $data['title'] = $data['post']['title'] . "&dash; Chaplain's Corner";

        $this->load->view('templates/header');
        $this->load->view('templates/chaplain_header');
        $this->load->view('chaplain/post');
        $this->load->view('templates/footer');
    }
}
?>