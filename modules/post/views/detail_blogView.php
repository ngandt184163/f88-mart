<?php
get_header("", $data);
?>
<div id="main-content-wp" class="clearfix detail-blog-page">
    <div class="wp-inner">
        <div class="secion" id="breadcrumb-wp">
            <div class="secion-detail">
                <ul class="list-item clearfix">
                    <li>
                        <a href="<?php echo base_url(); ?>" title="">Trang chủ</a>
                    </li>
                    <li>
                        <a href="?mod=post&controller=index&action=blog" title="">Blog</a>
                    </li>
                    <!-- <li>
                        <a href="#" title="">Doanh nghiệp EU tìm kiếm ...</a>
                    </li> -->
                </ul>
            </div>
        </div>
        <div class="main-content fl-right">
            <?php
            if(!empty($post)) {
                ?>
                <div class="section" id="detail-blog-wp">
                    <div class="section-head clearfix">
                        <h3 class="section-title"><?php echo $post['title']; ?></h3>
                    </div>
                    <div class="section-detail">
                        <span class="create-date"><?php echo $post['created_at']; ?></span>
                        <div class="detail">
                            <p style="text-align: center;">
                                <img src="public/images/<?php echo $post['image']; ?>" alt="">
                            </p>
                            <?php echo $post['content']; ?>
                        </div>
                    </div>
                </div>
                <?php
            }
            ?>
            <div class="section" id="social-wp">
                <div class="section-detail">
                    <div class="fb-like" data-href="" data-layout="button_count" data-action="like" data-size="small" data-show-faces="true" data-share="true"></div>
                    <div class="g-plusone-wp">
                        <div class="g-plusone" data-size="medium"></div>
                    </div>
                    <div class="fb-comments" id="fb-comment" data-href="" data-numposts="5"></div>
                </div>
            </div>
        </div>
        <div class="sidebar fl-left">
            <?php
            get_sidebar('2', $data);
            ?>
        </div>
    </div>
</div>

<?php
get_footer();
?>