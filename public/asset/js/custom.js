//menu
function menu(e) {
  $("#" + e).addClass("active");
}

function buatNoInvoice() {
  let tanggal = $("#tgl_penyewaan").val();

  $.ajax({
    type: "post",
    url: "/penyewaan_detail/buatNoInvoice",
    data: {
      [csrfToken]: csrfHash,
      tanggal: tanggal,
    },
    dataType: "json",
    success: function (response) {
      $("#no_invoice").val(response.noInvoice);
    },
    error: function (xhr, ajaxOptions, thrownError) {
      console.log(xhr.status + "\n" + thrownError);
    },
  });
}

function detailKamar() {
  let id_kamar = $("#id_kamar").val();

  $.ajax({
    type: "post",
    url: "/kamar/detailKamar",
    data: {
      [csrfToken]: csrfHash,
      id_kamar: id_kamar,
    },
    dataType: "json",
    success: function (response) {
      console.log(response.kamar);
      $("#status_kamar").val(response.kamar.status_kamar);
      $("#fasilitas").val(response.kamar.fasilitas_kamar);
      $("#harga_kamar").val(response.kamar.harga_kamar);
      $("#nomor_kamar").val(response.kamar.nomor_kamar);
    },
    error: function (xhr, ajaxOptions, thrownError) {
      console.log(xhr.status + "\n" + thrownError);
    },
  });
}

function total_harga() {
  let lama_penyewaan = $("#lama_penyewaan").val();
  let harga_kamar = $("#harga_kamar").val();

  var total = lama_penyewaan * harga_kamar;
  $("#total_harga").val(total);
}

