
<?php
    get_header();
?>
<div id="main-content-wp" class="add-cat-page">
    <div class="wrap clearfix">
        <?php get_sidebar(); ?>
        <div id="content" class="fl-right">      
            <div class="section" id="title-page">
                <div class="clearfix">
                    <h3 id="index" class="fl-left">Thêm mới danh mục</h3>
                </div>
            </div>
            <div class="section" id="detail-page">
                <div class="section-detail">
                    <form enctype="multipart/form-data" method="POST">
                        <label for="name">Tên danh mục</label>
                        <input type="text" name="name" id="name" value="<?php echo set_value('name'); ?>">
                        <?php echo form_error('name'); ?>

                        <!-- <label for="title">Slug ( Friendly_url )</label>
                        <input type="text" name="slug" id="slug"> -->

                        <label for="content">Mô tả</label>
                        <textarea name="content" id="content" class="ckeditor"><?php echo set_value('content'); ?></textarea>
                        <?php echo form_error('content'); ?>

                        <label>Hình ảnh</label>
                        <div id="uploadFile">
                            <input type="file" name="file" id="upload-thumb">
                            <!-- <input type="submit" name="btn-upload-thumb" value="Upload" id="btn-upload-thumb"> -->
                            <!-- <img src="public/images/img-thumb.png"> -->
                        </div>

                        <label>Danh mục cha</label>
                        <select name="parent_category_id">
                            <option value="">-- Chọn danh mục --</option>
                            <?php
                            if(!empty($data)){
                                foreach($data as $category){
                                ?>
                                <option value="<?php echo $category['category_id']; ?>"><?php echo $category['name']; ?></option>
                                <?php
                                }
                            }
                            ?>
                        </select>

                        <!-- <button type="submit" name="btn-submit" id="btn-submit">Cập nhật</button> -->
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