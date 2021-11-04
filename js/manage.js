$(document).ready(function () {
  var DOMAIN = "";
  var name = "";
  var Toast = Swal.mixin({
    toast: true,
    position: "top-end",
    showConfirmButton: false,
    timer: 3000,
  });



    //Fetch Category


    function fetchCategory() {
      $.ajax({
        url: DOMAIN + "/includes/process.php",
        method: "POST",
        data: {
          getCategory: 1,
        },
        success: function (data) {
          var root = "<option value='0'>Root</option>";
          var choose = "<option value=''>Choose Category</option>";
          //  console.log(data);
          $("#updateParentCategory").html(root + data);
          $("#selectUpdateCategory").html(choose + data);
  
          $("#parentCategory").html(root + data);
          $("#selectCategory").html(choose + data);
        },
      });
    }

  function fetchUser() {
    $.ajax({
      url: DOMAIN + "/includes/process.php",
      method: "POST",
      data: {
        getUser: 1,
      },
      success: function (data) {
        // alert(logEmail);
        // alert(data);
        $("#profileInformation").html(data);
      },
    });
  }

  function fetchLocation() {
    $.ajax({
      url: DOMAIN + "/includes/process.php",
      method: "POST",
      data: {
        getLocation: 1,
      },
      success: function (data) {
        var choose = "<option value=''>Choose Location</option>";
        // alert(data);
        $("#selectUpdateLocation").html(choose + data);
        $("#selectLocation").html(choose + data);
      },
    });
  }

  fetchUser();
  fetchCategory();
  fetchLocation();

  // Manage Category
  manageCategory(1);

  function manageCategory(pn) {
    $.ajax({
      url: DOMAIN + "/includes/process.php",
      method: "POST",
      data: {
        manageCategory: 1,
        pageno: pn,
      },
      success: function (data) {
        $("#getCategory").html(data);
        // alert(data);
      },
    });
  }

  function relaunchCategory(pn) {
    $.ajax({
      url: DOMAIN + "/includes/process.php",
      method: "POST",
      data: {
        relaunchCategory: 1,
        pageno: pn,
      },
      success: function (data) {
        $("#getCategory").html(data);
        // alert(data);
      },
    });
  }

  // $("body").delegate(".page-link", "click", function () {
  //   var pn = $(this).attr("pn");
  //   manageCategory(pn);
  // })






    //DELETE CATEGORY

    $("body").delegate(".del_cat", "click", function () {
      var did = $(this).attr("did");
      name = $(this).attr("cim");
      if (confirm("Are you sure You want to delete this category?")) {
        $.ajax({
          url: DOMAIN + "/includes/process.php",
          method: "POST",
          data: {
            deleteCategory: 1,
            id: did,
            cname: name,
          },
          success: function (data) {
            if (data == "DEPENDENT_CATEGORY") {
              Toast.fire({
                icon: "error",
                title: name + " is a parent category",
              });
              // alert("Sorry You can't delete this category!");
            } else if (data == "CATEGORY_DELETED") {
              Toast.fire({
                icon: "success",
                title: name + " has been DELETED",
              });
              $("#getCategory").children("tr").remove();
              $("#table").dataTable().fnDestroy();
              fetchCategory();
              relaunchCategory(1);
            } else if (data == "DELETED") {
              Toast.fire({
                icon: "success",
                title: name + " has been DELETED",
              });
              $("#getCategory").children("tr").remove();
              $("#table").dataTable().fnDestroy();
              fetchCategory();
              relaunchCategory(1);
            } else {
              Toast.fire({
                icon: "error",
                title:
                  name + " CAN'T be DELTED because one of the product use it",
              });
            }
          },
        });
      }
    });

  //UPDATE CATEGORY
  $("body").delegate(".editCat", "click", function () {
    var eid = $(this).attr("eid");
    $.ajax({
      url: DOMAIN + "/includes/process.php",
      method: "POST",
      dataType: "json",
      data: {
        updateCategory: 1,
        id: eid,
      },
      success: function (data) {
        $("#categoryID").val(data["categoryID"]);
        $("#updateCategoryName").val(data["categoryName"]);
        $("#updateParent").val(data["parentCategory"]);
        name = $("#updateCategoryName").val();
      },
    });
  });
  //UPDATING CATEGORY
  $("#update_category_form").on("submit", function () {
    if ($("#updateCategoryName").val() == "") {
      $("#updateCategoryName").addClass("border-danger");
      $("#updateCategoryError").html(
        "<span class='text-danger'>Please Enter Category Name</span>"
      );
    } else {
      $.ajax({
        url: DOMAIN + "/includes/process.php",
        method: "POST",
        data: $("#update_category_form").serialize(),
        success: function (data) {
          if (data == "UPDATED") {
            Toast.fire({
              icon: "success",
              title: name + " has been UPDATED",
            });
            $("#getCategory").children("tr").remove();
            $("#table").dataTable().fnDestroy();
            fetchCategory();
            relaunchCategory(1);
          } else {
            $("#updateCategoryName");

            Toast.fire({
              icon: "error",
              title: name + " has been USED",
            });
          }
        },
      });
    }
  });

  //---------- Location -----------//
  manageLocation(1);

  function manageLocation(pn) {
    $.ajax({
      url: DOMAIN + "/includes/process.php",
      method: "POST",
      data: {
        manageLocation: 1,
        pageno: pn,
      },
      success: function (data) {
        $("#getBrand").html(data);
      },
    });
  }

  function relaunchLocation(pn) {
    $.ajax({
      url: DOMAIN + "/includes/process.php",
      method: "POST",
      data: {
        relaunchLocation: 1,
        pageno: pn,
      },
      success: function (data) {
        $("#getBrand").html(data);
      },
    });
  }

  // $("body").delegate(".page-link", "click", function () {
  //   var pn = $(this).attr("pn")

  //   relaunchLocation(1);
  // })

  //Delete Location

  $("body").delegate(".delLocation", "click", function () {
    var did = $(this).attr("did");
    name = $(this).attr("lim");
    if (confirm("Are you sure You want to delete this Location?")) {
      $.ajax({
        url: DOMAIN + "/includes/process.php",
        method: "POST",
        data: {
          deleteLocation: 1,
          id: did,
          lname: name,
        },
        success: function (data) {
          if (data == "DELETED") {
            Toast.fire({
              icon: "success",
              title: name + " has been DELETED",
            });
            $("#getBrand").children("tr").remove();
            $("#table").dataTable().fnDestroy();
            fetchLocation();
            relaunchLocation(1);
          } else {
            Toast.fire({
              icon: "error",
              title:
                name + " CAN'T be DELTED because one of the product use it",
            });
          }
        },
      });
    }
  });

  //UPDATE LOCATION
  $("body").delegate(".editLocation", "click", function () {
    var eid = $(this).attr("eid");
    name = $(this).attr("lim");
    $.ajax({
      url: DOMAIN + "/includes/process.php",
      method: "POST",
      dataType: "json",
      data: {
        updateLocation: 1,
        id: eid,
      },
      success: function (data) {
        $("#locationID").val(data["locationID"]);
        $("#updateLocationName").val(data["locationName"]);
      },
    });
  });

  //UPDATING Location
  $("#update_location_form").on("submit", function () {
    if ($("#updateLocationName").val() == "") {
      $("#updateLocationName").addClass("border-danger");
      $("#updateLocationError").html(
        "<span class='text-danger'>Please Enter Location Name</span>"
      );
    } else {
      $.ajax({
        url: DOMAIN + "/includes/process.php",
        method: "POST",
        data: $("#update_location_form").serialize(),
        success: function (data) {
          if (data == "UPDATED") {
            Toast.fire({
              icon: "success",
              title: name + " has been UPDATED",
            });
            $("#getBrand").children("tr").remove();
            $("#table").dataTable().fnDestroy();
            fetchLocation();
            relaunchLocation(1);
          } else {
            name = $("#updateLocationName").val();
            Toast.fire({
              icon: "error",
              title: name + " has been USED",
            });
          }
        },
      });
    }
  });

  //--------------------Product-------------------------//

  //Fetch Location
 
 
  //Manage Product
  manageProduct(1);

  function manageProduct(pn) {
    $.ajax({
      url: DOMAIN + "/includes/process.php",
      method: "POST",
      data: {
        manageProduct: 1,
        pageno: pn,
      },
      success: function (data) {
        $("#getProduct").html(data);
        // alert(data);
      },
    });
  }

  function relaunchProduct(pn) {
    $.ajax({
      url: DOMAIN + "/includes/process.php",
      method: "POST",
      data: {
        relaunchProduct: 1,
        pageno: pn,
      },
      success: function (data) {
        $("#getProduct").html(data);
        // alert(data);
      },
    });
  }

  // $("body").delegate(".page-link", "click", function () {
  //   var pn = $(this).attr("pn");
  //   manageProduct(pn);
  // })

  //Delete Product

  $("body").delegate(".delProduct", "click", function () {
    did = $(this).attr("did");
    name = $(this).attr("pim");
    imgLoc = $(this).attr("imgID");
    if (confirm("Are you sure You want to delete this Product?")) {
      $.ajax({
        url: DOMAIN + "/includes/process.php",
        method: "POST",
        data: {
          deleteProduct: 1,
          id: did,
          pname: name,
          imgName: imgLoc,
        },
        success: function (data) {
          if (data == "DELETED") {
            Toast.fire({
              icon: "success",
              title: name + " has been DELETED",
            });
            $("#getProduct").children("tr").remove();
            $("#table").dataTable().fnDestroy();
            relaunchProduct(1);
          } else {
            alert(data);
          }
        },
      });
    }
  });

  //UPDATE PRODUCT
  $("body").delegate(".editProduct", "click", function () {
    var eid = $(this).attr("eid");
    name = $(this).attr("pim");

    $.ajax({
      url: DOMAIN + "/includes/process.php",
      method: "POST",
      dataType: "json",
      data: {
        updateProduct: 1,
        id: eid,
      },
      success: function (data) {
        $("#productID").val(data["productID"]);
        $("#updateProductName").val(data["productName"]);
        $("#selectUpdateCategory").val(data["categoryID"]);
        $("#selectUpdateLocation").val(data["locationID"]);
        $("#updateProductPrice").val(data["productPrice"]);
        $("#updateProductStock").val(data["productStock"]);
        $("#updateProductStockLimit").val(data["productLimit"]);
      },
    });
  });

  // checkProductStock()
  // function checkProductStock() {
  //   productData = new Array()
  //   $.ajax({

  //     url: DOMAIN + "/includes/process.php",
  //     method: "POST",
  //     dataType: "json",
  //     data: {
  //       checkStock: 1

  //     },
  //     success: function (data) {

  //       for (i = 0; i < data.length; i++) {
  //         var obj = data[i];
  //         if (obj["productStock"] <= obj["productLimit"]) {
  //           $(document).Toasts('create', {
  //             class: 'bg-warning',
  //             title: 'Toast Title',
  //             body: obj["productName"] + " need to be RESTOCKED!"
  //           })
  //         }

  //       }

  //     }
  //   })

  // }
  //UPDATING PRODUCT
  $("#update_product_form").on("submit", function () {
    price = document.getElementById("updateProductPrice").value;
    price = price.replace(",", ".");
    document.getElementById("updateProductPrice").value = price;
    var price = parseFloat($("#updateProductPrice").val());
    var stock = parseInt($("#updateProductStock").val());
    var limit = parseInt($("#updateProductStockLimit").val());
    var formData = new FormData($("#update_product_form")[0]);
    if (price < 0) {
      Toast.fire({
        icon: "error",
        title: "Product Price Should be higher than 0!",
      });
    } else if (stock <= 0) {
      Toast.fire({
        icon: "error",
        title: "Product Stock Can't be Minus!",
      });
    } 
    else {
      if (stock <= limit) {
        toastr.info('Product Stock Should be higher than Stock limit!')
      
      }
    
      $.ajax({
        url: DOMAIN + "/includes/process.php",
        method: "POST",
        processData: false,
        contentType: false,
        data: formData,
        success: function (data) {

            if (data == "UPDATED") {
              Toast.fire({
                icon: "success",
                title: name + " has been UPDATED",
              });
        
              // toastr.success(name + " has been UPDATED");
              
              $("#getProduct").children("tr").remove();
              $("#table").dataTable().fnDestroy();
              relaunchProduct(1);
            } else {
              name = $("#updateProductName").val();
              Toast.fire({
                icon: "error",
                title: name + " has been USED",
              });
            }
          
        },
      });
    }
  });

  //ADD product
  $("#product_form").on("submit", function () {
    price = document.getElementById("productPrice").value;
    price = price.replace(",", ".");
    document.getElementById("productPrice").value = price;
    var name = $("#productName").val();
    var price = parseFloat($("#productPrice").val());
    var stock = parseInt($("#productStock").val());
    var limit = parseInt($("#productStockLimit").val());
    var formData = new FormData($("#product_form")[0]);
    if (price < 0) {
      Toast.fire({
        icon: "error",
        title: "Product Price Should be higher than 0!",
      });
    } else if (stock <= 0) {
      Toast.fire({
        icon: "error",
        title: "Product Stock Can't be Minus!",
      });
    } else {
      if (stock <= limit) {
        Toast.fire({
          icon: "info",
          title: "Product Stock Should be higher than Stock limit!",
        });
      }
      $.ajax({
        url: DOMAIN + "/includes/process.php",
        method: "POST",
        processData: false,
        contentType: false,
        data: formData,
        success: function (data) {
            if (data == "PRODUCT_ADDED") {
              $("#productName").val("");
              $("#productStock").val("");
              $("#productPrice").val("");
              $("#productStockLimit").val("");
              $("#productImage").val("");
              Toast.fire({
                icon: "success",
                title: name + " has been ADDED to PRODUCT",
              });
              $("#getProduct").children("tr").remove();
              $("#table").dataTable().fnDestroy();
              relaunchProduct(1);
            } else {
              Toast.fire({
                icon: "error",
                title: name + " is ALREADY on the LIST",
              });
            }
          
        },
      });
    }
  });

  //ADD LOCATION
  $("#location_form").on("submit", function () {
    var name = $("#locationName").val();
    if ($("#locationName").val() == "") {
      $("#locationName").addClass("border-danger");
      $("#locationError").html(
        "<span class='text-danger'>Please Enter Location Name</span>"
      );
    } else {
      $.ajax({
        url: DOMAIN + "/includes/process.php",
        method: "POST",
        data: $("#location_form").serialize(),
        success: function (data) {
          if (data == "LOCATION_ADDED") {
            $("#locationName").removeClass("border-danger");
            $("#locationError").html(
              "<span class='text-success'>New Location Added Succesfully</span>"
            );
            $("#locationName").val("");
            Toast.fire({
              icon: "success",
              title: name + " has been ADDED to LOCATION",
            });
            $("#getBrand").children("tr").remove();
            $("#table").dataTable().fnDestroy();
            fetchLocation();
            relaunchLocation(1);
          } else {
            Toast.fire({
              icon: "error",
              title: name + " is ALREADY on the LIST",
            });
          }
        },
      });
    }
  });

  $("#category_form").on("submit", function () {
    var name = $("#categoryName").val();
    if ($("#categoryName").val() == "") {
      $("#categoryName").addClass("border-danger");
      $("#categoryError").html(
        "<span class='text-danger'>Please Enter Category Name</span>"
      );
    } else {
      $.ajax({
        url: DOMAIN + "/includes/process.php",
        method: "POST",
        data: $("#category_form").serialize(),
        success: function (data) {
          if (data == "CATEGORY_ADDED") {
            $("#categoryName").removeClass("border-danger");
            $("#categoryError").html(
              "<span class='text-success'>New Category Added Succesfully</span>"
            );
            $("#categoryName").val("");

            Toast.fire({
              icon: "success",
              title: name + " has been ADDED to CATEGORY",
            });
            $("#getCategory").children("tr").remove();
            $("#table").dataTable().fnDestroy();
            fetchCategory();
            relaunchCategory(1);
          } else {
            Toast.fire({
              icon: "error",
              title: name + " is ALREADY on the LIST",
            });
            // alert(data);
          }
        },
      });
    }
  });
});
