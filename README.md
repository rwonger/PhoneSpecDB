
# PhoneSpecDB

![image](https://github.com/rwonger/PhoneSpecDB/assets/89073648/f0e4e879-38a6-406b-abd2-4ca706a74aa6)


PhoneSpecDB is a web-based Oracle DB interface that allows users to compare differences between phone specifications, phone manufacturers, and phone accessories. Users can select specific phones to compare to each other, view helpful statistics about manufactures and phones, and filter through the data in different ways. Overall, this project was a means to further understand and explore SQL, PHP, and the OracleSQL database.

Developed by Morgan Dean, Ricky Wong, and Mike Zhang

## Project Organization

### SQL Files
* Put SQL files in `public_html/sql` to be accessed by php functions for most queries. This makes it easy to change an sql query without having to deal with php.
* This will not work for most update or delete calls, but will work well for selects.

### PHP Files
* Put PHP files in `public_html` to be accessed on the web.
* The `public_html/.sample.env` file should be used to create a `.env` file for storing your oracle database username and password. The `.env` file will not be commited to git and will automatically load your credentials in `db_lib.php`
* `public_html/db_lib.php` contains all oracle db utitlity functions and can be easily required like so: `<?php require __DIR__ . "/db_lib.php";?>`

### Misc. Files
* `public_html/.htaccess` makes sure that your `.env` file and `sql/` directory are not exposed to the internet.
* `Milestone Submissions` contains the PDF files for all group milestone submissions.

# Publishing
To publish your changes to your php server, you can copy `public_html` into your own `public_html` directory.

Here is an example command that removes the old public_html and replaces it with the directory in this repository.
```bash
rm -r ~/public_html && cp -r public_html ~/public_html
```
