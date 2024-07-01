<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\School;
use App\Models\User;
use Illuminate\Support\Facades\Response;


class RelationshipController extends Controller
{
    // all students follows school
    public function schoolstudents($id)
    {
        $school = School::findOrFail($id);
        $users = $school->users()->where('role', 1)->get();

        return Response::json([
            'data' => $users->toArray()
        ], 200);
    }
    public function schoolteachers($id)
    {
        $school = School::findOrFail($id);
        $users = $school->users()->where('role', 2)->get();

        return Response::json([
            'data' => $users->toArray()
        ], 200);
    }
    public function schoolmanagers($id)
    {
        $school = School::findOrFail($id);
        $users = $school->users()->where('role', 3)->get();

        return Response::json([
            'data' => $users->toArray()
        ], 200);
    }
}
