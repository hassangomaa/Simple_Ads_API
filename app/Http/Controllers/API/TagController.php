<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Resources\TagResources;
use App\Models\Ads;
use App\Models\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TagController extends Controller
{
    //
    public function index()
    {
        //return all using Resources
        ########################################333

        ###########################################3
        $tag = Tag::all();
//        $tag = Tag::where('type', '1')->with('user')->latest()->get();

        $response = [
            'success' => true,
            'data' => $tag,
            'total' => count($tag),
            'message' => 'Getting Tag Data',
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
            # prevent HTML and JS tags from being executed
//            $cleaned_name = strip_tags($request->get('name'));

            $ad = new Tag();
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
                'message' => 'Getting Tag Data',
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
        $tag = Tag::all();
        $ad =  TagResources::collection($tag) ;

        return $this -> returnData('Table OF Tag admins only!!',$ad);

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
        $ad = Tag::find($id);
        $ad->name = $request->get('name');

        $ad->description = $request->get('description');

        $ad->save();
        $response = [
            'success' => true,
            'data' => $ad,
            'message' => 'Getting Tag Data',
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
        $tag=     Tag::where('id', $id)->delete();
        #SQL inject Prevention:is to rewrite the initial query using a parameterized query.
//        DB::table('Tag')
//            ->s('id','name',
//                ,.........)
//            ->whereRaw('id = ?', $id)->first();
        $response = [
            'success' => true,
            'data' => $tag,
            'total' => count($tag),
            'message' => 'Getting Tag Data',
        ];
        return response()->json($response, 200);
//        return redirect()->back();#only for MVC APP

    }

}
