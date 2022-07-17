@if(!$childCategories->isEmpty())
<div class="col-sm-2 form-group">
    <label class="product-form-label">Next Category</label><span class="alert-astrisk"> *</span>
</div>

<div class="col-sm-10 form-group">
    <select class="form-control select2_demo_1" name="child_category_id" id="child_category_id">
        <option value="0">None</option>
        @foreach($childCategories as $row)
        <option <?php
        if (isset($product) && $row->id == $product->child_category_id) {
            echo "selected";
        }
        ?> value="{{ $row->id }}">{{ ucwords($row->child_category_name) }}
    </option>
    @endforeach
</select>
</div> 
@endif