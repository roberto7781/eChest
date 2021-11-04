
<!-- Modal -->
<div class="modal fade" id="update_location" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header" style ="background-color:#9ddfd3;">
        <h5 class="modal-title" id="exampleModalLabel">Update Location</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body" style ="background-color:#dbf6e9;">
      <div class="modal-body" >
        <form id="update_location_form" onsubmit="return false">
          <div class="form-group">
            <label>Location Name</label>
            <input type="hidden" name="locationID" id="locationID" value="">
            <input type="text" class="form-control" name="updateLocationName" id="updateLocationName" placeholder="Location Name">
            <small id="updateLocationError" class="form-text text-muted"></small>
          </div>
         
          <button type="submit" class="btn btn-primary">Update</button>
        </form>
      </div>
      </div>
      <div class="modal-footer" style ="background-color:#9ddfd3;">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
    
  </div>
</div>
</div>