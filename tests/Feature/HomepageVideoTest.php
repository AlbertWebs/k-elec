<?php

namespace Tests\Feature;

use App\Models\HomepageVideo;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class HomepageVideoTest extends TestCase
{
    use RefreshDatabase;

    public function test_homepage_hides_about_section_when_inactive(): void
    {
        HomepageVideo::create([
            'is_active' => false,
            'video_url' => HomepageVideo::DEFAULT_VIDEO_URL,
        ]);

        $this->get('/')
            ->assertOk()
            ->assertDontSee('data-about-kelec="1"', false)
            ->assertDontSee('ABOUT K-ELEC');
    }

    public function test_homepage_shows_about_section_when_active(): void
    {
        HomepageVideo::create([
            'title' => 'ABOUT K-ELEC',
            'is_active' => true,
            'video_url' => HomepageVideo::DEFAULT_VIDEO_URL,
        ]);

        $this->get('/')
            ->assertOk()
            ->assertSee('data-about-kelec="1"', false)
            ->assertSee('ABOUT K-ELEC')
            ->assertSee('1goNHL_j4Rt-IMOn59-_CQLVSPMOUk9hZ', false);
    }

    public function test_admin_can_toggle_homepage_video_visibility(): void
    {
        $admin = User::factory()->create(['is_admin' => true]);
        $video = HomepageVideo::create([
            'is_active' => true,
            'video_url' => HomepageVideo::DEFAULT_VIDEO_URL,
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
                'title' => 'ABOUT K-ELEC',
                'video_url' => 'https://youtu.be/dQw4w9WgXcQ',
            ])
            ->assertRedirect(route('admin.homepage-video.edit'));

        $this->assertDatabaseHas('homepage_videos', [
            'title' => 'ABOUT K-ELEC',
            'video_url' => 'https://youtu.be/dQw4w9WgXcQ',
        ]);
    }
}
