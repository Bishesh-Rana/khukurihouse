<option value=""><li>
{{$sub_mark}}
{{ $child_category->category_name }}</li></option>
@if ($child_category->categories)
    <ul>
        @foreach ($child_category->categories as $childCategory)
            @include('admin.form.child_category', ['child_category' => $childCategory])
        @endforeach
    </ul>
@endif