<?php

namespace App\Http\Controllers\Features;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Features\AmenityController;
use App\Http\Controllers\Features\UnitController;
use Illuminate\Http\Request;

class HandleFeatureController extends Controller
{

    public function getFeatureForm($theForm)
    {
        try {
            $fileName = 'admin.featureForms.' . $theForm;

            $amenityCategories = $amenityAccessibilities = $unitCategories = null;
            switch ($theForm) {
                case 'Amenity':
                    $amenityCategories = app(AmenityController::class)->getCat()['amenityCategories'];
                    $amenityAccessibilities = app(AmenityController::class)->getAccess()['amenityAccessibilities'];
                    $html = view($fileName, compact('amenityCategories', 'amenityAccessibilities'))->render();
                    return response()->json([
                        'html' => $html,
                    ]);

                case 'Unit':
                    $amenityAccessibilities = app(AmenityController::class)->getAccess()['amenityAccessibilities'];

                    $unitCategories = app(UnitController::class)->getCat()['unitCategories'];
                    $html = view($fileName, compact('unitCategories','amenityAccessibilities'))->render();
                    return response()->json([
                        'html' => $html,
                    ]);

                case 'Address':
                    $html = view($fileName)->render();
                    return response()->json([
                        'html'=>$html
                    ]);
                case 'Anchor':
                    $html = view($fileName)->render();
                    return response()->json([
                        'html'=>$html
                    ]);
                case 'Building':
                    $html = view($fileName)->render();
                    return response()->json([
                        'html'=>$html
                    ]);
                case 'Detail':
                    $html = view($fileName)->render();
                    return response()->json([
                        'html'=>$html
                    ]);
                case 'Fixture':
                    $html = view($fileName)->render();
                    return response()->json([
                        'html'=>$html
                    ]);
                case 'Footprint':
                    $html = view($fileName)->render();
                    return response()->json([
                        'html'=>$html
                    ]);
                case 'Geofence':
                    $html = view($fileName)->render();
                    return response()->json([
                        'html'=>$html
                    ]);
                case 'Kiosk':
                    $html = view($fileName)->render();
                    return response()->json([
                        'html'=>$html
                    ]);
                case 'Level':
                    $html = view($fileName)->render();
                    return response()->json([
                        'html'=>$html
                    ]);
                case 'Occupant':
                    $html = view($fileName)->render();
                    return response()->json([
                        'html'=>$html
                    ]);
                case 'Opening':
                    $html = view($fileName)->render();
                    return response()->json([
                        'html'=>$html
                    ]);
                case 'Relationship':
                    $html = view($fileName)->render();
                    return response()->json([
                        'html'=>$html
                    ]);
                case 'Section':
                    $html = view($fileName)->render();
                    return response()->json([
                        'html'=>$html
                    ]);
                case 'Venue':
                    $html = view($fileName)->render();
                    return response()->json([
                        'html'=>$html
                    ]);


            }


            if (view()->exists($fileName)) {
                $html = view($fileName, compact('amenityCategories', 'amenityAccessibilities'))->render();
                // return view($html);
                // dd($html);
                return response()->json([
                    'html' => $html,
                    //     'amenityCategories' => $amenityCategories,
                    //     'amenityAccessibilities' => $amenityAccessibilities
                ]);
            }
            // return view('admin.featureForms.Amenity');
            return response()->json([
                'html' => view('admin.featureForms.Amenity')->render(),
                'amenityCategories' => $amenityCategories,
                'amenityAccessibilities' => $amenityAccessibilities
            ]);
        } catch (\Exception $exception) {
            dd('Error: ' . $exception->getMessage());
        }
    }
    public function index()
    {
        $featureList = [
            'Address',
            'Amenity',
            'Anchor',
            'Building',
            'Detail',
            'Fixture',
            'Footprint',
            'Geofence',
            'Kiosk',
            'Level',
            'Occupant',
            'Opening',
            'Relationship',
            'Section',
            'Unit',
            'Veune'
        ];

        $amenityCategories = app(AmenityController::class)->getCat()['amenityCategories'];
        // dd($amenityCategories);
        $amenityAccessibilities = app(AmenityController::class)->getAccess()['amenityAccessibilities'];

        return view('admin.handlefeature', compact(
            'featureList',
            'amenityCategories',
            'amenityAccessibilities'
        ));
    }
}
