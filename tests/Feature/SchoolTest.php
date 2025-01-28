<?php

use App\Models\School;

test('can fetch list of schools', function () {
    $response = $this->getJson('/api/schools');
    $response->assertStatus(200);
})->group('schools');


// School Tests
test('can create a school', function () {
    $schoolData = [
        'name' => 'Test School',
        'address' => '123 Test St',
        'principal_name' => 'John Doe',
    ];

    $response = $this->postJson('/api/schools', $schoolData);
    $response->assertStatus(201)->assertJson($schoolData);
})->group('schools');

test('can view a specific school', function () {
    $school = School::factory()->create();
    $response = $this->getJson("/api/schools/{$school->id}");
    $response->assertStatus(200)->assertJson(['id' => $school->id]);
})->group('schools');

test('can update a school', function () {
    $school = School::factory()->create();
    $updatedData = ['name' => 'Test School1',
        'address' => '1234 Test St',
        'principal_name' => 'Jane Doe',];

    $response = $this->putJson("/api/schools/{$school->id}", $updatedData);
    $response->assertStatus(200)->assertJson($updatedData);
})->group('schools');

test('can delete a school', function () {
    $school = School::factory()->create();
    $response = $this->deleteJson("/api/schools/{$school->id}");
    $response->assertStatus(204);
})->group('schools');
