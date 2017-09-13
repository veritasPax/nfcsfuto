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
  function addChaplainBlogPost($title, $post, $image) {
    date_default_timezone_set("Africa/Lagos");
    $dateTime = new DateTime(date("Y-m-d h:i:s"));
    $dateTime->modify('+1 week');
    $date = $dateTime->format('Y-m-d H:i:s');
    $data = array("title" => $title, "content" => $post, "close_date" => $date,
    "image" => $image, $date => date("Y-m-d h:i:s"));
    return $this->db->insert("chaplain_blog_posts", $data);
  }

  /**
   * [getImageUrl gets the actual url of an image file to be used in the src
   * attribut of an img tag.]
   * @param  [string] $image [image name gotten from the database.]
   * @return [string]        [http url of image.]
   */
  function getImageUrl($image) {
    $this->load-helper('url');
    return base_url() . "images/$image.jpg";
  }

  function getChaplainBlogPostsByMonth($month) {
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

  function getChaplainBlogPostsByMonthAndYear($month, $year) {
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

  function getChaplainBlogPostsByYear($year) {
    $date = "$year-01-" . date("d h:i:s");
    $this->db->where("date >=", $date);
    $query = $this->db->get("chaplain_blog_posts");
    return $query->result_array();
  }

}
?>
