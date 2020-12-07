<?php

namespace App\Repositories;

use Illuminate\Http\Request;
use App\Models\Student;
use App\Repositories\BaseRepository;
use Exception;

class StudentRepository extends BaseRepository
{
    public function __construct(Student $student){
        $this->student = $student;
    }

    public function storeStudent($student){
        try {
            return $this->student->create($student);
        } catch (\Exception $e) {
            throw new \Exception($e->getMessage(), 500);

        }
    }
}
