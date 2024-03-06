<?php
require_once('./../../config.php');
if(isset($_GET['id'])){
    $qry = $conn->query("SELECT p.*,c.name as category FROM `price_list` p inner join `category_list` c on p.category_id = c.id where p.id = '{$_GET['id']}'");
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
    #uni_modal .modal-footer{
        display:none;
    }
</style>
<div class="container-fluid">
    <div class="row">
            <dl>
                <dt class="text-muted">Category</dt>
                <dd class='pl-4 fs-4 fw-bold'><?= isset($category) ? $category : 'N/A' ?></dd>
                <dt class="text-muted">Size</dt>
                <dd class='pl-4 fs-4 fw-bold'><?= isset($size) ? $size : 'N/A' ?></dd>
                <dt class="text-muted">Price</dt>
                <dd class='pl-4 fs-4 fw-bold'><?= isset($price) ? number_format($price,2) : 'N/A' ?></dd>
                <dt class="text-muted">Status</dt>
                <dd class='pl-4 fs-4 fw-bold'>
                    <?php 
                        if(isset($status)){
                            switch($status){
                                case 0:
                                    echo '<span class="rounded-pill badge badge-danger bg-gradient-danger px-3">Inactive</span>';
                                    break;
                                case 1:
                                    echo '<span class="rounded-pill badge badge-success bg-gradient-primatealry px-3">Active</span>';
                                    break;
                            }
                        }
                    
                    ?>
                </dd>
            </dl>
    </div>
    <div class="text-right">
        <button class="btn btn-dark btn-sm btn-flat" type="button" data-dismiss="modal"><i class="fa fa-close"></i> Close</button>
    </div>
</div>
