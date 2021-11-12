$(document).ready(function () {

      var DOMAIN = "";

      var Toast = Swal.mixin({
        toast: true,
        position: 'top-end',
        showConfirmButton: false,
        timer: 3000
      });




    function checkProductStock() {
    productData = new Array()
    $.ajax({

      url: DOMAIN + "/includes/process.php",
      method: "POST",
      dataType: "json",
      data: {
        checkStock: 1

      },
      success: function (data) {


        for (i = 0; i < data.length; i++) {
          var obj = data[i];
          if (obj["productStock"] <= obj["productLimit"]) {
            $(document).Toasts('create', {
              class: 'bg-warning',
              title: 'Reminder',
              body: obj["productName"] + " need to be RESTOCKED!"
            })
          }


        }

      }
    })

  }

        addNewRow();

        $("#add").click(function () {

          addNewRow();

        })



        function addNewRow() {
          $.ajax({
            url: DOMAIN + "/includes/process.php",
            method: "POST",
            data: {
              getNewOrderItem: 1
            },
            success: function (data) {
              $("#invoice_item").append(data);
              var n = 0;

              $(".number").each(function () {
                $(this).html(++n);
              })
            }

          })

        }

        $("#remove").click(function () {
          $("#invoice_item").children("tr:last").remove();
          calculate(0, 0);

        })

        $("#invoice_item").delegate(".productID", "change", function () {
          var productID = $(this).val();
          var tr = $(this).parent().parent();

          $(".overlay").show();

          $.ajax({
            url: DOMAIN + "/includes/process.php",
            method: "POST",
            dataType: "json",
            data: {
              getData: 1,
              id: productID
            },
            success: function (data) {
              tr.find(".tqty").val(data["productStock"]);
              tr.find(".productName").val(data["productName"]);
              tr.find(".productID").val(data["productID"]);
              tr.find(".qty").val(0);
              tr.find(".price").val(data["productPrice"]);
              tr.find(".amt").html(tr.find(".qty").val() * tr.find(".price").val());
              calculate(0, 0);
            }


          })


        })

        $("#invoice_item").delegate(".qty", "keyup", function () {
          var qty = $(this);
          var tr = $(this).parent().parent();

          if (isNaN(qty.val())) {
            Toast.fire({
              icon: 'error',
              title: "Please enter a valid QUANTITY!"
            })
            qty.val(0);
          } else {
            if ((qty.val() - 0) > (tr.find(".tqty").val() - 0)) {
              Toast.fire({
                icon: 'error',
                title: "Please enter a valid QUANTITY!"
              })
              qty.val(0);
            } else {
              tr.find(".amt").html(tr.find(".qty").val() * tr.find(".price").val());
              calculate(0, 0);
            }
          }


        })


        function calculate(dis, paid) {

          var subTotal = 0;
          var netTotal = 0;
          var discount = dis;
          var paidAmount = paid;
          var due = 0;
          $(".amt").each(function () {

            subTotal = subTotal + ($(this).html() - 0);
          })

          netTotal = subTotal - discount;
          due = netTotal - paidAmount

          $("#subTotal").val(subTotal);
          $("#discount").val(discount);
          $("#netTotal").val(netTotal);
          $("#paid").val(paidAmount);
          $("#due").val(due);

        }


        $("#discount").keyup(function () {
          var discount = $(this).val();
          calculate(discount, 0);

        })

        $("#paid").keyup(function () {
          var paid = $(this).val();
          var discount = $("#discount").val();
          calculate(discount, paid);

        })

        //ORDER ACCEPTING

        $("#invoiceFormSubmit").click(function () {

          var invoice = $("#invoiceForm").serialize();

          if ($("#customerName").val() === "") {
            Toast.fire({
              icon: 'error',
              title: "Please enter CUSTOMER NAME!"
            })
          } else if ($("#paid").val() === "") {
            Toast.fire({
              icon: 'error',
              title: "Please enter PAID AMAOUNT!"
            })
          } else {
            $.ajax({
              url: DOMAIN + "/includes/process.php",
              method: "POST",
              data: $("#invoiceForm").serialize(),
              success: function (data) {


                if (data != null) {

                  $("#invoiceForm").trigger("reset");

                  if (confirm("Do you want to print Invoice")) {
                    window.open(DOMAIN + "/includes/invoiceBill.php?transactionID=" + data + "&" + invoice)

                  }
                  checkProductStock()
                } else {
                  alert("Error");
                }
              }


            })
          }



        })




      })