<?php
require_once('../../config.php');
if(isset($_GET['id'])){
    $qry = $conn->query("SELECT * FROM `price_list` where id = '{$_GET['id']}'");
    if($qry->num_rows > 0){
        $res = $qry->fetch_array();
        foreach($res as $k => $v){
            if(!is_numeric($k))
            $$k = $v;
        }
    }
}
?>
<style>
	img#cimg{
		height: 17vh;
		width: 25vw;
		object-fit: scale-down;
	}
</style>
<div class="container-fluid">
    <form action="" id="price-form">
        <input type="hidden" name="id" value="<?php echo isset($id) ? $id : '' ?>">
        <div class="form-group">
            <label for="category_id" class="control-label">Category</label>
            <select name="category_id" id="category_id" class="form-control form-control-border select2" required>
                <option value="" <?= !isset($category_id) ? 'selected' : "" ?> disabled></option>
                <?php 
                $categories = $conn->query("SELECT * FROM `category_list` where `status` = 1 and `delete_flag` = 0 ".(isset($category_id) ? " or id = '{$category_id}' " : "")." order by `name` asc ");
                while($row = $categories->fetch_assoc()):
                ?>
                    <option value="<?= $row['id'] ?>" <?= isset($category_id) && $category_id == $row['id'] ? "selected" : "" ?>><?= $row['name'] ?><?= ($row['delete_flag'] == 1) ? " <small class='text-muted'>(deleted)</small>" : "" ?></option>
                <?php endwhile; ?>
            </select>
        </div>
        <div class="form-group">
            <label for="size" class="control-label">Size</label>
            <input type="text" name="size" id="size" class="form-control form-control-border" placeholder="Enter Size" value ="<?php echo isset($size) ? $size : '' ?>" required>
        </div>
        <div class="form-group">
            <label for="price" class="control-label">Price</label>
            <input type="number" step="any" name="price" id="price" class="form-control form-control-border" placeholder="Enter Price" value ="<?php echo isset($price) ? $price : 0 ?>" required>
        </div>
        <div class="form-group">
            <label for="status" class="control-label">Status</label>
            <select name="status" id="status" class="form-control form-control-sm form-control-border" required>
                <option value="1" <?= isset($status) && $status == 1 ? 'selected' : '' ?>>Active</option>
                <option value="0" <?= isset($status) && $status == 0 ? 'selected' : '' ?>>Inactive</option>
            </select>
        </div>
    </form>
</div>
<script>
    $(function(){
        $('#uni_modal').on('shown.bs.modal',function(){
            $('.select2').select2({
                placeholder:'Please select here',
                width:'100%',
                dropdownParent: $('#uni_modal')
            })
        })
        $('#uni_modal #price-form').submit(function(e){
            e.preventDefault();
            var _this = $(this)
            $('.pop-msg').remove()
            var el = $('<div>')
                el.addClass("pop-msg alert")
                el.hide()
            start_loader();
            $.ajax({
                url:_base_url_+"classes/Master.php?f=save_price",
				data: new FormData($(this)[0]),
                cache: false,
                contentType: false,
                processData: false,
                method: 'POST',
                type: 'POST',
                dataType: 'json',
				error:err=>{
					console.log(err)
					alert_toast("An error occured",'error');
					end_loader();
				},
                success:function(resp){
                    if(resp.status == 'success'){
                        location.reload();
                    }else if(!!resp.msg){
                        el.addClass("alert-danger")
                        el.text(resp.msg)
                        _this.prepend(el)
                    }else{
                        el.addClass("alert-danger")
                        el.text("An error occurred due to unknown reason.")
                        _this.prepend(el)
                    }
                    el.show('slow')
                    $('html,body,.modal').animate({scrollTop:0},'fast')
                    end_loader();
                }
            })
        })
    })
</script>