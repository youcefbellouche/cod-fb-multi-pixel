function getRandomId() {
  return Math.floor(Math.random() * 10000 ) + 1;
}
function modelFbPixel(
index = 0,
pixel = "",
api = "",
test =""
) {
const model = `
  <div class="cod_facebook_pixel">
  <input type="text" required name="cod_facebook_pixels[${index}][pixel]" value="${pixel}" placeholder="Pixel Id" id="">
  <input type="text" name="cod_facebook_pixels[${index}][api]" value="${api}" placeholder="Conversion Api" id="">
  <input type="text" name="cod_facebook_pixels[${index}][test]" value="${test}" placeholder="Conversion Api Test Event" id="">
  <button class="button-red remove_pixel_field" style="margin-left: 5px;">Delete</button>
  </div>
  `;

return model;
}



const fbFieldsContainer = jQuery(".cod_facebook_pixels");
const addPixelField = jQuery(".add_pixel_field");

// Add New Field
addPixelField.on("click", function (e) {
e.preventDefault();
const childContainer = jQuery(".cod_facebook_pixel");
fbFieldsContainer.append(modelFbPixel(getRandomId()));
});

// Remove Field
jQuery(document).on("click", ".remove_pixel_field", function (e) {
e.preventDefault();
const childContainer = jQuery(".cod_facebook_pixel");
jQuery(this).parent().remove();
});

// Init Field
const childContainer = jQuery(".cod_facebook_pixel");
if (childContainer.length == 0) {
fbFieldsContainer.append(modelFbPixel(getRandomId()));
}
