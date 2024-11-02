<?php

namespace Tests;

use App\Models\Task;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\TaskStatus;
use App\Models\User;
use PHPUnit\Framework\Attributes\DataProvider;

class TaskStatusControllerTest extends TestCase
{
    protected TaskStatus $taskStatus;
    public function setUp(): void
    {
        parent::setUp();

        $user = User::factory()->create();
        $this->actingAs($user);
        $this->taskStatus = TaskStatus::factory()->create();
    }

    public static function pathProvider(): array
    {
        return [
            ['task_statuses.index', [], 200, 'taskStatuses.index'],
            ['task_statuses.create', [], 200],
            ['task_statuses.edit', ['task_status' => 1], 200]
        ];
    }

    #[DataProvider('pathProvider')]
    public function testAccessGuest(string $path, array $param, int $code, ?string $view = null)
    {
        auth()->logout();
        $response = $this->get(route($path, $param));
        $response->assertStatus($code);
        if ($view !== null) {
            $response->assertViewIs($view);
            $response->assertViewHas('taskStatuses');
        }
    }

    public function testIndex()
    {
        $response = $this->get('/task_statuses');

        $response->assertStatus(200);
        $response->assertViewIs('taskStatuses.index');
        $response->assertViewHas('taskStatuses');
    }

    public function testCreate()
    {
        $response = $this->get('/task_statuses/create');
        $response->assertStatus(200);
        $response->assertViewIs('taskStatuses.create');
    }

    public function testEdit()
    {
        $response = $this->get("/task_statuses/{$this->taskStatus->id}/edit");

        $response->assertStatus(200);
        $response->assertViewIs('taskStatuses.edit');
        $response->assertViewHas('taskStatus', $this->taskStatus);
    }

    public function testStore()
    {
        $taskStatus = TaskStatus::factory()->make();
        $response = $this->post('/task_statuses', ['name' => $taskStatus->name]);

        $this->assertDatabaseHas('task_statuses', ['name' => $taskStatus->name]);
        $response->assertRedirectToRoute('task_statuses.index');
    }

    public function testUpdate()
    {
        $updatedData = ['name' => fake()->word];

        $response = $this->patch("/task_statuses/{$this->taskStatus->id}", $updatedData);

        $this->assertDatabaseHas('task_statuses', $updatedData);
        $response->assertRedirect('/task_statuses');
    }

    public function testValidate()
    {
        $validateProvider = [
            ['post', 'task_statuses.index', []],
            ['patch', 'task_statuses.update', ['task_status' => $this->taskStatus->id]]
        ];

        foreach ($validateProvider as [$method, $path, $param]) {
            $response = $this->call($method, route($path, $param));
            $response->assertStatus(302);
            $response->assertRedirect('/');
            $response->assertSessionHasErrors(['name']);
        }
    }
}
