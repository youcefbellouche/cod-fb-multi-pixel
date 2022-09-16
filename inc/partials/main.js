function model(
  index = 0,
  pixel = "",
  api = ""
) {
  const model = `
    <div class="cod_facebook_pixel">
    <input type="text" required name="cod_facebook_pixels[${index}][pixel]" value="${pixel}" placeholder="Pixel Id" id="">
    <input type="text" name="cod_facebook_pixels[${index}][api]" value="${api}" placeholder="Confersion Api" id="">
    <button class="button-red remove_pixel_field" style="margin-left: 5px;">Delete</button>
    </div>
    `;

  return model;
}



const parentContainer = jQuery(".cod_facebook_pixels");
const addButton = jQuery(".add_price_field");

// Add New Field
addButton.on("click", function (e) {
  e.preventDefault();
  const childContainer = jQuery(".cod_facebook_pixel");
  parentContainer.append(model(childContainer.length));
});

// Remove Field
jQuery(document).on("click", ".remove_pixel_field", function (e) {
  e.preventDefault();
  const childContainer = jQuery(".cod_facebook_pixel");
  if (childContainer.length > 1) {
    jQuery(this).parent().remove();
  }
});

// Init Field
const childContainer = jQuery(".cod_facebook_pixel");
if (childContainer.length == 0) {
  parentContainer.append(model(childContainer.length));
}
