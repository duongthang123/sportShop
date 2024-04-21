<?php

namespace App\Http\Services;

use App\Http\Repository\CartRepository;
use App\Http\Repository\ProductRepository;

class CartService
{
    protected $cartRepository;
    protected $productRepository;

    public function __construct(CartRepository $cartRepository, ProductRepository $productRepository)
    {
        $this->cartRepository = $cartRepository;
        $this->productRepository = $productRepository;
    }

    public function firstOrCreateBy($userId)
    {
        return $this->cartRepository->firstOrCreateBy($userId);
    }

    public function updateOrCreateCart($request, $cartId)
    {
        if ($request->has('size') && $request->has('color') && $request->input('size') != null) {
            $dataCreate = $request->all();
            $checkQuantity = $this->checkQuantity($dataCreate);
            if (!$checkQuantity) return false;

            $cartProduct = $this->cartRepository->getCartProductBy($cartId, $dataCreate);
            if ($cartProduct) {
                $quantity = $cartProduct->product_quantity;
                $cartProduct->update(['product_quantity' => $quantity + $dataCreate['quantity']]);
                toastr()->success('Đã thêm sản phẩm vào giỏ hàng');
                return true;
            } else {
                $dataCreateCart['cart_id'] = $cartId;
                $dataCreateCart['product_id'] = $dataCreate['product_id'];
                $dataCreateCart['product_size'] = $dataCreate['size'];
                $dataCreateCart['product_color'] = $dataCreate['color'];
                $dataCreateCart['product_quantity'] = $dataCreate['quantity'];
                $dataCreateCart['product_price'] = $dataCreate['price'];
                $this->cartRepository->createCartProduct($dataCreateCart);
                toastr()->success('Đã thêm sản phẩm vào giỏ hàng');
                return true;
            }

        } else {
            toastr()->error('Bạn cần chọn size hoặc màu sắc!');
            return false;
        }
    }

    protected function checkQuantity($dataCreate)
    {
        $productQty = $this->productRepository->getProductByIdAndSizeColor($dataCreate);
        if ($dataCreate['quantity'] == 0) {
            toastr()->error('Hãy nhập số lượng sản phẩm cần mua!');
            return false;
        }
        if ($productQty['quantity'] > 0) {
            if ($dataCreate['quantity'] < $productQty['quantity']) {
                return true;
            } else {
                toastr()->error('Số lượng sản phẩm không đủ!');
                return false;
            }
        } else {
            toastr()->error('Sản phẩm này đã hết hàng');
            return false;
        }
    }

    public function updateQuantityProductInCart($cartId, $request)
    {
        $cartProduct = $this->cartRepository->getCartProductBy($cartId, $request);
        $dataUpdate = $request->all();
        $productDetail = $this->productRepository->getProductByIdAndSizeColor($request);
        if (!((int)$dataUpdate['quantity'] > $productDetail['quantity'])) {
            if ((int)$dataUpdate['quantity'] < 1) {
                $cartProduct->delete();
            } else {
                $cartProduct->update(['product_quantity' => $dataUpdate['quantity']]);
            }
            return $cartProduct;
        }
        return false;
    }

    public function deleteProductInCart($cartId, $request)
    {
        $cartProduct = $this->cartRepository->getCartProductBy($cartId, $request);
        if($cartProduct) {
            $cartProduct->delete();
            return true;
        }
        return false;
    }
}
