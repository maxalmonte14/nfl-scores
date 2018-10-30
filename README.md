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
3rd Quarter | 13:48 | BAL 1st & 10
+-----+----+----+---+---+----+----+
|     | 1  | 2  | 3 | 4 | OT | T  |
+-----+----+----+---+---+----+----+
| BAL | 14 | 12 | 0 | 0 | 0  | 26 |
| BUF | 0  | 0  | 0 | 0 | 0  | 0  |
+-----+----+----+---+---+----+----+


CLE VS PIT @ FirstEnergy Stadium
3rd Quarter | 08:24 | PIT 1st & 10
+-----+---+---+---+---+----+----+
|     | 1 | 2 | 3 | 4 | OT | T  |
+-----+---+---+---+---+----+----+
| CLE | 0 | 0 | 7 | 0 | 0  | 7  |
| PIT | 0 | 7 | 7 | 0 | 0  | 14 |
+-----+---+---+---+---+----+----+
```

You can see the teams that are playing, at which stadium, the current quarter, the clock, the possession team, the current down, and the yards to go. Pretty good, ah?

### Getting your favorite team live game

You can get one specific live game just passing a parameter with your team abbreviation to the `live` command.

```
php nfl-scores live CLE
```

And now you have the Cleveland Browns game live on your terminal!

```
CLE VS PIT @ FirstEnergy Stadium
3rd Quarter | 08:24 | PIT 1st & 10
+-----+---+---+---+---+----+----+
|     | 1 | 2 | 3 | 4 | OT | T  |
+-----+---+---+---+---+----+----+
| CLE | 0 | 0 | 7 | 0 | 0  | 7  |
| PIT | 0 | 7 | 7 | 0 | 0  | 14 |
+-----+---+---+---+---+----+----+
```

### Getting a list of today's games

If you want to see what teams are going to play today you can use the `today` command.

```
php nfl-scores today
```

That will show an output as the following.

```
+------+---------+-------------------------------+------------+-------------+
| Home | Visitor | Stadium                       | Date       | Hour        |
+------+---------+-------------------------------+------------+-------------+
| ATL  | NO      | Mercedes-Benz Stadium         | 09/23/2018 | 13:00:00 ET |
| LA   | LAC     | Los Angeles Memorial Coliseum | 09/23/2018 | 16:05:00 ET |
| ARI  | CHI     | State Farm Stadium            | 09/23/2018 | 16:25:00 ET |
| SEA  | DAL     | CenturyLink Field             | 09/23/2018 | 16:25:00 ET |
| DET  | NE      | Ford Field                    | 09/23/2018 | 20:20:00 ET |
| BAL  | DEN     | M&T Bank Stadium              | 09/23/2018 | 13:00:00 ET |
| CAR  | CIN     | Bank of America Stadium       | 09/23/2018 | 13:00:00 ET |
| HOU  | NYG     | NRG Stadium                   | 09/23/2018 | 13:00:00 ET |
| JAX  | TEN     | TIAA Bank Field               | 09/23/2018 | 13:00:00 ET |
| KC   | SF      | Arrowhead Stadium             | 09/23/2018 | 13:00:00 ET |
| MIA  | OAK     | Hard Rock Stadium             | 09/23/2018 | 13:00:00 ET |
| MIN  | BUF     | U.S. Bank Stadium             | 09/23/2018 | 13:00:00 ET |
| PHI  | IND     | Lincoln Financial Field       | 09/23/2018 | 13:00:00 ET |
| WAS  | GB      | FedExField                    | 09/23/2018 | 13:00:00 ET |
+------+---------+-------------------------------+------------+-------------+

```

### Getting today's finished games

The `live` command won't show you the finished games, so, if want to know the final results of a game you should use the `finished` command.

```
php nfl-scores finished
```

The output will be like the following:

```
PHI VS ATL @ Lincoln Financial Field
+-----+---+---+---+---+----+----+
|     | 1 | 2 | 3 | 4 | OT | T  |
+-----+---+---+---+---+----+----+
| PHI | 0 | 3 | 7 | 8 | 0  | 18 |
| ATL | 3 | 3 | 0 | 6 | 0  | 12 |
+-----+---+---+---+---+----+----+

