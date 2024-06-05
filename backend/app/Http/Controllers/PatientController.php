<?php

namespace App\Http\Controllers;

use App\Models\Patient;
use Illuminate\Http\Request;

class PatientController extends Controller
{
    public function index()
    {
        $patients = Patient::all();
        return response()->json($patients);
    }

    public function store(Request $request)
    {
        $data = $request->only([
            'first_name',
            'last_name',
            'date_of_birth',
            'gender',
            'address',
            'phone',
            'email',
            'emergency_contact',
            'medical_history'
        ]);
        $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'date_of_birth' => 'required|date',
            'gender' => 'required|string|max:255',
            'address' => 'required|string|max:255',
            'phone' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:patients',
            'emergency_contact' => 'required|string|max:255',
            'medical_history' => 'nullable|string',
        ]);

        $patient = Patient::create($data);

        return response()->json($patient, 201);
    }

    public function show($id)
    {
        $patient = Patient::findOrFail($id);
        return response()->json($patient);
    }

    public function update(Request $request, $id)
    {
        $patient = Patient::findOrFail($id);

        $data = $request->only([
            'first_name',
            'last_name',
            'date_of_birth',
            'gender',
            'address',
            'phone',
            'email',
            'emergency_contact',
            'medical_history'
        ]);

        $request->validate([
            'first_name' => 'sometimes|required|string|max:255',
            'last_name' => 'sometimes|required|string|max:255',
            'date_of_birth' => 'sometimes|required|date',
            'gender' => 'sometimes|required|string|max:255',
            'address' => 'sometimes|required|string|max:255',
            'phone' => 'sometimes|required|string|max:255',
            'email' => 'sometimes|required|string|email|max:255|unique:patients,email,' . $patient->id,
            'emergency_contact' => 'sometimes|required|string|max:255',
            'medical_history' => 'sometimes|nullable|string',
        ]);

        $patient->update($data);

        return response()->json($patient);
    }

    public function destroy($id)
    {
        $patient = Patient::findOrFail($id);
        $patient->delete();

        return response()->json(null, 204);
    }
}
