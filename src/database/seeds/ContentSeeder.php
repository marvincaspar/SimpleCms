<?php

namespace Mc388\SimpleCms\Database\Seeds;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Mc388\SimpleCms\App\Models\Content;

/**
 * Class ContentSeeder
 */
class ContentSeeder extends Seeder
{

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('contents')->delete();

        $root1 = Content::create(
            [
                'title' => 'Home',
                'nav_title' => 'Home',
                'banner' => 'media/home.jpg',
                'body' => 'The issue of your cores will listen wisely when you love that peace is the ego.',
                'user_id' => 1,
                'order' => 1,
                'type' => 'site'
            ]
        );

        $site1 = [
            [
                'title' => '',
                'nav_title' => 'Home',
                'banner' => 'media/home.jpg',
                'body' => '',
                'user_id' => 1,
                'order' => 1,
                'type' => 'link',
                'link_to_content_id' => $root1->id,
                'children' => [
                    [
                        'title' => 'Site 1.1.0',
                        'nav_title' => 'Site 1.1.0',
                        'body' => 'The creator has meditation, but not everyone absorbs it.',
                        'user_id' => 1,
                        'order' => 1,
                        'type' => 'site',
                        'children' => [
                            [
                                'title' => 'Site 1.1.2',
                                'nav_title' => 'Site 1.1.2',
                                'body' => 'The creator has meditation, but not everyone absorbs it.',
                                'user_id' => 1,
                                'order' => 1,
                                'type' => 'site'
                            ]
                        ]
                    ],
                    [
                        'title' => 'Site 1.2.0',
                        'nav_title' => 'Site 1.2.0',
                        'banner' => '',
                        'body' => 'One must remember the follower in order to hear the aspect of sincere harmony.',
                        'user_id' => 1,
                        'order' => 1,
                        'type' => 'site'
                    ],
                    [
                        'title' => 'Site 1.3.0',
                        'nav_title' => 'Site 1.3.0',
                        'banner' => '',
                        'body' => 'Everything we do is connected with purpose: grace, heaven, satori, mind.',
                        'user_id' => 1,
                        'order' => 1,
                        'type' => 'site'
                    ]
                ]
            ],
            [
                'title' => 'Site 2',
                'nav_title' => 'Site 2',
                'banner' => '',
                'body' => 'The saint has advice, but not everyone absorbs it.',
                'user_id' => 1,
                'order' => 1,
                'type' => 'site'
            ],
            [
                'title' => 'Site 3',
                'nav_title' => 'Site 3',
                'banner' => '',
                'body' => 'Moonlight is the only resurrection, the only guarantee of fear.',
                'user_id' => 1,
                'order' => 1,
                'type' => 'site'
            ],
            [
                'title' => 'Impressum',
                'nav_title' => 'Impressum',
                'body' => '<p>Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren, no sea takimata sanctus est Lorem ipsum dolor sit amet. Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren, no sea takimata sanctus est Lorem ipsum dolor sit amet. Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren, no sea takimata sanctus est Lorem ipsum dolor sit amet.</p><p>Duis autem vel eum iriure dolor in hendrerit in vulputate velit esse molestie consequat, vel illum dolore eu feugiat nulla facilisis at vero eros et accumsan et iusto odio dignissim qui blandit praesent luptatum zzril delenit augue duis dolore te feugait nulla facilisi. Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat.</p><p>Ut wisi enim ad minim veniam, quis nostrud exerci tation ullamcorper suscipit lobortis nisl ut aliquip ex ea commodo consequat. Duis autem vel eum iriure dolor in hendrerit in vulputate velit esse molestie consequat, vel illum dolore eu feugiat nulla facilisis at vero eros et accumsan et iusto odio dignissim qui blandit praesent luptatum zzril delenit augue duis dolore te feugait nulla facilisi.</p>',
                'user_id' => 1,
                'order' => 1,
                'type' => 'global'
            ],
            [
                'title' => 'AGB',
                'nav_title' => 'AGB',
                'body' => '<p>Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren, no sea takimata sanctus est Lorem ipsum dolor sit amet. Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren, no sea takimata sanctus est Lorem ipsum dolor sit amet. Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren, no sea takimata sanctus est Lorem ipsum dolor sit amet.</p><p>Duis autem vel eum iriure dolor in hendrerit in vulputate velit esse molestie consequat, vel illum dolore eu feugiat nulla facilisis at vero eros et accumsan et iusto odio dignissim qui blandit praesent luptatum zzril delenit augue duis dolore te feugait nulla facilisi. Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat.</p><p>Ut wisi enim ad minim veniam, quis nostrud exerci tation ullamcorper suscipit lobortis nisl ut aliquip ex ea commodo consequat. Duis autem vel eum iriure dolor in hendrerit in vulputate velit esse molestie consequat, vel illum dolore eu feugiat nulla facilisis at vero eros et accumsan et iusto odio dignissim qui blandit praesent luptatum zzril delenit augue duis dolore te feugait nulla facilisi.</p>',
                'user_id' => 1,
                'order' => 1,
                'type' => 'global'
            ]
        ];

        $root1->makeTree($site1);
    }
}
