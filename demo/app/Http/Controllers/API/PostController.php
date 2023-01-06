<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Post;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use App\Traits\HttpResponses;


class PostController extends Controller
{
    use HttpResponses;

    public function index()
    {
        $pagination = DB::table('posts')->paginate(5);
        return response()->json($pagination, 200);
    }

    public function postById($id)
    {
        $post = Post::find($id);
        if (is_null($post)) {
            return response()->json("Not found", 404);
        }

//        return response()->json($post, 200);
        return $this->success($post, "succesful", 200);
    }

    public function addRecord(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'name' => 'required|max:255',
            'body' => 'required',
        ]);
        if ($validator->fails()) {
            return response()->json($validator->errors(), 404);
        }
        $input = $request->all();
        $input['created_at'] = Carbon::now()->toDateTimeString();
        $input['updated_at'] = Carbon::now()->toDateTimeString();
        $addRecord = Post::create($input);
        return response()->json($addRecord, 200);
    }

    public function updateRecord(Request $request, $id)
    {
        $post = Post::find($id);
        if (is_null($post)) {
            return response()->json('not found', 404);

        }
        $post->update($request->all());
        return response()->json($post, 200);
    }

    public function deleteRecord(Request $request, $id)
    {
        $post = Post::find($id);
        if (is_null($post)) {
            return response()->json('not found', 404);
        }

        $post->delete();
        return response()->json(null, 204);
    }
}
