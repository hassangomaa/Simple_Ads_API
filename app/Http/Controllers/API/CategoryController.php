<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\ads;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    //
    public function index()
    {
        //return all using Resources
        ########################################333

        ###########################################3
        $category = Category::all();
//        $category = Category::where('type', '1')->with('user')->latest()->get();

        $response = [
            'success' => true,
            'data' => $category,
            'total' => count($category),
            'message' => 'Getting Category Data',
        ];
        return response()->json($response, 200);
//        return "HELLO!!!!!!";

    }



    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        #validate by required inputs
        $rules = [
//            'name'=> 'required',
//            '.....'=> 'required',
//            'video_url'=> 'required',
//            'likes_count'=> 'required',
//            'comments_count' => 'required|'
        ];

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            abort(404);
        }else {
            //Run query
            # prevent HTML and JS Categorys from being executed
//            $cleaned_name = strip_Categorys($request->get('name'));

            $ad = new Category();
//            ###################
//            $user->fill([
//                'secret' => encrypt($request->secret)
//            ])->save();
            ##########
            $ad->name = $request->get('name');
            $ad->description = $request->get('description');



//            $ad->video_url = encrypt( $request->get('video_url'));
//            $ad->likes_count = $request->get('likes_count');
//            $ad->comments_count = $request->get('comments_count');
            $ad->save();
            $response = [
                'success' => true,
                'data' => $ad,
                'message' => 'Getting Category Data',
            ];
            return response()->json($response, 200);

        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Reel  $ad
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
        $category = Category::all();
        $ad =  CategoryResources::collection($category) ;

        return $this -> returnData('Table OF Category admins only!!',$ad);

    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Reel  $ad
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
        $ad = Category::find($id);
        $ad->name = $request->get('name');

        $ad->description = $request->get('description');

        $ad->save();
        $response = [
            'success' => true,
            'data' => $ad,
            'message' => 'Getting Category Data',
        ];
        return response()->json($response, 200);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Reel  $ad
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        $category=     Category::where('id', $id)->delete();
        #SQL inject Prevention:is to rewrite the initial query using a parameterized query.
//        DB::table('Category')
//            ->s('id','name',
//                ,.........)
//            ->whereRaw('id = ?', $id)->first();
        $response = [
            'success' => true,
            'data' => $category,
            'total' => count($category),
            'message' => 'Getting Category Data',
        ];
        return response()->json($response, 200);
//        return redirect()->back();#only for MVC APP

    }}
