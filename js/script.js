function changeProductView() {
    var Listing = document.getElementById("addProductBox");
    var Updating = document.getElementById("updateProductBox");
    Listing.classList.toggle("d-none");
    Updating.classList.toggle("d-none");
    document.body.scrollTop = 0;
    document.documentElement.scrollTop = 0;
}

function AdminVerify() {
    var modelshow = new bootstrap.Modal(document.getElementById("AdminModel"), { backdrop: 'static', keyboard: false });
    modelshow.show();
}