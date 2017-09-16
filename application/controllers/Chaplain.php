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
            $this->load->view('chaplain/empty', $data);
        } else {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/chaplain_header', $data);
            $this->load->view('chaplain/index', $data);
            $this->load->view('templates/footer', $data);
        }
    }

    public function post($slug = NULL) {
        $data['post'] = $this->social->getChaplainBlogPost($slug);
        if (empty($data['post'])) {
            show_404();
        }

        $data['title'] = $data['post']['title'] . "&dash; Chaplain's Corner";

        $this->load->view('templates/header', $data);
        $this->load->view('templates/chaplain_header');
        $this->load->view('chaplain/post', $data);
        $this->load->view('templates/footer');
    }

    public function create() {
        $data['title'] = "Make a New Post" . " &dash; Chaplain's Corner";
        if ($_POST) {
            $this->social->addChaplainBlogPost();
            $this->index();
        } else {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/chaplain_header');
            $this->load->view('chaplain/create');
            $this->load->view('templates/footer');
        }        
        

    }
}
?>