<?php

namespace App\Http\Controllers;

use App\Models\Certificate;
use App\Models\General;
use App\Models\Project;
use App\Models\Skill;
use App\Models\SocialLink;
use Illuminate\Http\Request;

class PortfolioController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $generals = General::first();
        $social_links = SocialLink::all();
        $skills = Skill::all();
        $projects = Project::all();
        $certificates = Certificate::all();

        return view('welcome', compact('generals', 'social_links', 'skills', 'projects', 'certificates'));
    }
}
