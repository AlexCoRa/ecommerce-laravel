<div class="col-md-4">
    <div class="panel shadow">
        <div class="header">
            <h2 class="title"><i class="fas fa-boxes"></i> Modulo Productos</h2>
        </div>
        <div class="inside">
            <div class="container">
                <div class="form-check">
                    <input type="checkbox" value="true" name="products" @if(kvfj($u->permissions, 'products')) checked @endif>
                    <label for="products">Puede ver el listado de productos.</label>
                </div>

                <div class="form-check">
                    <input type="checkbox" value="true" name="products_add" @if(kvfj($u->permissions, 'products_add')) checked @endif>
                    <label for="products_add">Puede agregar nuevos productos.</label>
                </div>

                <div class="form-check">
                    <input type="checkbox" value="true" name="products__edit" @if(kvfj($u->permissions, 'products__edit')) checked @endif>
                    <label for="products__edit">Puede editar productos.</label>
                </div>

                <div class="form-check">
                    <input type="checkbox" value="true" name="product_gallery_add" @if(kvfj($u->permissions, 'product_gallery_add')) checked @endif>
                    <label for="product_gallery_add">Puede agregar imágenes al producto.</label>
                </div>

                <div class="form-check">
                    <input type="checkbox" value="true" name="product_gallery_delete" @if(kvfj($u->permissions, 'product_gallery_delete')) checked @endif>
                    <label for="product_gallery_delete">Puede eliminar imágenes del producto.</label>
                </div>
            </div>
        </div>
    </div>
</div>
