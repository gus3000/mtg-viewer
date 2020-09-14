# Mtg viewer

This projects fetches data from the [scryfall API](https://scryfall.com/docs/api) (and in the future from [mtgtop8](https://mtgtop8.com/)) and aims to give tools to search and rank cards based on their historical performance.

Inspiration : [Nizzahon Magic](https://www.youtube.com/channel/UCkfWtgQSg3yp7vmIj3Z5W0A) 

This project is developped using Symfony 5.1 and uses Doctrine heavily.

To initialize the database, you need to download cards on this [Scryfall page](https://scryfall.com/docs/api/bulk-data), and rename the imported file in `ImportCards.php`.

## Roadmap
For now, only the basic import commands are implemented.
### TODO
 - add the competitive aspect to the schema
 - make a smart and respectful mtgtop8 crawler
 - add a viewer and a search engine
### DONE
 - add cards and basic properties (color, card faces, sets...) to the database
 - add commands to import cards automatically
 
