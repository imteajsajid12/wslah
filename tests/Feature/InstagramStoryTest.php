<?php

namespace Tests\Feature;

use App\Models\InstagramStory;
use App\Models\Restaurant;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class InstagramStoryTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    protected function setUp(): void
    {
        parent::setUp();
        
        // Create test users and restaurants
        $this->user1 = User::factory()->create([
            'user_type' => 2, // Regular restaurant user
            'first_name' => 'Restaurant',
            'last_name' => 'Owner1'
        ]);
        
        $this->user2 = User::factory()->create([
            'user_type' => 2, // Regular restaurant user
            'first_name' => 'Restaurant',
            'last_name' => 'Owner2'
        ]);
        
        $this->restaurant1 = Restaurant::factory()->create([
            'user_id' => $this->user1->id,
            'name' => 'Test Restaurant 1',
            'uuid' => 'test-uuid-1'
        ]);
        
        $this->restaurant2 = Restaurant::factory()->create([
            'user_id' => $this->user2->id,
            'name' => 'Test Restaurant 2',
            'uuid' => 'test-uuid-2'
        ]);
        
        // Create Instagram stories for each user
        $this->story1 = InstagramStory::create([
            'user_id' => $this->user1->id,
            'insta_story_id' => 'story_1_user_1',
            'payload' => json_encode([
                'id' => 'story_1_user_1',
                'media_type' => 'IMAGE',
                'media_url' => 'https://example.com/story1.jpg',
                'timestamp' => now()->toISOString()
            ])
        ]);
        
        $this->story2 = InstagramStory::create([
            'user_id' => $this->user2->id,
            'insta_story_id' => 'story_1_user_2',
            'payload' => json_encode([
                'id' => 'story_1_user_2',
                'media_type' => 'IMAGE',
                'media_url' => 'https://example.com/story2.jpg',
                'timestamp' => now()->toISOString()
            ])
        ]);
    }

    /** @test */
    public function it_returns_only_user_specific_stories_via_ajax()
    {
        // Test for user 1's restaurant
        $response = $this->get('/instagram/sliderAjax?menu=test-uuid-1');
        
        $response->assertStatus(200);
        $data = $response->json();
        
        $this->assertEquals(1, $data['stories_count']);
        $this->assertEquals('story_1_user_1', $data['stories'][0]['insta_story_id']);
        $this->assertEquals($this->user1->id, $data['stories'][0]['user_id']);
        
        // Test for user 2's restaurant
        $response = $this->get('/instagram/sliderAjax?menu=test-uuid-2');
        
        $response->assertStatus(200);
        $data = $response->json();
        
        $this->assertEquals(1, $data['stories_count']);
        $this->assertEquals('story_1_user_2', $data['stories'][0]['insta_story_id']);
        $this->assertEquals($this->user2->id, $data['stories'][0]['user_id']);
    }

    /** @test */
    public function it_returns_empty_stories_for_invalid_restaurant()
    {
        $response = $this->get('/instagram/sliderAjax?menu=invalid-uuid');
        
        $response->assertStatus(404);
        $data = $response->json();
        
        $this->assertEquals(0, $data['stories_count']);
        $this->assertEmpty($data['stories']);
    }

    /** @test */
    public function helper_function_returns_correct_user_stories()
    {
        // Mock the request to simulate accessing restaurant 1
        request()->merge(['menu' => 'test-uuid-1']);
        
        $stories = instagram_stories_for_store();
        
        $this->assertCount(1, $stories);
        $this->assertEquals('story_1_user_1', $stories->first()->insta_story_id);
        $this->assertEquals($this->user1->id, $stories->first()->user_id);
        
        // Mock the request to simulate accessing restaurant 2
        request()->merge(['menu' => 'test-uuid-2']);
        
        $stories = instagram_stories_for_store();
        
        $this->assertCount(1, $stories);
        $this->assertEquals('story_1_user_2', $stories->first()->insta_story_id);
        $this->assertEquals($this->user2->id, $stories->first()->user_id);
    }

    /** @test */
    public function menu_page_shows_correct_story_count()
    {
        // Test restaurant 1's menu page
        $response = $this->get('/menu/test-uuid-1');
        
        $response->assertStatus(200);
        $response->assertViewHas('stories_count', 1);
        $response->assertViewHas('rest');
        
        $restaurant = $response->viewData('rest');
        $this->assertEquals('test-uuid-1', $restaurant->uuid);
        $this->assertEquals($this->user1->id, $restaurant->user_id);
    }
}
