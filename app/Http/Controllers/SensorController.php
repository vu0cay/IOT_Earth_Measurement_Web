<?php

namespace App\Http\Controllers;

use App\Constants\TablesName;
use App\Http\Resources\TreeResource;
use App\Models\Tree;
use DB;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class SensorController extends Controller
{
    public function history() {
         // $activeSensors = Sensor::where('status', 'active')->count();
         
        


         $response = Http::withHeaders([
            'token' => 'Add7rMPgCuGvKVj5F0Osmo4ahWKZzHmohg8nEMDVS7l49No6Bfhyu2tnWfJO'
        ])->get('http://127.0.0.1:8081/api/get/observations?top=all&order=id desc');

        // dd($response->json());

        $measurementData = $response->json();
        // dd($sensors["value"]);
        $measurements = [];

        foreach ($measurementData as $meas) {
            if(isset($meas['result']) && isset($meas['result'][0])) {
                $data = $meas['result'][0];
                $data['resultTime'] = $meas['resultTime'];
                $data['id'] = $meas['id'];
                


                $nutrientValues = [
                    'N' => $meas['result'][0]['Nito'] ?? null,  // Example value for N (nullable or numeric)
                    'P' => $meas['result'][0]['Photpho'] ?? null, // Example: P is not provided
                    'K' => $meas['result'][0]['Kali'] ?? null,
                    'S' => $meas['result'][0]['S'] ?? null,
                    'Ca' => $meas['result'][0]['Ca'] ?? null
                ];

                $trees = DB::table(TablesName::TREES . ' as t')
                    ->select([
                        't.id as tree_id',
                        't.name as tree_name',
                        'tc.name as tree_category',
                        'n.name as nutrient_name',
                        'n.lower_bound as lower_bound',
                        'n.upper_bound as upper_bound'
                    ])
                    ->join(TablesName::TREE_CATEGORIES . ' as tc', 't.type_id', '=', 'tc.id')
                    ->join(TablesName::TREE_NUTRIENTS . ' as tn', 't.id', '=', 'tn.tree_id')
                    ->join(TablesName::NUTRIENTS . ' as n', 'n.id', '=', 'tn.nutrient_id')
                    ->where(function ($query) use ($nutrientValues) {
                        // Add conditions dynamically for each nutrient
                        foreach ($nutrientValues as $name => $value) {
                            if (!is_null($value)) {
                                $query->orWhere(function ($subQuery) use ($name, $value) {
                                    $subQuery->where('n.name', $name)
                                        ->where('n.lower_bound', '<=', $value)
                                        ->where('n.upper_bound', '>=', $value);
                                });
                            }
                        }
                    })
                    ->get()
                    ->groupBy('tree_id')
                    ->map(function ($group) {
                        return [
                            'tree_id' => $group->first()->tree_id,
                            'tree_name' => $group->first()->tree_name,
                            'tree_category' => $group->first()->tree_category,
                            'nutrients' => $group->map(function ($item) {
                                return [
                                    'name' => $item->nutrient_name,
                                    'lower_bound' => $item->lower_bound,
                                    'upper_bound' => $item->upper_bound,
                                ];
                            })->values()->all(),
                            'nutrient_count' => $group->count(), // Count the number of nutrients satisfying the conditions
                        ];
                    })
                    ->sortByDesc('nutrient_count') // Sort by the number of nutrients in descending order
                    ->first(); // Get the tree with the most nutrients
                    // dd($trees['tree_name']);
                    $data['tree_name'] = $trees['tree_name'] ?? null;
                    // dd($data);
                    
                    array_push($measurements, $data );
                }
        }
        // dd($measurements);

        // appropriate tree
        

        // return view('admin.sensors', compact('activeSensors','sensors'));
        return view('admin.history_measurement', compact( 'measurements'));
        
    }
    public function index()
    {
        $rows = [];
        $trees = Tree::all();
        $treeResource = TreeResource::collection($trees);

        // dd($trees);

        // array_push($rows, [
        //     'name' => 'Chuoi',
        //     'type' => 'Cay an qua',
        //     'N' => '1 - 2',
        //     'P' => '2 - 3',
        //     'K' => '4 - 5',
        //     'S' => '_',
        //     'Ca' => '_'
        // ]);
        // dd($treeResource->json());
        // $trees = response()->json($treeResource);
        foreach($treeResource as $tree) { 
            $treeInfo = [
                'id' => $tree['id'],
                'name' => $tree["name"],
                'type' => $tree->treecategory->name
            ];
            if(isset($tree['nutrients'])) {
                foreach($tree['nutrients'] as $nutrient) {
                    // $nAdd = [$nutrient['name'] => $nutrient['lower_bound'].' - '.$nutrient['upper_bound']];
                    // array_push($treeInfo, $nAdd);
                    $treeInfo[$nutrient['name']] = $nutrient['lower_bound'].' - '.$nutrient['upper_bound'];
                }
            }
            array_push($rows, $treeInfo);
        }

        // dd($rows);


        return view('admin.sensors', compact('rows'));
        
    }
    public function getSensorID($anchor_id)
    {
        $result = DB::table('sensor_map')
            ->select('sensor_id')
            ->where('anchor_id', $anchor_id)->get();
        // dd($result);
        return response()->json($result[0], 200);
    }
    public function getSensors()
    {
        $result = DB::table('sensor_map')
            ->select('sensor_id', 'anchor_id')->get();
        // dd($result);
        return response()->json($result, 200);
    }
}
