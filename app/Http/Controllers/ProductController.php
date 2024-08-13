<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Support\Str;
class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products=Product::getAllProduct();
        // return $products;
        return view('backend.product.index')->with('products',$products);
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $category=Category::where('is_parent',1)->get();
        // return $category;
        return view('backend.product.create')->with('categories',$category);
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // return $request->all();
        $this->validate($request,[
            'title'=>'string|required',
            'summary'=>'string|required',
            'description'=>'string|nullable',
            'photo'=>'string|required',
            'size'=>'string|required',
            'stock'=>"required|numeric",
            'cat_id'=>'required|exists:categories,id',
            'child_cat_id'=>'nullable|exists:categories,id',
            'is_featured'=>'sometimes|in:1',
            'status'=>'required|in:active,inactive',
            'material' => 'string|required',
            'price'=>'required|numeric',
            'discount'=>'nullable|numeric'
        ]);
           
    // Ambil data material dari input
    $material = $request->input('material');
    $customMaterial = $request->input('custom_material');
    
    if ($material === 'custom' && $customMaterial) {
        $material = $customMaterial;
    }
    Product::create([
        'title' => $request->input('title'),
        'summary' => $request->input('summary'),
        'description' => $request->input('description'),
        'photo' => $request->input('photo'),
        'size' => $request->input('size'),
        'stock' => $request->input('stock'),
        'cat_id' => $request->input('cat_id'),
        'child_cat_id' => $request->input('child_cat_id'),
        'is_featured' => $request->input('is_featured'),
        'status' => $request->input('status'),
        'material' => $material,
        'price' => $request->input('price'),
        'discount' => $request->input('discount')
    ]);
            $data = $request->all();
            $slug = Str::slug($request->title);
            $count = Product::where('slug', $slug)->count();
            if ($count > 0) {
                $slug = $slug . '-' . date('ymdis') . '-' . rand(0, 999);
            }
            $data['slug'] = $slug;
            $data['is_featured'] = $request->input('is_featured', 0);
            $size = $request->input('size');
            if (is_array($size)) {
                $data['size'] = implode(',', $size);
            } else {
                $data['size'] = $size;
            }
        // return $material;
        // return $size;
        // return $data;
        $status=Product::create($data);
        if($status){
            request()->session()->flash('success','Product created successfully');
        }
        else{
            request()->session()->flash('error','Please try again!!');
        }
        return redirect()->route('product.index');
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
        
        $product=Product::findOrFail($id);
        $category=Category::where('is_parent',1)->get();
        $items=Product::where('id',$id)->get();
        // return $items;
        return view('backend.product.edit')->with('product',$product)
                    ->with('categories',$category)->with('items',$items);
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
        $product=Product::findOrFail($id);
        $this->validate($request,[
            'title'=>'string|required',
            'summary'=>'string|required',
            'description'=>'string|nullable',
            'photo'=>'string|required',
            'size'=>'string|required',
            'stock'=>"required|numeric",
            'cat_id'=>'required|exists:categories,id',
            'child_cat_id'=>'nullable|exists:categories,id',
            'is_featured'=>'sometimes|in:1',
            'status'=>'required|in:active,inactive',
            'material'=>'string|required',
            'price'=>'required|numeric',
            'discount'=>'nullable|numeric'
        ]);

        
    // Ambil data material dari input
    $material = $request->input('material');
    $customMaterial = $request->input('custom_material');

    // Jika ada input manual dan opsi 'Lainnya...' dipilih, gunakan custom material
    if ($material === 'custom' && $customMaterial) {
        $material = $customMaterial;
    }
        // Update data produk
        $product->update([
            'title' => $request->input('title'),
            'summary' => $request->input('summary'),
            'description' => $request->input('description'),
            'photo' => $request->input('photo'),
            'size' => $request->input('size'),
            'stock' => $request->input('stock'),
            'cat_id' => $request->input('cat_id'),
            'child_cat_id' => $request->input('child_cat_id'),
            'is_featured' => $request->input('is_featured'),
            'status' => $request->input('status'),
            'material' => $material,
            'price' => $request->input('price'),
            'discount' => $request->input('discount')
        ]);
    
        $data = $request->all();
        $data['is_featured'] = $request->input('is_featured', 0);
        $size = $request->input('size');
        if (is_array($size)) {
            $data['size'] = implode(',', $size);
        } else {
            $data['size'] = $size;
        }
        // return $data;
        $status=$product->fill($data)->save();
        if($status){
            request()->session()->flash('success','Product updated');
        }
        else{
            request()->session()->flash('error','Please try again!!');
        }
        return redirect()->route('product.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $product=Product::findOrFail($id);
        $status=$product->delete();
        
        if($status){
            request()->session()->flash('success','Product deleted');
        }
        else{
            request()->session()->flash('error','Error while deleting product');
        }
        return redirect()->route('product.index');
    }
}