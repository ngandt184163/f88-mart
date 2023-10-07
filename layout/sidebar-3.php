<div class="section" id="filter-product-wp">
    <div class="section-head">
        <h3 class="section-title">Bộ lọc</h3>
    </div>
    <div class="section-detail">
        <form method="POST" action="">
            <table>
                <thead>
                    <tr>
                        <td colspan="2">Giá</td>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td><input type="radio" name="filter" value="<?php echo set_value('filter') ?>"></td>
                        <td>Dưới 500.000đ</td>
                    </tr>
                    <tr>
                        <td><input type="radio" name="filter" value="<?php echo set_value('filter') ?>"></td>
                        <td>500.000đ - 1.000.000đ</td>
                    </tr>
                    <tr>
                        <td><input type="radio" name="filter" value="<?php echo set_value('filter') ?>"></td>
                        <td>1.000.000đ - 5.000.000đ</td>
                    </tr>
                    <tr>
                        <td><input type="radio" name="filter" value="<?php echo set_value('filter') ?>"></td>
                        <td>5.000.000đ - 10.000.000đ</td>
                    </tr>
                    <tr>
                        <td><input type="radio" name="filter" value="<?php echo set_value('filter') ?>"></td>
                        <td>Trên 10.000.000đ</td>
                    </tr>
                    <tr>                
                        <td><input type="submit" id="sm-s" name="" value="Lọc"></td>
                    </tr>
                </tbody>
            </table>
        </form>

        <form method="POST" action="">
            <table>
                <thead>
                    <tr>
                        <td colspan="2">Khoảng giá</td>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td><input type="number" name="filter_from_price" value="<?php echo set_value('filter_from_price') ?>" placeholder="₫ TỪ"></td>
                    </tr>
                    <tr>                        
                        <td><input type="number" name="filter_to_price" value="<?php echo set_value('filter_to_price') ?>" placeholder="₫ ĐẾN"></td>
                    </tr>
                    <tr>                
                        <td><input type="submit" id="sm-s" name="btn-filter-price" value="Áp dụng"></td>
                    </tr>
                </tbody>
            </table>
        </form>
            <!-- <table>
                <thead>
                    <tr>
                        <td colspan="2">Hãng</td>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td><input type="radio" name="r-brand"></td>
                        <td>Acer</td>
                    </tr>
                    <tr>
                        <td><input type="radio" name="r-brand"></td>
                        <td>Apple</td>
                    </tr>
                    <tr>
                        <td><input type="radio" name="r-brand"></td>
                        <td>Hp</td>
                    </tr>
                    <tr>
                        <td><input type="radio" name="r-brand"></td>
                        <td>Lenovo</td>
                    </tr>
                    <tr>
                        <td><input type="radio" name="r-brand"></td>
                        <td>Samsung</td>
                    </tr>
                    <tr>
                        <td><input type="radio" name="r-brand"></td>
                        <td>Toshiba</td>
                    </tr>
                </tbody>
            </table>
            <table>
                <thead>
                    <tr>
                        <td colspan="2">Loại</td>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td><input type="radio" name="r-price"></td>
                        <td>Điện thoại</td>
                    </tr>
                    <tr>
                        <td><input type="radio" name="r-price"></td>
                        <td>Laptop</td>
                    </tr>
                </tbody>
            </table> -->
        
    </div>
</div>