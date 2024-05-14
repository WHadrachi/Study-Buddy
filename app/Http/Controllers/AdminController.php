<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use App\Models\Subject;
use App\Models\StudyMaterial;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    /**
     * Manage subjects.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function manageSubjects(Request $request)
    {
        $this->authorize('manage_subjects', Admin::class);

        if ($request->isMethod('post')) {
            $request->validate([
                'name' => 'required|string|max:255',
                'description' => 'nullable|string',
            ]);

            $subject = Subject::create([
                'name' => $request->input('name'),
                'description' => $request->input('description'),
            ]);

            return response()->json([
                'message' => 'Subject created successfully.',
                'subject' => $subject,
            ], 201);
        } elseif ($request->isMethod('put')) {
            $subject = Subject::findOrFail($request->input('id'));
            $subject->update([
                'name' => $request->input('name'),
                'description' => $request->input('description'),
            ]);

            return response()->json([
                'message' => 'Subject updated successfully.',
                'subject' => $subject,
            ], 200);
        } elseif ($request->isMethod('delete')) {
            $subject = Subject::findOrFail($request->input('id'));
            $subject->delete();

            return response()->json([
                'message' => 'Subject deleted successfully.',
            ], 200);
        }

        $subjects = Subject::all();
        return response()->json([
            'subjects' => $subjects,
        ], 200);
    }

    /**
     * Manage study materials.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function manageStudyMaterials(Request $request)
    {
        $this->authorize('manage_study_materials', Admin::class);

        if ($request->isMethod('post')) {
            $request->validate([
                'title' => 'required|string|max:255',
                'description' => 'nullable|string',
                'file' => 'required|file',
                'subject_id' => 'required|exists:subjects,id',
            ]);

            $studyMaterial = StudyMaterial::create([
                'title' => $request->input('title'),
                'description' => $request->input('description'),
                'file' => $request->file('file')->store('study-materials'),
                'subject_id' => $request->input('subject_id'),
            ]);

            return response()->json([
                'message' => 'Study material created successfully.',
                'study_material' => $studyMaterial,
            ], 201);
        } elseif ($request->isMethod('put')) {
            $studyMaterial = StudyMaterial::findOrFail($request->input('id'));
            $studyMaterial->update([
                'title' => $request->input('title'),
                'description' => $request->input('description'),
                'file' => $request->hasFile('file') ? $request->file('file')->store('study-materials') : $studyMaterial->file,
                'subject_id' => $request->input('subject_id'),
            ]);

            return response()->json([
                'message' => 'Study material updated successfully.',
                'study_material' => $studyMaterial,
            ], 200);
        } elseif ($request->isMethod('delete')) {
            $studyMaterial = StudyMaterial::findOrFail($request->input('id'));
            $studyMaterial->delete();

            return response()->json([
                'message' => 'Study material deleted successfully.',
            ], 200);
        }

        $studyMaterials = StudyMaterial::all();
        return response()->json([
            'study_materials' => $studyMaterials,
        ], 200);
    }
}