RestAPI_Slim - Readme
=============================

Version 1.0.0

RESTful application based on Slim PHP framework with token authentication and SQLite database.

Copyright
---------

Copyright (C) 2017
    Felipe Morcelli <felipemorcelli@gmail.com>


License
-------

This program is free software; you can redistribute it and/or modify it under the terms of the GNU General Public License version 2, as published by the Free Software Foundation. This program is distributed in the hope that it will be useful, but WITHOUT ANY WARRANTY; without even the implied warranty of MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the GNU General Public License for more details. You should have received a copy of the GNU General Public License
along with this program.  If not, see <http://www.gnu.org/licenses/>.


Requirements
------------

* PHP 5.3 or later
* SQLite3
* A web-browser and tools for API testing like Postman or cUrl

Documentation on how to install each one of those requirements can be found in:

- http://php.net/manual/en/install.php
- https://www.tutorialspoint.com/sqlite/sqlite_installation.htm

This application also needs the latest version of Slim framework. However, it's latest version is already installed and configured in this package. Newer releases are not required for this application.


Installation and Configuration
-------------------------------

- Download the files from github
- Uncomment line 24 from the file validate.php to check your access token on the first access the app
- Save it and comment the line once again
- Test get methods using your browser and the other methods with Postman or cUrl
- Instruction can be seen accessing http://[yoururl]/restapi/ for the first time


More Information
----------------

Please see the SPECS files in the application root folder.

Enjoy!

PS: Feel free to ask any questions about this application at felipemorcelli@gmail.com. You can also send your questions to the appropriate mailing lists / forums if needed.
