<?php
    get_header();
?>
<div id="main-content-wp" class="add-cat-page">
    <div class="wrap clearfix">
        <?php get_sidebar(); ?>
        <div id="content" class="fl-right">      
            <div class="section" id="title-page">
                <div class="clearfix">
                    <h3 id="index" class="fl-left">Cập nhật trang</h3>
                </div>
            </div>
            <div class="section" id="detail-page">
                <div class="section-detail">
                    <form enctype="multipart/form-data" method="POST">
                        <label for="title">Tiêu đề</label>
                        <input type="text" name="title" id="title" value="<?php echo $data['title']; ?>">
                        <?php echo form_error('title'); ?>

                        <label for="content">Mô tả</label>
                        <textarea name="content" id="content" class="ckeditor"><?php echo $data['content']; ?></textarea>
                        <?php echo form_error('content'); ?>

                        <label>Hình ảnh</label>
                        <div id="uploadFile">
                            <input type="file" name="file">
                            <img src="public/images/<?php echo $data['image'] ?>">
                        </div>

                        <input type="submit" name="btn" id="btn-submit" value="Cập nhật">

                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<?php
    get_footer();
?>