<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ArtistIndexTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testIndex()
    {
        //テストデータが二つ存在するとする
//        $first = factory(App\Http\Model\Artist::class)->create();
//        $second = factory(App\Http\Model\Artist::class)->create();
//        $first->save();
//        $second->save();

        //テスト開始
        $this->visit('/')
        ->assertSee('アーティスト');
//        ->see($first->name)->see($first->content)
//        ->see($second->name)->see($second->content);
    }
}
