TwitchBot 
===

TwitchBot is an IRC bot fork from [OUTRAGEbot](https://github.com/Westie/OUTRAGEbot)

TwitchBot is PHP written IRC bot that connects to twitch, with your provided account and oauth token.  
Currently TwitchBot has one *script* `TwitchLogger`, which tracks what commands people use from `#twitchplayspokemon` (or [TwitchPlaysPokemon on Twitch.tv](http://twitch.tv/twitchplayspokemon) repectively). 

###In production
TwitchBot is still being developed semi-actively, I've a few plans for it, it still needs to be properly documented, should be configured from its respective Configuration and in general a few variable names should meet the rest of the bots standards.

###shell folder
The shell folder are just some scripts that will help you move the files around, they're not required but you might find use in them.

They were originally written by me, but improved on by [FiXato](http://github.com/FiXato).

###Installation
There are (for now) a few things that you'll need to manually configure.

In [Socket.php](https://github.com/Zarthus/TwitchBot/blob/master/src/System/Core/Socket.php#L74) you'll need to manually replace `your_oauth_token` in `$this->Output("PASS :oauth:your_oauth_token")` with your twitch oauth token. Generate one [here](http://twitchapps.com/tmi/).

In [OUTRAGEbot.ini](https://github.com/Zarthus/TwitchBot/blob/master/src/Configuration/OUTRAGEbot.ini#L58-L60) you will need to go to `your_twitchtv_name` and replace `your_twitchtv_name` with your actual username or bot name.
