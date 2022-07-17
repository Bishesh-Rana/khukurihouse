<?php

namespace App\Http\Controllers\Admin;

use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class RoleController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function index()
    {
        $roles = Role::get();
        return view('admin.list.role', compact('roles'));
    }

    public function create()
    {
        $contentPermission = Permission::where('table_name', 'tbl_contents')->get();
        $sellerPermission = Permission::where('table_name', 'tbl_sellers')->get();
        $deliveryPermission = Permission::where('table_name', 'tbl_deliveries')->get();
        $affiliatePermission = Permission::where('table_name', 'tbl_affiliates')->get();
        $customerPermission = Permission::where('table_name', 'tbl_customers')->get();
        // $parentCategoryPermission = Permission::where('table_name','tbl_parent_categories')->get();
        // $childCategoryPermission = Permission::where('table_name','tbl_child_categories')->get();
        // $subCategoryPermission = Permission::where('table_name','tbl_sub_categories')->get();
        $categoryPermission = Permission::where('table_name', 'tbl_categories')->get();
        $productPermission = Permission::where('table_name', 'tbl_products')->get();
        $adminPermission = Permission::where('table_name', 'tbl_admins')->get();
        $settingPermission = Permission::where('table_name', 'tbl_settings')->get();
        $rolePermission = Permission::where('table_name', 'tbl_roles')->get();
        $newsCategoryPermission = Permission::where('table_name', 'tbl_news_categories')->get();
        $newsPermission = Permission::where('table_name', 'tbl_news')->get();
        $sliderPermission = Permission::where('table_name', 'tbl_sliders')->get();
        $deliverySettingPermission = Permission::where('table_name', 'tbl_delivery_settings')->get();
        $couponPermission = Permission::where('table_name', 'tbl_coupons')->get();
        $advertisementPermission = Permission::where('table_name', 'tbl_advertisements')->get();
        $brandPermission = Permission::where('table_name', 'tbl_brands')->get();
        $pushNotificationPermission = Permission::where('table_name', 'tbl_push_notifications')->get();
        $salesReturnPermission = Permission::where('table_name', 'tbl_sales_returns')->get();
        $sellerFinancePermission = Permission::where('table_name', 'tbl_statements')->where('name', 'create_statement')->orWhere('name', 'browse_statement')->get();
        $affiliateFinancePermission = Permission::where('table_name', 'tbl_affiliate_statements')->where('name', 'create_affiliate_statement')->orWhere('name', 'browse_affiliate_statement')->get();

        return view('admin.form.role', compact(
            'contentPermission',
            'sellerPermission',
            'newsCategoryPermission',
            'productPermission',
            'adminPermission',
            'settingPermission',
            'rolePermission',
            'categoryPermission',
            'newsPermission',
            'sliderPermission',
            'deliveryPermission',
            'affiliatePermission',
            'customerPermission',
            'deliverySettingPermission',
            'couponPermission',
            'advertisementPermission',
            'brandPermission',
            'pushNotificationPermission',
            'salesReturnPermission',
            'sellerFinancePermission',
            'affiliateFinancePermission'
        ));
    }

    public function store(Request $request)
    {
        // $galleryId = request('gallery');

        //validate the form
        $this->validate(request(), [

            'name' => 'required|unique:roles|max:255',

        ]);
        //dd('wait');
        //create and save category
        $role = new Role();

        $role->name = request('name');
        // $role->guard_name = 'admin';

        $role->save();

        $permissionId = request('permissions');
        // dd($permissionId);

        if ($permissionId !== null) {
            foreach ($permissionId as $permission) {
                // dd($role);
                $role = Role::where('id', $role->id)->first();
                $role->givePermissionTo($permission);
            }
        }
        return redirect('/ns-admin/roles')->with('success', 'Role created successfully.');
    }

    public function edit($role)
    {
        $role = Role::where('id', $role)->first();

        $contentPermission = Permission::where('table_name', 'tbl_contents')->get();
        $sellerPermission = Permission::where('table_name', 'tbl_sellers')->get();
        $deliveryPermission = Permission::where('table_name', 'tbl_deliveries')->get();
        $affiliatePermission = Permission::where('table_name', 'tbl_affiliates')->get();
        $customerPermission = Permission::where('table_name', 'tbl_customers')->get();
        // $parentCategoryPermission = Permission::where('table_name','tbl_parent_categories')->get();
        // $childCategoryPermission = Permission::where('table_name','tbl_child_categories')->get();
        // $subCategoryPermission = Permission::where('table_name','tbl_sub_categories')->get();
        $categoryPermission = Permission::where('table_name', 'tbl_categories')->get();
        $productPermission = Permission::where('table_name', 'tbl_products')->get();
        $adminPermission = Permission::where('table_name', 'tbl_admins')->get();
        $settingPermission = Permission::where('table_name', 'tbl_settings')->get();
        $rolePermission = Permission::where('table_name', 'tbl_roles')->get();
        $newsCategoryPermission = Permission::where('table_name', 'tbl_news_categories')->get();
        $newsPermission = Permission::where('table_name', 'tbl_news')->get();
        $sliderPermission = Permission::where('table_name', 'tbl_sliders')->get();
        $deliverySettingPermission = Permission::where('table_name', 'tbl_delivery_settings')->get();
        $couponPermission = Permission::where('table_name', 'tbl_coupons')->get();
        $advertisementPermission = Permission::where('table_name', 'tbl_advertisements')->get();
        $permissionSelected = $role->getAllPermissions();
        $brandPermission = Permission::where('table_name', 'tbl_brands')->get();
        $pushNotificationPermission = Permission::where('table_name', 'tbl_push_notifications')->get();
        $salesReturnPermission = Permission::where('table_name', 'tbl_sales_returns')->get();
        $sellerFinancePermission = Permission::where('table_name', 'tbl_statements')->where('name', 'create_statement')->orWhere('name', 'browse_statement')->get();
        $affiliateFinancePermission = Permission::where('table_name', 'tbl_affiliate_statements')
            ->where('name', 'create_affiliate_statement')
            ->orWhere('name', 'browse_affiliate_statement')
            ->get();
        // dd($permissionSelected);

        return view('admin.form.role', compact(
            'role',
            'contentPermission',
            'sellerPermission',
            'permissionSelected',
            'newsCategoryPermission',
            'productPermission',
            'adminPermission',
            'settingPermission',
            'rolePermission',
            'categoryPermission',
            'newsPermission',
            'sliderPermission',
            'deliveryPermission',
            'affiliatePermission',
            'customerPermission',
            'deliverySettingPermission',
            'couponPermission',
            'advertisementPermission',
            'brandPermission',
            'pushNotificationPermission',
            'salesReturnPermission',
            'sellerFinancePermission',
            'affiliateFinancePermission'
        ));
    }

    public function update(Request $request, $id)
    {
        $role = Role::where('id', $id)->first();
        // dd($role);

        $this->validate(request(), [
            'name' => 'required',
        ]);

        $data = ([
            'name' => request('name'),
        ]);

        Role::where('id', $id)->update($data);

        $role->permissions()->detach();
        $permissionId = request('permissions');
        // dd($permissionId);

        if ($permissionId !== null) {
            foreach ($permissionId as $permission) {
                $role = Role::where('id', $id)->first();
                $role->givePermissionTo($permission);
            }
        }

        //redirect to dashboard
        return redirect('/ns-admin/roles')->with('success', 'Role updated successfully.');
    }
}
