<?php

namespace App\Services;

use App\Models\AttributeValue;
use App\Models\Color;
use App\Models\ProductStock; 

class ProductStockService
{
    public function store(array $data, $product)
    { 
        $collection = collect($data);

        //combinations start
        $options = array(); 
        if($collection->has('colors')){ 
            array_push($options, $collection['colors']);
        }

        if($collection->has('attribute_options')){
            foreach ($collection['attribute_options'] as $key => $no) {
                $name = 'attribute_options_'.$no;
                $attributeValues = AttributeValue::whereIn('id',$collection[$name] ?? [])->get()->pluck('value') ?? []; 
                array_push($options, $attributeValues); 
            }
        } 
        
        //Generates the combinations of attributes options options
        $combinations = combinations($options);
        if(count($combinations[0]) > 0){

            // Step 1: Collect all updated variants
            $updatedVariants = [];

            $product->variant_product = 1;
            foreach ($combinations as $key => $combination){
                $str = '';
                foreach ($combination as $key => $item){
                    if($key > 0){
                        $str .= '-'.str_replace(' ', '', $item);
                    }else{
                        if($collection->has('colors')){
                            $color_name = Color::where('code', $item)->first()->name;
                            $str .= $color_name;
                        }else{
                            $str .= str_replace(' ', '', $item);
                        }
                    }
                } 

                // Store the items that updated
                $updatedVariants[] = str_replace('.', '_', $str); 

                // Prepare the data array for updateOrCreate
                $data = [
                    'unit_price' => request()['unit_price_' . str_replace('.', '_', $str)],
                    'purchase_price' => request()['purchase_price_' . str_replace('.', '_', $str)],
                    'sku' => request()['sku_' . str_replace('.', '_', $str)],
                    'stock' => request()['stock_' . str_replace('.', '_', $str)], 
                ];
                
                ProductStock::updateOrCreate(
                    ['product_id' => $product->id, 'variant' => $str],
                    $data
                );
            }
            // Step 2: Remove items that are not part of the updated variants
            ProductStock::where('product_id', $product->id)
                ->whereNotIn('variant', $updatedVariants)
                ->delete();
        }else{ 
            $product->variant_product = 0;
        }
        $product->save();
    }
    
}
