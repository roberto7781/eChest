$(document).ready(function () {
  var DOMAIN = "";
  $("#register_form").on("submit", function () {
    var status = false;
    var name = $("#userName");
    var email = $("#email");
    var pass1 = $("#password1");
    var pass2 = $("#password2");
    var type = $("#userType");
    var n_patt = new RegExp(/^[A-Za-z ]+$/);

    var e_patt = new RegExp(
      /^[a-z0-9_-]+(\.[a-z0-9_-]+)*@[a-z0-9_-]+(\.[a-z0-9_-]+)*(\.[a-z]{2-4})$/
    );

    var correctCounter = 0;

    if (name.val() == "" || name.val().length < 6) {
      name.addClass("border-danger");
      $("#user_error").html(
        "<span class='text-danger'>Please Enter Name and Name Should be More Than 6 Characters</span>"
      );

    } else {
      name.removeClass("border-danger");
      $("#user_error").html("");
      correctCounter++;
    }

    // if(!e_patt.test(email.val())){
    //   email.addClass("border-danger");
    //   $("#email_error").html("<span class='text-danger'>Please Enter Valid Email Address</span>");
    //   status = false;
    // }
    // else{
    //   email.removeClass("border-danger");
    //   $("#email_error").html("");
    //   status = true;
    // }

    if (pass1.val() == "" || pass1.val().length < 9) {
      pass1.addClass("border-danger");
      $("#password1_error").html(
        "<span class='text-danger'>Please Enter Name More Than 9 Characters</span>"
      );
 
    } else {
      pass1.removeClass("border-danger");
      $("#password1_error").html("");
      correctCounter++;
    }

    if (pass2.val() == "" || pass2.val().length < 9) {
      pass2.addClass("border-danger");
      $("#password2_error").html(
        "<span class='text-danger'>Please Enter Name More Than 9 Characters</span>"
      );
   
    } else {
      pass2.removeClass("border-danger");
      $("#password2_error").html("");
      correctCounter++;
    }

    if (type.val() == "") {
      type.addClass("border-danger");
      $("#type_error").html(
        "<span class='text-danger'>Please Enter Name More Than 9 Characters</span>"
      );
 
    } else {
      type.removeClass("border-danger");
      $("#type_error").html("");
      correctCounter++;
    }

    if (pass1.val() == pass2.val() && correctCounter == 4) {
      $(".overlay").show();
      $.ajax({
        url: DOMAIN + "/includes/process.php",
        method: "POST",
        data: $("#register_form").serialize(),
        success: function (data) {
          if (data == "EMAIL_ALREADY_EXISTS") {
            $(".overlay").hide();
            alert("Email Has been Used");
          } else if (data == "SOMETHING_WENT_WRONG") {
            $(".overlay").hide();
            alert("Something Went Wrong");
          } else {
            $(".overlay").hide();
            window.location.href = DOMAIN + "/index.php"
            
          }
        },
      });
    } else {
      pass2.addClass("border-danger");
      $("#password2_error").html(
        "<span class='text-danger'>Password isn't Matched</span>"
      );
      status = false;
    }
  });
  

  //FOR LOGIN
  $("#login_form").on("submit", function () {
    $(".overlay").show();
    var status = false;
    var pass = $("#log_password");
    var email = $("#log_email");

    if (email.val() == "") {
      email.addClass("border-danger");
      $("#email_error").html(
        "<span class='text-danger'>Please Enter Email Address</span>"
      );
      status = false;
    } else {
      email.removeClass("border-danger");
      $("#email_error").html("");
      status = true;
    }

    if (pass.val() == "" || pass.val().length < 9) {
      pass.addClass("border-danger");
      $("#password_error").html(
        "<span class='text-danger'>Please Enter Name More Than 9 Characters</span>"
      );
      status = false;
    } else {
      pass.removeClass("border-danger");
      $("#password_error").html("");
      status = true;
    }

    if (status) {
      $.ajax({
        url: DOMAIN + "/includes/process.php",
        method: "POST",
        data: $("#login_form").serialize(),
        success: function (data) {
          if (data == "NOT_REGISTERED") {
            $(".overlay").hide();
            alert("NOT_REGISTERED");
          } else if (data == "WRONG_PASSWORD") {
            $(".overlay").hide();
            alert("WRONG_PASSWORD");
          } else {
            $(".overlay").hide();
            // console.log(data);

            window.location.href = DOMAIN + "/dashboard.php";
            // fetchUser(document.getElementById("log_email").value);
          }
        },
      });
    }
  });

    
  function getRecentActivities() {
    $.ajax({
      url: DOMAIN + "/includes/process.php",
      method: "POST",
      data: {
        getLog: 1,
      },
      success: function (data) {
        // console.log(data);
        // alert(data);
        $("#recentActivities").html(data);
      },
    });
  }


  function totalProduct() {
    $.ajax({
      url: DOMAIN + "/includes/process.php",
      method: "POST",
      data: {
        totalProduct: 1,
      },
      success: function (data) {
      
        $("#productCount").html(data);
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



  
  function totalCategory() {
    $.ajax({
      url: DOMAIN + "/includes/process.php",
      method: "POST",
      data: {
        totalCategory: 1,
      },
      success: function (data) {
        // console.log(data);
        // alert(data);

        $("#categoryCount").html(data);
      },
    });
  }

  function checkLocation(){
    $.ajax({
      url: DOMAIN + "/includes/process.php",
      method: "POST",
      data: {
        getLog: 1,
      },
      success: function (data) {
        // console.log(data);
        // alert(data);
        $("#recentActivities").html(data);
      },
    });
  }

  function totalLocation() {
    $.ajax({
      url: DOMAIN + "/includes/process.php",
      method: "POST",
      data: {
        totalLocation: 1,
      },
      success: function (data) {
        // console.log(data);
        // alert(data);

        $("#locationCount").html(data);
      },
    });
  }

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
        // alert(data);
        $("#parentCategory").html(root + data);
        $("#selectCategory").html(choose + data);
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
        $("#selectLocation").html(choose + data);
      },
    });
  }

  fetchUser();
  //Total Product
    totalProduct();
    


  getRecentActivities();


  //Total Category
  totalCategory();


  //RECENT ACTIVITIES

  //Total Location
  totalLocation();

  

  //Fetch Category

  fetchCategory();

  

  //Fetch Location

  fetchLocation();


  //ADDING CATEGORY
  var Toast = Swal.mixin({
    toast: true,
    position: "top-end",
    showConfirmButton: false,
    timer: 3000,
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
            fetchCategory();
            getRecentActivities();
            totalCategory();
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
            fetchLocation();
            getRecentActivities();
            totalLocation();
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

  //ADD product
  $("#product_form").on("submit", function () {
    price = document.getElementById('productPrice').value;
    price = price.replace(',','.');
    document.getElementById('productPrice').value = price;
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
    } else if (stock <= limit) {
      Toast.fire({
        icon: "Info",
        title: "Product Stock Should be higher than Stock limit!",
      });
    } else {
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
              getRecentActivities();
              totalProduct();
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
});
