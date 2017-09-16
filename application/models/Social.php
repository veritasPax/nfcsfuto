<?php
class Social extends CI_Model {

  /**
   * [getChaplainBlogComments gets the comments under a chaplain's post given by
   * the post id.]
   * @param  [int] $postId [id of post under chaplain posts.]
   * @return [array of associative arrays] [array of commets.]
   */
  function getChaplainBlogComments($postId) {
    $query = $this->db->get_where("comments", array("id" => $postId));
    return $query->result_array();
  }

  /**
   * [getReplies get replies for a given comment]
   * @param  [int] $commentId [the id of the comment to get replies from.]
   * @return [array of associative arrays] [array of replies.]
   */
  function getReplies($commentId) {
    $query = $this->db->get_where("comments", array("type" => 1,
    "type_id" => $commentId));
    return $query->result_array();
  }

/**
 * [addChaplainBlogComment adds a comment for the chaplain blog]
 * @param [int] $userId  [id of user commenting]
 * @param [string $comment [the comment]
 * @return [boolean] [true if successful otherwise false.]
 */
  function addChaplainBlogComment($userId, $postId, $comment) {
    date_default_timezone_set("Africa/Lagos");
    $now = new DateTime(date("Y-m-d h:i:s"));
    $query = $this->db->get_where("chaplain_blog_posts", array("id" => $postId));
    if ($query->num_rows()) {
      $against = new DateTime($query->result()[0]->close_date);
      if ($now >= $against) {
        return false;
      } else {
        $data = array("user_id" => $userId, "type_id" => $postId, "comment" => $comment,
        "under_which" => 0, "type" => 0);
        return $this->db->insert("comments", $data);
      }
    }
    return false;
  }

  /**
   * [addChaplainBlogReply adds a reply to a comment for a chaplain blog comment.]
   * @param [int] $userId    [id of the user replying.]
   * @param [int] $commentId [id of comment to which to add reply to.]
   * @param [string] $reply     [the reply.]
   * @return [boolean] [true if successful otherwise false.]
   */
  function addChaplainBlogReply($userId, $commentId, $reply) {
    date_default_timezone_set("Africa/Lagos");
    $now = new DateTime(date("Y-m-d h:i:s"));
    $query = $this->db->get_where("chaplain_blog_posts", array("id" => $postId));
    if ($query->num_rows()) {
      $against = new DateTime($query->result()[0]->close_date);
      if ($now >= $against) {
        return false;
      } else {
        $data = array("user_id" => $userId, "type_id" => $commentId,
        "comment" => $reply, "type" => 1, "under_which" => 0);
        return $this->db->insert("comments", $data);
      }
    }
    return false;
  }

  /**
   * [addChaplainBlogPost adds a chaplain blog post]
   * @param [string] $title [title of post]
   * @param [string] $post  [the actual post content]
   * @param [string] $image [image name without extension.]
   * @return [boolean] [true if successful otherwise false.]
   */
  function addChaplainBlogPost() {
    date_default_timezone_set("Africa/Lagos");
    $dateTime = new DateTime(date("Y-m-d h:i:s"));
    $dateTime->modify('+1 week');
    $date = $dateTime->format('Y-m-d H:i:s');
    $this->load->helper("url");
    $title = $this->input->post('title');
    $data = array(
      "title" => $title, 
      "content" => $this->input->post('content'), 
      "close_date" => $date,
      "image" => $this->input->post('image'), 
      "slug" => url_title($title, 'dash', TRUE),
      "date" => date("Y-m-d h:i:s")
      );
    return $this->db->insert("chaplain_blog_posts", $data);
  }
  /**
   * [getChaplainBlogPost gets a particular blog post identified by the slug]
   * @param  [string] $slug [the slug for the given post.]
   * @return [associative array] [returns an associative row array or null if
   *                             not found.]
   */
  function getChaplainBlogPost($slug) {
    $query = $this->db->get_where("chaplain_blog_posts", array("slug"=>$slug));
    if ($query->num_rows() == 1)  {
      return $query->result_array()[0];
    }
    return null;
  }
  /**
   * [getImageUrl gets the actual url of an image file to be used in the src
   * attribut of an img tag.]
   * @param  [string] $image [image name gotten from the database.]
   * @return [string]        [http url of image.]
   */
  function getImageUrl($image) {
    $this->load->helper('url');
    return base_url() . "images/$image.jpg";
  }
  /**
    * [getChaplainBlogPosts get 10 chaplain blog posts starting from given value
    * of $start.]
    * @param  [int] $start  [the index to start from.]
    * @return [array of associative arrays]        [chaplain blog posts.]
    */
  function getChaplainBlogPosts($start) {
    $this->order_by("id", "DESC");
    $query = $this->db->get("chaplain_blog_posts", 10, $start);
    return $query->result_array();
  }
  /**
   * [getChaplainBlogPostsByMonth gets chaplain posts by month.]
   * @param  [int] $month [month to fetch posts for.]
   * @return [array of associative arrays] [array of associative arrays containing
   * posts made within selected month.]
   */
  function getChaplainBlogPostsByMonth($month) {
    date_default_timezone_set("Africa/Lagos");
    $upper = str_pad($month + 1, 2, "0", STR_PAD_LEFT);
    $lower = str_pad($month - 1, 2, "0", STR_PAD_LEFT);
    $month = str_pad($month, 2, "0", STR_PAD_LEFT);
    $upperDate = date("Y") . "-$upper-" . date("d h:i:s");
    $lowerDate = date("Y") . "-$lower-" . date("d h:i:s");
    $this->db->where("date <", $upperDate);
    $this->db->where("date >", $lowerDate);
    $query = $this->db->get("chaplain_blog_posts");
    return $query->result_array();
  }

  /**
   * [getChaplainBlogPostsByMonthAndYear gets chaplain posts by month and year.]
   * @param  [int] $month [month to fetch posts by]
   * @param  [int] $year  [year to fetch posts by]
   * @return [array of associative arrays] [arrays of associative arrays of blog
   * posts made within the specified month and year.]
   */
  function getChaplainBlogPostsByMonthAndYear($month, $year) {
    date_default_timezone_set("Africa/Lagos");
    $upper = str_pad($month + 1, 2, "0", STR_PAD_LEFT);
    $lower = str_pad($month - 1, 2, "0", STR_PAD_LEFT);
    $month = str_pad($month, 2, "0", STR_PAD_LEFT);
    $upperDate = "$year-$upper-" . date("d h:i:s");
    $lowerDate = "$year-$lower-" . date("d h:i:s");
    $this->db->where("date <", $upperDate);
    $this->db->where("date >", $lowerDate);
    $query = $this->db->get("chaplain_blog_posts");
    return $query->result_array();
  }

  /**
   * [getChaplainBlogPostsByYear get chaplain post by year]
   * @param  [int] $year [year to fetch blog posts by.]
   * @return [array of associative arrays] [arrays of associative arrays of blog
   * posts made within the specified year.]
   */
  function getChaplainBlogPostsByYear($year) {
    date_default_timezone_set("Africa/Lagos");
    $date = "$year-01-" . date("d h:i:s");
    $this->db->where("date >=", $date);
    $query = $this->db->get("chaplain_blog_posts");
    return $query->result_array();
  }

}
?>
