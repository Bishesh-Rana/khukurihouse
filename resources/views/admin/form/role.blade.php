@section('title')

Roles | {{env('APP_NAME')}}

@stop

@section('header')
<style>
.this-one {
  color: #555;
  font-size: 1.25em;
  font-family: 'Helvetica Neue', Helvetica, Arial, sans-serif;
  margin: 10px 0;
}
.this-one hr {
  margin: 50px 0;
}

.this-one ul {
  list-style: none;
}

.this-one .container {
  margin: 40px auto;
  max-width: 700px;
}

.this-one li {
  margin-top: 1em;
}

.this-one label {
  font-weight: bold;
}
</style>
@endsection

@extends('admin.layouts.app')

@section('content')

<!-- START PAGE CONTENT-->
<div class="page-heading">
    <h1 class="page-title">Roles</h1>
    <ol class="breadcrumb">
        <li class="breadcrumb-item">
            <a href="index.html"><i class="la la-home font-20"></i></a>
        </li>
    </ol>
</div>
<div class="page-content fade-in-up">
    <div class="ibox">
        <div class="ibox-head">
            <div class="ibox-title">
                <?php if (isset($role)) {
                    echo "Edit Role";
                } else {
                    echo "Add Role";
                } ?>
            </div>
            <div class="ibox-tools">
                <a class="ibox-collapse"><i class="fa fa-minus"></i></a>
                <a class="fullscreen-link"><i class="fa fa-expand"></i></a>
            </div>
        </div>
        <div class="ibox-body">
            @include('admin.layouts.error')

            <?php
            if (isset($role)) {
                $action = url('/ns-admin/roles/edit/' . $role->id);
                $button = 'Update';
            } else {
                $action = url('/ns-admin/roles/add');
                $button = 'Add';
            } ?>
            <form action="{{$action}}" id="upload_form" class="form-horizontal" method="post" novalidate="novalidate" enctype="multipart/form-data">
                @csrf

                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Role Title</label>
                            <input type="text" name="name" class="form-control" placeholder="Role Title" value="<?php if (isset($role->name)) {
                                echo $role->name;
                            } else {
                                echo old('name');
                            } ?>">
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="this-one col-md-4">
                        <ul>
                            <li>
                                <input type="checkbox"/>Content Model
                                <ul>
                                    @foreach($contentPermission as $key => $row)
                                    <li>
                                        <input type="checkbox" name="permissions[]" value="{{ $row->id }}" <?php if(isset($permissionSelected)) {
                                            foreach ($permissionSelected as $check) {
                                                if($row->id == $check->id) {
                                                    echo "checked";
                                                }
                                            }
                                        } ?>/>{{ ucwords(str_replace('_',' ',$row->name))}}
                                    </li>
                                    @endforeach

                                </ul>
                            </li>
                        </ul>
                    </div>

                    <div class="this-one col-md-4">
                        <ul>
                            <li>
                                <input type="checkbox"/>Role Model
                                <ul>
                                    @foreach($rolePermission as $key => $row)
                                    <li>
                                        <input type="checkbox" name="permissions[]" value="{{ $row->id }}" <?php if(isset($permissionSelected)) {
                                            foreach ($permissionSelected as $check) {
                                                if($row->id == $check->id) {
                                                    echo "checked";
                                                }
                                            }
                                        } ?>/>{{ ucwords(str_replace('_',' ',$row->name))}}
                                    </li>
                                    @endforeach

                                </ul>
                            </li>
                        </ul>
                    </div>

                    <div class="this-one col-md-4">
                        <ul>
                            <li>
                                <input type="checkbox"/>Admin Model
                                <ul>
                                    @foreach($adminPermission as $key => $row)
                                    <li>
                                        <input type="checkbox" name="permissions[]" value="{{ $row->id }}" <?php if(isset($permissionSelected)) {
                                            foreach ($permissionSelected as $check) {
                                                if($row->id == $check->id) {
                                                    echo "checked";
                                                }
                                            }
                                        } ?>/>{{ ucwords(str_replace('_',' ',$row->name))}}
                                    </li>
                                    @endforeach

                                </ul>
                            </li>
                        </ul>
                    </div>
                </div>
                
                <div class="row">
                    <div class="this-one col-md-4">
                        <ul>
                            <li>
                                <input type="checkbox"/> Category Model
                                <ul>
                                    @foreach($categoryPermission as $key => $row)
                                    <li>
                                        <input type="checkbox" name="permissions[]" value="{{ $row->id }}" <?php if(isset($permissionSelected)) {
                                            foreach ($permissionSelected as $check) {
                                                if($row->id == $check->id) {
                                                    echo "checked";
                                                }
                                            }
                                        } ?>/>{{ ucwords(str_replace('_',' ',$row->name))}}
                                    </li>
                                    @endforeach

                                </ul>
                            </li>
                        </ul>
                    </div>
                    <div class="this-one col-md-4">
                        <ul>
                            <li>
                                <input type="checkbox"/>Product Model
                                <ul>
                                    @foreach($productPermission as $key => $row)
                                    <li>
                                        <input type="checkbox" name="permissions[]" value="{{ $row->id }}" <?php if(isset($permissionSelected)) {
                                            foreach ($permissionSelected as $check) {
                                                if($row->id == $check->id) {
                                                    echo "checked";
                                                }
                                            }
                                        } ?>/>{{ ucwords(str_replace('_',' ',$row->name))}}
                                    </li>
                                    @endforeach

                                </ul>
                            </li>
                        </ul>
                    </div>
                    <div class="this-one col-md-4">
                        <ul>
                            <li>
                                <input type="checkbox"/>Setting Model
                                <ul>
                                    @foreach($settingPermission as $key => $row)
                                    <li>
                                        <input type="checkbox" name="permissions[]" value="{{ $row->id }}" <?php if(isset($permissionSelected)) {
                                            foreach ($permissionSelected as $check) {
                                                if($row->id == $check->id) {
                                                    echo "checked";
                                                }
                                            }
                                        } ?>/>{{ ucwords(str_replace('_',' ',$row->name))}}
                                    </li>
                                    @endforeach

                                </ul>
                            </li>
                        </ul>
                    </div>
                </div>

                <div class="row">
                    <div class="this-one col-md-4">
                        <ul>
                            <li>
                                <input type="checkbox"/>Affiliate Model
                                <ul>
                                    @foreach($affiliatePermission as $key => $row)
                                    <li>
                                        <input type="checkbox" name="permissions[]" value="{{ $row->id }}" <?php if(isset($permissionSelected)) {
                                            foreach ($permissionSelected as $check) {
                                                if($row->id == $check->id) {
                                                    echo "checked";
                                                }
                                            }
                                        } ?>/>{{ ucwords(str_replace('_',' ',$row->name))}}
                                    </li>
                                    @endforeach

                                </ul>
                            </li>
                        </ul>
                    </div>
                    <div class="this-one col-md-4">
                        <ul>
                            <li>
                                <input type="checkbox"/>Seller Registration Model
                                <ul>
                                    @foreach($sellerPermission as $key => $row)
                                    <li>
                                        <input type="checkbox" name="permissions[]" value="{{ $row->id }}" <?php if(isset($permissionSelected)) {
                                            foreach ($permissionSelected as $check) {
                                                if($row->id == $check->id) {
                                                    echo "checked";
                                                }
                                            }
                                        } ?>/>{{ ucwords(str_replace('_',' ',$row->name))}}
                                    </li>
                                    @endforeach

                                </ul>
                            </li>
                        </ul>
                    </div>
                    <div class="this-one col-md-4">
                        <ul>
                            <li>
                                <input type="checkbox"/>Delivery Registration Model
                                <ul>
                                    @foreach($deliveryPermission as $key => $row)
                                    <li>
                                        <input type="checkbox" name="permissions[]" value="{{ $row->id }}" <?php if(isset($permissionSelected)) {
                                            foreach ($permissionSelected as $check) {
                                                if($row->id == $check->id) {
                                                    echo "checked";
                                                }
                                            }
                                        } ?>/>{{ ucwords(str_replace('_',' ',$row->name))}}
                                    </li>
                                    @endforeach

                                </ul>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="row">
                    <div class="this-one col-md-4">
                        <ul>
                            <li>
                                <input type="checkbox"/> Customer Model
                                <ul>
                                    @foreach($customerPermission as $key => $row)
                                    <li>
                                        <input type="checkbox" name="permissions[]" value="{{ $row->id }}" <?php if(isset($permissionSelected)) {
                                            foreach ($permissionSelected as $check) {
                                                if($row->id == $check->id) {
                                                    echo "checked";
                                                }
                                            }
                                        } ?>/>{{ ucwords(str_replace('_',' ',$row->name))}}
                                    </li>
                                    @endforeach

                                </ul>
                            </li>
                        </ul>
                    </div>
                    <div class="this-one col-md-4">
                        <ul>
                            <li>
                                <input type="checkbox"/>News Category Model
                                <ul>
                                    @foreach($newsCategoryPermission as $key => $row)
                                    <li>
                                        <input type="checkbox" name="permissions[]" value="{{ $row->id }}" <?php if(isset($permissionSelected)) {
                                            foreach ($permissionSelected as $check) {
                                                if($row->id == $check->id) {
                                                    echo "checked";
                                                }
                                            }
                                        } ?>/>{{ ucwords(str_replace('_',' ',$row->name))}}
                                    </li>
                                    @endforeach

                                </ul>
                            </li>
                        </ul>
                    </div>
                    <div class="this-one col-md-4">
                        <ul>
                            <li>
                                <input type="checkbox"/>News Model
                                <ul>
                                    @foreach($newsPermission as $key => $row)
                                    <li>
                                        <input type="checkbox" name="permissions[]" value="{{ $row->id }}" <?php if(isset($permissionSelected)) {
                                            foreach ($permissionSelected as $check) {
                                                if($row->id == $check->id) {
                                                    echo "checked";
                                                }
                                            }
                                        } ?>/>{{ ucwords(str_replace('_',' ',$row->name))}}
                                    </li>
                                    @endforeach

                                </ul>
                            </li>
                        </ul>
                    </div>
                    
                </div>
                <!-- fifth row -->
                <div class="row">
                    <div class="this-one col-md-4">
                        <ul>
                            <li>
                                <input type="checkbox"/> Slider Model
                                <ul>
                                    @foreach($sliderPermission as $key => $row)
                                    <li>
                                        <input type="checkbox" name="permissions[]" value="{{ $row->id }}" <?php if(isset($permissionSelected)) {
                                            foreach ($permissionSelected as $check) {
                                                if($row->id == $check->id) {
                                                    echo "checked";
                                                }
                                            }
                                        } ?>/>{{ ucwords(str_replace('_',' ',$row->name))}}
                                    </li>
                                    @endforeach

                                </ul>
                            </li>
                        </ul>
                    </div>
                    <div class="this-one col-md-4">
                        <ul>
                            <li>
                                <input type="checkbox"/> Delivery Setting Model
                                <ul>
                                    @foreach($deliverySettingPermission as $key => $row)
                                    <li>
                                        <input type="checkbox" name="permissions[]" value="{{ $row->id }}" <?php if(isset($permissionSelected)) {
                                            foreach ($permissionSelected as $check) {
                                                if($row->id == $check->id) {
                                                    echo "checked";
                                                }
                                            }
                                        } ?>/>{{ ucwords(str_replace('_',' ',$row->name))}}
                                    </li>
                                    @endforeach

                                </ul>
                            </li>
                        </ul>
                    </div>

                    <div class="this-one col-md-4">
                        <ul>
                            <li>
                                <input type="checkbox"/> Coupon Model
                                <ul>
                                    @foreach($couponPermission as $key => $row)
                                    <li>
                                        <input type="checkbox" name="permissions[]" value="{{ $row->id }}" <?php if(isset($permissionSelected)) {
                                            foreach ($permissionSelected as $check) {
                                                if($row->id == $check->id) {
                                                    echo "checked";
                                                }
                                            }
                                        } ?>/>{{ ucwords(str_replace('_',' ',$row->name))}}
                                    </li>
                                    @endforeach

                                </ul>
                            </li>
                        </ul>
                    </div>
                </div>

                <!-- Sixth row -->
                <div class="row">
                    <div class="this-one col-md-4">
                        <ul>
                            <li>
                                <input type="checkbox"/> Advertisement Model
                                <ul>
                                    @foreach($advertisementPermission as $key => $row)
                                    <li>
                                        <input type="checkbox" name="permissions[]" value="{{ $row->id }}" <?php if(isset($permissionSelected)) {
                                            foreach ($permissionSelected as $check) {
                                                if($row->id == $check->id) {
                                                    echo "checked";
                                                }
                                            }
                                        } ?>/>{{ ucwords(str_replace('_',' ',$row->name))}}
                                    </li>
                                    @endforeach

                                </ul>
                            </li>
                        </ul>
                    </div>
                    <div class="this-one col-md-4">
                        <ul>
                            <li>
                                <input type="checkbox"/> Brand Model
                                <ul>
                                    @foreach($brandPermission as $key => $row)
                                    <li>
                                        <input type="checkbox" name="permissions[]" value="{{ $row->id }}" <?php if(isset($permissionSelected)) {
                                            foreach ($permissionSelected as $check) {
                                                if($row->id == $check->id) {
                                                    echo "checked";
                                                }
                                            }
                                        } ?>/>{{ ucwords(str_replace('_',' ',$row->name))}}
                                    </li>
                                    @endforeach

                                </ul>
                            </li>
                        </ul>
                    </div>

                    <div class="this-one col-md-4">
                        <ul>
                            <li>
                                <input type="checkbox"/> Push Notification Model
                                <ul>
                                    @foreach($pushNotificationPermission as $key => $row)
                                    <li>
                                        <input type="checkbox" name="permissions[]" value="{{ $row->id }}" <?php if(isset($permissionSelected)) {
                                            foreach ($permissionSelected as $check) {
                                                if($row->id == $check->id) {
                                                    echo "checked";
                                                }
                                            }
                                        } ?>/>{{ ucwords(str_replace('_',' ',$row->name))}}
                                    </li>
                                    @endforeach

                                </ul>
                            </li>
                        </ul>
                    </div>
                </div>

                <!-- Seventh row -->
                <div class="row">
                    <div class="this-one col-md-4">
                        <ul>
                            <li>
                                <input type="checkbox"/> Sales Return Model
                                <ul>
                                    @foreach($salesReturnPermission as $key => $row)
                                    <li>
                                        <input type="checkbox" name="permissions[]" value="{{ $row->id }}" <?php if(isset($permissionSelected)) {
                                            foreach ($permissionSelected as $check) {
                                                if($row->id == $check->id) {
                                                    echo "checked";
                                                }
                                            }
                                        } ?>/>{{ ucwords(str_replace('_',' ',$row->name))}}
                                    </li>
                                    @endforeach

                                </ul>
                            </li>
                        </ul>
                    </div>
                    <div class="this-one col-md-4">
                        <ul>
                            <li>
                                <input type="checkbox"/> Seller Finance Model
                                <ul>
                                    @foreach($sellerFinancePermission as $key => $row)
                                    <li>
                                        <input type="checkbox" name="permissions[]" value="{{ $row->id }}" <?php if(isset($permissionSelected)) {
                                            foreach ($permissionSelected as $check) {
                                                if($row->id == $check->id) {
                                                    echo "checked";
                                                }
                                            }
                                        } ?>/>{{ ucwords(str_replace('_',' ',$row->name))}}
                                    </li>
                                    @endforeach

                                </ul>
                            </li>
                        </ul>
                    </div>

                    <div class="this-one col-md-4">
                        <ul>
                            <li>
                                <input type="checkbox"/> Affiliate Finance Model
                                <ul>
                                    @foreach($affiliateFinancePermission as $key => $row)
                                    <li>
                                        <input type="checkbox" name="permissions[]" value="{{ $row->id }}" <?php if(isset($permissionSelected)) {
                                            foreach ($permissionSelected as $check) {
                                                if($row->id == $check->id) {
                                                    echo "checked";
                                                }
                                            }
                                        } ?>/>{{ ucwords(str_replace('_',' ',$row->name))}}
                                    </li>
                                    @endforeach

                                </ul>
                            </li>
                        </ul>
                    </div>
                </div>

                <button class="btn btn-info" type="submit">Submit</button>
                <a class="btn btn-warning" href="{{ url('ns-admin/roles') }}">Cancel</a>

            </form>

        </div>
    </div>
</div>
<!-- END PAGE CONTENT-->

@stop

@section('footer')

<script>
    $('li :checkbox').on('click', function () {
        var $chk = $(this), $li = $chk.closest('li'), $ul, $parent;
        if ($li.has('ul')) {
            $li.find(':checkbox').not(this).prop('checked', this.checked)
        }
        do {
            $ul = $li.parent();
            $parent = $ul.siblings(':checkbox');
            if ($chk.is(':checked')) {
                $parent.prop('checked', $ul.has(':checkbox:not(:checked)').length == 0)
            } else {
                $parent.prop('checked', false)
            }
            $chk = $parent;
            $li = $chk.closest('li');
        } while ($ul.is(':not(.someclass)'));
    });

</script>

@stop