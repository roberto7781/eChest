<!-- Modal -->
<div class="modal fade" id="form_category" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" >
  <div class="modal-dialog" role="document">
    <div class="modal-content" >
      <div class="modal-header" style ="background-color:#9ddfd3;">
        <h5 class="modal-title" id="exampleModalLabel">Category</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body" style ="background-color:#dbf6e9;">
        <form id="category_form" onsubmit="return false">
          <div class="form-group">
            <label>Category Name</label>
            <input type="text" class="form-control" name="categoryName" id="categoryName" placeholder="Category Name">
            <small id="categoryError" class="form-text text-muted"></small>
          </div>
          <div class="form-group">
            <label>Parent Category</label>
            <select class="form-control" id="parentCategory" name="parentCategory">
        
            </select>
          </div>
         
          <button type="submit" class="btn btn-primary">Add</button>
        </form>
      </div>
      <div class="modal-footer" style ="background-color:#9ddfd3;">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>