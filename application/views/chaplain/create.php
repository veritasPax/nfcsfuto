<?php 
$attributes = array (
    'role' => 'form'
);
echo form_open('chaplain/create', $attributes);
?>

<div class="form-group">
    <label for="title">Title</label>
    <input type="text" class="form-control" name="title">
<div>

<div class="form-group">
    <label for="conent">Post</label>
    <textarea class="form-control" name="content" row="10"></textarea>
<div>

<div class="form-group">
    <label for="image">Post Image</label>
    <input type="text" class="form-control" name="image">
<div>

<input type="submit" name="submit" value="Post">
</div>
