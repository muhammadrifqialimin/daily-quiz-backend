<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Quiz;
use App\Models\Result;

class ResultController extends Controller
{
    // --- FUNGSI 1: SUBMIT JAWABAN (UPDATE) ---
    public function submit(Request $request)
    {
        $studentId = $request->student_id;
        $category = $request->category;
        
        $studentAnswers = $request->answers; 

        $totalCorrect = 0;
        
        $totalQuestions = count($studentAnswers);

        foreach ($studentAnswers as $quizId => $answer) {
            $quiz = Quiz::find($quizId);
            
            if ($quiz && strtolower($quiz->answer) == strtolower($answer)) {
                $totalCorrect++;
            }
        }

        $finalScore = ($totalQuestions > 0) ? round(($totalCorrect / $totalQuestions) * 100) : 0;

        // SIMPAN KE DATABASE
        Result::create([
            'student_id' => $studentId,
            'category' => $category,
            'total_correct' => $totalCorrect,
            'total_questions' => $totalQuestions,
            'score' => $finalScore,
            'answers' => json_encode($studentAnswers)
        ]);

        return response()->json([
            'status' => true,
            'message' => 'Nilai berhasil disimpan',
            'score' => $finalScore,
            'correct' => $totalCorrect,
            'total' => $totalQuestions
        ]);
    }

    public function show($id)
    {
        $result = Result::find($id);

        if (!$result) {
            return response()->json(['message' => 'Data tidak ditemukan'], 404);
        }
        $studentAnswers = json_decode($result->answers, true) ?? [];
        
        $quizIds = array_keys($studentAnswers);
        
        $quizzes = Quiz::whereIn('id', $quizIds)->get();

        $evaluation = $quizzes->map(function($q) use ($studentAnswers) {
            $myAns = strtolower($studentAnswers[$q->id] ?? '-');
            $correctAns = strtolower($q->answer);
            $isCorrect = $myAns == $correctAns;

            return [
                'question' => $q->question,
                'options' => [
                    'a' => $q->option_a, 
                    'b' => $q->option_b, 
                    'c' => $q->option_c, 
                    'd' => $q->option_d
                ],
                'my_answer' => $myAns,
                'correct_answer' => $correctAns,
                'is_correct' => $isCorrect
            ];
        });

        return response()->json([
            'status' => true,
            'data' => [
                'score' => $result->score,
                'date' => $result->created_at->format('d M Y, H:i'),
                'details' => $evaluation
            ]
        ]);
    }
}