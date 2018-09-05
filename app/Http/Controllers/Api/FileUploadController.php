<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\Api\ImageRequest;
use App\Models\Image;
use Illuminate\Http\Request;
use App\Helpers\ImageUpload;
use Auth;

// 文件上传
class FileUploadController extends Controller
{
    // 文件上传
    public function store(ImageRequest $request, ImageUpload $imageUpload, Image $image)
    {
        $type = $request->type;
        if (!$type) {
            $type = 'topic';
        }

        $folder = $type;
        $file_prefix = Auth::user()->id;
        $max_width = $type == 'topic' ? 800 : 200;
        $result = $imageUpload->save($request->image, $folder, $file_prefix, $max_width);

        if ($result) {
            $image->path = $result['path'];
            $image->type = $type;
            $image->user_id = Auth::user()->id;
            $image->save();


            $data = [
                'type' => $type,
                'path' => $result['path'],
                'image_id' => $image->id,
            ];
            return $this->success($data);
        } else {
            return $this->failed(trans('web.upload_error'));
        }
    }
}
