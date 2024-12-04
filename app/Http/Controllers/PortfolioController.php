<?php

namespace App\Http\Controllers;

use App\Models\Certificate;
use App\Models\General;
use App\Models\Project;
use App\Models\Skill;
use App\Models\SocialLink;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class PortfolioController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = Cache::remember('portfolio_data', 60, function () {
            $general = General::first();
            $socialLinks = SocialLink::get(['icon', 'link']);
            $skills = Skill::get(['name', 'percent']);
            $projects = Project::get(['name', 'category', 'link', 'image']);
            $certificates = Certificate::get(['name', 'initiated_by', 'initiated_at', 'description', 'file']);

            if (!$general) {
                abort(404, 'Couldn\'t find General Record');
            }

            return [
                'general' => $general,
                'socialLinks' => $socialLinks,
                'skills' => $skills,
                'projects' => $projects,
                'certificates' => $certificates
            ];
        });

        return view('welcome', $data);
    }
}
