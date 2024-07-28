<div class="modal animated zoomIn" id="update-modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Update Product</h5>
            </div>
            <div class="modal-body">
                <form id="update-form">
                    <div class="container">
                        <div class="row">
                            <div class="col-12 p-1">
                                <label class="form-label">Category</label>
                                <select type="text" class="form-control form-select" id="productCategoryUpdate">
                                    <option value="">Select Category</option>
                                </select>

                                <label class="form-label mt-2">Brand</label>
                                <select type="text" class="form-control form-select" id="productBrandUpdate">
                                    <option value="">Select Brand</option>
                                </select>

                                <label class="form-label mt-2">Name</label>
                                <input type="text" class="form-control" id="productNameUpdate">

                                <label class="form-label mt-2">Description</label>
                                <input type="text" class="form-control" id="productDescriptionUpdate">

                                <label class="form-label mt-2">Price</label>
                                <input type="text" class="form-control" id="productPriceUpdate">

                                <label class="form-label mt-2">Cost Price</label>
                                <input type="text" class="form-control" id="productCostPriceUpdate">

                                <label class="form-label mt-2">Unit</label>
                                <input type="text" class="form-control" id="productUnitUpdate">

                                <label class="form-label mt-2">Color</label>
                                <input type="text" class="form-control" id="productColorUpdate">

                                <label class="form-label mt-2">Size</label>
                                <input type="text" class="form-control" id="productSizeUpdate">

                                <label class="form-label mt-2">Date Added</label>
                                <input type="date" class="form-control" id="productDateAddedUpdate">

                                <label class="form-label mt-2">Expiry Date</label>
                                <input type="date" class="form-control" id="productExpiryDateUpdate">

                                <label class="form-label mt-2">Status</label>
                                <select class="form-control form-select" id="productStatusUpdate">
                                    <option value="active">Active</option>
                                    <option value="inactive">Inactive</option>
                                </select>

                                <br/>
                                <img class="w-15" id="oldImg" src="{{asset('images/default.jpg')}}"/>
                                <br/>

                                <label class="form-label mt-2">Image</label>
                                <input oninput="oldImg.src=window.URL.createObjectURL(this.files[0])" type="file" class="form-control" id="productImgUpdate">

                                <input type="text" class="d-none" id="updateID">
                                <input type="text" class="d-none" id="filePath">
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button id="update-modal-close" class="btn bg-gradient-primary" data-bs-dismiss="modal" aria-label="Close">Close</button>
                <button onclick="update()" id="update-btn" class="btn bg-gradient-success">Update</button>
            </div>
        </div>
    </div>
</div>

<script>
async function UpdateFillCategoryDropDown(){
    let res = await axios.get("/category-list");
    res.data.forEach(function (item, i) {
        let option = `<option value="${item['id']}">${item['name']}</option>`;
        $("#productCategoryUpdate").append(option);
    });
}

async function UpdateFillBrandDropDown(){
    let res = await axios.get("/brand-list");
    res.data.forEach(function (item, i) {
        let option = `<option value="${item['id']}">${item['name']}</option>`;
        $("#productBrandUpdate").append(option);
    });
}

async function FillUpUpdateForm(id, filePath){
    document.getElementById('updateID').value = id;
    document.getElementById('filePath').value = filePath;
    document.getElementById('oldImg').src = filePath;

    showLoader();
    await UpdateFillCategoryDropDown();
    await UpdateFillBrandDropDown();

    let res = await axios.post("/product-by-id", {id: id});
    hideLoader();

    document.getElementById('productNameUpdate').value = res.data['name'];
    document.getElementById('productDescriptionUpdate').value = res.data['description'];
    document.getElementById('productPriceUpdate').value = res.data['price'];
    document.getElementById('productCostPriceUpdate').value = res.data['cost_price'];
    document.getElementById('productUnitUpdate').value = res.data['unit'];
    document.getElementById('productCategoryUpdate').value = res.data['category_id'];
    document.getElementById('productBrandUpdate').value = res.data['brand_id'];
    document.getElementById('productColorUpdate').value = res.data['color'];
    document.getElementById('productSizeUpdate').value = res.data['size'];
    document.getElementById('productDateAddedUpdate').value = res.data['date_added'];
    document.getElementById('productExpiryDateUpdate').value = res.data['expiry_date'];
    document.getElementById('productStatusUpdate').value = res.data['status'];
}

async function update() {
    let productCategoryUpdate = document.getElementById('productCategoryUpdate').value;
    let productBrandUpdate = document.getElementById('productBrandUpdate').value;
    let productNameUpdate = document.getElementById('productNameUpdate').value;
    let productDescriptionUpdate = document.getElementById('productDescriptionUpdate').value;
    let productPriceUpdate = document.getElementById('productPriceUpdate').value;
    let productCostPriceUpdate = document.getElementById('productCostPriceUpdate').value;
    let productUnitUpdate = document.getElementById('productUnitUpdate').value;
    let productColorUpdate = document.getElementById('productColorUpdate').value;
    let productSizeUpdate = document.getElementById('productSizeUpdate').value;
    let productDateAddedUpdate = document.getElementById('productDateAddedUpdate').value;
    let productExpiryDateUpdate = document.getElementById('productExpiryDateUpdate').value;
    let productStatusUpdate = document.getElementById('productStatusUpdate').value;
    let updateID = document.getElementById('updateID').value;
    let filePath = document.getElementById('filePath').value;
    let productImgUpdate = document.getElementById('productImgUpdate').files[0];

    if (productCategoryUpdate.length === 0) {
        errorToast("Product Category Required!")
    }
    else if (productBrandUpdate.length === 0) {
        errorToast("Product Brand Required!")
    }
    else if (productNameUpdate.length === 0) {
        errorToast("Product Name Required!")
    }
    else if (productDescriptionUpdate.length === 0) {
        errorToast("Product Description Required!")
    }
    else if (productPriceUpdate.length === 0) {
        errorToast("Product Price Required!")
    }
    else if (productCostPriceUpdate.length === 0) {
        errorToast("Product Cost Price Required!")
    }
    else if (productUnitUpdate.length === 0) {
        errorToast("Product Unit Required!")
    }
    else if (productColorUpdate.length === 0) {
        errorToast("Product Color Required!")
    }
    else if (productSizeUpdate.length === 0) {
        errorToast("Product Size Required!")
    }
    else if (productDateAddedUpdate.length === 0) {
        errorToast("Product Date Added Required!")
    }
    else {
        document.getElementById('update-modal-close').click();

        let formData = new FormData();
        formData.append('img', productImgUpdate);
        formData.append('id', updateID);
        formData.append('name', productNameUpdate);
        formData.append('description', productDescriptionUpdate);
        formData.append('price', productPriceUpdate);
        formData.append('cost_price', productCostPriceUpdate);
        formData.append('unit', productUnitUpdate);
        formData.append('category_id', productCategoryUpdate);
        formData.append('brand_id', productBrandUpdate);
        formData.append('color', productColorUpdate);
        formData.append('size', productSizeUpdate);
        formData.append('date_added', productDateAddedUpdate);
        formData.append('expiry_date', productExpiryDateUpdate);
        formData.append('status', productStatusUpdate);
        formData.append('file_path', filePath);

        const config = {
            headers: {
                'content-type': 'multipart/form-data'
            }
        };

        showLoader();
        let res = await axios.post("/product-update", formData, config);
        hideLoader();

        if (res.status === 200 && res.data === 1) {
            successToast('Request completed');
            document.getElementById("update-form").reset();
            await getList();
        }
        else {
            errorToast("Request failed!")
        }
    }
}
</script>
