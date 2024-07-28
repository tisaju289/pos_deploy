<div class="modal animated zoomIn" id="create-modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Create Product</h5>
            </div>
            <div class="modal-body">
                <form id="save-form">
                    <div class="container">
                        <div class="row">
                            <div class="col-12 p-1">
                                <label class="form-label">Category</label>
                                <select type="text" class="form-control form-select" id="productCategory">
                                    <option value="">Select Category</option>
                                </select>

                                <label class="form-label mt-2">Brand</label>
                                <select type="text" class="form-control form-select" id="productBrand">
                                    <option value="">Select Brand</option>
                                </select>

                                <label class="form-label mt-2">Name</label>
                                <input type="text" class="form-control" id="productName">

                                <label class="form-label mt-2">Description</label>
                                <input type="text" class="form-control" id="productDescription">

                                <label class="form-label mt-2">Price</label>
                                <input type="text" class="form-control" id="productPrice">

                                <label class="form-label mt-2">Cost Price</label>
                                <input type="text" class="form-control" id="productCostPrice">

                                <label class="form-label mt-2">Unit</label>
                                <input type="text" class="form-control" id="productUnit">

                                <label class="form-label mt-2">Color</label>
                                <input type="text" class="form-control" id="productColor">

                                <label class="form-label mt-2">Size</label>
                                <input type="text" class="form-control" id="productSize">

                                <label class="form-label mt-2">Date Added</label>
                                <input type="date" class="form-control" id="productDateAdded">

                                <label class="form-label mt-2">Expiry Date</label>
                                <input type="date" class="form-control" id="productExpiryDate">

                                <label class="form-label mt-2">Status</label>
                                <select class="form-control form-select" id="productStatus">
                                    <option value="active">Active</option>
                                    <option value="inactive">Inactive</option>
                                </select>

                                <br/>
                                <img class="w-15" id="newImg" src="{{asset('images/default.jpg')}}"/>
                                <br/>

                                <label class="form-label">Image</label>
                                <input oninput="newImg.src=window.URL.createObjectURL(this.files[0])" type="file" class="form-control" id="productImg">
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button id="modal-close" class="btn bg-gradient-primary mx-2" data-bs-dismiss="modal" aria-label="Close">Close</button>
                <button onclick="Save()" id="save-btn" class="btn bg-gradient-success">Save</button>
            </div>
        </div>
    </div>
</div>

<script>
FillCategoryDropDown();
FillBrandDropDown();

async function FillCategoryDropDown(){
    let res = await axios.get("/category-list");
    res.data.forEach(function (item, i) {
        let option = `<option value="${item['id']}">${item['name']}</option>`;
        $("#productCategory").append(option);
    });
}

async function FillBrandDropDown(){
    let res = await axios.get("/brand-list");
    res.data.forEach(function (item, i) {
        let option = `<option value="${item['id']}">${item['name']}</option>`;
        $("#productBrand").append(option);
    });
}

async function Save() {
    let productCategory = document.getElementById('productCategory').value;
    let productBrand = document.getElementById('productBrand').value;
    let productName = document.getElementById('productName').value;
    let productDescription = document.getElementById('productDescription').value;
    let productPrice = document.getElementById('productPrice').value;
    let productCostPrice = document.getElementById('productCostPrice').value;
    let productUnit = document.getElementById('productUnit').value;
    let productColor = document.getElementById('productColor').value;
    let productSize = document.getElementById('productSize').value;
    let productDateAdded = document.getElementById('productDateAdded').value;
    let productExpiryDate = document.getElementById('productExpiryDate').value;
    let productStatus = document.getElementById('productStatus').value;
    let productImg = document.getElementById('productImg').files[0];

    if (productCategory.length === 0) {
        errorToast("Product Category Required!")
    }
    else if (productBrand.length === 0) {
        errorToast("Product Brand Required!")
    }
    else if (productName.length === 0) {
        errorToast("Product Name Required!")
    }
    else if (productDescription.length === 0) {
        errorToast("Product Description Required!")
    }
    else if (productPrice.length === 0) {
        errorToast("Product Price Required!")
    }
    else if (productCostPrice.length === 0) {
        errorToast("Product Cost Price Required!")
    }
    else if (productUnit.length === 0) {
        errorToast("Product Unit Required!")
    }
    else if (productColor.length === 0) {
        errorToast("Product Color Required!")
    }
    else if (productSize.length === 0) {
        errorToast("Product Size Required!")
    }
    else if (productDateAdded.length === 0) {
        errorToast("Product Date Added Required!")
    }
    else if (!productImg) {
        errorToast("Product Image Required!")
    }
    else {
        document.getElementById('modal-close').click();

        let formData = new FormData();
        formData.append('img', productImg);
        formData.append('name', productName);
        formData.append('description', productDescription);
        formData.append('price', productPrice);
        formData.append('cost_price', productCostPrice);
        formData.append('unit', productUnit);
        formData.append('category_id', productCategory);
        formData.append('brand_id', productBrand);
        formData.append('color', productColor);
        formData.append('size', productSize);
        formData.append('date_added', productDateAdded);
        formData.append('expiry_date', productExpiryDate);
        formData.append('status', productStatus);

        const config = {
            headers: {
                'content-type': 'multipart/form-data'
            }
        };

        showLoader();
        let res = await axios.post("/product-create", formData, config);
        hideLoader();

        if (res.status === 201) {
            successToast('Request completed');
            document.getElementById("save-form").reset();
            await getList();
        }
        else {
            errorToast("Request failed!")
        }
    }
}
</script>
