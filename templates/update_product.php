<!-- Modal -->
<div class="modal fade" id="update_product" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header" style="background-color:#9ddfd3;">
        <h5 class="modal-title" id="exampleModalLabel">Update Product</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body" style="background-color:#dbf6e9;">
        <div class="modal-body">
          <form id="update_product_form" onsubmit="return false"  method='POST'>
            <div class="form-row">
              <div class="form-group col-md-6">
                <input type="hidden" name="productID" id="productID" value="">
                <label>Date</label>
                <input type="text" class="form-control" name="addedDate" id="addedDate" placeholder="Date" value="<?php echo date("Y-m-d"); ?>" readonly />
              </div>
              <div class="form-group col-md-6">
                <label>Porduct Name</label>
                <input type="text" class="form-control" name="updateProductName" id="updateProductName" placeholder="Product Name" required />
              </div>
            </div>
            <div class="form-group">
              <label>Category</label>
              <select class="form-control" id="selectUpdateCategory" name="selectUpdateCategory" required />

              </select>
            </div>
            <div class="form-group">
              <label>Location</label>
              <select class="form-control" id="selectUpdateLocation" name="selectUpdateLocation" required />

              </select>
            </div>
            <div class="form-row">
              <div class="form-group col-md-6">
                <label>Price</label>
                <input type="text" class="form-control" name="updateProductPrice" id="updateProductPrice" placeholder="Product Price" required />
              </div>
              <div class="form-group col-md-6">
                <label>Stock</label>
                <input type="text" class="form-control" name="updateProductStock" id="updateProductStock" placeholder="Product Stock" required />
              </div>
            </div>

            <div class="form-row">
              <div class="form-group col-md-12">
                <label>Set Stock Limit</label>
                <input type="text" class="form-control" name="updateProductStockLimit" id="updateProductStockLimit" placeholder="Stock Limit" required />
              </div>
            </div>
           

            <button type="submit" class="btn btn-primary">Update Product</button>
          </form>
        </div>
      </div>
      <div class="modal-footer" style="background-color:#9ddfd3;">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>

    </div>
  </div>
</div>