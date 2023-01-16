<?php

namespace App\Http\Controllers;

use App\Models\Visit;
use Illuminate\Http\Request;
use Inertia\Inertia;

/**
 *  VisitController
 */
class VisitController extends Controller
{
    /**
     * View the edit page
     *
     * @param Visit $visit the visit being viewed
     *
     * @return response
     */
    public function edit(Visit $visit)
    {
        return Inertia::render(
            'EditVisit', [
                'Visit' => $visit
            ]
        );
    }
}
