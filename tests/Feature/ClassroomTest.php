<?php

// Classroom Tests
use App\Models\Classroom;
use App\Models\School;

test('can fetch classrooms of a school', function () {
    $school = School::factory()->create();
    $response = $this->getJson("/api/schools/{$school->id}/classrooms");
    $response->assertStatus(200);
})->group('classrooms');

test('can create a classroom in a school', function () {
    $school = School::factory()->create();
    $classroomData = ['room_number' => '242', 'grade' => 12];

    $response = $this->postJson("/api/schools/{$school->id}/classrooms", $classroomData);
    $response->assertStatus(201)->assertJson($classroomData);
})->group('classrooms');

test('can view a specific classroom', function () {
    $classroom = Classroom::factory()->create();
    $response = $this->getJson("/api/schools/{$classroom->school_id}/classrooms/{$classroom->id}");
    $response->assertStatus(200)->assertJson(['id' => $classroom->id]);
})->group('classrooms');

test('can update a classroom', function () {
    $classroom = Classroom::factory()->create();
    $updatedData = ['room_number' => '242', 'grade' => 11];

    $response = $this->putJson("/api/schools/{$classroom->school_id}/classrooms/{$classroom->id}", $updatedData);
    $response->assertStatus(200)->assertJson($updatedData);
})->group('classrooms');

test('can delete a classroom', function () {
    $classroom = Classroom::factory()->create();
    $response = $this->deleteJson("/api/schools/{$classroom->school_id}/classrooms/{$classroom->id}");
    $response->assertStatus(204);
})->group('classrooms');
