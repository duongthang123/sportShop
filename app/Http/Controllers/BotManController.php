<?php

namespace App\Http\Controllers;

use App\Http\Services\OrderService;
use App\Http\Services\ProductService;
use BotMan\BotMan\BotMan;
use BotMan\BotMan\Messages\Incoming\Answer;
use BotMan\BotMan\Messages\Outgoing\Actions\Button;
use BotMan\BotMan\Messages\Outgoing\Question;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BotManController extends Controller
{
    protected $orderService;
    protected $productService;

    public function __construct(OrderService $orderService, ProductService $productService)
    {
        $this->orderService = $orderService;
        $this->productService = $productService;
    }

    public function handle()
    {
        $botman = app('botman');

        $botman->hears('{message}', function (\BotMan\BotMan\BotMan $botman, $message) {
            $arrayHi = ['chào shop','lô', 'chao', 'chào', 'hello', 'xin chào', 'alo', 'shop ơi', '.', 'hi', 'xin chao', 'helu', 'anhon' , 'lo' , 'lô'];
            $arrayBye = ['Cảm ơn', 'cảm ơn', 'cảm ơn shop', 'oke', 'ok', 'bye shop', 'thanks', 'Thank shop', 'thank shop'];
            $arrayInforSop = ['zalo của shop', 'liên hệ với shop', 'Liên hệ', 'lien he' , 'liên hệ','địa chỉ', 'số điện thoại shop', 'cửa hàng shop ở đâu', 'shop ở đâu', 'địa chỉ shop ở đâu', 'thông tin của shop'];
            $arrayBuy = ['tôi muốn đặt hàng', 'dat hang', 'đặt hàng như nào', 'mua hang', 'tôi muốn mua hàng', 'tư vấn cho tôi', 'mua hàng', 'toi muon mua hang', 'cach mua hang', 'dat hang kieu gi'];


            if(in_array($message, $arrayHi)) {
                $this->startConversation($botman);
                $this->sayHi($botman);
            }
            else if(in_array($message, $arrayBuy)) {
                $this->buyProduct($botman);
            }
            else if($message == 'tôi muốn kiểm tra đơn hàng') {
                $this->checkOrderStatus($botman);
            }
            else if(in_array($message, $arrayInforSop)) {
                $botman->reply('Thông tin liên hệ');
                $botman->reply('Địa chỉ: Lương Xá, Lương Điền, Cẩm Giàng, Hải Dương');
                $botman->reply('Số điện thoại: 0961172612');

            }
            else if(in_array($message, $arrayBye)) {
                $botman->reply('Cảm ơn bạn, nếu còn câu hỏi hãy liên hệ shop để được shop hỗ trợ nhé!');
                $this->startConversation($botman);
            }
            else if($message == 'tôi muốn hủy đơn hàng') {
                $this->cancelOrder($botman);
            }

            else {
                $botman->reply('Tôi không hiểu câu hỏi của bạn!');
                $this->startConversation($botman);
            }
        });

        $botman->listen();
    }

    public function startConversation(BotMan $botman)
    {
        $question = Question::create("Chào mừng bạn đến với SportShop! Bạn muốn làm gì tiếp theo?")
            ->addButtons([
                Button::create('Kiểm tra đơn hàng')->value('tôi muốn kiểm tra đơn hàng'),
                Button::create('Mua hàng')->value('mua hàng'),
                Button::create('Liên hệ cửa hàng')->value('liên hệ')
            ]);

        $botman->reply($question);
    }

    public function sayHi($botman)
    {
        $botman->ask('Xin chào, bạn tên là gì?', function (Answer $answer) {
            $name = $answer->getText();
            $this->say('Xin chào bạn '.$name. '. Shop có thể giúp gì được cho bạn?');
        });
    }

    public function checkOrderStatus($botman)
    {
        $orderService = $this->orderService;

        $botman->ask('Bạn vui lòng cho shop mã đơn hàng để shop kiểm tra cho bạn nhé.', function (Answer $answer) use ($orderService) {
            $orderId = $answer->getText();
            $statusOrder = $orderService->getOrderById($orderId);
            if($statusOrder) {
                $this->say('Đơn hàng: '.$orderId. ' của ' . $statusOrder['customer_name'] . ' đang trong trạng thái: '. $statusOrder['status']);
            } else{
                $this->say('Đơn hàng: '.$orderId. ' không tồn tại! Vui lòng thử lại');
            }
        });
    }

    public function cancelOrder($botman)
    {
        $orderService = $this->orderService;

        $botman->ask('Bạn cho shop mã đơn hàng để shop kiểm tra đơn hàng bạn muốn hủy nhé!.', function (Answer $answer) use ($orderService) {
            $orderId = $answer->getText();
            $statusOrder = $orderService->getStatusOrderById($orderId, Auth::user()->id);
            if($statusOrder['status'] == 'Đợi duyệt') {
                $this->say('Đơn hàng: '.$orderId. ' của bạn đang trong trạng thái: '. $statusOrder['status'] . ' Vui lòng liên hệ với nhân viên để được hủy!');
            }
            elseif ($statusOrder['status'] == 'Đã hủy') {
                $this->say('Đơn hàng: '.$orderId. ' của bạn đã được hủy');
            }
            else{
                $this->say('Đơn hàng: '.$orderId. ' đang trong trạng thái ' . $statusOrder['status'] . ' nên không thể hủy! Nếu không nhận hàng vui lòng liên hệ với nhân viên để được hỗ trợ!');
            }
        });
    }
    public function buyProduct($botman)
    {
        $productService = $this->productService;

        $botman->ask('Bạn muốn mua sản phẩm nào. Hãy cho shop Mã sản phẩm bạn muốn mua để shop hỗ trợ!', function (Answer $answer) use ($productService) {
            $productId = $answer->getText();
            if(is_numeric($productId)) {
                $product = $productService->getProductById($productId);
                $productQty =$product->details->sum('quantity');
                if($product) {
                    $message = $product['name'] . ' còn ' . $productQty . ' sản phẩm trong kho. Hãy mua ngay để nhận ưu đãi!' . PHP_EOL . PHP_EOL;
                    $message .= "Các bước đặt hàng:" . " Cửa hàng -> Tìm kiếm sản phẩm -> Chọn size và màu sắc -> Thanh toán.";
                    $this->say($message);
                }
            }
             else {
                $message = 'Để mua sản phẩm ' . $productId . ' hãy vào cửa hàng, nhập tên vào ô tìm kiếm và chọn size và màu sắc chính xác sản phẩm bạn muốn mua  nhé !';
                $this->say($message);
            }
        });
    }


}
