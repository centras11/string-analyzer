# String Analyzer

Steps to run:
- install dependencies using composer `composer install`;
- run command `php public/index.php`;
- 4 parameters can be passed to command:
  * path to data file (`public/upload/sample.txt` used by default),
  * the environment to analyze - `text` or `line`,
  * what to count - `word` or `symbol`,
  * how to group results. Supported: `max`, `asc`.
- run `php bin/phpunit` to run tests;

About solution:
- provided text is split into sentences by environment;
- if analyzing `lines` only fully fitting into line sentences are analyzed;
- all analyzing sentences are saved to multidimensional array with count;
- view layer sorts results by custom logic and outputs; 

Some Todos left:
- throw custom exception if Class not exists; 
- some code miss tests;
- improve naming;