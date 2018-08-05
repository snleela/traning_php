<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User as UserMod;
use App\Model\Shop as ShopMod;
use App\Model\Product as ProductMod;


class UsersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $mods = UserMod::paginate(15);
    return view('admin.user.lists', compact('mods') );
       
        //return view('admin.user.lists');
        // return view('template');

        /*   $data = [
           'name' => 'My Name',
           'surname' => 'My SurName',
           'email' => 'myemail@gmail.com'
       ];

        $user = UserMod::find(1);
        $mods = UserMod::all();

        return view('test', compact('data', 'user', 'mods'));*/

         /* $mods = UserMod::all();
        return view('test', compact('mods'));*/

         /* $data = [
            'name' => 'My Name',
            'surname' => 'My SurName',
            'email' => 'myemail@gmail.com'
        ];

        $item = [
            'item1' => 'My Value1',
            'item2' => 'My Value2'
        ];

        $results = [
            'data' => $data,
            'item' => $item
        ];


        return view('template', $results);*/


       /* return view('test')        แสดงข้อมูล
                  ->with('name', 'My Name')
                   ->with('surname', 'Leelawadee')
                   ->with('email', 'sanookleelawadee@outlook.co.th');*/

       /* $mods = UserMod::all();
        // Using alias name
        //$mods = UserMod::all();

       $mods = UserMod::where('active', 1)
              ->where('city', "bangkok")
              ->orderBy('name', 'desc')
              ->take(100)
              ->get();
         //$data = array(1,2,3);
         $mods = UserMod::find([1, 2, 3]);


        foreach ($mods as $item) {  // ลูป
            echo $item->name." ".$item->surname." ".$item->email.
            "<br/>";
        }*/

     /* $count = UserMod::where('active', 1)->count();
      echo $count;*/
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
       
    return view('admin.user.create' );
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
 request()->validate([
            'name' => 'required|min:2|max:50',
            'surname' => 'required|min:2|max:50',
            'mobile' => 'required|numeric',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6',
            'age' => 'required|numeric',
            'confirm_password' => 'required|min:6|max:20|same:password',
        ], [
            'name.required' => 'Name is required',
            'name.min' => 'Name must be at least 2 characters.',
            'name.max' => 'Name should not be greater than 50 characters.',
        ]);


        $mod = new UserMod;
        $mod->email    = $request->email;
        $mod->password = bcrypt($request->password);
        $mod->name     = $request->name;
        $mod->surname  = $request->surname;
        $mod->mobile   = $request->mobile;
        $mod->age      = $request->age;
        $mod->address  = $request->address;
        $mod->city     = $request->city;
        $mod->save();

        return redirect('admin/users')
                    ->with('success', 'User ['.$request->name.'] created successfully.');

         

        //dd($request); exit;
      /* $mod = new UserMod;
        $mod->name = $request->name;
        $mod->email = $request->email;
        $mod->password = bcrypt($request->password);
        $mod->save();
        echo "Update Success";
       // return "Update";*/
         echo  "Save New data to table";
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
     /* $mod = UserMod::find(1);
       echo $mod->name." ".$mod->surname." ".$mod->email.
            "<br/>";
            $shop = UserMod::find($id)->shop;
             echo $mod->name;*/
    /* $mod = ShopMod::find($id);
        echo $mod->name;
        echo "<br/>";
       echo $mod->user->name;*/

      /* $products = ShopMod::find($id)->products;
 
      foreach ($products as $product) {
         echo $product->name;
         echo "<br/>";
     }
          echo "OR <br/><br/>";
          $shop = ShopMod::find($id);
          echo $shop->name;
          echo "<br/>";
          foreach ($shop->products as $product) {
            echo $product->name;
            echo "<br/>";
       }*/

      /* $product = ProductMod::find($id);
       echo "Product name Is" .$product->name;
       echo "<br /><br />";
       echo "Shop Owner Is : ".$product->shop->name;*/
       return view('test');
     }

    

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
      $item = Usermod::find($id);
      return view('admin.user.edit',compact('item') );
         echo "edit";
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {request()->validate([
            'name' => 'required|min:2|max:50',
            'surname' => 'required|min:2|max:50',
            'mobile' => 'required|numeric',
            'password' => 'required|min:6',
            'age' => 'required|numeric',
            'confirm_password' => 'required|min:6|max:20|same:password',
        ], [
            'name.required' => 'Name is required',
            'name.min' => 'Name must be at least 2 characters.',
            'name.max' => 'Name should not be greater than 50 characters.',
        ]);

        $request->validated();
        $mod = UserMod::find($id);
        $mod->name     = $request->name;
        $mod->surname  = $request->surname;
        //$mod->email    = $request->email;
        $mod->mobile   = $request->mobile;
        $mod->surname  = $request->surname;
        $mod->age      = $request->age;
        $mod->address  = $request->address;
        $mod->city     = $request->city;
        $mod->save();

        return redirect('admin/users')
                    ->with('success', 'User ['.$request->name.'] updated successfully.');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
         $mod = UserMod::find($id);
       $mod->delete();
        echo "Delete Success";
       // return "Update";
    }
}
