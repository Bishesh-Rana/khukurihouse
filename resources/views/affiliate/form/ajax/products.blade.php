<div class="form-group">
    <label>Product</label>
    <select class="form-control select2_demo_1" id="product" name="product_id" required>
        <option value="none" disabled @if(!isset($salesReturn)) selected @endif>Please select a product</option>
        @foreach($products as $row)
        <option @if(isset($salesReturn) && $salesReturn->product_id == $row->id) selected @endif
            value="{{ $row->id }}">{{ ucwords($row->product_name) }}
        </option>
        @endforeach
    </select>
</div>

<div class="form-group">
    <label>Quantity</label>
    <input type="text" name="quantity" class="form-control m-input" placeholder="Quantity"
        value="<?php if (isset($salesReturn->quantity)) { echo $salesReturn->quantity; } else { echo old('quantity'); } ?>">
</div>

<div class="form-group">
    <label>Order number</label>
    <input type="text" name="ref_id" class="form-control m-input" placeholder="Order Number"
        value="<?php if (isset($salesReturn->ref_id)) { echo $salesReturn->ref_id; } else { echo old('ref_id'); } ?>">
</div>