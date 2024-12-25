<?php

namespace App\Http\Controllers;

use App\Constants\TablesName;
use App\Http\Resources\TreeResource;
use App\Models\Nutrient;
use App\Models\Tree;
use App\Models\TreeCategory;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Validator;

class TreeController extends Controller
{

    public function getObservations()
    {

        $response = Http::withHeaders([
            'token' => 'Add7rMPgCuGvKVj5F0Osmo4ahWKZzHmohg8nEMDVS7l49No6Bfhyu2tnWfJO'
        ])->get('http://127.0.0.1:8081/api/get/observations?top=1&order=id desc');


        $observations = $response->json();
        $result = $observations[0]['result'][0];
        // dd($result);
        // dd($result);
        // $join = DB::
        //     table(TablesName::TREES.' as t')
        //     ->select(['t.id as tree_id', 'n.name as name',
        //     ,'n.lower_bound as lower_bound','n.upper_bound as upper_bound'])
        //     ->join(TablesName::TREE_NUTRIENTS.' as tn','t.id','=','tn.tree_id')
        //     ->join(TablesName::NUTRIENTS.' as n', 'n.id','=','tn.nutrient_id')
        //     ->groupBy('t.id')
        //     ->get();
        // 
        $nutrientValues = [
            'N' => $result['Nito'],  // Example value for N (nullable or numeric)
            'P' => $result['Photpho'], // Example: P is not provided
            'K' => $result['Kali'],
            'S' => null,
            'Ca' => null
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

        $trees['N_measure'] = $result['Nito'] ?? null;
        $trees['P_measure'] = $result['Photpho'] ?? null;
        $trees['K_measure'] = $result['Kali'] ?? null;
        $trees['S_measure'] = $result['S'] ?? null;
        $trees['Ca_measure'] = $result['Ca'] ?? null;
            
        // dd($trees);
        // $trees = Tree::all();
        // $treeResource = TreeResource::collection($trees);
        return response()->json(["value" => $trees], 200);
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $trees = Tree::all();
        $treeResource = TreeResource::collection($trees);
        return response()->json(["value" => $treeResource], 200);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            $attribute = Validator::make($request->all(), [
                // 'id' => 'required',
                'name' => 'required|string',
                'type' => 'required|string',
                'nutrients' => 'required|array'
            ]);


            if ($attribute->fails()) {
                return response()->json(['success' => false, 'message' => $attribute->errors()], 404);
            }

            DB::beginTransaction();
            $type_id = DB::table(TablesName::TREE_CATEGORIES)->where('name', $request->type)->first()->id;
            if (!$type_id) {
                $tree_category = TreeCategory::create([
                    'name' => $request->type
                ]);
                $type_id = $tree_category->id;
            }
            $tree = Tree::create([
                'name' => $request->name,
                'type_id' => $type_id
            ]);

            // nuntrients
            if (isset($request->nutrients)) {
                foreach ($request->nutrients as $nutrient) {
                    $ele = DB::table(TablesName::NUTRIENTS)
                        ->where('name', $nutrient['name'])
                        ->where('lower_bound', $nutrient['lower_bound'])
                        ->where('upper_bound', $nutrient['upper_bound'])
                        ->first();
                    if (!$ele) {
                        $nut = Nutrient::create([
                            'name' => $nutrient['name'],
                            'lower_bound' => $nutrient['lower_bound'],
                            'upper_bound' => $nutrient['upper_bound']
                        ]);
                        $ele = $nut;
                    }

                    DB::table(TablesName::TREE_NUTRIENTS)->insert([
                        'nutrient_id' => $ele->id,
                        'tree_id' => $tree->id
                    ]);
                }
            }
            DB::commit();
        } catch (Exception $e) {
            DB::rollBack();
            return response()->json(['success' => false, 'message' => $e->getMessage()], status: 400);
        }

        $treeResource = TreeResource::collection([$tree]);

        return response()->json(['success' => true, 'value' => $treeResource], 200);

    }

    /**
     * Display the specified resource.
     */
    public function show($tree_id)
    {
        $tree = Tree::where('id', $tree_id)->first();

        if (!$tree) {
            return response()->json(['success' => 'false', 'message' => 'Not found'], 404);
        }

        $treeResource = TreeResource::collection([$tree]);
        return response()->json($treeResource[0], 200);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($tree_id)
    {
        $tree = Tree::query()->where('id', $tree_id)->first();

        if (!$tree) {
            return response()->json(['success' => 'false', 'message' => 'Not found'], 404);
        }

        $tree->delete();

        // $treeResource = TreeResource::collection([$tree]);
        return response()->json(['success' => true], 204);
    }
}