$(document).ready(function () {
  var successElement = document.getElementById("success");
  var failElement = document.getElementById("error");
  if (successElement) {
    swal({
      text: successElement.innerHTML,
      icon: "success",
    });
  } else if (failElement) {
    swal({
      text: failElement.innerHTML,
      icon: "error",
    });
  }

  $("#tgl_penyewaan").change(function (e) {
    buatNoInvoice();
  });

  $("#id_kamar").change(function (e) {
    detailKamar();
    total_harga();
  });

  $("#lama_penyewaan").change(function (e) {
    total_harga();
  });

  $("#tombolPay").click(function (e) {
    e.preventDefault();
    $.ajax({
      type: "post",
      url: "/penyewaan_detail/payMidtrans",
      data: {
        [csrfToken]: csrfHash,
        no_invoice: $("#no_invoice").val(),
        tgl_penyewaan: $("#tgl_penyewaan").val(),
        id_kamar: $("#id_kamar").val(),
        id_penghuni: $("#id_penghuni").val(),
        nomor_kamar: $("#nomor_kamar").val(),
        lama_penyewaan: $("#lama_penyewaan").val(),
        harga_kamar: $("#harga_kamar").val(),
        total_harga: $("#total_harga").val(),
      },
      dataType: "json",
      success: function (response) {
        if (response.error) {
          swal({
            text: response.error,
            icon: "error",
          });
          console.log(response);
        } else {
          snap.pay(response.snapToken, {
            // Optional
            onSuccess: function (result) {
              /* You may add your own js here, this is just example */
              let dataResult = JSON.stringify(result, null, 2);
              let dataObj = JSON.parse(dataResult);

              $.ajax({
                type: "post",
                url: "/penyewaan_detail/payment",
                data: {
                  [csrfToken]: csrfHash,
                  no_invoice: response.no_invoice,
                  tgl_penyewaan: response.tgl_penyewaan,
                  id_penghuni: response.id_penghuni,
                  id_kamar: response.id_kamar,
                  lama_penyewaan: response.lama_penyewaan,
                  harga_kamar: response.harga_kamar,
                  order_id: dataObj.order_id,
                  payment_type: dataObj.payment_type,
                  transaction_time: dataObj.transaction_time,
                  transaction_status: dataObj.transaction_status,
                  va_number: dataObj.va_numbers[0].va_number,
                  bank: dataObj.va_numbers[0].bank,
                },
                dataType: "json",
                success: function (response) {
                  if (response.success) {
                    window.location.replace("/penghuni");
                    swal({
                      text: response.success,
                      icon: "success",
                    });
                  }
                },
              });
            },
            // Optional
            onPending: function (result) {
              /* You may add your own js here, this is just example */
              let dataResult = JSON.stringify(result, null, 2);
              let dataObj = JSON.parse(dataResult);

              $.ajax({
                type: "post",
                url: "/penyewaan_detail/payment",
                data: {
                  [csrfToken]: csrfHash,
                  no_invoice: response.no_invoice,
                  tgl_penyewaan: response.tgl_penyewaan,
                  id_penghuni: response.id_penghuni,
                  id_kamar: response.id_kamar,
                  lama_penyewaan: response.lama_penyewaan,
                  harga_kamar: response.harga_kamar,
                  order_id: dataObj.order_id,
                  payment_type: dataObj.payment_type,
                  transaction_time: dataObj.transaction_time,
                  transaction_status: dataObj.transaction_status,
                  va_number: dataObj.va_numbers[0].va_number,
                  bank: dataObj.va_numbers[0].bank,
                },
                dataType: "json",
                success: function (response) {
                  if (response.success) {
                    swal({
                      text: response.success,
                      icon: "success",
                    }).then((confirm) => {
                      if (confirm) {
                        window.location.replace("penghuni");
                      }
                    });
                  } else if (response.data) {
                  }
                },
              });
            },
            // Optional
            onError: function (result) {
              /* You may add your own js here, this is just example */
              let dataResult = JSON.stringify(result, null, 2);
              let dataObj = JSON.parse(dataResult);

              $.ajax({
                type: "post",
                url: "/penyewaan_detail/payment",
                data: {
                  [csrfToken]: csrfHash,
                  no_invoice: response.no_invoice,
                  tgl_penyewaan: response.tgl_penyewaan,
                  id_penghuni: response.id_penghuni,
                  id_kamar: response.id_kamar,
                  lama_penyewaan: response.lama_penyewaan,
                  harga_kamar: response.harga_kamar,
                  order_id: dataObj.order_id,
                  payment_type: dataObj.payment_type,
                  transaction_time: dataObj.transaction_time,
                  transaction_status: dataObj.transaction_status,
                  va_number: dataObj.va_numbers[0].va_number,
                  bank: dataObj.va_numbers[0].bank,
                },
                dataType: "json",
                success: function (response) {
                  swal({
                    text: response.success,
                    icon: "success",
                  });
                },
              });
            },
          });
        }
      },
      error: function () {},
    });
  });

  $("#btnBayar").click(function (e) {
    e.preventDefault();
    $.ajax({
      type: "post",
      url: "/penyewaan_detail/payMidtrans",
      data: {
        [csrfToken]: csrfHash,
        id_penyewaan: $("#id_penyewaan").val(),
        no_invoice: $("#no_invoice").val(),
        periode: $("#periode").val(),
      },
      dataType: "json",
      success: function (response) {
        if (response.error) {
          swal({
            text: response.error,
            icon: "error",
          });
          console.log(response);
        } else {
          snap.pay(response.snapToken, {
            // Optional
            onSuccess: function (result) {
              /* You may add your own js here, this is just example */
              let dataResult = JSON.stringify(result, null, 2);
              let dataObj = JSON.parse(dataResult);

              $.ajax({
                type: "post",
                url: "/penyewaan_detail/payment",
                data: {
                  [csrfToken]: csrfHash,
                  no_invoice: response.no_invoice,
                  id_penyewaan: response.id_penyewaan,
                  periode: response.periode,
                  payment: response.payment,
                  order_id: dataObj.order_id,
                  payment_type: dataObj.payment_type,
                  transaction_time: dataObj.transaction_time,
                  transaction_status: dataObj.transaction_status,
                  va_number: dataObj.va_numbers[0].va_number,
                  bank: dataObj.va_numbers[0].bank,
                },
                dataType: "json",
                success: function (response) {
                  if (response.success) {
                    window.location.replace("/penghuni");
                    swal({
                      text: response.success,
                      icon: "success",
                    });
                  }
                },
              });
            },
            // Optional
            onPending: function (result) {
              /* You may add your own js here, this is just example */
              let dataResult = JSON.stringify(result, null, 2);
              let dataObj = JSON.parse(dataResult);

              $.ajax({
                type: "post",
                url: "/penyewaan_detail/payment",
                data: {
                  [csrfToken]: csrfHash,
                  no_invoice: response.no_invoice,
                  id_penyewaan: response.id_penyewaan,
                  periode: response.periode,
                  payment: response.payment,
                  order_id: dataObj.order_id,
                  payment_type: dataObj.payment_type,
                  transaction_time: dataObj.transaction_time,
                  transaction_status: dataObj.transaction_status,
                  va_number: dataObj.va_numbers[0].va_number,
                  bank: dataObj.va_numbers[0].bank,
                },
                dataType: "json",
                success: function (response) {
                  if (response.success) {
                    swal({
                      text: response.success,
                      icon: "success",
                    }).then((confirm) => {
                      if (confirm) {
                        window.location.replace(
                          "/penghuni/penyewaan/detail_penyewaan/" +
                            response.id_penyewaan
                        );
                      }
                    });
                  } else if (response.data) {
                  }
                },
              });
            },
            // Optional
            onError: function (result) {
              /* You may add your own js here, this is just example */
              let dataResult = JSON.stringify(result, null, 2);
              let dataObj = JSON.parse(dataResult);

              $.ajax({
                type: "post",
                url: "/penyewaan_detail/payment",
                data: {
                  [csrfToken]: csrfHash,
                  no_invoice: response.no_invoice,
                  id_penyewaan: response.id_penyewaan,
                  periode: response.periode,
                  payment: response.payment,
                  order_id: dataObj.order_id,
                  payment_type: dataObj.payment_type,
                  transaction_time: dataObj.transaction_time,
                  transaction_status: dataObj.transaction_status,
                  va_number: dataObj.va_numbers[0].va_number,
                  bank: dataObj.va_numbers[0].bank,
                },
                dataType: "json",
                success: function (response) {
                  swal({
                    text: response.success,
                    icon: "success",
                  });
                },
              });
            },
          });
        }
      },
      error: function () {},
    });
  });
});
