<fieldset>

    <div class="form-group">
        <label for="first_names">First Names *</label>
          <input type="text" readonly name="first_names" value="<?php echo $edit ? $candidate['first_names'] : ''; ?>" placeholder="First Names" class="form-control" required="required" id = "first_names" >
    </div> 

    <div class="form-group">
        <label for="last_name">Surname *</label>
        <input type="text" readonly name="last_name" value="<?php echo $edit ? $candidate['last_name'] : ''; ?>" placeholder="Last Name" class="form-control" required="required" id="last_name">
    </div> 

    <div class="form-group">
        <label for="id_number">ID Number/Passport Number *</label>
        <input type="text" readonly name="id_number" value="<?php echo $edit ? $candidate['id_number'] : ''; ?>" placeholder="ID Number or Passport Number" class="form-control" required="required" id="id_number">
    </div> 

    <div class="form-group">
        <label>Sex * </label>
        <label class="radio-inline">
            <input type="radio" readonly name="gender" value="Male" <?php echo ($edit &&$candidate['gender'] =='Male') ? "checked": "" ; ?> required="required"/> Male
        </label>
        <label class="radio-inline">
            <input type="radio" readonly name="gender" value="Female" <?php echo ($edit && $candidate['gender'] =='Female')? "checked": "" ; ?> required="required" id="female"/> Female
        </label>
        <label class="radio-inline">
            <input type="radio" readonly name="gender" value="Other" <?php echo ($edit && $candidate['gender'] =='Other')? "checked": "" ; ?> required="required" id="Other"/> Other
        </label>
    </div>

    <div class="form-group">
        <label for="hosting_company">Civil Society Partners Name * </label>
        <input type="text" readonly name="hosting_company" value="<?php echo $edit ? $candidate['hosting_company'] : ''; ?>" placeholder="Civil Society Partners Name" class="form-control" required="required" id="hosting_company">
    </div> 

    <div class="form-group">
        <label for="supervisor_name">Alternative Contact Persone</label>
        <input type="text" readonly name="supervisor_name" value="<?php echo $edit ? $candidate['supervisor_name'] : ''; ?>" placeholder="Alternative Contact Person" class="form-control" id="supervisor_name">
    </div> 

    <div class="form-group text-center">
        <label></label>
        <button type="submit" class="btn btn-warning" >Submit <span class="glyphicon glyphicon-send"></span></button>
    </div>           

</fieldset>