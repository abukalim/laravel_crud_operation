<?php

namespace App\Http\Controllers;


use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

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
            $productImage = DB::table('product')->select('product_image')->where('id', $id)->first();
            $randomName = null;  // Initialize $randomName as null

            // If a new image is uploaded, handle the image processing
            if ($request->hasFile('product_image')) {
                if (!empty($productImage->product_image)) {

                    // Delete the old image if it exists
                    $imagePath = public_path('storage/images/' . $productImage->product_image);
                if (file_exists($imagePath)) {

                    unlink($imagePath);  // Delete the old image
                }
                }

                // Process the new image
                $file = $request->file('product_image');
                $randomName = Str::random(10) . time() . '.' . $file->getClientOriginalExtension();
                $file->storeAs('images', $randomName, 'public');
            }

            // Capture form data
            $name = $request->product_name;
            $description = $request->product_desc;
            $price = $request->product_price;

            // Prepare the update data
            $updateData = [
                'product_name' => $name,
                'product_description' => $description,
                'product_price' => $price,
                'updated_at' => now(),
            ];

            // Only update the image if a new one was uploaded
            if ($randomName) {
                $updateData['product_image'] = $randomName;
            }

            // Update product information in the database
            $productUpdate = DB::table('product')
                ->where('id', $id)
                ->update($updateData);

            // Check if the update was successful
            if ($productUpdate) {
                DB::commit();
                return redirect()->route('editProduct', ['id' => $id])
                                 ->with('success', 'Product Updated Successfully');
            } else {
                DB::rollBack();
                return redirect()->route('editProduct', ['id' => $id])
                                 ->with('error', 'Failed to update product.');
            }
        } catch (\Exception $e) {
            DB::rollBack();
            \Log::error('Product Update Error: ' . $e->getMessage());
            return redirect()->route('editProduct', ['id' => $id])
                             ->with('error', 'An error occurred while updating the product.');
        }
    }

    public function deleteProduct(Request $request ,$id){

        $productImage = DB::table('product')->select('product_image')->where('id', $id)->first();
        $imagePath = public_path('storage/images/' . $productImage->product_image);
        if (file_exists($imagePath)) {

            unlink($imagePath);
        }

        $deleteProduct=DB::table('product')->where('id',$id)->delete();

        return redirect()->route('dashboard')->with('success', 'Product Deleted Successfully');


    }


}
