<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Ads;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdsController extends Controller
{
    //
//    public function __invoke(Request $request)
//    {
//        return "Welcome to our homepage";
//    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //return all using Resources
        ########################################333

        ###########################################3
        $ads = Ads::all();
//        $ads = Ads::where('type', '1')->with('user')->latest()->get();

        $response = [
            'success' => true,
            'data' => $ads,
            'total' => count($ads),
            'message' => 'Getting Ads Data',
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

            $ad = new Ads();
//            ###################
//            $user->fill([
//                'secret' => encrypt($request->secret)
//            ])->save();
            ##########
            $ad->name = $request->get('name');
            $ad->type = $request->get('type');
            $ad->title = $request->get('title');
            $ad->description = $request->get('description');
            $ad->category = $request->get('category');
            $ad->tags = $request->get('tags');
//            $ad->start_date = now(); #static Next day
            $ad->start_date =  $request->get('start_date');#user input

            $ad->advertiser =Auth::id();//user ID



//            $ad->video_url = encrypt( $request->get('video_url'));
//            $ad->likes_count = $request->get('likes_count');
//            $ad->comments_count = $request->get('comments_count');
            $ad->save();
            $response = [
                'success' => true,
                'data' => $ad,
                'message' => 'Getting Ads Data',
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
        $ads = Reel::all();
        $ad =  ReelResource::collection($ads) ;

        return $this -> returnData('Table OF Ads admins only!!',$ad);

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
        $ad = Ads::find($id);
        $ad->name = $request->get('name');
        $ad->type = $request->get('type');
        $ad->title = $request->get('title');
        $ad->description = $request->get('description');
        $ad->category = $request->get('category');
        $ad->tags = $request->get('tags');
//            $ad->start_date = now(); #static Next day
        $ad->start_date =  $request->get('start_date');#user input

        $ad->save();
        $response = [
            'success' => true,
            'data' => $ad,
            'message' => 'Getting Ads Data',
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
   $ads=     Ads::where('id', $id)->delete();
        #SQL inject Prevention:is to rewrite the initial query using a parameterized query.
//        DB::table('Ads')
//            ->s('id','name',
//                ,.........)
//            ->whereRaw('id = ?', $id)->first();
        $response = [
            'success' => true,
            'data' => $ads,
            'total' => count($ads),
            'message' => 'Getting Ads Data',
        ];
        return response()->json($response, 200);
//        return redirect()->back();#only for MVC APP

    }


}
