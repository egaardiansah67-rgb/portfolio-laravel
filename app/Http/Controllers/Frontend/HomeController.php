<?php

namespace App\Http\Controllers\Frontend;

use App\Models\Hero;
use App\Models\About;
use App\Models\Service;
use App\Models\SkillCategory;
use App\Models\Experience;
use App\Models\Education;
use App\Models\Portfolio;
use App\Models\Testimonial;
use App\Models\Achievement;
use App\Models\Faq;
use Illuminate\View\View;

class HomeController extends Controller
{
    public function index(): View
    {
        $hero = Hero::first();
        $about = About::first();
        $services = Service::ordered()->get();
        $skillCategories = SkillCategory::with('skills')
            ->ordered()
            ->get();
        $experiences = Experience::ordered()->get();
        $educations = Education::ordered()->get();
        $featuredPortfolios = Portfolio::featured()->take(6)->get();
        $testimonials = Testimonial::ordered()->get();
        $achievements = Achievement::ordered()->get();
        $faqs = Faq::ordered()->get();

        return view('frontend.home', compact(
            'hero',
            'about',
            'services',
            'skillCategories',
            'experiences',
            'educations',
            'featuredPortfolios',
            'testimonials',
            'achievements',
            'faqs'
        ));
    }
}
