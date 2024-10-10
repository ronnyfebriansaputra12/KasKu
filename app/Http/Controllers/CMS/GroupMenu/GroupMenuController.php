<?php

namespace App\Http\Controllers\CMS\GroupMenu;

use App\Http\Controllers\Controller;
use App\Models\GroupMenu;
use Illuminate\Http\Request;
use Spatie\Activitylog\ActivityLogger;
use Spatie\Activitylog\Models\Activity;
use Yajra\DataTables\Facades\DataTables;

class GroupMenuController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $title = 'Group Menu';
        return view('configuration.group_menu.be_group_menu_index', compact('title'));
    }

    public function fnGetData()
    {
        $data = GroupMenu::select('id', 'name', 'sequence')->get();
        if (!empty($data)) {
            return DataTables::of($data)
                // ->skipPaging()
                // ->setTotalRecords($data->total)
                // ->setFilteredRecords($data->total)
                ->addColumn('action', function ($q) {
                    $btn = '<div class="dropdown">';
                    $btn .= '<button class="btn btn-sm dropdown-toggle" type="button" id="dr5" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">';
                    $btn .= '<span class="text-muted sr-only">Action</span>';
                    $btn .= '</button>';
                    $btn .= '<div class="dropdown-menu dropdown-menu-right" aria-labelledby="dr5">';
                    $btn .= '<a class="dropdown-item btnDetail" href="#" data-toggle="modal" data-target=".modal-right-detail" data-id="' . $q->id . '">Detail</a>';
                    $btn .= '<a class="dropdown-item btnEdit" href="#" data-toggle="modal" data-target=".modal-right-edit" data-id="' . $q->id . '">Edit</a>';
                    $btn .= '<a class="dropdown-item btnDelete" href="#" data-id="' . $q->id . '">Delete</a>';
                    $btn .= '</div>';
                    $btn .= '</div>';
                    return $btn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }

        return false;
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return response()->json([
            'status' => 200,
            'template' => (string) view('configuration.group_menu.be_group_menu_create')
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $params = $request->only('name', 'sequence', 'icon');

        if ($params['sequence'] < 1) {
            return response()->json([
                'status' => 400,
                'message' => 'Sequence must be greater than 0'
            ]);
        }
        $checkSequence = GroupMenu::where('sequence', $params['sequence'])->first();
        if ($checkSequence) {
            return response()->json([
                'status' => 400,
                'message' => 'Please choose other sequence',
            ]);
        }

        GroupMenu::create($params);
        $activity = Activity::all()->last();

        $activity->description;
        $activity->subject;
        $activity->changes;
        return response()->json([
            'status' => 200,
            'message' => 'Group Menu has been created'
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(GroupMenu $groupMenu, $id)
    {
        $groupMenu = GroupMenu::where('id', $id)->first();
        if ($groupMenu) {
            return response()->json([
                'status' => 200,
                'template' => (string) view('configuration.group_menu.be_group_menu_detail', compact('groupMenu')),
                'data' => $groupMenu
            ]);
        } else {
            return response()->json([
                'status' => 404,
                'message' => 'Group Menu not found'
            ]);
        }
    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit(GroupMenu $groupMenu, $id)
    {
        $groupMenu = GroupMenu::where('id', $id)->first();
        if ($groupMenu) {
            return response()->json([
                'status' => 200,
                'template' => (string) view('configuration.group_menu.be_group_menu_edit', compact('groupMenu')),
                'data' => $groupMenu
            ]);
        } else {
            return response()->json([
                'status' => 404,
                'message' => 'Group Menu not found'
            ]);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, GroupMenu $groupMenu)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(GroupMenu $groupMenu)
    {
        //
    }
}
