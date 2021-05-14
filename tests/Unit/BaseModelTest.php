<?php

namespace EolabsIo\YotpoApi\Tests\Unit;

use Illuminate\Support\Arr;
use EolabsIo\YotpoApi\Tests\TestCase;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Testing\RefreshDatabase;

abstract class BaseModelTest extends TestCase
{
    use RefreshDatabase;

    /** @var string */
    public $modelClass;


    public function setUp(): void
    {
        parent::setUp();

        $this->seedDatabase();

        $this->modelClass = $this->getModelClass();
    }

    abstract protected function getModelClass();

    public function seedDatabase()
    {
    }

    /** @test */
    public function it_can_find_models()
    {
        $modelsInDb = $this->modelClass::factory(10)->create();

        $models = $this->modelClass::All();

        $this->assertArraysEqual($models->toArray(), $modelsInDb->toArray());
    }

    /** @test */
    public function it_can_create_a_model()
    {
        $data = $this->modelClass::factory()->make()->toArray();

        $model = $this->modelClass::create($data);
        $table = $model->getTable();

        $this->assertInstanceOf($this->modelClass, $model);
        $this->assertDatabaseHasModel($model);
    }

    /** @test */
    public function it_can_find_a_model()
    {
        $model = $this->modelClass::factory()->create();
        $primaryKey = $this->getPrimaryKeyValue($model);

        $found = $this->modelClass::find($primaryKey);

        $this->assertInstanceOf($this->modelClass, $found);
        $this->assertEquals($found->toArray(), $model->toArray());
    }

    /** @test */
    public function it_can_update_a_model()
    {
        $model = $this->modelClass::factory()->create();
        $table = $model->getTable();
        $data = $this->removePrimaryKeyFromModel($this->modelClass::factory()->make());

        $update = $model->update($data);

        $this->assertTrue($update);
        $this->assertDatabaseHasModel($model);
    }


    /** @test */
    public function it_can_delete_a_model()
    {
        $model = $this->modelClass::factory()->create();
        $table = $model->getTable();

        $model->delete();

        $this->assertDatabaseMissing($table, $model->toArray());
    }

    // Helpers //
    public function assertArraysEqual($array1, $array2)
    {
        $sortedArray1 = Arr::sortRecursive($array1);
        $sortedArray2 = Arr::sortRecursive($array2);

        // return
        $this->assertEquals($sortedArray1, $sortedArray2);
    }

    private function assertDatabaseHasModel(Model $model)
    {
        $id = $model->getKey();
        $found = $this->modelClass::find($id);
        $this->assertEquals($found->toArray(), $model->toArray());
    }

    public function getPrimaryKeyValue($model)
    {
        return $model->getKey();
    }

    public function getPrimaryKeyName($model)
    {
        return $model->getKeyName();
    }

    private function removePrimaryKeyFromModel($model)
    {
        $keys = $this->getPrimaryKeyName($model);

        $primaryKeys = (is_array($keys)) ? $keys : array($keys);

        $data = collect($model->toArray())->except($primaryKeys);

        return $data->toArray();
    }
}
