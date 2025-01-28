<?php

// Student Tests
use App\Models\Classroom;
use App\Models\Student;

test('can fetch students in a classroom', function () {
    $classroom = Classroom::factory()->create();
    $response = $this->getJson("/api/schools/{$classroom->school_id}/classrooms/{$classroom->id}/students");
    $response->assertStatus(200);
})->group('students');

test('can create a student in a classroom', function () {
    $classroom = Classroom::factory()->create();
    $studentData = ['name' => 'John Doe', 'age' => 15];

    $response = $this->postJson("/api/schools/{$classroom->school_id}/classrooms/{$classroom->id}/students", $studentData);
    $response->assertStatus(201)->assertJson($studentData);
})->group('students');

test('can view a specific student', function () {
    $student = Student::factory()->create();
    $response = $this->getJson("/api/schools/{$student->classroom->school_id}/classrooms/{$student->classroom_id}/students/{$student->id}");
    $response->assertStatus(200)->assertJson(['id' => $student->id]);
})->group('students');

test('can update a student', function () {
    $student = Student::factory()->create();
    $updatedData = ['name' => 'Jane Doe', 'age' => 16];

    $response = $this->putJson("/api/schools/{$student->classroom->school_id}/classrooms/{$student->classroom_id}/students/{$student->id}", $updatedData);
    $response->assertStatus(200)->assertJson($updatedData);
})->group('students');

test('can delete a student', function () {
    $student = Student::factory()->create();
    $response = $this->deleteJson("/api/schools/{$student->classroom->school_id}/classrooms/{$student->classroom_id}/students/{$student->id}");
    $response->assertStatus(204);
})->group('students');
