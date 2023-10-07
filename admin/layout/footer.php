<div id="footer-wp">
    <div class="wp-inner">
        <p id="copyright">2023 © Admin by 20184163</p>
    </div>
</div>
</div>
</div>
</body>

<script>
    $(document).ready(function () {
        var base_url = "<?php echo base_url(); ?>";
        var sale_id = "<?php if(!empty($sale)) echo $sale['sale_id']; ?>"
        updateStatusSale(base_url, sale_id);
    });
    
</script>

</html>