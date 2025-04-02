<?php

namespace App\Services;

use App\Models\AttributeValue;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;

class ProductService
{
    public function store(array $data)
    {
        $collection = collect($data);
        
        $attribute_options = array(); 
        if($collection->has('attribute_options')){
            foreach ($collection['attribute_options'] as $key => $no) {
                $str = 'attribute_options_'.$no; 
                $attributeValues = AttributeValue::whereIn('id',$collection[$str] ?? [])->get()->pluck('value') ?? [];
                $item['attribute_id'] = $no;
                $item['values'] = $attributeValues; 
                array_push($attribute_options, $item);
            }
        }

        $collection['store_id']=   $collection->has('store_id') && $collection['store_id'] != null 
                                    ? $collection['store_id'] 
                                    : (Auth::user() && Auth::user()->store ? Auth::user()->store->id : null);
        $collection['colors'] = $collection->has('colors') ? json_encode($collection['colors']) : json_encode(array());
        $collection['tags'] = implode('|',$collection['tags']); 
        $collection['attributes'] = !empty($collection['attribute_options']) ?  json_encode($collection['attribute_options']) : json_encode(array());
        $collection['choice_options'] = json_encode($attribute_options, JSON_UNESCAPED_UNICODE); 

        return Product::create($collection->toArray());
    }

    public function update(array $data, Product $product)
    {  
        $collection = collect($data);  

        $collection['tags'] = implode('|',$collection['tags']);  
        $collection['colors'] = $collection->has('colors') ? json_encode($collection['colors']) : json_encode(array());

        $attribute_options = array();

        if($collection->has('attribute_options')){
            foreach ($collection['attribute_options'] as $key => $no) {
                $str = 'attribute_options_'.$no; 
                $attributeValues = AttributeValue::whereIn('id',$collection[$str] ?? [])->get()->pluck('value') ?? [];
                $item['attribute_id'] = $no;
                $item['values'] = $attributeValues; 
                array_push($attribute_options, $item);
            }
        } 

        $collection['attributes'] = !empty($collection['attribute_options']) ?  json_encode($collection['attribute_options']) : json_encode(array());
        $collection['choice_options'] = json_encode($attribute_options, JSON_UNESCAPED_UNICODE); 

        $product->update($collection->toArray());

        return $product;
    }


    public function destroy($id)
    {
        $product = Product::findOrFail($id); 
        $product->product_categories()->detach();
        $product->stocks()->delete(); 
        $product->productProductReviews()->delete(); 
        $product->productProductComplaints()->delete(); 
        $product->favorites()->delete();
        $product->carts()->delete();  
        Product::destroy($id);
    } 

}