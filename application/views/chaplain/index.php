<div class="container main-content">
    <div class="top-banner">
        <div class="banner-image" style="background-image: url(<?php echo base_url('assets/img/church-bank-wood-benches-161060.jpeg');?>">
            <h1 class="text-center">Chaplain's Corner</h1>
        </div>
    </div>
    <div class="row">
        <!--left area-->
        <div class="col-md-8  left-area">
            <?php foreach($posts as $post): ?>
            <div class="post-item">
                <h3 class="page-header"><a href="<?php echo base_url('chaplain/post/') . $post['slug']; ?>" class="link caption-link"><?php echo $post['title']; ?></a></h3>
                <div class="meta">
                    <small>
                        <span class="text-primary"><i class="fa fa-edit"></i> &nbsp; Rev. Fr. Jude Ike</span>&nbsp;&nbsp;
                        <span><i class="fa fa-calendar"></i>&nbsp; 12th September, 2017<span>&nbsp;&nbsp;
                        <span class="text-primary"><i class="fa fa-comment"></i>&nbsp;3 comments</span>
                    </small>
                </div>
                <div class="row post-content">
                    <div class="col-sm-4">
                    <a href="<?php echo base_url('chaplain/post/') . $post['slug']; ?>" class="link"><img class="img-thumbnail" src="<?php echo base_url('assets/img/church-window-baptism-sacrament-glass-window (1).jpg'); ?>"/></a>
                    </div>
                    <div class="col-sm-8">
                    <p>
                        <?php echo substr($post['content'], 0, 300); ?>
                        ...
                    </p>
                    <p class="readmore"><a href="<?php echo base_url('chaplain/post/') . $post['slug']; ?>" class="link">Continue Reading <i class="fa fa-angle-double-right"></i></a></p>
                    </div>
                </div>
            </div>
            <?php endforeach; ?>

        </div>
    </div>