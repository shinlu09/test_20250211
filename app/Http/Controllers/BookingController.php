<?php

namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use App\Shop\Entity\Booking;

class BookingController extends Controller
{
    // 預約頁面

    public function BookingPage ()
    {
        $binding=[
            'title' =>'預約',
            'note' =>'預約頁面'
        ];
        return view('booking.booking',$binding);

    }
    //新增預約

    public function BookingProcess()
    {
        $input = request()->all();
        print_r($input);

        if($input['name']==''){
            print('姓名不得為空');
            return redirect('/booking/booking')
                ->withErrors(['姓名不得為空', '請重新輸入'])
                ->withInput();

        }else if($input['email']==''){
            rint('郵件不得為空');
            return redirect('/booking/booking')
                ->withErrors(['郵件不得為空', '請重新輸入'])
                ->withInput();

        }else if($input['phone']==''){
            rint('電話不得為空');
            return redirect('/booking/booking')
                ->withErrors(['電話不得為空', '請重新輸入'])
                ->withInput();
        
        }else if($input['booking_time']==''){
            rint('預約時間不得為空');
            return redirect('/booking/booking')
                ->withErrors(['預約不得為空', '請重新輸入'])
                ->withInput();
        
        }else{

            Booking::create([

                'name' => $input->input('name'),
                'email' => $input->input('email'),
                'phone' => $input->input('phone'),
                'date' => $input->input('date'),
                'time' => $input->input('time'),
                
            ]);

        }
        Mail::send('email.Booking',

        //送給郵件參數

        ['name' => $input['name']],
        function($message) use ($input) {
            $message->to($input['email'], $input['name'])
            
            //發送郵件端,需跟.env中MAIL_USERNAME=相同
            ->from('g0970980831@gmail.com')
            ->subject('已預約成功');
        });
    }
}
