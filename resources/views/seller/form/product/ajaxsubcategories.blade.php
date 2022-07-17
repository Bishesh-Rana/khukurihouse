@if(!$subCategory->isEmpty())
<div class="col-sm-2 form-group" id="child-label-{{$childTrial}}">
    <label class="product-form-label">Sub Category</label><span class="alert-astrisk"> *</span>
</div>

<div class="col-sm-10 form-group" id="child-{{$childTrial}}">
    <select class="form-control select2_demo_1" name="sub_child_category_id" id="sub_child_category_id" onchange="getNextChildren(event,this,{{$childTrial}})">
        <option value="0" selected disabled>None</option>
        @foreach($subCategory as $row)
        <option value="{{ $row->id }}">{{ ucwords($row->category_name) }}
    </option>
    @endforeach
</select>
</div> 
    
@endif