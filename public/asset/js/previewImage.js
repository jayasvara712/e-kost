let array_image = [];

function autoPreviewFiles() {
  const preview = document.querySelector("#old_preview");
  const files = document.querySelector("input[type=file]").files;
  const old_image = document.getElementById("old-image");
  const change = preview.classList.contains("old_data");
  let array = [];
  let div = "";

  if (old_image) {
    if (!change) {
      // preview.className += "old_data";
      data_old_image = old_image.value.split(",");
      for (i = 0; i < data_old_image.length; i++) {
        array.push(data_old_image[i]);
        // array_image.push(data_old_image[i]);
        div += '<div class="col-6 col-sm-4 col-lg-4" id="img_' + i + '">';
        div += '<div class="card">';
        div += '<div class="card-body">';
        div +=
          '<img height="100" src="/uploads/kamar/' +
          data_old_image[i] +
          '" onclick="document.getElementById(\'img_' +
          i +
          "').remove();removeObjectWithId('" +
          data_old_image[i] +
          "');\">";
        div += "</div></div></div>";
        preview.innerHTML = div;
        preview.classList.add("old_data");
      }
    }
  }

  function readAndPreview(file) {
    // Make sure `file.name` matches our extensions criteria
    if (/\.(jpe?g|png|gif|jfif)$/i.test(file.name)) {
      // preview.innerHTML = "";

      const reader = new FileReader();

      reader.addEventListener(
        "load",
        () => {
          let input = "";
          input += '<div class="col-6 col-sm-4 col-lg-4" id="img_' + i + '">';
          input += '<div class="card">';
          input += '<div class="card-body">';
          input += '<img height="100" src="' + reader.result + '" >';
          input += "</div></div></div>";
          preview.innerHTML += input;
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

function removeObjectWithId(id) {
  // const objWithIdIndex = array_image.findIndex((obj) => obj === id);

  // if (objWithIdIndex > -1) {
  //   array_image.splice(objWithIdIndex, 1);
  // }
  // console.log(array_image);
  array_image.push(id);
  document.getElementById("array_image").value = array_image;
  // return array_image;
}

$(document).ready(function () {
  autoPreviewFiles();
});
