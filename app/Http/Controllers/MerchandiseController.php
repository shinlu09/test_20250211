<?php

//使用繼承的方式(複製另存成額外的controller.php)載入外部

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Hash;
use App\Shop\Entity\User;
use Illuminate\Support\Facades\Mail;

//新增連結使用的資料表(建立商品)
use App\Shop\Entity\Merchandise;



//建立路由控制器,注意下方檔名(MerchandiseController)與(MerchandiseController.php)要完全一致
class MerchandiseController  extends Controller 
{

    //設定建立商品路由
    public function MerchandiseCreateProcess(){
        $merchandise_data=[
            'id'=>'3',
            'status' => 'C',
            'name' => '',
            'name_en' => '',
            'introduction' => '',
            'introduction_en' => '',
            'photo' => '',
            'price' => 0,
            'remain_count' => 3,

        ];

    //將建立的商品內容寫入mysql資料表
    $merchandise_sql_data = Merchandise::create($merchandise_data);

    return redirect('/merchandise/' . $merchandise_sql_data['id'] . '/edit');

    }

    //設定編輯商品路由
    public function MerchandiseEditPage($merchandise_id)
    {
        $merchandises = Merchandise::where('id', $merchandise_id);
        if ($merchandises->count() === 0) {
            return redirect('/');
        } else {
            $merchandise = $merchandises->first();
            $binding = [
                'title' => '編輯商品',
                'merchandise' => $merchandise
            ];
            return view('merchandise.edit', $binding);
        }
    }
    public function MerchandiseEditProcess($merchandise_id)
    {
        $input = request()->all();

        //修改時會因laravel的_token阻擋修改,於是寫入unset
        unset($input['_token']);

       

        //上傳圖片設置
        if (isset($input['photo'])) {
            // 有上傳圖片
            $photo = $input['photo'];
            // 檔案副檔名
            $file_extension = $photo->getClientOriginalExtension();
            // 產生自訂隨機檔案名稱
            $file_name = uniqid() . '.' . $file_extension;
            // 檔案相對路徑
            $file_relative_path = 'images/merchandise/';
            // 檔案存放目錄為對外公開 public 目錄下的相對位置
            $file_path = public_path($file_relative_path);

            //移動上傳檔案設置
            $photo->move($file_path,$file_name);

            //寫入資料庫設置,存入的檔案路徑是相對路徑
            $input['photo']=$file_relative_path.$file_name;

            print($file_path);
            // 裁切圖片
            // $image = Image::make($photo)->fit(450, 300)->save($file_path);
            // 設定圖片檔案相對位置
            // $input['photo'] = $file_relative_path;
        }
         //編輯商品設置
         Merchandise::where('id', $merchandise_id)
            ->update($input);
            return redirect('/merchandise/' . $merchandise_id . '/edit');

    }
    //管理商品設置
    public function MerchandiseManagePage()
    {
        $merchandises = Merchandise::get();
        $binding = [
            'title' => '管理商品',
            'merchandises' => $merchandises
        ];
        return view('merchandise.manage', $binding);
    }

    //刪除商品
    public function MerchandiseDelete()
    {
        $merchandises = Merchandise::delete();
        $binding = [
            'title' => '刪除商品',
            'merchandises' => $merchandises
        ];
        return view('merchandise.manage', $binding);
    }
    


        


}
