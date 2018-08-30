<?php
/**
 * Created by PhpStorm.
 * User: fay
 * Date: 2018/8/29
 * Time: 下午5:12
 */

namespace App\Helpers;
use Image;

class ImageUpload
{
    // 允许上传的文件后缀
    protected $allowed_ext = ['jpg','jpeg','png','gif'];

    /**
     * @param $file request->file  上传的文件
     * @param $folder
     * @param $file_prefix
     * @param bool $max_width
     * @return array
     */
    public function save($file, $folder, $file_prefix, $max_width = false)
    {
        // 设置文件目录
        $folder_name = 'uploads/'.$folder.'/'.date('Ym').'/'.date('d').'/';

        $upload_path = public_path().'/'.$folder_name;

        // 获取文件的后缀名
        $extention = strtolower($file->getClientOriginalExtension()) ? : 'png';

        // 设置文件名称
        $file_name = $file_prefix .'_'. time() .'_'. strtolower(str_random(6)) .'.'. $extention;

        // 如果上传的不是图片将终止操作
        if ( ! in_array($extention, $this->allowed_ext)) {
            return false;
        }

        $file->move($upload_path, $file_name);

        if ($max_width && $extention != 'gif') {
            $this->reduceSize($upload_path .'/'. $file_name, $max_width);
        }

        return [
            'path' => config('app.url'). '/' .$folder_name . $file_name,
        ];

    }

    // 剪裁图片
    public function reduceSize($file_path, $max_width)
    {
        // file_path 文件的物理路径
        $image = Image::make($file_path);
        $image->resize($max_width, null, function ($constraint) {

            // 设定宽度是 $max_width，高度等比例双方缩放
            $constraint->aspectRatio();

            // 防止裁图时图片尺寸变大
            $constraint->upsize();
        });

        $image->save();
    }
}