<?php
/**
 * Visit Controller
 */

namespace App\Http\Controllers;

use App\Models\Visit;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Inertia\Inertia;

/**
 *  VisitController
 */
class VisitController extends Controller
{
    public function visits()
    {
        return Visit::all();
    }

    /**
     * View the edit page
     *
     * @param Visit $visit the visit being viewed
     *
     * @return response
     */
    public function edit(Visit $visit)
    {
        Log::info('Found visit', [$visit->toArray()]);

        return Inertia::render(
            'EditVisit', [
                'PropVisit' => $visit->toArray()
            ]
        );
    }

    /**
     * View the Add Visit Page
     *
     * @return response
     */
    public function add()
    {
        return Inertia::render('AddVisit');
    }

    /**
     * Add the request
     *
     * @param $request Request
     *
     * @return response
     */
    public function submitAdd(Request $request)
    {
        Visit::unguard();

        $visit = new Visit(
            [
                'patient_name' => $request->input('patient'),
                'date_of_exam' => Carbon::parse($request->input('date_of_exam'))
                    ->format('Y-m-d'),
                'hospital_number' => $request->input('hospital_number'),
                'fast' => $request->input('fast'),
                'selection' => $request->input('selection'),
                'correlation' => $request->input('correlation'),
                'patient_conselled' => $request->input('patient_conselled'),
            ]
        );

        Log::info('saving', $visit->toArray());

        $visit->save();

        return $visit;
    }

    /**
     * Edit the request
     *
     * @param $request Request
     *
     * @return response
     */
    public function submitEdit(Request $request, Visit $visit)
    {
        $data = [
            'patient_name' => $request->input('patient_name'),
            'date_of_exam' => Carbon::parse($request->input('date_of_exam'))
                ->format('Y-m-d'),
            'hospital_number' => $request->input('hospital_number'),
            'fast' => $request->input('fast'),
            'selection' => $request->input('selection'),
            'correlation' => $request->input('correlation'),
            'patient_conselled' => $request->input('patient_conselled'),
        ];

        foreach ($data as $key => $value) {
            $visit->$key = $value;
        }

        Log::info('saving', $visit->toArray());

        $visit->save();

        return $visit;
    }
}
