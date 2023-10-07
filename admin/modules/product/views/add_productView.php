
<?php
    get_header();
?>
<div id="main-content-wp" class="add-cat-page">
    <div class="wrap clearfix">
        <?php get_sidebar(); ?>
        <div id="content" class="fl-right">      
            <div class="section" id="title-page">
                <div class="clearfix">
                    <h3 id="index" class="fl-left">THÊM SẢN PHẨM</h3>
                </div>
            </div>
            <div class="section" id="detail-page">
                <div class="section-detail">
                    <form enctype="multipart/form-data" method="POST">
                        <label for="name">Tên sản phẩm</label>
                        <input type="text" name="name" id="name" value="<?php echo set_value('name'); ?>">
                        <?php echo form_error('name'); ?>

                        <label for="price">Giá sản phẩm</label>
                        <input type="number" name="price" id="price" value="<?php echo set_value('price'); ?>">
                        <?php echo form_error('price'); ?>

                        <label for="total">So luong</label>
                        <input type="number" name="total" id="total" value="<?php echo set_value('total'); ?>">
                        <?php echo form_error('total'); ?>

                        <label for="desc">Mô tả ngắn</label>
                        <textarea name="desc" id="desc" class="ckeditor"><?php echo set_value('desc'); ?></textarea>
                        <?php echo form_error('desc'); ?>

                        <label for="content">Chi tiết</label>
                        <textarea name="content" id="content" class="ckeditor"><?php echo set_value('content'); ?></textarea>
                        <?php echo form_error('content'); ?>

                        <label>Hình ảnh</label>
                        <div id="uploadFile">
                            <input type="file" name="file" id="upload-thumb">
                        </div>

                        <label>Danh mục sản phẩm</label>
                        <select name="category_id">
                            <option value="">-- Chọn danh mục --</option>
                            <?php
                            if(!empty($data)){
                                foreach($data as $category){
                                ?>
                                <option <?php if(set_value("category_id") == $category['category_id']) echo "selected='selected'"; ?> value="<?php echo $category['category_id']; ?>"><?php echo $category['name']; ?></option>
                                <?php
                                }
                            }
                            ?>
                        </select>
                        <?php echo form_error('category_id'); ?>

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