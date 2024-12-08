<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;

class PortfolioController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = Cache::remember('portfolio_data', 60, function () {
            return DB::transaction(function () {
                $general = DB::table('generals')->first();
                if (! $general) {
                    abort(404, 'Couldn\'t find General Record');
                }

                $socialLinks = DB::table('social_links')->select('icon', 'link')->get();
                $skills = DB::table('skills')->select('name', 'percent')->get();
                $projects = DB::table('projects')->select('name', 'category', 'link', 'image')->get();
                $certificates = DB::table('certificates')->select('name', 'initiated_by', 'initiated_at', 'description', 'file')->get();

                return [
                    'general' => $general,
                    'socialLinks' => $socialLinks ?? [],
                    'skills' => $skills ?? [],
                    'projects' => $projects ?? [],
                    'certificates' => $certificates ?? [],
                ];
            });
        });

        return view('welcome', $data);
    }
}
