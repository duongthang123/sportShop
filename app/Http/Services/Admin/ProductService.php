<?php

namespace App\Http\Services\Admin;

use App\Http\Repository\Admin\CategoryRepository;
use App\Http\Repository\Admin\ProductRepository;
use App\Models\Product;

class ProductService
{
    protected $productRepository;

    public function __construct(ProductRepository $productRepository)
    {
        $this->productRepository = $productRepository;
    }

    public function getAllProductWithPaginate()
    {
        return $this->productRepository->getAllProductWithPaginate();
    }

    public function getProductById($id)
    {
        return $this->productRepository->getProductById($id);
    }

    protected function isValidPrice($request)
    {
        if ($request->input('price') != 0 && $request->input('sale') != 0 &&
            $request->input('sale') >= $request->input('price'))
        {
            toastr()->error('Giá giảm phải nhỏ hơn giá gốc');
            return false;
        }

        if ($request->input('sale') != 0 && $request->input('price') == 0)
        {
            toastr()->error('Hãy nhập giá gốc');
            return false;
        }

        return true;
    }

    public function createProduct($request)
    {
        if(!$this->isValidPrice($request))  return false;

        try {
            $dataCreate = [
                'name' => $request->input('name'),
                'price' => $request->input('price'),
                'sale' => $request->input('sale'),
                'description' => $request->input('description'),
                'active' => $request->input('active'),
                'category_ids' => $request->input('category_ids'),
            ];

            $product = $this->productRepository->createProduct($dataCreate);
            $dataCreate['image'] = $this->productRepository->saveImage($request);
            $product->images()->create(['url' => $dataCreate['image']]);
            $product->assignCategory($dataCreate['category_ids']);
            $this->addProductDetail($request, $product);
            toastr()->success('Thêm sản phẩm thành công');
        } catch (\Exception $e)
        {
            toastr()->error('Có lỗi khi thêm sản phẩm');
            return false;
        }

        return true;
    }

    public function updateProduct($request, $id)
    {
        if(!$this->isValidPrice($request))  return false;

        try {
            $dataUpdate = $request->all();
            $product = $this->productRepository->findProductById($id);
            $currentImage =$product->images->count() > 0 ? $product->images->first()->url : '';
            $dataUpdate['image'] = $this->productRepository->updateImage($request, $currentImage);

            $product->update($dataUpdate);
            $product->images()->delete();

            $product->images()->create(['url' => $dataUpdate['image']]);
            $product->assignCategory($dataUpdate['category_ids']);

            $this->updateProductDetail($request, $product);
            toastr()->success('Cập nhật sản phẩm thành công');
        } catch (\Exception $e)
        {
            toastr()->error('Có lỗi khi cập nhật sản phẩm');
            return false;
        }

        return true;

    }

    public function destroyProduct($id)
    {
        try {
            $product = $this->productRepository->getProductById($id);
            $currentImage = $product->images->count() > 0 ? $product->images->first()->url : '';
            if($currentImage) {
                $this->productRepository->deleteImage($currentImage);
            }
            $product->images()->delete();
            $product->delete();
            return true;
        } catch (\Exception $e) {
            toastr()->error('Có lỗi khi xóa');
            return false;
        }

    }

    public function addProductDetail($request, $product)
    {
        $sizes = $request->input('size');
        $quantities = $request->input('quantity');
        $colors = $request->input('color');
        foreach ($sizes as $index => $size) {
            $product->details()->create([
                'size' => $size,
                'quantity' => $quantities[$index],
                'color' => $colors[$index],
                'product_id' => $product->id,
            ]);
        }
    }

    public function updateProductDetail($request, $product)
    {
        $sizes = $request->input('size');
        $quantities = $request->input('quantity');
        $colors = $request->input('color');
        foreach ($sizes as $index => $size) {
            $detail = $product->details()->where([
                'size' => $size,
                'color' => $colors[$index]
            ])->first();

            if($detail) {
                $detail->update([
                    'quantity' => $quantities[$index],
                ]);
            } else {
                $product->details()->updateOrCreate([
                    'size' => $size,
                    'quantity' => $quantities[$index],
                    'color' => $colors[$index],
                    'product_id' => $product->id,
                ]);
            }
        }
    }

    public function search($request)
    {
        return $this->productRepository->search($request);
    }

    public function revenueProduct($request)
    {
        return $this->productRepository->revenueProduct($request);
    }
}
