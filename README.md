About NFL-Scores
====================

NFL-Scores is a CLI program that allows you to see the scores of live NFL games, as well as the list of games of the day and the current weekly schedule.

## Requirements

```
PHP >= 7.1.3
```

## Installation

```
composer require "maxalmonte14/nfl-scores"
``` 

## How to use

### Getting all live games

```
php nfl-scores live
```

That will show you something like this.

```
BAL VS BUF @ M&T Bank Stadium
3rd quarter | 13:48 | BAL 1st & 10
+-----+----+----+---+---+----+----+
|     | 1  | 2  | 3 | 4 | OT | T  |
+-----+----+----+---+---+----+----+
| BAL | 14 | 12 | 0 | 0 | 0  | 26 |
| BUF | 0  | 0  | 0 | 0 | 0  | 0  |
+-----+----+----+---+---+----+----+


CLE VS PIT @ FirstEnergy Stadium
3rd quarter | 08:24 | PIT 1st & 10
+-----+---+---+---+---+----+----+
|     | 1 | 2 | 3 | 4 | OT | T  |
+-----+---+---+---+---+----+----+
| CLE | 0 | 0 | 7 | 0 | 0  | 7  |
| PIT | 0 | 7 | 7 | 0 | 0  | 14 |
+-----+---+---+---+---+----+----+
```

You can see the teams that are playing, at which stadium, the current quarter, the clock, the possession team, the current down, and the yards to go. Pretty good, ah?

### Getting your favorite team live game

You can get one specific live game just passing a parameter with your team abbreviation to the live command.

```
php nfl-scores live CLE
```

And now you have the Cleveland Browns game live on your terminal!

```
CLE VS PIT @ FirstEnergy Stadium
3rd quarter | 08:24 | PIT 1st & 10
+-----+---+---+---+---+----+----+
|     | 1 | 2 | 3 | 4 | OT | T  |
+-----+---+---+---+---+----+----+
| CLE | 0 | 0 | 7 | 0 | 0  | 7  |
| PIT | 0 | 7 | 7 | 0 | 0  | 14 |
+-----+---+---+---+---+----+----+
```

### Getting a list of today's games

If you want to see what teams are going to play today you can use the today command.

```
php nfl-scores today
```

That will show an output as the following.

```
BAL VS BUF @ M&T Bank Stadium
CLE VS PIT @ FirstEnergy Stadium
IND VS CIN @ Lucas Oil Stadium
MIA VS TEN @ Hard Rock Stadium
MIN VS SF @ U.S. Bank Stadium
NE VS HOU @ Gillette Stadium
NO VS TB @ Mercedes-Benz Superdome
NYG VS JAC @ MetLife Stadium
LAC VS KC @ ROKiT Field at StubHub Center
ARI VS WAS @ State Farm Stadium
CAR VS DAL @ Bank of America Stadium
DEN VS SEA @ Broncos Stadium at Mile High
GB VS CHI @ Lambeau Field
```

### Getting the games for this week

The week command will show the games for the current week.

```
php nfl-scores week
```
______________________________________________________

> **Note**: Remember a week in the NFL is composed by a Thursday, a Sunday and the Monday of next week.

The output will be similar to the following.

```
PHI VS ATL @ Lincoln Financial Field 09/06/2018
BAL VS BUF @ M&T Bank Stadium 09/09/2018
CLE VS PIT @ FirstEnergy Stadium 09/09/2018
IND VS CIN @ Lucas Oil Stadium 09/09/2018
MIA VS TEN @ Hard Rock Stadium 09/09/2018
MIN VS SF @ U.S. Bank Stadium 09/09/2018
NE VS HOU @ Gillette Stadium 09/09/2018
NO VS TB @ Mercedes-Benz Superdome 09/09/2018
NYG VS JAC @ MetLife Stadium 09/09/2018
LAC VS KC @ ROKiT Field at StubHub Center 09/09/2018
ARI VS WAS @ State Farm Stadium 09/09/2018
CAR VS DAL @ Bank of America Stadium 09/09/2018
DEN VS SEA @ Broncos Stadium at Mile High 09/09/2018
GB VS CHI @ Lambeau Field 09/09/2018
DET VS NYJ @ Ford Field 09/10/2018
OAK VS LA @ Oakland Coliseum 09/10/2018
```

## What this program cannot do

This program has its limitations, the NFL hasn't an open API to get precise data at any time you want, so I'm using an NFL Game Center JSON file which is updated every certain time to get the data that the CLI show.

For that reason this program cannot do the following things:

-Show information about games played before the current NFL week.
-Show player stats, because they're not contained in the JSON file.
-Show the hour that the games are going to be played, because that data is not contained in the JSON file.

## What this program doesn't do but could do!

There is a lot of things that I would love to add in future versions of this program, these are some of them:

- Show the output in a prettier way. Everybody loves nice things!
- Update the data in real time. For the moment anytime you run the live command the program will show you the score at that time, you need to run the command over and over again every time you want to see the updated data.
- Show notifications every time a team scores or the game is finished.

## What this program can improve

There is a lot of things that can be done to improve this program, there are a few of them:

- Refactor! Everything turns better when you refactor it.
- Add some Feature tests. Of course this program has a test suite, but I focused on the Unit tests, so adding some features test is a must-do task.
- Separate the HTTP client and data model logic. Yeah, another must-do task.
- Add caching. Why making a request when the response will be the same?
- Speed up. Everybody loves fast things.

## Contributing

Do you like this little app? Do you follow the PSR standards? It sounds good to me! Send me a PR.