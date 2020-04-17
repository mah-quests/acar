<fieldset>
     <div class="col-lg-12">
            <h2 class="page-header">Company Details</h2>
    </div>

    <div class="form-group">
        <label for="ck_number">Company Registration *</label>
          <input type="text" name="ck_number" value="<?php echo $edit ? $companyDetails['ck_number'] : ''; ?>" placeholder="Company Registration Number" class="form-control" required="required" id = "ck_number" >
    </div> 

    <div class="form-group">
        <label for="business_name">Company Name *</label>
        <input type="text" name="business_name" value="<?php echo $edit ? $companyDetails['business_name'] : ''; ?>" placeholder="Company Name" class="form-control" required="required" id="business_name">
    </div> 

    <div class="form-group">
        <label for="address1">Address #1 *</label>
        <input type="text" name="address1" value="<?php echo $edit ? $companyDetails['address1'] : ''; ?>" placeholder="Address #1: Office Park Name / Street Name" class="form-control" required="required" id="address1">
    </div> 

    <div class="form-group">
        <label for="address2">Address #2 </label>
        <input type="text" name="address2" value="<?php echo $edit ? $companyDetails['address2'] : ''; ?>" placeholder="Address #2: Office Park Name / Street Name" class="form-control" id="address2">
    </div> 

    <div class="form-group">
        <label for="city">City *</label>
        <input type="text" name="city" value="<?php echo $edit ? $companyDetails['city'] : ''; ?>" placeholder="Town / City" class="form-control" required="required" id="city">
    </div> 

    <div class="form-group">
        <label for="postal_code">Postal Code *</label>
        <input type="text" name="postal_code" value="<?php echo $edit ? $companyDetails['postal_code'] : ''; ?>" placeholder="Postal Code" class="form-control" required="required" id="postal_code">
    </div> 

    <div class="form-group">
        <label for="phone_number">Office Number *</label>
        <input type="text" name="phone_number" value="<?php echo $edit ? $companyDetails['phone_number'] : ''; ?>" placeholder="Office Number" class="form-control" required="required" id="phone_number">
    </div> 

    <div class="form-group">
        <label for="email">Company Email Address</label>
        <input type="email" name="email" value="<?php echo $edit ? $companyDetails['email'] : ''; ?>" placeholder="Company Email Address, eg, info@example.com" class="form-control" id="email">
    </div> 

    <div class="form-group">
        <label for="web">Website URL</label>
        <input type="text" name="web" value="<?php echo $edit ? $companyDetails['web'] : ''; ?>" placeholder="Company Website URL, www.example.com" class="form-control" id="web">
    </div> 

    <div class="form-group">
        <label for="sdl_number">SDL Number</label>
        <input type="text" name="sdl_number" value="<?php echo $edit ? $companyDetails['sdl_number'] : ''; ?>" placeholder="Company SDL Number" class="form-control" id="sdl_number">
    </div> 

    <div class="form-group">
        <label for="paye_number">PAYE Number</label>
        <input type="text" name="paye_number" value="<?php echo $edit ? $companyDetails['paye_number'] : ''; ?>" placeholder="Company PAYE Number" class="form-control" id="paye_number">
    </div> 

    <div class="form-group">
        <label for="uif_number">UIF Number</label>
        <input type="text" name="uif_number" value="<?php echo $edit ? $companyDetails['uif_number'] : ''; ?>" placeholder="Company UIF Number" class="form-control" id="uif_number">
    </div> 

    <div class="form-group text-center">
        <label></label>
        <button type="submit" class="btn btn-warning" >Update <span class="glyphicon glyphicon-send"></span></button>
    </div>            
</fieldset>