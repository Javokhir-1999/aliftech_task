<!-- Modal - Article -->
<div class="modal fade" id="addContact" tabindex="-1" aria-labelledby="addContactlLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="addContactlLabel">Create Contact</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <div class="input-group mb-3">
          <label class="form-label">Name:</label> 
          <input name="name" type="text" id="name" class="form-control" placeholder="Lee Jeyong" aria-label="Contactname" aria-describedby="basic-addon1">
        </div>
        <div class="input-group mb-3">
        <label class="form-label">Phone:</label>
          <input type="phone" id="yourNumber" name="phone" id="phone" onkeyup="this.value = this.value.replace (/[^0-9+]/, '')"       
              placeholder="+998......" maxlength="13" class="form-control" id="message-text" />
        </div>
        <div class="input-group mb-3">
          <label class="form-label">Email:</label>
          <input type="text" name="email" id="email" class="form-control" placeholder="demo@email.adress" aria-label="Email adress" aria-describedby="basic-addon2">
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-success add-contacts">Add</button>
      </div>
    </div>
  </div>
</div>