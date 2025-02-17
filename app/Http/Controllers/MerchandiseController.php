<?php

//使用繼承的方式(複製另存成額外的controller.php)載入外部

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Hash;
use App\Shop\Entity\User;
use Illuminate\Support\Facades\Mail;

//新增連結使用的資料表(建立商品)
use App\Shop\Entity\Merchandise;



//建立路由控制器,注意下方檔名(UMerchandiseController)與(MerchandiseController.php)要完全一致
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
    
    


        


}
