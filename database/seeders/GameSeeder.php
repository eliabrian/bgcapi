<?php

namespace Database\Seeders;

use App\Models\Difficulty;
use App\Models\Game;
use App\Models\Tag;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class GameSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $game = [
            'name' => 'Rummikub',
            'difficulty' => 'Easy',
            'tag' => 'Economic',
            'player_min' => 2,
            'player_max' => 4,
            'age' => 8,
            'duration' => 60,
            'summary' => "Rummikub is similar to several central European card games which are played with two decks of playing cards, including Machiavelli and Vatikan. Ephraim Hertzano invented the tile game Rummikub in the 1940s when card-playing was outlawed under the Communist regime. After World War II, Hertzano immigrated to British Mandate of Palestine (now Israel) and developed the first sets with his family. Over the years, the Hertzano family licensed it to other countries and Rummikub became Israel's best-selling export game.",
            'description' => "Hertzano's Official Rummikub Book, published in 1978, describes three different versions of the game: American, Sabra, and International. Modern Rummikub sets include only the Sabra version rules, with no mention of the others, and there are variations in the rules between publishers. In Turkey, the game is known as Okey and is widely played by families at gatherings or at local cafes. Like Rummy that you play with cards, you try to get rid of all your tiles by forming numbers into runs of 3 tiles or more, or 3 to 4 of a kind. The colors of the numbers on the tiles are like card suits. This game may start rather uneventfully, but when the players start putting more and more tiles in play, the options for your upcoming turns can become more complex, challenging, and exciting (from areyougame.com)."
        ];

        Game::create([
            'name' => $game['name'],
            'slug' => Str::slug($game['name']),
            'difficulty_id' => Difficulty::where('name', 'like', '%' . $game['difficulty'] . '%')->first()->id,
            'tag_id' => Tag::where('name', 'like', '%' . $game['tag'] . '%')->first()->id,
            'player_min' => $game['player_min'],
            'player_max' => $game['player_max'],
            'age' => $game['age'],
            'duration' => $game['duration'],
            'summary' => $game['summary'],
            'description' => $game['description'],
        ]);
    }
}
