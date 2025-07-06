<?php

namespace App\Http\Controllers;

use App\Models\DislikesModels;
use App\Models\LikesModels;
use App\Models\LireModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

class LikeDislikeController extends Controller
{
    public function like(Request $request, int $histoireid)
    {
        if (!Auth::check() || Gate::allows(1)) {
            abort(403);
        }
        $userid = Auth::id();
        DislikesModels::where('user_id', $userid)->where('histoire_id',$histoireid)->delete();
        $like = LikesModels::where('user_id', $userid)->where('histoire_id',$histoireid)->first();
        if($like)
        {
            $like->delete();
        }
        else{
            LikesModels::create([
                'user_id' => $userid,
                'histoire_id' => $histoireid,
            ]);
        }
        //$totals = LikesModels::where('histoire_id', $histoireid)->count();
        return back();
        
    }
    public function dislike(Request $request, int $histoireid)
    {
        if (!Auth::check() || Gate::allows(1)) {
            abort(403);
        }
        $userid = Auth::id();
        LikesModels::where('user_id', $userid)->where('histoire_id',$histoireid)->delete();
        $like = DislikesModels::where('user_id', $userid)->where('histoire_id',$histoireid)->first();
        if($like)
        {
            $like->delete();
        }
        else{
            DislikesModels::create([
                'user_id' => $userid,
                'histoire_id' => $histoireid,
            ]);
        }
        //$totaldis = DislikesModels::where('histoire_id', $histoireid)->count();
        return redirect()->route('actions');
        
    }
    public function lecture(Request $request, int $histoireid)
    {
        $userId = Auth::id();
        $lire = LireModel::where('user_id', $userId)->where('histoire_id', $histoireid)->first();
        if($lire)
        {
            $lire->delete();
        }
        else
        {
            LireModel::create([
                'user_id' => $userId,
                'histoire_id' => $histoireid, 
            ]);           
        }
    }
}
