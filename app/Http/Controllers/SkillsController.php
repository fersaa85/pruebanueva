<?php

namespace App\Http\Controllers;


use App\Http\Resources\SkillResourceCollection;
use App\Models\Skill;
use Illuminate\Http\Request;

class SkillsController extends Controller
{
    public function index()
    {
        return new SkillResourceCollection(Skill::get());
    }
}