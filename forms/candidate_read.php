<fieldset>
     <div class="col-lg-12">
            <h2 class="page-header">Partner Representative Information</h2>
    </div>

    <div class="form-group">
        <label for="first_names">First Names (*)</label>
          <input type="text" name="first_names" readonly value="<?php echo $edit ? $candidate['first_names'] : ''; ?>" placeholder="First Names" class="form-control" required="required" id = "first_names" >
    </div> 

    <div class="form-group">
        <label for="last_name">Surname (*)</label>
        <input type="text" name="last_name" readonly value="<?php echo $edit ? $candidate['last_name'] : ''; ?>" placeholder="Last Name" class="form-control" required="required" id="last_name">
    </div> 

    <div class="form-group">
        <label>Sex (*) </label><br>
        <label class="radio-inline">
            <input type="radio" name="gender" readonly value="Male" <?php echo ($edit &&$candidate['gender'] =='Male') ? "checked": "" ; ?> required="required"/> Male
        </label>
        <label class="radio-inline">
            <input type="radio" name="gender" readonly value="Female" <?php echo ($edit && $candidate['gender'] =='Female')? "checked": "" ; ?> required="required" id="female"/> Female
        </label>
        <label class="radio-inline">
            <input type="radio" name="gender" readonly value="Other" <?php echo ($edit && $candidate['gender'] =='Other')? "checked": "" ; ?> required="required" id="other"/> Other
        </label>
    </div>

    <div class="form-group">
        <label>Date of birth (mm/dd/yyyy) * </label>
        <input name="date_of_birth" readonly value="<?php echo $edit ? $candidate['date_of_birth'] : ''; ?>"  placeholder="Birth date" class="form-control" required="required"  type="date">
    </div>

    <div class="form-group">
        <label for="id_number">ID Number/Passport Number (*)</label>
        <input type="text" name="id_number" readonly value="<?php echo $edit ? $candidate['id_number'] : ''; ?>" placeholder="ID Number or Passport Number" class="form-control" required="required" id="id_number">
    </div> 

 <!--<div class="form-group">
        <label for="tax_ref">Tax Ref Number</label>
        <input type="text" name="tax_ref" readonly value="<?php echo $edit ? $internship['tax_ref'] : '00000'; ?>" placeholder="Candidate Tax Reference" class="form-control" id="tax_ref">
    </div> -->

    <div class="form-group">
        <label for="candidate_address">Home Address</label>
          <textarea name="candidate_address" placeholder="Candidate Home Address" class="form-control" id="candidate_address" ><?php echo ($edit)? $candidate['candidate_address'] : ''; ?>
          </textarea>
    </div>     

    <div class="form-group">
        <label for="email">Email</label>
            <input  type="email" name="email" readonly value="<?php echo $edit ? $candidate['email'] : ''; ?>" placeholder="E-Mail Address" class="form-control" id="email">
    </div>

    <div class="form-group">
        <label for="phone">Phone (*) </label>
            <input name="phone" readonly value="<?php echo $edit ? $candidate['phone'] : ''; ?>" placeholder="+27 82 345 6789" class="form-control"  type="text" required="required" id="phone">
    </div> 

     <div class="col-lg-12">
            <h2 class="page-header"> Civil Society Partner Details</h2>
    </div>

    <div class="form-group">
        <label for="hosting_company"> Civil Society Name</label>
        <input type="text" name="hosting_company" readonly value="<?php echo $edit ? $candidate['hosting_company'] : ''; ?>" placeholder="Civil Society Partners Name" class="form-control" id="hosting_company">
    </div> 

    <div class="form-group">
        <label for="hosting_address"> Company Address</label>
          <textarea name="hosting_address" placeholder="Civil Society Partners Address" class="form-control" id="hosting_address" ><?php echo ($edit)? $candidate['hosting_address'] : ''; ?>
          </textarea>
    </div> 

    <div class="form-group">
        <label for="supervisor_name">Alternative Contact Person</label>
        <input type="text" name="supervisor_name" readonly value="<?php echo $edit ? $candidate['supervisor_name'] : ''; ?>" placeholder="Alternative Contact Person Name" class="form-control" id="supervisor_name">
    </div> 

    <div class="form-group">
        <label for="supervisor_phone">Alternative Contact Person Phone Number</label>
        <input type="text" name="supervisor_phone" readonly value="<?php echo $edit ? $candidate['supervisor_phone'] : ''; ?>" placeholder="Alternative Contact Person Phone Numberr" class="form-control" id="supervisor_phone">
    </div> 

    <div class="form-group">
        <label for="supervisor_email">Alternative Contact Person Email Address</label>
        <input type="text" name="supervisor_email" readonly value="<?php echo $edit ? $candidate['supervisor_email'] : ''; ?>" placeholder="Alternative Contact Person Email Address" class="form-control" id="supervisor_email">
    </div> 

    <!-- <div class="col-lg-12">
            <h2 class="page-header">Employment Details</h2>
    </div>

    <div class="form-group">
        <label>Start Date (mm/dd/yyyy) *</label>
        <input name="employment_date" readonly value="<?php echo $edit ? $internship['employment_date'] : '00000'; ?>"  placeholder="Internship start date" class="form-control" required="required" type="date">
    </div>

    <div class="form-group">
        <label for="position">Partner Representative Position</label>
        <input type="text" name="position" readonly value="<?php echo $edit ? $internship['position'] : '00000'; ?>" placeholder="Internship Position" class="form-control" id="position">
    </div> 

    <div class="form-group">
        <label for="department">Department</label>
        <input type="text" name="department" readonly value="<?php echo $edit ? $internship['department'] : '00000'; ?>" placeholder="Hosting Department" class="form-control" id="department">
    </div> 

    <div class="form-group">
        <label for="salary_amount">Salary Amount</label>
        <input type="text" name="salary_amount" readonly value="<?php echo $edit ? $internship['salary_amount'] : '00000'; ?>" placeholder="Stipend Amount in ZAR" class="form-control" id="salary_amount">
    </div> 

     <div class="col-lg-12">
            <h2 class="page-header">Bank Account Details</h2>
    </div>

    <div class="form-group">
        <label for="account_owner">Account Holder Name (*)</label>
        <input type="text" name="account_owner" readonly value="<?php echo $edit ? $bankAccount['account_owner'] : '00000'; ?>" placeholder="Account Holder Name" required="required"  class="form-control" id="account_owner">
    </div> 

    <div class="form-group">
        <label for="bank_name">Bank Name (*)</label>
        <input type="text" name="bank_name" readonly value="<?php echo $edit ? $bankAccount['bank_name'] : '00000'; ?>" placeholder="Bank Name" class="form-control" required="required" id="bank_name">
    </div> 

    <div class="form-group">
        <label for="account_number">Account Number (*)</label>
        <input type="text" name="account_number" readonly value="<?php echo $edit ? $bankAccount['account_number'] : '000000'; ?>" placeholder="Account Number" required="required" class="form-control" id="account_number">
    </div> 
    
    <div class="form-group">
        <label for="branch_code">Branch Code (*)</label>
        <input type="text" name="branch_code" readonly value="<?php echo $edit ? $bankAccount['branch_code'] : '00000'; ?>" placeholder="Bank Branch Code" required="required" class="form-control" id="branch_code">
    </div> 

    <div class="form-group">
        <label for="branch_name">Branch Name</label>
        <input type="text" name="branch_name" readonly value="<?php echo $edit ? $bankAccount['branch_name'] : '00000'; ?>" placeholder="Bank Branch Name" class="form-control" id="branch_name">
    </div> 

     <div class="col-lg-12">
            <h2 class="page-header">Systems Login Details</h2>
    </div>

    <div class="form-group">
        <label class="col-md-6 control-label">User name (*)</label>
        <div class="col-md-6 inputGroupContainer">
            <div class="input-group">
                <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
                <input  type="text" name="user_name" placeholder="user name" class="form-control" required="required" readonly value="<?php echo ($edit) ? $systemsLogin['user_name'] : ''; ?>" autocomplete="yes">
            </div>
        </div>
    </div>
    -- Text input--
    <div class="form-group">
        <label class="col-md-6 control-label" >Password (*)</label>
        <div class="col-md-6 inputGroupContainer">
            <div class="input-group">
                <span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
                <input type="password" name="passwd" required="required" placeholder="Password " readonly value="<?php echo ($edit) ? $systemsLogin['passwd'] : ''; ?>" class="form-control" required="" autocomplete="yes">
            </div>
        </div>
    </div>
  -- radio checks --
    <div class="form-group">
        <label class="col-md-6 control-label">User type (*)</label>
        <div class="col-md-6">
            <div class="radio">
            </div>
            <div class="radio">
                <label>
                    <input type="radio" name="admin_type" readonly value="candidate" required="" <?php echo ($edit && $systemsLogin['admin_type'] =='candidate') ? "checked": "" ; ?> /> Partner Representative
                </label>
            </div>
        </div>
    </div>

    <div class="form-group text-center">
        <label></label>
        <button type="submit" class="btn btn-warning" >Save <span class="glyphicon glyphicon-send"></span></button>
    </div>       -->     
</fieldset>