<?php

namespace Tests;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\Task;
use App\Models\User;
use App\Models\TaskStatus;
use PHPUnit\Framework\Attributes\DataProvider;

class TaskControllerTest extends TestCase
{
    public function setUp(): void
    {
        parent::setUp();

        $user = User::factory()->create();
        TaskStatus::factory()->count(5)->create();
        $this->actingAs($user);
        $this->task = Task::factory()->create();
    }

    public static function pathProvider(): array
    {
        return [
            ['tasks.index', [], 200, 'tasks', 'tasks.index'],
            ['tasks.show', ['task' => 1], 200, 'task', 'tasks.show'],
            ['tasks.create', [], 200, ''],
            ['tasks.edit', ['task' => 1], 200, ''],
        ];
    }

    #[DataProvider('pathProvider')]
    public function testAccessGuest(
        string $path,
        array $param,
        int $code,
        string $viewHas,
        ?string $view = null,
    ) {
        auth()->logout();
        $response = $this->get(route($path, $param));

        $response->assertStatus($code);
        if ($view !== null) {
            $response->assertViewIs($view);
            $response->assertViewHas($viewHas);
        }
    }

    public function testIndex()
    {
        $response = $this->get('/tasks');

        $response->assertStatus(200);
        $response->assertViewIs('tasks.index');
        $response->assertViewHas('tasks');
    }

    public function testCreate()
    {
        $response = $this->get('/tasks/create');
        $response->assertStatus(200);
        $response->assertViewIs('tasks.create');
    }

    public function testEdit()
    {
        $response = $this->get("/tasks/{$this->task->id}/edit");
        $response->assertStatus(200);
        $response->assertViewIs('tasks.edit');
        $response->assertViewHas('task', $this->task);
    }

    public function testStore()
    {
        $task = Task::factory()->make();
        $response = $this->post(route('tasks.store'), $task->toArray());

        $response->assertStatus(302);
        $response->assertRedirectToRoute('tasks.index');
        $this->assertDatabaseHas('tasks', ['name' => $task->name]);
    }

    public function testShow()
    {
        $response = $this->get("/tasks/{$this->task->id}");
        $response->assertStatus(200);
        $response->assertViewIs('tasks.show');
        $response->assertViewHas('task', $this->task);
    }

    public function testUpdate()
    {
        $updatedData = Task::factory()->make()->only([
            'name', 'description', 'status_id', 'assigned_to_id'
        ]);
        $response = $this->patch("/tasks/{$this->task->id}", $updatedData);
        $this->assertDatabaseHas('tasks', $updatedData);
//        $response->assertRedirectToRoute('tasks.index');
    }

    public function testDestroy()
    {
        $response = $this->delete("/tasks/{$this->task->id}");
        $this->assertDatabaseMissing('tasks', ['id' => $this->task->id]);
//        $response->assertRedirectToRoute('/tasks');
    }

    public function testDestroyNotOwner()
    {
        $newUser = User::factory()->create();
        $response = $this->actingAs($newUser)->delete("/tasks/{$this->task->id}");
        $response->assertStatus(302);
    }
}
