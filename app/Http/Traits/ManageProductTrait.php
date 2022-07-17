<?php

namespace App\Http\Traits;

use Illuminate\Support\Facades\DB;
use Intervention\Image\Facades\Image;
use App\Models\Photo;
use Illuminate\Support\Facades\Validator;

trait ManageProductTrait
{
    public function imageUpload($request, $file, $imagename, $uploadfolder, $formImage) //formImage for validation
    {

        $v = Validator::make([$formImage => request()->file($formImage)], [
            $formImage => 'image|mimes:jpeg,png,jpg,gif,svg|max:5120',
            ]);
            if ($v->fails()) {
                $response = array(
                    'status' => 'error',
                    'message' => $v->getMessageBag()->toArray()
                );
            } else {
                if ($file != null) {
                    $image_name = "$imagename" . time() . "." . $file->clientExtension();

                    // open an image file
                    $img = Image::make($file);

                    // save image in desired format
                    $img->save('uploads/' . $uploadfolder . '/' . $image_name);


                    if($request->image_id == '') {
                    $photo = new Photo();
                    $photo->image = $image_name;
                    $photo->imageable_id = $request->product_id;
                    $photo->imageable_type = 'App\Product';
                    $photo->save();
                    }

                    else{

                    $check_image_id = Photo::where('id', $request->image_id)->first();


                        $data = [
                            'image' => $image_name,
                        ];
                        Photo::where('id', $request->image_id)->update($data);



                    // else{

                    //     $response = array(
                    //         'status' => 'error',
                    //         'message' => $v->getMessageBag()->toArray()
                    //     );
                    // }

                    }


                     }

                $response = array(
                    'status' => 'success',
                    'message' => 'Image Uploaded Successfully!'
                );
            }
            header('Content-Type: application/json');
            echo json_encode($response);
        }
    }
