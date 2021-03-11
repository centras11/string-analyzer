# Commission task 

Steps to run:
- install dependencies using composer `composer install`;
- run command `php public/index.php` to count commission;
- put your custom data file `public/upload` folder and add file name then running command `php public/index.php filename.csv`. If file is not provided - script will use default `sample.csv`;
- run `php bin/phpunit` to run tests;

About solution:
- for each data row we calculate key for easy search - `userId + year + week number`;
- extra logic was added for counting year, because of ISO standards first and last weeks can overlap between years: https://en.wikipedia.org/wiki/ISO_week_date#First_week;
- the rule for counting commissions is selected based on row parameters;
- every commission counting case has own logic on `Rule` folder, extending `RuleInterface`;

Some Todos left:
- throw custom exception in Converter if not supported currency supplied; 
- getting currency rates mocked for simplicity - should be added any client which do curl to external API;