<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Http\Controllers\Controller;
use App\Models\Products;
use App\Models\Category;
use App\Models\UploadingImage;
use Session;

class ProductsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = Products::with(['category'])->orderBy('name')->get();
      
        
        return view('admin.products.index',compact('products') );
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $category = Category::all();
        return view('admin.products.create',compact('category'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // Validate the inputs
        $request->validate([
            'name'            => 'required',
            'category_id'     => 'required',
            'description'     => 'required',
            'files'           => 'required',
            'expiration_date' => 'required',
        ]);

        // ensure the request has a file before we attempt anything else.

        if ($request->hasfile('files')) {

            $files = $request->file('files');
            $path = storage_path('uploads/products'.$request->name);
        
           
            if(!Storage::exists($path)){
                Storage::disk('uploads')->makeDirectory($request->name);
            }

            $product = new Products;
            $product->name              = $request->name;
            $product->category_id          = $request->category_id;
            $product->description       = $request->description;
            $product->expiration_date   = $request->expiration_date;
        
            if($product->save()) {
                $newid = $product->id;
              
                foreach($files as $file) {
                    $name = $file->getClientOriginalName();
                    $path = $file->storeAs('uploads/products/'.$request->name, $name);
                    
                    UploadingImage::create([
                       'name'         => $name,
                       'product_id'   => $newid,
                       'file_path'    => '/storage/'.$path,
                      
                    ]);
                }
                
                $alert_toast = 
                [
                    'title' => 'Operation Successful : ',
                    'text'  => 'Product Successfully Added.',
                    'type'  => 'success',
                ];
            }else
            {
                $alert_toast = 
                [
                    'title' => 'Operation Failed : ',
                    'text'  => 'A Problem Occurred While Adding a Product.',
                    'type'  => 'danger',
                ];
            }

                Session::flash('alert_toast', $alert_toast);

                return redirect()->route('admin.products.index');
            }
         
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $products = Products::findOrFail($id);
        return view('admin.products.edit', compact('products'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'name'            => 'required',
            'category_id'     => 'required',
            'description'     => 'required',
            'files'           => 'required',
            'expiration_date' => 'required',
        ]);

        $products = Products::findOrFail($id);

        $product->name              = $request->name;
        $product->category_id       = $request->category_id;
        $product->description       = $request->description;
        $product->expiration_date   = $request->expiration_date;

        if($product->save()) {
            $newid = $product->id;

            foreach($files as $file) {
                $name = $file->getClientOriginalName();
                $path = $file->storeAs('uploads/products/'.$request->name, $name);
                
                UploadingImage::create([
                   'name'         => $name,
                   'product_id'   => $newid,
                   'file_path'    => '/storage/'.$path,
                  
                ]);
            }
            
            $alert_toast = 
            [
                'title' => 'Operation Successful : ',
                'text'  => 'Product Successfully Added.',
                'type'  => 'success',
            ];
        }else
        {
            $alert_toast = 
            [
                'title' => 'Operation Failed : ',
                'text'  => 'A Problem Occurred While Adding a Product.',
                'type'  => 'danger',
            ];
        }

        Session::flash('alert_toast', $alert_toast);
        return redirect()->route('admin.product.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function delete(Request $request)
    {
        $products = Products::findOrFail($request->id);
        if($products->delete())
        {
            $alert_toast = 
            [
                'title' =>  'Operation Successful : ',
                'text'  =>  'Product Successfully Deleted.',
                'type'  =>  'success',
            ];
        }
        else
        {
            $alert_toast = 
            [
                'title' => 'Operation Failed : ',
                'text'  => 'A Problem Deleting The product.',
                'type'  => 'danger',
            ];
        }

        Session::flash('alert_toast', $alert_toast);
        return redirect()->route('admin.products.index');
    }

    public function uploadFile(Request $request)
    {
        $products = Products::find($request->principal_id);

        if ($request->hasfile('files')) {

            $files = $request->file('files');
            $path = storage_path('uploads/Principal/data-attachment/'.$principal->id);
        
            if(!Storage::exists($path)){
                Storage::disk('principal-attach')->makeDirectory($principal->id);
            }

            foreach($files as $file) {
                $name = $file->getClientOriginalName();
                $path = $file->storeAs('uploads/Principal/data-attachment/'.$principal->id, $name);
                
                UploadingFile::create([
                    'name' => $name,
                    'path' => '/storage/'.$path
                  ]);
            }
         }
         
        return back()->with('success', 'Files uploaded successfully');

    }
}
