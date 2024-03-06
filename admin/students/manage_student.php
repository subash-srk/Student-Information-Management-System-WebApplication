<?php
if(isset($_GET['id'])){
    $qry = $conn->query("SELECT * FROM `student_list` where id = '{$_GET['id']}'");
    if($qry->num_rows > 0){
        $res = $qry->fetch_array();
        foreach($res as $k => $v){
            if(!is_numeric($k))
            $$k = $v;
        }
    }
}
?>
<div class="content py-3">
    <div class="card card-outline card-primary shadow rounded-0">
        <div class="card-header">
            <h3 class="card-title"><b><?= isset($id) ? "Update Student Details - ". $roll : "New Student" ?></b></h3>
        </div>
        <div class="card-body">
            <div class="container-fluid">
                <form action="" id="student_form">
                <input type="hidden" name="id" value="<?php echo isset($id) ? $id : '' ?>">
                    <fieldset class="border-bottom">
                        <div class="row">
                            <div class="form-group col-md-4">
                                <label for="roll" class="control-label">Student Register No.</label>
                                <input type="text" name="roll" id="roll" autofocus value="<?= isset($roll) ? $roll : "" ?>" class="form-control form-control-sm rounded-0" required>
                            </div>
                            <div class="form-group col-md-4">
                                <label for="dept" class="control-label">Department</label>
                                <select name="dept" id="dept" value="<?= isset($dept) ? $dept : "" ?>" class="form-control form-control-sm rounded-0" required>
                                    <option <?= isset($dept) && $dept == 'CIVIL' ? 'selected' : '' ?>>CIVIL</option>
                                    <option <?= isset($dept) && $dept == 'MECH' ? 'selected' : '' ?>>MECH</option>
                                    <option <?= isset($dept) && $dept == 'CSE' ? 'selected' : '' ?>>CSE</option>
                                    <option <?= isset($dept) && $dept == 'EEE' ? 'selected' : '' ?>>EEE</option>
                                    <option <?= isset($dept) && $dept == 'ECE' ? 'selected' : '' ?>>ECE</option>
                                </select>
                            </div>  
                        </div>
                        <div class="row">
                            <div class="form-group col-md-4">
                                <label for="firstname" class="control-label">First Name</label>
                                <input type="text" name="firstname" id="firstname" value="<?= isset($firstname) ? $firstname : "" ?>" class="form-control form-control-sm rounded-0" required>
                            </div>
                            <div class="form-group col-md-4">
                                <label for="middlename" class="control-label">Middle Name</label>
                                <input type="text" name="middlename" id="middlename" value="<?= isset($middlename) ? $middlename : "" ?>" class="form-control form-control-sm rounded-0" placeholder='optional'>
                            </div>
                            <div class="form-group col-md-4">
                                <label for="lastname" class="control-label">Last Name</label>
                                <input type="text" name="lastname" id="lastname" autofocus value="<?= isset($lastname) ? $lastname : "" ?>" class="form-control form-control-sm rounded-0" placeholder='optional'>
                            </div>
                            <div class="form-group col-md-4">
                                <label for="fathername" class="control-label">Father Name</label>
                                <input type="text" name="fathername" id="fathername" value="<?= isset($fathername) ? $fathername : "" ?>" class="form-control form-control-sm rounded-0">
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-md-4">
                                <label for="gender" class="control-label">Gender</label>
                                <select name="gender" id="gender" value="<?= isset($gender) ? $gender : "" ?>" class="form-control form-control-sm rounded-0" required>
                                    <option <?= isset($gender) && $gender == 'Male' ? 'selected' : '' ?>>Male</option>
                                    <option <?= isset($gender) && $gender == 'Female' ? 'selected' : '' ?>>Female</option>
                                </select>
                            </div>
                            <div class="form-group col-md-4">
                                <label for="dob" class="control-label">Date of Birth</label>
                                <input type="date" name="dob" id="dob" value="<?= isset($dob) ? $dob : "" ?>" class="form-control form-control-sm rounded-0" required>
                            </div>
                            <div class="form-group col-md-4">
                                <label for="contact" class="control-label">Contact</label>
                                <input type="text" name="contact" id="contact" value="<?= isset($contact) ? $contact : "" ?>" class="form-control form-control-sm rounded-0" required>
                            </div>
                            <div class="form-group col-md-4">
                                <label for="email" class="control-label">Email ID</label>
                                <input type="text" name="email" id="email" value="<?= isset($email) ? $email : "" ?>" class="form-control form-control-sm rounded-0" required>
                            </div>               
                        </div>

                        <div class="row">
                            <div class="form-group col-md-12">
                                <label for="present_address" class="control-label">Present Address</label>
                                <textarea rows="3" name="present_address" id="present_address" class="form-control form-control-sm rounded-0" required><?= isset($present_address) ? $present_address : "" ?></textarea>
                            </div>
                        </div>

                        <div class="row">
                            <div class="form-group col-md-12">
                                <label for="permanent_address" class="control-label">Permanent Address</label>
                                <textarea rows="3" name="permanent_address" id="permanent_address" class="form-control form-control-sm rounded-0" required><?= isset($permanent_address) ? $permanent_address : "" ?></textarea>
                            </div>
                        </div>
                    </fieldset>
                </form>
            </div>
        </div>
        <div class="card-footer text-right">
            <button class="btn btn-flat btn-primary btn-sm" type="submit" form="student_form">Save Student Details</button>
            <a href="./?page=students" class="btn btn-flat btn-default border btn-sm">Cancel</a>
        </div>
    </div>
</div>
<script>
    $(function(){
        $('#student_form').submit(function(e){
            e.preventDefault();
            var _this = $(this)
            $('.pop-msg').remove()
            var el = $('<div>')
                el.addClass("pop-msg alert")
                el.hide()
            start_loader();
            $.ajax({
                url:_base_url_+"classes/Master.php?f=save_student",
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
                        location.href="./?page=students/view_student&id="+resp.sid;
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