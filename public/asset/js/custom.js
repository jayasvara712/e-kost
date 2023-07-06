//menu
function menu(e) {
  $("#" + e).addClass("active");
}

function countRangeDate() {
  const current_date = document.getElementById("tgl_penyewaan").value;
  const selector = document.getElementById("lama_penyewaan").value;
  const text = document.getElementById("tanggal_berakhir");

  if (selector != null) {
    // Convert current_date to a Date object
    const currentDateObj = new Date(current_date);

    // Add the selected number of months to the current date
    const endDate = new Date(
      currentDateObj.getFullYear(),
      currentDateObj.getMonth() + parseInt(selector),
      currentDateObj.getDate()
    );

    // Format the end date as desired (e.g., "YYYY-MM-DD")
    const formattedEndDate = `${endDate.getFullYear()}-${(
      endDate.getMonth() + 1
    )
      .toString()
      .padStart(2, "0")}-${endDate.getDate().toString().padStart(2, "0")}`;

    // Update the text element with the formatted end date
    text.value = formattedEndDate;
  }
}

function select_lantai() {
  // variabel dari nilai combo box
  var lantai = document.getElementById("lantai_kamar");
  var lantaiValue = lantai.options[lantai.selectedIndex].value;
  var csrfName = document.getElementById("csrfName").value,
    csrfHash = document.getElementById("csrfHash").value;
  // Menggunakan ajax untuk mengirim dan dan menerima data dari server
  var dataJson = {
    [csrfName]: csrfHash,
    lantai_kamar: lantaiValue,
  };

  $.ajax({
    url: "/home/getKamar",
    method: "POST",
    data: dataJson,
    async: false,
    dataType: "json",
    success: function (data) {},
    error: function (err, e) {
      for (var x in err) {
        console.log(x + " <=> error index of <=> " + err[x]);
      }
    },
  });
}

function previewFiles() {
  const preview = document.querySelector("#preview");
  const files = document.querySelector("input[type=file]").files;
  const old_image = document.getElementById("old-image");
  const change = preview.classList.contains("old_data");
  let array = [];

  if (old_image) {
    if (!change) {
      // preview.className += "old_data";
      data_old_image = old_image.value.split(",");
      for (i = 0; i < data_old_image.length; i++) {
        const img = document.createElement("img");
        array.push(data_old_image[i]);
        img.id = "temp_img" + i;
        img.height = 100;
        img.title = data_old_image[i];
        img.src = "/uploads/kamar/" + data_old_image[i];
        preview.appendChild(img);
      }
    }
  }

  function readAndPreview(file) {
    // Make sure `file.name` matches our extensions criteria
    if (/\.(jpe?g|png|gif|jfif)$/i.test(file.name)) {
      preview.innerHTML = "";

      const reader = new FileReader();

      reader.addEventListener(
        "load",
        () => {
          const image = new Image();
          image.height = 100;
          image.title = file.name;
          image.src = reader.result;
          preview.appendChild(image);
        },
        false
      );

      reader.readAsDataURL(file);
    }
  }

  if (files) {
    Array.prototype.forEach.call(files, readAndPreview);
  }
}

// const picker = document.querySelector("#browse");
// picker.addEventListener("change", previewFiles);

