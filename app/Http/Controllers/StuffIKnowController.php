<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;
use Illuminate\Support\Facades\DB;

class StuffIKnowController extends Controller
{
    public function index()
    {
        $knownQuestions = app(KnownController::class)->getKnownQuestions();
        return Inertia::render('StuffIKnow', ['knownQuestions' => $knownQuestions->original]);
    }
}