BAL VS BUF @ M&T Bank Stadium
+-----+----+----+----+---+----+----+
|     | 1  | 2  | 3  | 4 | OT | T  |
+-----+----+----+----+---+----+----+
| BAL | 14 | 12 | 14 | 8 | 0  | 47 |
| BUF | 0  | 0  | 3  | 0 | 0  | 3  |
+-----+----+----+----+---+----+----+
```

You can also get one specific game passing a parameter to the `finished` command.

```
php nfl-scores finished PHI
```

The output will be like the following:

```
PHI VS ATL @ Lincoln Financial Field
+-----+---+---+---+---+----+----+
|     | 1 | 2 | 3 | 4 | OT | T  |
+-----+---+---+---+---+----+----+
| PHI | 0 | 3 | 7 | 8 | 0  | 18 |
| ATL | 3 | 3 | 0 | 6 | 0  | 12 |
+-----+---+---+---+---+----+----+
```

### Getting the games for this week

The `week` command will show the games for the current week.

```
php nfl-scores week
```

> **Note**: Remember, a week in the NFL is composed by a Thursday, a Sunday and the Monday of next week.

The output will be similar to the following.

```
+------+---------+-------------------------------+------------+-------------+
| Home | Visitor | Stadium                       | Date       | Hour        |
+------+---------+-------------------------------+------------+-------------+
| ATL  | NO      | Mercedes-Benz Stadium         | 09/23/2018 | 13:00:00 ET |
| LA   | LAC     | Los Angeles Memorial Coliseum | 09/23/2018 | 16:05:00 ET |
| ARI  | CHI     | State Farm Stadium            | 09/23/2018 | 16:25:00 ET |
| SEA  | DAL     | CenturyLink Field             | 09/23/2018 | 16:25:00 ET |
| DET  | NE      | Ford Field                    | 09/23/2018 | 20:20:00 ET |
| BAL  | DEN     | M&T Bank Stadium              | 09/23/2018 | 13:00:00 ET |
| CAR  | CIN     | Bank of America Stadium       | 09/23/2018 | 13:00:00 ET |
| HOU  | NYG     | NRG Stadium                   | 09/23/2018 | 13:00:00 ET |
| JAX  | TEN     | TIAA Bank Field               | 09/23/2018 | 13:00:00 ET |
| KC   | SF      | Arrowhead Stadium             | 09/23/2018 | 13:00:00 ET |
| MIA  | OAK     | Hard Rock Stadium             | 09/23/2018 | 13:00:00 ET |
| MIN  | BUF     | U.S. Bank Stadium             | 09/23/2018 | 13:00:00 ET |
| PHI  | IND     | Lincoln Financial Field       | 09/23/2018 | 13:00:00 ET |
| WAS  | GB      | FedExField                    | 09/23/2018 | 13:00:00 ET |
| TB   | PIT     | Raymond James Stadium         | 09/24/2018 | 20:15:00 ET |
| CLE  | NYJ     | FirstEnergy Stadium           | 09/20/2018 | 20:20:00 ET |
+------+---------+-------------------------------+------------+-------------+

```

## What this program cannot do

This program has its limitations, the NFL hasn't an open API to get precise data at any time you want, so I'm using an NFL Game Center JSON file which is updated every certain time to get the data that the CLI show.

For that reason this program cannot do the following things:

- Show information about games played before the current NFL week.
- Show player stats, because they're not contained in the JSON file.

## What this program doesn't do but could do!

There is a lot of things that I would love to add in future versions of this program, these are some of them:

- Show the output in a prettier way. Everybody loves nice things!
- Update the data in real time. For the moment anytime you run the live command the program will show you the score at that time, you need to run the command over and over again every time you want to see the updated data.
- Show notifications every time a team scores or the game is finished.

## What this program can improve

There is a lot of things that can be done to improve this program, there are a few of them:

- Refactor! Everything turns better when you refactor it.
- Add some Feature tests. Of course this program has a test suite, but I focused on the Unit tests, so adding some features test is a must-do task.
- Speed up. Everybody loves fast things.

## Contributing

Do you like this little app? Do you follow the PSR standards? It sounds good to me! Send me a PR, and don't forget to add some tests.