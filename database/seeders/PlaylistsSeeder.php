<?php

namespace Database\Seeders;

use App\Actions\CreatePlaylistAction;
use App\Jobs\CreatePlaylistJob;
use App\Models\Playlist;
use Illuminate\Database\Seeder;
use function resolve;

class PlaylistsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        CreatePlaylistJob::dispatch('7liFrnyYTHeqfVcEu7PLnC', '2021-11-26 14:00:00');
        CreatePlaylistJob::dispatch('12vazVBiglSaomxyrdjQ8a', '2021-12-03 14:00:00');
        CreatePlaylistJob::dispatch('4Bg4jOqHLwGILOqirzwl3m', '2021-12-10 14:00:00');
        CreatePlaylistJob::dispatch('6ViMELs8y23a4vZw3dgsec', '2022-01-07 14:00:00');
        CreatePlaylistJob::dispatch('5jFpiepjkrykBbjhX9Gg5S', '2022-01-14 14:00:00');
        CreatePlaylistJob::dispatch('09e1I2sIgBpI3xJNx1dmpd', '2022-01-21 14:00:00');
        CreatePlaylistJob::dispatch('1ZrDQoW5mRGSrEfETakEjA', '2022-01-28 14:00:00');
        CreatePlaylistJob::dispatch('0TWMNycXgKCtJwLV5cvEfh', '2022-02-04 14:00:00');
        CreatePlaylistJob::dispatch('1YaMcWpx7OyMA3UG6lHMIM', '2022-02-11 14:00:00');
        CreatePlaylistJob::dispatch('6vftc2k63ked01qQLT5Whk', '2022-02-18 14:00:00');
        CreatePlaylistJob::dispatch('4J2AsRK4mVkTmOoEDxnZqD', '2022-03-04 14:00:00');
        CreatePlaylistJob::dispatch('0WmPNFz21cCdmLF6RTQW3q', '2022-03-11 14:00:00');
        CreatePlaylistJob::dispatch('6nvKZALHFTxRVoUnrhfc6p', '2022-03-18 14:00:00');
        CreatePlaylistJob::dispatch('4yYRiWwocsAeN6KrVmx46o', '2022-03-25 14:00:00');
        CreatePlaylistJob::dispatch('1uQnVhwdW0i3gCRkuSftjO', '2022-04-01 14:00:00');
        CreatePlaylistJob::dispatch('0UrWS5LS7rgeLep6kJRWXJ', '2022-04-08 14:00:00');
        CreatePlaylistJob::dispatch('1xjmA4MDqQajsUDNHUBSGT', '2022-04-14 14:00:00');
        CreatePlaylistJob::dispatch('3Y8epWSQxWeETojWu8Kr3m', '2022-04-22 14:00:00');
        CreatePlaylistJob::dispatch('308dUdiC1twHG42NEHDQcH', '2022-04-29 14:00:00');
        CreatePlaylistJob::dispatch('2hW4IgTUVuP4B3FDya6IIU', '2022-05-06 14:00:00');
        CreatePlaylistJob::dispatch('6I2DG7MAkj81hmFWq7pr3l', '2022-05-13 14:00:00');
        CreatePlaylistJob::dispatch('1vhubHU6VDEfovHSGzIknT', '2022-05-20 14:00:00');
        CreatePlaylistJob::dispatch('6oeBzsgZn8eUZW0aBOjbNg', '2022-05-27 14:00:00');
        CreatePlaylistJob::dispatch('6UXFHeHrVPyO1OOXFbESBk', '2022-06-01 14:00:00');
        CreatePlaylistJob::dispatch('0yLSxukkcdfKCk9IV2aicp', '2022-06-10 14:00:00');
        CreatePlaylistJob::dispatch('34bkcQo7Qu96YJAVQePT06', '2022-06-17 14:00:00');
        CreatePlaylistJob::dispatch('44ifrdqoHXI7vvEv51SAzb', '2022-06-24 14:00:00');
        CreatePlaylistJob::dispatch('3weWappIMuMvprT9Fesl6B', '2022-07-08 14:00:00');
        CreatePlaylistJob::dispatch('0ETFQ7WSdZk6ViW67By4ec', '2022-07-15 14:00:00');
        CreatePlaylistJob::dispatch('1gxkeqs8Yne2c2Z8ZTaqZO', '2022-07-22 14:00:00');
        CreatePlaylistJob::dispatch('6oJvlK3FUDbKPyttARaHce', '2022-07-29 14:00:00');
        CreatePlaylistJob::dispatch('7iu7XnacZPXqXIQAEvsIsl', '2022-08-05 14:00:00');
        CreatePlaylistJob::dispatch('67qdfXO8tgKEGhC2OBGHNt', '2022-08-12 14:00:00');
        CreatePlaylistJob::dispatch('6AHZtt4pDzJ1YUjG1uWAef', '2022-08-19 14:00:00');
        CreatePlaylistJob::dispatch('40sdGAG2arN6r9btTjlkYM', '2022-08-26 14:00:00');
        CreatePlaylistJob::dispatch('0Kp4clYRZR5LXKjMDkmeNQ', '2022-09-02 14:00:00');
    }
}
