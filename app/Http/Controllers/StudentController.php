<?php

namespace App\Http\Controllers;

use App\Models\Student;
use App\Models\LearningStyle;
use App\Models\Subject;
use App\Models\StudyPlan;
use App\Models\Performance;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class StudentController extends Controller
{
    /**
     * Assess the student's learning style.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function assessLearningStyle(Request $request)
    {
        $student = Auth::user()->student;
        $learningStyle = LearningStyle::create([
            'student_id' => $student->id,
            'style' => $request->input('learning_style'),
        ]);

        return response()->json([
            'message' => 'Learning style assessed successfully.',
            'learning_style' => $learningStyle,
        ], 201);
    }

    /**
     * Select subjects for the student.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function selectSubjects(Request $request)
    {
        $student = Auth::user()->student;
        $subjects = Subject::whereIn('id', $request->input('subject_ids'))->get();
        $student->subjects()->sync($subjects->pluck('id'));

        return response()->json([
            'message' => 'Subjects selected successfully.',
            'subjects' => $subjects,
        ], 200);
    }

    /**
     * View the student's study plan.
     *
     * @return \Illuminate\Http\Response
     */
    public function viewStudyPlan()
    {
        $student = Auth::user()->student;
        $studyPlan = $student->studyPlan;

        return response()->json([
            'study_plan' => $studyPlan,
        ], 200);
    }

    /**
     * Attempt practice questions.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function attemptPracticeQuestions(Request $request)
    {
        $student = Auth::user()->student;
        $performance = Performance::create([
            'student_id' => $student->id,
            'score' => $request->input('score'),
            'subject_id' => $request->input('subject_id'),
        ]);

        return response()->json([
            'message' => 'Practice questions attempted successfully.',
            'performance' => $performance,
        ], 201);
    }

    /**
     * Track the student's performance.
     *
     * @return \Illuminate\Http\Response
     */
    public function trackPerformance()
    {
        $student = Auth::user()->student;
        $performance = $student->performance;

        return response()->json([
            'performance' => $performance,
        ], 200);
    }

    /**
     * Receive feedback for the student.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function receiveFeedback(Request $request)
    {
        $student = Auth::user()->student;
        $studyPlan = $student->studyPlan;
        $studyPlan->update([
            'feedback' => $request->input('feedback'),
        ]);

        return response()->json([
            'message' => 'Feedback received successfully.',
            'study_plan' => $studyPlan,
        ], 200);
    }
    /**
 * Earn rewards for the student.
 *
 * @return \Illuminate\Http\Response
 */
public function earnRewards()
{
    $student = Auth::user()->student;

    // Calculate the student's overall performance score
    $performanceScore = $this->calculatePerformanceScore($student);

    // Check the student's study plan progress
    $studyPlanProgress = $this->calculateStudyPlanProgress($student);

    // Determine the reward based on the performance and study plan progress
    $reward = $this->determineReward($performanceScore, $studyPlanProgress);

    // Update the student's rewards
    $student->rewards += $reward;
    $student->save();

    return response()->json([
        'message' => 'Rewards earned successfully.',
        'rewards' => $student->rewards,
    ], 200);
}

/**
 * Calculate the student's overall performance score.
 *
 * @param  \App\Models\Student  $student
 * @return float
 */
private function calculatePerformanceScore($student)
{
    $performances = $student->performance;
    $totalScore = 0;
    $totalAttempts = 0;

    foreach ($performances as $performance) {
        $totalScore += $performance->score;
        $totalAttempts++;
    }

    return $totalAttempts > 0 ? $totalScore / $totalAttempts : 0;
}

/**
 * Calculate the student's study plan progress.
 *
 * @param  \App\Models\Student  $student
 * @return float
 */
private function calculateStudyPlanProgress($student)
{
    $studyPlan = $student->studyPlan;
    $totalTasks = $studyPlan->tasks->count();
    $completedTasks = $studyPlan->tasks()->where('completed', true)->count();

    return $totalTasks > 0 ? ($completedTasks / $totalTasks) * 100 : 0;
}

/**
 * Determine the reward based on the performance and study plan progress.
 *
 * @param  float  $performanceScore
 * @param  float  $studyPlanProgress
 * @return int
 */
private function determineReward($performanceScore, $studyPlanProgress)
{
    $baseReward = 100; // Base reward amount
    $performanceMultiplier = $performanceScore / 100; // Performance-based multiplier
    $studyPlanMultiplier = $studyPlanProgress / 100; // Study plan progress-based multiplier

    $reward = $baseReward * $performanceMultiplier * $studyPlanMultiplier;
    return (int) $reward;
}
}