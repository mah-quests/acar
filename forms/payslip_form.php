<fieldset>

    <div class="form-group">
        <label for="first_names">First Names</label>
          <input type="text" readonly name="first_names" value="<?php echo $create ? $candidate['first_names'] : ''; ?>" placeholder="First Names" class="form-control" required="required" id = "first_names" >
    </div> 

    <div class="form-group">
        <label for="last_name">Surname *</label>
        <input type="text" readonly name="last_name" value="<?php echo $create ? $candidate['last_name'] : ''; ?>" placeholder="Last Name" class="form-control" required="required" id="last_name">
    </div> 

    <div class="form-group">
        <label for="id_number">ID Number/Passport Number *</label>
        <input type="text" readonly name="id_number" value="<?php echo $create ? $candidate['id_number'] : ''; ?>" placeholder="ID Number or Passport Number" class="form-control" required="required" id="id_number">
    </div>

    <div class="form-group">
        <label for="hosting_company">Hosting Company Name *</label>
        <input type="text" readonly name="hosting_company" value="<?php echo $create ? $candidate['hosting_company'] : ''; ?>" placeholder="Hosting Company Name" class="form-control" required="required" id="hosting_company">
    </div> 

    <div class="form-group">
        <label>Payslip Date (mm/dd/yyyy) * </label>
        <input name="payslip_date" value="<?php echo $edit ? $payslip['payslip_date'] : ''; ?>"  placeholder="Payslip date" class="form-control" required="required"  type="date">
    </div>

    <div class="form-group">
        <label for="gross">Stipend Amount *</label>
        <input type="text" name="gross" value="<?php echo $create ? $payslip['gross'] : ''; ?>" placeholder="Stipend Amount" class="form-control" id="gross" required="required" >
    </div> 

    <div class="form-group">
        <label for="approved_leave">Approved Leave Days *</label>
        <input type="text" name="approved_leave" value="<?php echo $create ? $payslip['approved_leave'] : ''; ?>" placeholder="Number of Approved Leave Days" class="form-control" id="approved_leave" required="required">
    </div>     

    <div class="form-group">
        <label for="commission">Commission </label>
        <input type="text" name="commission" value="<?php echo $create ? $payslip['commission'] : ''; ?>" placeholder="Commission Amount" class="form-control" id="commission" >
    </div> 

    <div class="form-group">
        <label for="overtime">Overtime </label>
        <input type="text" name="overtime" value="<?php echo $create ? $payslip['overtime'] : ''; ?>" placeholder="Overtime Amount" class="form-control" id="overtime" >
    </div> 

    <div class="form-group">
        <label for="bonus">Bonus </label>
        <input type="text" name="bonus" value="<?php echo $create ? $payslip['bonus'] : ''; ?>" placeholder="Bonus Amount" class="form-control" id="bonus">
    </div> 

    <div class="form-group">
        <label for="other">Other </label>
        <input type="text" name="other" value="<?php echo $create ? $payslip['other'] : ''; ?>" placeholder="Bonus Amount" class="form-control" id="other">
    </div> 

    <div class="form-group text-center">
        <label></label>
        <button type="submit" class="btn btn-warning" >Submit <span class="glyphicon glyphicon-send"></span></button>
    </div>           

</fieldset>