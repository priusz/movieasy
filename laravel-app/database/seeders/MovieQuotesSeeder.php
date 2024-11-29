<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MovieQuotesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run() : void
    {
        $quotes = [
            ['quote' => 'A man\'s got to know his limitations.', 'said_by' => 'Harry Callahan, Magnum Force (1973)'],
            ['quote' => 'You make me want to be a better man.', 'said_by' => 'Melvin Udall, As Good as It Gets (1997)'],
            ['quote' => 'Here\'s looking at you, kid.', 'said_by' => 'Rick Blaine, Casablanca (1942)'],
            ['quote' => 'May the Force be with you.', 'said_by' => 'Star Wars (1977)'],
            ['quote' => 'I\'ll be back.', 'said_by' => 'The Terminator, The Terminator (1984)'],
            ['quote' => 'Keep your friends close, but your enemies closer.', 'said_by' => 'Michael Corleone, The Godfather Part II (1974)'],
            ['quote' => 'Say hello to my little friend!', 'said_by' => 'Tony Montana, Scarface (1983)'],
            ['quote' => 'I see dead people.', 'said_by' => 'Cole Sear, The Sixth Sense (1999)'],
            ['quote' => 'Why so serious?', 'said_by' => 'The Joker, The Dark Knight (2008)'],
            ['quote' => 'Carpe diem. Seize the day, boys.', 'said_by' => 'John Keating, Dead Poets Society (1989)'],
            ['quote' => 'I\'m the king of the world!', 'said_by' => 'Jack Dawson, Titanic (1997)'],
            ['quote' => 'You talking to me?', 'said_by' => 'Travis Bickle, Taxi Driver (1976)'],
            ['quote' => 'E.T. phone home.', 'said_by' => 'E.T., E.T. the Extra-Terrestrial (1982)'],
            ['quote' => 'Hasta la vista, baby.', 'said_by' => 'The Terminator, Terminator 2: Judgment Day (1991)'],
            ['quote' => 'To infinity and beyond!', 'said_by' => 'Buzz Lightyear, Toy Story (1995)'],
            ['quote' => 'I am Groot.', 'said_by' => 'Groot, Guardians of the Galaxy (2014)'],
            ['quote' => 'I drink your milkshake!', 'said_by' => 'Daniel Plainview, There Will Be Blood (2007)'],
            ['quote' => 'I\'ll have what she\'s having.', 'said_by' => 'Customer, When Harry Met Sally (1989)'],
            ['quote' => 'It\'s alive! It\'s alive!', 'said_by' => 'Henry Frankenstein, Frankenstein (1931)'],
            ['quote' => 'You can\'t handle the truth!', 'said_by' => 'Colonel Jessup, A Few Good Men (1992)'],
            ['quote' => 'I feel the need—the need for speed!', 'said_by' => 'Maverick, Top Gun (1986)'],
            ['quote' => 'I\'m just one stomach flu away from my goal weight.', 'said_by' => 'Emily Charlton, The Devil Wears Prada (2006)'],
            ['quote' => 'Every man dies, not every man really lives.', 'said_by' => 'William Wallace, Braveheart (1995)'],
            ['quote' => 'Houston, we have a problem.', 'said_by' => 'Jim Lovell, Apollo 13 (1995)'],
            ['quote' => 'There\'s no crying in baseball!', 'said_by' => 'Jimmy Dugan, A League of Their Own (1992)'],
            ['quote' => 'I\'m having an old friend for dinner.', 'said_by' => 'Hannibal Lecter, The Silence of the Lambs (1991)'],
            ['quote' => 'They call it a Royale with Cheese.', 'said_by' => 'Vincent Vega, Pulp Fiction (1994)'],
            ['quote' => 'Roads? Where we\'re going, we don\'t need roads.', 'said_by' => 'Dr. Emmett Brown, Back to the Future (1985)'],
            ['quote' => 'I am serious. And don\'t call me Shirley.', 'said_by' => 'Dr. Rumack, Airplane! (1980)'],
            ['quote' => 'You shall not pass!', 'said_by' => 'Gandalf, The Lord of the Rings: The Fellowship of the Ring (2001)'],
            ['quote' => 'Life is like a box of chocolates.', 'said_by' => 'Forrest Gump, Forrest Gump (1994)'],
            ['quote' => 'Frankly, my dear, I don\'t give a damn.', 'said_by' => 'Rhett Butler, Gone with the Wind (1939)'],
            ['quote' => 'I\'m walkin\' here!', 'said_by' => 'Ratso Rizzo, Midnight Cowboy (1969)'],
            ['quote' => 'Toto, I\'ve a feeling we\'re not in Kansas anymore.', 'said_by' => 'Dorothy Gale, The Wizard of Oz (1939)'],
            ['quote' => 'If you build it, he will come.', 'said_by' => 'Field of Dreams (1989)'],
            ['quote' => 'I see you.', 'said_by' => 'Jake Sully, Avatar (2009)'],
            ['quote' => 'It\'s not who I am underneath, but what I do that defines me.', 'said_by' => 'Batman, Batman Begins (2005)'],
            ['quote' => 'I have had it with these mother****ing snakes on this mother****ing plane!', 'said_by' => 'Neville Flynn, Snakes on a Plane (2006)'],
            ['quote' => 'What we do in life echoes in eternity.', 'said_by' => 'Maximus, Gladiator (2000)'],
            ['quote' => 'You\'ve got a friend in me.', 'said_by' => 'Toy Story (1995)'],
            ['quote' => 'I solemnly swear that I am up to no good.', 'said_by' => 'Harry Potter, Harry Potter and the Prisoner of Azkaban (2004)'],
            ['quote' => 'Winter is coming.', 'said_by' => 'Game of Thrones (2011)'],
            ['quote' => 'Do. Or do not. There is no try.', 'said_by' => 'Yoda, Star Wars: Episode V - The Empire Strikes Back (1980)'],
            ['quote' => 'Just keep swimming.', 'said_by' => 'Dory, Finding Nemo (2003)'],
            ['quote' => 'I volunteer as tribute!', 'said_by' => 'Katniss Everdeen, The Hunger Games (2012)'],
            ['quote' => 'My precious.', 'said_by' => 'Gollum, The Lord of the Rings: The Two Towers (2002)'],
            ['quote' => 'Here\'s Johnny!', 'said_by' => 'Jack Torrance, The Shining (1980)'],
            ['quote' => 'This is Sparta!', 'said_by' => 'King Leonidas, 300 (2006)'],
            ['quote' => 'It\'s just a flesh wound.', 'said_by' => 'The Black Knight, Monty Python and the Holy Grail (1975)'],
            ['quote' => 'I\'ll never let go, Jack.', 'said_by' => 'Rose DeWitt Bukater, Titanic (1997)'],
            ['quote' => 'It\'s clobberin\' time!', 'said_by' => 'Ben Grimm, Fantastic Four (2005)'],
            ['quote' => 'I know it was you, Fredo. You broke my heart.', 'said_by' => 'Michael Corleone, The Godfather Part II (1974)'],
            ['quote' => 'You’re gonna need a bigger boat.', 'said_by' => 'Martin Brody, Jaws (1975)'],
            ['quote' => 'I love the smell of napalm in the morning.', 'said_by' => 'Lt. Col. Bill Kilgore, Apocalypse Now (1979)'],
            ['quote' => 'I\'m too old for this.', 'said_by' => 'Roger Murtaugh, Lethal Weapon (1987)'],
            ['quote' => 'Wax on, wax off.', 'said_by' => 'Mr. Miyagi, The Karate Kid (1984)'],
            ['quote' => 'You had me at hello.', 'said_by' => 'Dorothy Boyd, Jerry Maguire (1996)'],
            ['quote' => 'I\'m the Dude, so that\'s what you call me.', 'said_by' => 'Jeffrey Lebowski, The Big Lebowski (1998)'],
            ['quote' => 'Good morning, Vietnam!', 'said_by' => 'Adrian Cronauer, Good Morning, Vietnam (1987)'],
            ['quote' => 'I ate his liver with some fava beans and a nice Chianti.', 'said_by' => 'Hannibal Lecter, The Silence of the Lambs (1991)'],
            ['quote' => 'The first rule of Fight Club is: You do not talk about Fight Club.', 'said_by' => 'Tyler Durden, Fight Club (1999)'],
            ['quote' => 'Elementary, my dear Watson.', 'said_by' => 'Sherlock Holmes, The Adventures of Sherlock Holmes (1939)'],
            ['quote' => 'To infinity and beyond!', 'said_by' => 'Buzz Lightyear, Toy Story (1995)'],
            ['quote' => 'Shaken, not stirred.', 'said_by' => 'James Bond, Goldfinger (1964)'],
            ['quote' => 'Chewie, we\'re home.', 'said_by' => 'Han Solo, Star Wars: The Force Awakens (2015)'],
            ['quote' => 'There\'s no place like home.', 'said_by' => 'Dorothy Gale, The Wizard of Oz (1939)'],
            ['quote' => 'All right, Mr. DeMille, I\'m ready for my close-up.', 'said_by' => 'Norma Desmond, Sunset Boulevard (1950)'],
            ['quote' => 'Forget it, Jake. It\'s Chinatown.', 'said_by' => 'Lawrence Walsh, Chinatown (1974)'],
            ['quote' => 'I am big! It\'s the pictures that got small.', 'said_by' => 'Norma Desmond, Sunset Boulevard (1950)'],
            ['quote' => 'Say “what” again. I dare you, I double dare you!', 'said_by' => 'Jules Winnfield, Pulp Fiction (1994)'],
            ['quote' => 'That\'ll do, pig. That\'ll do.', 'said_by' => 'Farmer Hoggett, Babe (1995)'],
            ['quote' => 'I\'m not bad. I\'m just drawn that way.', 'said_by' => 'Jessica Rabbit, Who Framed Roger Rabbit (1988)'],
            ['quote' => 'You complete me.', 'said_by' => 'Jerry Maguire, Jerry Maguire (1996)'],
            ['quote' => 'Why don’t you come up sometime and see me?', 'said_by' => 'Lady Lou, She Done Him Wrong (1933)'],
            ['quote' => 'I’m just a girl, standing in front of a boy, asking him to love her.', 'said_by' => 'Anna Scott, Notting Hill (1999)'],
            ['quote' => 'What a dump.', 'said_by' => 'Rosa Moline, Beyond the Forest (1949)'],
            ['quote' => 'You had me at hello.', 'said_by' => 'Dorothy Boyd, Jerry Maguire (1996)'],
            ['quote' => 'Here’s Johnny!', 'said_by' => 'Jack Torrance, The Shining (1980)'],
            ['quote' => 'Houston, we have a problem.', 'said_by' => 'Jim Lovell, Apollo 13 (1995)'],
            ['quote' => 'As if!', 'said_by' => 'Cher Horowitz, Clueless (1995)'],
            ['quote' => 'Say hello to my little friend!', 'said_by' => 'Tony Montana, Scarface (1983)'],
            ['quote' => 'I see dead people.', 'said_by' => 'Cole Sear, The Sixth Sense (1999)'],
            ['quote' => 'Keep your friends close, but your enemies closer.', 'said_by' => 'Michael Corleone, The Godfather Part II (1974)'],
            ['quote' => 'To infinity and beyond!', 'said_by' => 'Buzz Lightyear, Toy Story (1995)'],
            ['quote' => 'Yippee-ki-yay, mother******!', 'said_by' => 'John McClane, Die Hard (1988)'],
            ['quote' => 'I’ll have what she’s having.', 'said_by' => 'Customer, When Harry Met Sally (1989)'],
            ['quote' => 'Show me the money!', 'said_by' => 'Rod Tidwell, Jerry Maguire (1996)'],
            ['quote' => 'I am serious, and don’t call me Shirley.', 'said_by' => 'Dr. Rumack, Airplane! (1980)'],
            ['quote' => 'I’ll be back.', 'said_by' => 'The Terminator, The Terminator (1984)'],
            ['quote' => 'Hasta la vista, baby.', 'said_by' => 'The Terminator, Terminator 2: Judgment Day (1991)'],
            ['quote' => 'Mama says, stupid is as stupid does.', 'said_by' => 'Forrest Gump, Forrest Gump (1994)'],
            ['quote' => 'Elementary, my dear Watson.', 'said_by' => 'Sherlock Holmes, The Adventures of Sherlock Holmes (1939)'],
            ['quote' => 'You’re gonna need a bigger boat.', 'said_by' => 'Martin Brody, Jaws (1975)'],
            ['quote' => 'You had me at hello.', 'said_by' => 'Dorothy Boyd, Jerry Maguire (1996)'],
            ['quote' => 'I am Groot.', 'said_by' => 'Groot, Guardians of the Galaxy (2014)'],
            ['quote' => 'I feel the need—the need for speed!', 'said_by' => 'Maverick, Top Gun (1986)'],
            ['quote' => 'This is Sparta!', 'said_by' => 'King Leonidas, 300 (2006)'],
            ['quote' => 'My name is Bond. James Bond.', 'said_by' => 'James Bond, Casino Royale (2006)'],
            ['quote' => 'You shall not pass!', 'said_by' => 'Gandalf, The Lord of the Rings: The Fellowship of the Ring (2001)'],
        ];


        foreach ($quotes as $quote) {
            DB::statement('INSERT INTO movie_quotes (quote, said_by) VALUES (?, ?)', [$quote['quote'], $quote['said_by']]);
        }
    }
}