function imagePreview() {
  const gambar = document.querySelector("#gambar");
  const label = document.querySelector(".gambar-label");
  const imgPrev = document.querySelector(".img-preview");

  if (label) {
    label.textContent = gambar.files[0].name;
  }
  const fileImage = new FileReader();
  fileImage.readAsDataURL(gambar.files[0]);

  fileImage.onload = function (e) {
    imgPrev.src = e.target.result;
  };
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

function deleteData(btnID, idData, urlDelete, text) {
  $("#btndelete" + btnID).click(function (e) {
    //var deleteid = $("#_delte_jenis_id").val();

    swal({
      title: "Apakah anda yakin?",
      text: text,
      icon: "warning",
      buttons: true,
      dangerMode: true,
    }).then((willDelete) => {
      if (willDelete) {
        //parameter ajax
        var CSRF_TOKEN = $('meta[name="csrf-token"]').attr("content");
        var data = {
          [csrfToken]: csrfHash,
        };

        //ajax call (ex. '/admin/jenis/ + id')
        $.ajax({
          type: "POST",
          url: urlDelete + "/delete/" + idData,
          data: data,
          dataType: "json",
          success: function (response) {
            if (response.success) {
              swal({
                text: response.success,
                icon: "success",
              }).then((confirm) => {
                if (confirm) {
                  window.location.replace(urlDelete);
                }
              });
            } else if (response.data) {
            }
          },
          error: function (err, e) {
            for (var x in err) {
              console.log(x + " <=> error index of <=> " + err[x]);
            }
          },
        });
      }
    });
  });
}

function action(btnID, idData, url, action, text) {
  $("#btn" + btnID).click(function (e) {
    //var deleteid = $("#_delte_jenis_id").val();

    swal({
      title: "Apakah anda yakin?",
      text: text,
      icon: "warning",
      buttons: true,
      dangerMode: true,
    }).then((willDelete) => {
      if (willDelete) {
        //parameter ajax
        var CSRF_TOKEN = $('meta[name="csrf-token"]').attr("content");
        var data = {
          [csrfToken]: csrfHash,
        };

        //ajax call (ex. '/admin/jenis/ + id')
        $.ajax({
          type: "POST",
          url: url + action + "/" + idData,
          data: data,
          dataType: "json",
          success: function (response) {
            if (response.success) {
              swal({
                text: response.success,
                icon: "success",
              }).then((confirm) => {
                if (confirm) {
                  window.location.replace(url);
                }
              });
            } else if (response.data) {
            }
          },
          error: function (err, e) {
            for (var x in err) {
              console.log(x + " <=> error index of <=> " + err[x]);
            }
          },
        });
      }
    });
  });
}

function logout() {
  swal({
    title: "Apakah anda yakin?",
    text: "Apakah anda yakin ingin keluar dari sistem ?",
    icon: "warning",
    buttons: true,
    dangerMode: true,
  }).then((willDelete) => {
    if (willDelete) {
      document.getElementById("logout").submit();
    }
  });
}

function showPass() {
  var input1 = document.getElementById("password1");
  var icons = document.getElementById("pweye1");
  if (input1.type === "password") {
    input1.type = "text";
    icons.classList.remove("fa-eye");
    icons.classList.add("fa-eye-slash");
  } else {
    input1.type = "password";
    icons.classList.remove("fa-eye-slash");
    icons.classList.add("fa-eye");
  }
}

function showPassConfrm() {
  var input2 = document.getElementById("password2");
  var icons = document.getElementById("pweye2");
  if (input2.type === "password") {
    input2.type = "text";
    icons.classList.remove("fa-eye");
    icons.classList.add("fa-eye-slash");
  } else {
    input2.type = "password";
    icons.classList.remove("fa-eye-slash");
    icons.classList.add("fa-eye");
  }
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
        denda: $("#denda").val(),
        total_bayar: $("#total_bayar").val(),
      },
      dataType: "json",
      success: function (response) {
        if (response.error) {
          swal({
            text: response.error,
            icon: "error",
          });
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
                  denda: response.denda,
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
                        window.location.replace("/penghuni/penyewaan/");
                      }
                    });
                  } else if (response.data) {
                  }
                },
              });
            },
            // Optional
            onPending: function (result) {
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
                  denda: response.denda,
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
                        window.location.replace("/penghuni/penyewaan/");
                      }
                    });
                  } else if (response.data) {
                  }
                },
              });
            },
            // Optional
            onError: function (result) {
              swal({
                text: "pembayaran gagal silahkan ulangi!",
                icon: "error",
              }).then((confirm) => {
                if (confirm) {
                  window.location.replace(
                    "/penghuni/penyewaan/bayar/" + response.id_penyewaan
                  );
                }
              });
            },
          });
        }
      },
      error: function () {},
    });
  });
});
