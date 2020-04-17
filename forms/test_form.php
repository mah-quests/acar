<fieldset>
     <div class="col-lg-12">
            <h2 class="page-header">Candidate Information</h2>
    </div>

    <div class="form-group">
        <label for="first_names">First Names (*)</label>
          <input type="text" name="first_names" value="<?php echo $edit ? $candidate['first_names'] : ''; ?>" placeholder="First Names" class="form-control" required="required" id = "first_names" >
    </div> 

    <div class="form-group">
        <label for="last_name">Surname (*)</label>
        <input type="text" name="last_name" value="<?php echo $edit ? $candidate['last_name'] : ''; ?>" placeholder="Last Name" class="form-control" required="required" id="last_name">
    </div> 

    <div class="form-group">
        <label>Gender (*) </label><br>
        <label class="radio-inline">
            <input type="radio" name="gender" value="Male" <?php echo ($edit &&$candidate['gender'] =='Male') ? "checked": "" ; ?> required="required"/> Male
        </label>
        <label class="radio-inline">
            <input type="radio" name="gender" value="Female" <?php echo ($edit && $candidate['gender'] =='Female')? "checked": "" ; ?> required="required" id="female"/> Female
        </label>
    </div>

    <div class="form-group">
        <label>Date of birth (mm/dd/yyyy) * </label>
        <input name="date_of_birth" value="<?php echo $edit ? $candidate['date_of_birth'] : ''; ?>"  placeholder="Birth date" class="form-control" required="required"  type="date">
    </div>

    <div class="form-group">
        <label for="id_number">ID Number/Passport Number (*)</label>
        <input type="text" name="id_number" value="<?php echo $edit ? $candidate['id_number'] : ''; ?>" placeholder="ID Number or Passport Number" class="form-control" required="required" id="id_number">
    </div> 

    <div class="form-group">
        <label for="email">Email</label>
            <input  type="email" name="email" value="<?php echo $edit ? $candidate['email'] : ''; ?>" placeholder="E-Mail Address" class="form-control" id="email">
    </div>

    <div class="form-group">
        <label for="phone">Phone (*) </label>
            <input name="phone" value="<?php echo $edit ? $candidate['phone'] : ''; ?>" placeholder="+27 82 345 6789" class="form-control"  type="text" required="required" id="phone">
    </div> 

     <div class="col-lg-12">
            <h2 class="page-header">Hosting Company Details</h2>
    </div>

    <div class="form-group">
        <label for="hosting_company">Hosting Company Name</label>
        <input type="text" name="hosting_company" value="<?php echo $edit ? $candidate['hosting_company'] : ''; ?>" placeholder="Hosting Company Name" class="form-control" id="hosting_company">
    </div> 

    <div class="form-group">
        <label for="hosting_address">Hosting Company Address</label>
          <textarea name="hosting_address" placeholder="Hosting Company Address" class="form-control" id="hosting_address" ><?php echo ($edit)? $candidate['hosting_address'] : ''; ?>
          </textarea>
    </div> 

    <div class="form-group">
        <label for="supervisor_name">Direct Supervisor Name</label>
        <input type="text" name="supervisor_name" value="<?php echo $edit ? $candidate['supervisor_name'] : ''; ?>" placeholder="Hosting Supervisor Name" class="form-control" id="supervisor_name">
    </div> 

    <div class="form-group">
        <label for="supervisor_phone">Supervisor Email Phone Number</label>
        <input type="text" name="supervisor_phone" value="<?php echo $edit ? $candidate['supervisor_phone'] : ''; ?>" placeholder="Hosting Supervisor Phone Number" class="form-control" id="supervisor_phone">
    </div> 

    <div class="form-group">
        <label for="supervisor_email">Supervisor Email Address</label>
        <input type="text" name="supervisor_email" value="<?php echo $edit ? $candidate['supervisor_email'] : ''; ?>" placeholder="Hosting Supervisor Email Address" class="form-control" id="supervisor_email">
    </div> 

     <div class="col-lg-12">
            <h2 class="page-header">Internship Details</h2>
    </div>

    <div class="form-group">
        <label>Start Date (mm/dd/yyyy) *</label>
        <input name="employment_date" value="<?php echo $edit ? $internship['employment_date'] : ''; ?>"  placeholder="Internship start date" class="form-control" required="required" type="date">
    </div>

    <div class="form-group">
        <label for="position">Internship Position</label>
        <input type="text" name="position" value="<?php echo $edit ? $internship['position'] : ''; ?>" placeholder="Internship Position" class="form-control" id="position">
    </div> 

    <div class="form-group">
        <label for="department">Department</label>
        <input type="text" name="department" value="<?php echo $edit ? $internship['department'] : ''; ?>" placeholder="Hosting Department" class="form-control" id="department">
    </div> 

    <div class="form-group">
        <label for="salary_amount">Stipend Amount</label>
        <input type="text" name="salary_amount" value="<?php echo $edit ? $internship['salary_amount'] : ''; ?>" placeholder="Hosting Supervisor Email Address" class="form-control" id="salary_amount">
    </div> 

     <div class="col-lg-12">
            <h2 class="page-header">Bank Account Details</h2>
    </div>

    <div class="form-group">
        <label for="account_owner">Account Holder Name (*)</label>
        <input type="text" name="account_owner" value="<?php echo $edit ? $bankAccount['account_owner'] : ''; ?>" placeholder="Account Holder Name" required="required"  class="form-control" id="account_owner">
    </div> 

    <div class="form-group">
        <label for="bank_name">Bank Name (*)</label>
        <input type="text" name="bank_name" value="<?php echo $edit ? $bankAccount['bank_name'] : ''; ?>" placeholder="Bank Name" class="form-control" required="required" id="bank_name">
    </div> 

    <div class="form-group">
        <label for="account_number">Account Number (*)</label>
        <input type="text" name="account_number" value="<?php echo $edit ? $bankAccount['account_number'] : ''; ?>" placeholder="Account Number" required="required" class="form-control" id="account_number">
    </div> 
    
    <div class="form-group">
        <label for="branch_code">Branch Code (*)</label>
        <input type="text" name="branch_code" value="<?php echo $edit ? $bankAccount['branch_code'] : ''; ?>" placeholder="Bank Branch Name" required="required" class="form-control" id="branch_code">
    </div> 

    <div class="form-group">
        <label for="branch_name">Branch Name</label>
        <input type="text" name="branch_name" value="<?php echo $edit ? $bankAccount['branch_name'] : ''; ?>" placeholder="Bank Branch Name" class="form-control" id="branch_name">
    </div> 


    <div class="form-group">
        <label for="leave_days">Leave Days Left</label>
        <input type="text" name="leave_days" value="<?php echo $edit ? $internship['leave_days'] : ''; ?>" placeholder="Hosting Supervisor Email Address" class="form-control" id="leave_days">
    </div> 

     <div class="col-lg-12">
            <h2 class="page-header">Systems Login Details</h2>
    </div>

    <div class="form-group">
        <label class="col-md-6 control-label">User name (*)</label>
        <div class="col-md-6 inputGroupContainer">
            <div class="input-group">
                <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
                <input  type="text" name="user_name" placeholder="user name" class="form-control" required="required" value="<?php echo ($edit) ? $candidate['user_name'] : ''; ?>" autocomplete="yes">
            </div>
        </div>
    </div>
    <!-- Text input-->
    <div class="form-group">
        <label class="col-md-6 control-label" >Password (*)</label>
        <div class="col-md-6 inputGroupContainer">
            <div class="input-group">
                <span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
                <input type="password" name="passwd" required="required" placeholder="Password " value="<?php echo ($edit) ? $candidate['passwd'] : ''; ?>" class="form-control" required="" autocomplete="yes">
            </div>
        </div>
    </div>
    <!-- radio checks -->
    <div class="form-group">
        <label class="col-md-6 control-label">User type (*)</label>
        <div class="col-md-6">
            <div class="radio">
            </div>
            <div class="radio">
                <label>
                    <input type="radio" name="admin_type" value="candidate" required="" <?php echo ($edit && $systemsLogin['admin_type'] =='admin') ? "checked": "" ; ?> /> Candidate
                </label>
            </div>
        </div>
    </div>

    <div class="form-group text-center">
        <label></label>
        <button type="submit" class="btn btn-warning" >Save <span class="glyphicon glyphicon-send"></span></button>
    </div>            
</fieldset>