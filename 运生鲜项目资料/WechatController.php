<?php
/**
 * Created by PhpStorm.
 * User: HappyQi
 * Date: 2018/1/11
 * Time: 9:43
 */

namespace App\Http\Controllers\API;


use App\Components\DateTool;
use App\Components\GoodsInfoManager;
use App\Components\MemberManager;
use App\Components\OrderManager;
use App\Components\SubOrderManager;
use App\Components\UserManager;
use App\Components\Utils;
use App\Http\Controllers\Controller;
use App\Models\MemberOrder;
use App\Models\Order;
use App\Models\SubOrder;
use Illuminate\Http\Request;
use App\Http\Controllers\ApiResponse;
use App\Components\RequestValidator;
use Illuminate\Support\Facades\Log;
use Yansongda\Pay\Pay;


class WechatController extends Controller
{
    //获取小程序微信支付的相关信息
    private function getConfig()
    {
        $config = [
            'appid' => '', // APP APPID
            'app_id' => '', // 公众号 APPID
            'miniapp_id' => 'wxb4077b9735ca748a',       //小程序miniapp_id
            'mch_id' => '1497470122',                    // 微信商户号
            'key' => 'LltO2bE5r4sGVJZjn0zd4aRsNQHezIiJ',                     // 微信支付签名秘钥  ImpYNtH4B5x7C587qy5ujzS6fbZnNv6T
            'notify_url' => 'https://yxp.isart.me/api/wechat/notify',      //支付结果通知地址  https://tclm.isart.me/api/wechat/notify
            'cert_client' => app_path() . '/cert/apiclient_cert.pem',        // 客户端证书路径，退款时需要用到
            'cert_key' => app_path() . '/cert/apiclient_key.pem',             // 客户端秘钥路径，退款时需要用到
            'log' => [ // optional
                'file' => app_path() . '/../storage/logs/wechat.log',
                'level' => 'debug'
            ]
        ];
        return $config;
    }


    /*
     * 获取小程序登录信息
     *
     * By TerryQi
     *
     */
    public function miniProgramLogin(Request $request)
    {
        $data = $request->all();
        //合规校验account_type
        $requestValidationResult = RequestValidator::validator($request->all(), [
            'code' => 'required',
        ]);
        if ($requestValidationResult !== true) {
            return ApiResponse::makeResponse(false, $requestValidationResult, ApiResponse::MISSING_PARAM);
        }
        $app = app('wechat.mini_program');
        $result = $app->auth->session($data['code']);
        return ApiResponse::makeResponse(true, $result, ApiResponse::SUCCESS_CODE);
    }

    /*
     * 订购会员
     *
     * By TerryQi
     *
     * 2018-01-12
     */
    public function payOrder(Request $request)
    {
        $data = $request->all();
        //合规校验account_type
        $requestValidationResult = RequestValidator::validator($request->all(), [
            'user_id' => 'required',
            'total_fee' => 'required',
            'address_id' => 'required',
//            'invoice_id' => 'required',
            'goods' => 'required',
        ]);
        if ($requestValidationResult !== true) {
            return ApiResponse::makeResponse(false, $requestValidationResult, ApiResponse::MISSING_PARAM);
        }
        $user = UserManager::getUserInfoById($data['user_id']);
        //生成订单
        $order = new Order();
        $order->user_id = $data['user_id'];
        $order->total_fee = $data['total_fee'];
        $order->address_id = $data['address_id'];
        $order->invoice_id = $data['invoice_id'];
        $order->content = "运鲜婆土特产品";
        $order->trade_no = Utils::generateTradeNo();
        //进行总订单支付
        $pay_order = [
            'out_trade_no' => $order->trade_no,
            'total_fee' => $order->total_fee,
            'body' => $order->content,
            'spbill_create_ip' => '47.93.127.4',
            'openid' => $user->xcx_openid,
        ];
//        dd($order);
        //配置config
        $config = $this->getConfig();
        $result = Pay::wechat($config)->miniapp($pay_order);
        //如果预下单成功
        if ($result) {
            //设置总订单prepay_id
            $order->prepay_id = explode("=", $result['package'])[1];
            $order->save();
            //生成子订单
            foreach ($data['goods'] as $goods) {
                $suborder = new SubOrder();
                $suborder->sub_trade_no = Utils::generateTradeNo();
                $suborder->trade_no = $order->trade_no;
                $suborder->user_id = $data['user_id'];
                $suborder->goods_id = $goods['goods_id'];
                $suborder->total_fee = $goods['total_fee'];
                $suborder->count = $goods['count'];
                $goods_s = GoodsInfoManager::getGoodsById($goods['goods_id']);
                $suborder->content = "运鲜婆土特产" . $goods_s->title;
                $suborder->save();
            }
            return ApiResponse::makeResponse(true, $result, ApiResponse::SUCCESS_CODE);
        } else {
            return ApiResponse::makeResponse(false, ApiResponse::$errorMassage[ApiResponse::UITIFY_ORDER_FAILED], ApiResponse::UITIFY_ORDER_FAILED);
        }

    }

    /*
     * 微信支付成功回调
     *
     * By TerryQi
     *
     * 2018-01-12
     */
    public function notify(Request $request)
    {
        $config = $this->getConfig();
        $wechat = Pay::wechat($config);
        try {
            $data = $wechat->verify($request->getContent()); // 是的，验签就这么简单！
            Log::info('Wechat notify', $data->all());
            //支付成功
            if ($data->result_code == "SUCCESS") {
                //总订单out_trade_no
                $out_trade_no = $data->out_trade_no;
                //针对总订单进行处理
                $order = OrderManager::getOrderByTradeNo($out_trade_no);
                $order->pay_at = DateTool::getCurrentTime();
                $order->status = Utils::ORDER_PAYSUCCESS;
                $order->save();     //总订单设定支付时间和订单状态
                Log::info('order trade_no:'.$order->trade_no);
                $sub_orders = SubOrderManager::getSubOrderByTradeNo($order->trade_no);
                Log::info('sub_orders:'.json_encode($sub_orders));
                //全部子订单设定支付状态
                foreach ($sub_orders as $sub_order) {
                    $sub_order->status = Utils::ORDER_PAYSUCCESS;
                    $sub_order->save();
                }
            }
            return $wechat->success();
        } catch (Exception $e) {
            Log::info($e->getMessage());
        }
    }


}