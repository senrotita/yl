<?php

namespace App\Http\Controllers;

use App\Model\Banner;
use App\Model\Book;
use App\Model\Product;
use App\Model\RandomPool;
use App\Model\SmsManager;
use App\Model\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Response;

class IndexController extends Controller
{


    /*为小程序提供无差别接口服务*/
    public function anyHomeMain()
    {
        $banner = Banner::getBannerList([1]);
        foreach( $banner as $key=>$item)
        {
            $banner[$key]->url = env('IMAGE_HOST') . $item->cover_image;
        }

        //判断vip信息
        $user = User::find(Request::input('openid'));
        $vip = ['isVip'=>false];
        if( $user instanceof  User)
        {
            if ( $user->vipExpireDay() )
            {
                $vip['isVip'] = true;
                $vip['expire'] = $user->vipExpireDay();
            }
        }

        return $this->jsonReturn(1,['banners'=>$banner,'vip'=>$vip]);
    }


    public function anyDetail()
    {
        $type = Request::input('type',1);
        return view('type');
    }
    /*end of block*/



    //首页
    public function getIndex()
    {
        $product = Product::find(1);
        $list = DB::table('essays')->orderBy('sort','desc')->get();
        return view('index')->with('product',$product)->with('list',$list);
    }

    public function getTest()
    {
//        $directUser = User::find(53);
//        $directUser->increment('charge_frozen',111);
//        $directUser->save();
        //DB::table('users')->where('id',53)->increment('charge_frozen',111);
        dd(4);
//        set_time_limit(3600);
//        RandomPool::make(1000);
//        exit;
    }

    public function getCalendarJson()
    {
//        [{"name":2018,"value":180000,"child":[{"name":"01","value":180100}]}]
        $startMonth = '2017-11';

        $currentMonth = $startMonth;
        $data = [];

        while(date('Y',strtotime($currentMonth)) <= date('Y'))
        {
            $currentTime = strtotime($currentMonth);
            $Y  = date('Y',$currentTime);
            $y = date('y',$currentTime);
            $data[] = (object)["name"=>$Y,"id"=>$y . '0000',"child"=>[]];
            $currentMonth = date('Y-m',strtotime('+1 year',$currentTime));
        }


        foreach($data as $key=>$val){
            if($data[$key]->name == date('Y')){
                for($i = 1;$i <= date('m');$i++)
                {
                    if($i < 10) {
                        $date = '0' . $i;
                    }else{
                        $date = $i;
                    }
                    $data[$key]->child[] = (object)["name"=>$date,"id"=>$data[$key]->id + $date * 100];
                }
            }else{
                for($i = 1;$i < 13; $i++)
                {
                    if($i < 10) {
                        $date = '0' . $i;
                    }else{
                        $date = $i;
                    }
                    $data[$key]->child[] = (object)["name"=>$date,"id"=>$data[$key]->id + $date * 100];
                }
            }

        }

        return Response::json($data);
    }


    public function getSms()
    {
        $query = SmsManager::orderBy('id','desc');

        if(Request::input('mobile'))
        {
            $query->where('mobile',Request::input('mobile'));
        }

        $res = $query->limit(10)->get();

        foreach($res as $key=>$val)
        {
            echo $val->mobile  . ':' . $val->content . '<br/>';
        }

        exit;
    }

    /**
     * 充点钱
     */
    public function getSetCharge()
    {
        $user = User::where('phone',Request::input('mobile'))->first();
        if(!$user) {
            dd('用户不存在');
        }

        $charge = intval(Request::input('charge'));

        $user->charge = $charge;

        $user->save();
        dd('修改成功');
    }


    /**
     * 理财报名
     */
    public function getAttendFinance()
    {
        $product = Product::activeFinance();
        $user_id = Request::input('user_id');

        $booked = Book::isBooked($user_id,$product->id)?true:false;
        return view('attend_finance')->with('product',$product)->with('booked',$booked);
    }


    /**
     * 理财预约
     */
    public function anyBookFinance()
    {
        $product = Product::activeFinance();
        $user_id = Request::input('user_id');

        Book::firstOrCreate(['product_id'=>$product->id,'user_id'=>$user_id]);

        return $this->jsonReturn(1);
    }


    public function getHealth()
    {
        $product = Product::activeHealth();
        $user_id = Request::input('user_id');
        return view('health')->with('product',$product);
    }



    /*任务管理*/


}