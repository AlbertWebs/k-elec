<?php

namespace Tests\Feature;

use App\Models\HomepageVideo;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class HomepageVideoTest extends TestCase
{
    use RefreshDatabase;

    public function test_homepage_hides_video_section_when_inactive(): void
    {
        HomepageVideo::create([
            'is_active' => false,
            'video_url' => 'https://www.youtube.com/watch?v=dQw4w9WgXcQ',
        ]);

        $this->get('/')
            ->assertOk()
            ->assertDontSee('data-homepage-video="1"', false)
            ->assertDontSee('youtube.com/embed/dQw4w9WgXcQ', false);
    }

    public function test_homepage_shows_video_section_when_active(): void
    {
        HomepageVideo::create([
            'title' => 'Brand film',
            'is_active' => true,
            'video_url' => 'https://www.youtube.com/watch?v=dQw4w9WgXcQ',
        ]);

        $this->get('/')
            ->assertOk()
            ->assertSee('data-homepage-video="1"', false)
            ->assertSee('youtube.com/embed/dQw4w9WgXcQ', false);
    }

    public function test_admin_can_toggle_homepage_video_visibility(): void
    {
        $admin = User::factory()->create(['is_admin' => true]);
        $video = HomepageVideo::create([
            'is_active' => true,
            'video_url' => 'https://www.youtube.com/watch?v=dQw4w9WgXcQ',
        ]);

        $this->actingAs($admin)
            ->patch(route('admin.homepage-video.toggle'))
            ->assertRedirect(route('admin.homepage-video.edit'));

        $this->assertFalse($video->fresh()->is_active);
    }

    public function test_admin_can_update_homepage_video_url(): void
    {
        $admin = User::factory()->create(['is_admin' => true]);

        $this->actingAs($admin)
            ->put(route('admin.homepage-video.update'), [
                'title' => 'Launch video',
                'video_url' => 'https://youtu.be/dQw4w9WgXcQ',
            ])
            ->assertRedirect(route('admin.homepage-video.edit'));

        $this->assertDatabaseHas('homepage_videos', [
            'title' => 'Launch video',
            'video_url' => 'https://youtu.be/dQw4w9WgXcQ',
        ]);
    }
}
