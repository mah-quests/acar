<fieldset>

    <div class="form-group">
        <label for="first_names">First Names</label>
          <input type="text" name="first_names" readonly value="<?php echo $edit ? $candidate['first_names'] : ''; ?>" placeholder="First Names" class="form-control" required="required" id = "first_names" >
    </div> 

    <div class="form-group">
        <label for="last_name">Surname</label>
        <input type="text" name="last_name" readonly value="<?php echo $edit ? $candidate['last_name'] : ''; ?>" placeholder="Last Name" class="form-control" required="required" id="last_name">
    </div> 

    <div class="form-group">
        <label for="id_number">ID Number / Passport Number</label>
        <input type="text" name="id_number" readonly value="<?php echo $edit ? $candidate['id_number'] : ''; ?>" placeholder="ID Number or Passport Number" class="form-control" required="required" id="id_number">
    </div> 

    <div class="form-group">
        <label for="hosting_company">Civil Society Partners Name</label>
        <input type="text" name="hosting_company" readonly value="<?php echo $edit ? $candidate['hosting_company'] : ''; ?>" placeholder="Civil Society Partners Name" class="form-control" required="required" id="hosting_company">
    </div> 

    <div class="form-group">
        <label for="supervisor_name">Alternative Contact Person</label>
        <input type="text" name="supervisor_name" readonly value="<?php echo $edit ? $candidate['supervisor_name'] : ''; ?>" placeholder="Alternative Contact Person" class="form-control" id="supervisor_name">
    </div> 

    <div class="form-group">
        <label for="created_at">Check In (dates & times)</label>
    </div> 
         
</fieldset>