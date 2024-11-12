<?php

namespace Database\Factories;

use App\Models\Board;
use App\Models\EducationalQualification;
use App\Models\Examination;
use App\Models\Institute;
use App\Models\Subject;
use Illuminate\Database\Eloquent\Factories\Factory;

class EducationalQualificationFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = EducationalQualification::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $durations = EducationalQualification::durations();
        $results = EducationalQualification::results();
        $gpas = number_format((float)(rand(1000,5000)/1000), 2, '.',',');
        $types = EducationalQualification::types();

        $type = $types[rand(0,5)];
        $exams = Examination::select('name')->get();
        $boards = Board::select('name')->get();
        $institutes = Institute::select('name')->get();
        $institutes_masters = Institute::where('type','Masters')->select('name')->get();
        $institutes_grads = Institute::where('type','Graduation')->select('name')->get();
        $subjects = Subject::select('name')->get();

        if ($type == 'jsc'){
            $exam = $exams[rand(0,3)];
            $board = $boards[rand(0,13)];
            $result = $results[0];
            $duration = '';
            $institute = $institutes[rand(0,Institute::count()-1)];
            $subject = '';
        } else if ($type == 'ssc') {
            $exam = $exams[rand(4,8)];
            $board = $boards[rand(0,13)];
            $result = $gpas;
            $duration = '';
            $institute = $institutes[rand(0,Institute::count()-1)];
            $subject = $subjects[rand(0,24)]['name'];
        } else if ($type == 'hsc') {
            $exam = $exams[rand(9,14)];
            $board = $boards[rand(14,27)];
            $result = $gpas;
            $duration = '';
            $institute = $institutes[rand(0,Institute::count()-1)];
            $subject = $subjects[rand(24,54)]['name'];
        } else if ($type == 'graduation') {
            $exam = $exams[rand(15,22)];
            $board = $boards[rand(28,41)];
            $result = $results[rand(1,3)];
            $duration = $durations[rand(0,4)];
            $institute = $institutes_grads[rand(0,Institute::where('type','Graduation')->count()-1)];
            $subject = $subjects[rand(54,227)]['name'];
        } else if ($type == 'masters') {
            $exam = $exams[rand(23,32)];
            $board = '';
            $result = $results[rand(1,3)];
            $duration = $durations[rand(0,4)];
            $institute = $institutes_masters[rand(0,Institute::where('type','Masters')->count()-1)];
            $subject = $subjects[rand(228,401)]['name'];
        } else {
            $exam = $exams[rand(33,38)];
            $board = '';
            $result = $results[rand(1,3)];
            $duration = $durations[rand(0,4)];
            $institute = $institutes[rand(0,Institute::count()-1)];
            $subject = $subjects[rand(228,401)]['name'];
        }

        return [
            "type" => $type,
            "examination" => $exam,
            "board" => $board,
            "roll" => rand(1111,999999),
            "result" => $result,
            "subject" => $subject,
            "duration" => $duration,
            "passing_year" => rand(1950,2020),
            "institute" => $institute['name'],
        ];
    }
}
