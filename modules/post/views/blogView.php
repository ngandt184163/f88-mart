<?php
get_header("", $data);
?>
<div id="main-content-wp" class="clearfix blog-page">
    <div class="wp-inner">
        <div class="secion" id="breadcrumb-wp">
            <div class="secion-detail">
                <ul class="list-item clearfix">
                    <li>
                        <a href="<?php echo base_url(); ?>" title="">Trang chủ</a>
                    </li>
                    <li>
                        <a href="#" title="">Blog</a>
                    </li>
                </ul>
            </div>
        </div>
        <div class="main-content fl-right">
            <div class="section" id="list-blog-wp">
                <div class="section-head clearfix">
                    <h3 class="section-title">Blog</h3>
                    <div class="filter-wp fl-right">
                        <p class="desc">Hiển thị <?php echo count($list_blog); ?> trên <?php echo $pagination['per_page']; ?> bài viết</p>
                    </div>
                </div>
                <div class="section-detail">
                    <ul class="list-item">
                        <?php
                        if(!empty($list_blog)) {
                            foreach($list_blog as $item) {
                                ?>
                                <li class="clearfix">
                                    <a href="?mod=post&controller=index&action=detailBlog&post_id=<?php echo $item['post_id']; ?>" title="" class="thumb fl-left">
                                        <img src="/images/<?php echo $item['image']; ?>" alt="">
                                    </a>
                                    <div class="info fl-right">
                                        <a href="?mod=post&controller=index&action=detailBlogpost_id=<?php echo $item['post_id']; ?>" title="" class="title"><?php echo $item['title']; ?></a>
                                        <span class="create-date"><?php echo $item['created_at']; ?></span>
                                        <p class="desc"><?php
                                         $trimmedText = substr($item['content'], 0, 200);
                                         echo $trimmedText."..."; 
                                         ?>
                                        </p>
                                    </div>
                                </li>
                                <?php
                            }
                        }
                        ?>
                    </ul>
                </div>
            </div>
            <div class="section" id="paging-wp">
                <div class="section-detail">
                    <ul class="list-item clearfix">
                        <?php
                        if($pagination['page'] > 1){
                            ?>
                            <li><a href="<?php echo $data['url']; ?>&page=<?php echo ($pagination['page']-1) ?>"><<</a></li>
                            <?php
                        }
                        ?>
                        
                        <?php
                        for($i = 1; $i <= $pagination['num_page']; $i++){
                            ?>
                        <li <?php if($i == $pagination['page']) echo "class = 'active_page'"?>><a href="<?php echo $data['url']; ?>&page=<?php echo $i ?>"><?php echo $i ?></a></li>
                            <?php
                        }
                        ?>
                        <?php
                        if($pagination['page'] < $pagination['num_page']){
                            ?>
                            <li><a href="<?php echo $data['url']; ?>&page=<?php echo ($pagination['page']+1) ?>">>></a></li>
                            <?php
                        }
                        ?>
                    </ul>
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