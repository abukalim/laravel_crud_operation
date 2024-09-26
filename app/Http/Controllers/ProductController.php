<?php

namespace App\Http\Controllers;


use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProductController extends Controller
{
    public function createProduct(){
        return view('create');
    }
    public function editProduct(Request $request,$id){
        $details=DB::table('product')
        ->select('id','product_name','product_description','product_image','product_price')
        ->where('id',$id)->first();
      return view('edit',['details'=>$details]);
    }

    public function submitProductone(Request $request){
     $name=$request->product_name;
     $description=$request->product_desc;
     $price=$request->product_price;

     if ($request->hasFile('product_image')) {
        $file = $request->file('product_image');

        // Generate a random 10-character string for the image name
        $randomName = Str::random(10).time() . '.' . $file->getClientOriginalExtension();

        // Store the image with the random name in the 'public/images' directory
        $path = $file->storeAs('images', $randomName, 'public');

    }

     $productinsert=DB::table('product')->insert([
        'product_name'=>$name,
        'product_description'=>$description,
        'product_price'=>$price,
        'product_image'=>$randomName,
        'created_at'=>now()
     ]);


     if($productinsert){
        return redirect()->route('createProduct')->with('success','Product Added Successfully');
     }
     else{
        return redirect()->route('createProduct');
     }


    }

    public function updateProduct(Request $request, $id)
    {
        // Start a database transaction
        DB::beginTransaction();

        try {
            // Capture form data
            $name = $request->product_name;
            $description = $request->product_desc;
            $price = $request->product_price;

            // If there's an image, process it (you can uncomment the code below if needed)
            // if ($request->hasFile('product_image')) {
            //     $file = $request->file('product_image');
            //     $randomName = Str::random(10).time() . '.' . $file->getClientOriginalExtension();
            //     $path = $file->storeAs('images', $randomName, 'public');
            // }

            // Update product information in the database
            $productUpdate = DB::table('product')
                ->where('id', $id)
                ->update([
                    'product_name' => $name,
                    'product_description' => $description,
                    'product_price' => $price,
                    'updated_at' => now() // Use updated_at instead of created_at
                ]);

            // Check if the update was successful
            if ($productUpdate) {
                // Commit the transaction
                DB::commit();
                return redirect()->route('editProduct', ['id' => $id])
                                 ->with('success', 'Product Updated Successfully');
            } else {
                // Rollback the transaction if the update fails
                DB::rollBack();
                return redirect()->route('editProduct', ['id' => $id])
                                 ->with('error', 'Failed to update product.');
            }

        } catch (\Exception $e) {
            // Rollback the transaction in case of any exception
            DB::rollBack();

            // Log the error for debugging (optional)
            \Log::error('Product Update Error: ' . $e->getMessage());

            // Redirect with an error message
            return redirect()->route('editProduct', ['id' => $id])
                             ->with('error', 'An error occurred while updating the product.');
        }
    }

}
