<?php

use Phinx\Seed\AbstractSeed;

class AFriendSeeder extends AbstractSeed
{
    /**
     * Run Method.
     *
     * Write your database seeder using this method.
     *
     * More information on writing seeders is available here:
     * http://docs.phinx.org/en/latest/seeding.html
     */
    public function run()
    {
        $data = [
            [
                'id' => 'd7d91b7a-dc84-4e3a-8c83-2812eff5f06e',
                'name' => 'Rebecca Jones',
                'slug' => 'rebecca-jones',
                'description' => 'Words fail to describe the beautiful life and heart-tendering ministry of Rebecca Jones (1739-1818). When still a child, her eyes were opened to see the "ancient path" through the powerful preaching of Catherine Payton; and persevering in it all the days of her long and fruitful life, she was made a "vessel for honor, sanctified and useful to the Master, prepared for every good work." Her diary and letters are both endearing and instructive, telling the story of a meek disciple, a powerful preacher, a tireless minister, a loving "mother in Israel", and an shining example of innocence, love, humility, and faithfulness to the Lord Jesus Christ.',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'id' => '27dab8a2-e675-4058-9d08-c3e5736bc429',
                'name' => 'Samuel Fothergill',
                'slug' => 'samuel-fothergill',
                'description' => 'Samuel Fothergill (1715-1772) was the youngest son of eminent Quaker minister, John Fothergill. As a young man, Samuel yielded to various temptations, "giving way to the indulgence of his evil passions, and abandoning himself to the pursuit of folly and dissipation." So great was his rebellion against the Truth, that his father, upon embarking on a long trip to America, took leave of him with these words: "And now, son Samuel, farewell!—farewell!; and unless it be as a changed man, I cannot say that I have any wish ever to see you again." These words pierced Samuel\'s heart, and were used of the Lord as a means to turn him to the path of repentance and conversion. Feeling the terrors of the Lord for sin, Samuel was made willing to abide under His righteous judgments, and so yielded to the transforming power of divine grace that, in time, he became one of the most distinguished and influential ministers of his day. ',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ]
        ];

        $this->table('friends')->insert($data)->save();
    }
}
