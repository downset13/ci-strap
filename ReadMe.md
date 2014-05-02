# CI-Strap
***

![CI-Strap Login Screen](http://www.d13development.com/img/cistrap-1.jpg "Login Screen")

CI-Strap is an admin system keystone built using CodeIgniter(PHP) and styled with Twitter Bootstrap 3.
It's an excellent starting place for those looking to dive into a legacy (but highly useful) MVC Framework
built in PHP.  Using Bootstrap 3, the front-end is sleek, intuitive, and adheres to responsive design
principles.

## Preface: Why CodeIgniter?
***
I built CI-Strap out of necessity and hobby.  The servers that host my work are virtually closed off
from all access.  The sysadmins have an old version of PHP running on the servers along with
PHPMyAdmin.  I don't even have access to .htaccess files!  

Therefore, CodeIgniter became the easy choice.  There's virtually no overhead.  Drop in and
configure a few files, create a table or two, and you can build some lovely multi-page applications.
More importantly, unlike some of the newer and more popular frameworks, I don't need SSH access to
install.

I could go on.  It's easy to write pages defending the choice of language and framework, but it honestly
doesn't matter.  You choose a tool that's right for the job and delivers solid code in a timely manner.
If you're cool with using a framework that hasn't been updated in nearly a year on a language that the
hipsters hate, keep reading.

## Who is it for?
***
Building on the previous section, CI-Strap is for developers who want to build a website or webapp that
requires a beautifully responsive front-end and a secured back-end... in CodeIgniter.  If the preface 
didn't make it clear, there are newer, more powerful frameworks out there (such as Laravel).  CodeIgniter
is a great starting place though.  The learning curve is relatively low and PHP seems to be installed on
every server I've touched.

I also hope that it will be used as a learning resource.  My first foray into MVC's was inheriting a
complicated system (no documentation or comments) with absolutely no experience.  I added bits here and 
there and scoured documentation, but initially refrained from any large changes.  
If I had been supplied a less complex system, the ability to cause a meltdown would have been minimized.

## What can it be used for?
***
Ideally, any webapp that needs a secure login platform for user management.  I've tried to keep the build
as simple as possible.  There's a login page with account request and password reset forms.  Once logged
in, there's a pre-built user administration panel, system log, and account preferences page.  Everything
is wrapped up in a pretty Bootstrap shell.

I've found that many "start-here frameworks" built on other frameworks are a bit too large.  I'd drop them 
in and have to hack away at the core before starting to build on top.  That's why I've coined this project
a "keystone."  It's a simple little block with some odd angles that holds the whole thing together.
Hopefully it doesn't overstep its reach.

## Installation
***
1. Download, clone, fork, cork, wine, or dine (I kid) the repo. It's good practice in CI to elevate the files 
off of the root directory, so create a folder on your server and drop the CI-Strap files there.
2. Use cistrap-tables.sql to create the necessary tables, then delete the file. (Hint: You can run the SQL 
code directly in your preferred database admin system, as long as it's running MySQL.)
3. The tables created should have "cistrap_" as their prefix, assuming you didn't modify the script.  Change
the prefix to something less generic if you plan on having multiple installs of CI-Strap.
4. Finally, navigate into the application/config/ folder.
5. Open config.php in your favorite text-editor and update the 'base_url', 'admin_email', 'table_prefix', and 'encryption_key'
variables. (Read the config.php comments for instructions)
6. Open database.php in the same text-editor and update the 'hostname', 'username', 'password, and 'database'
variables. (Red the database.php comments for instructions)
7.  Success!  If you did this correctly, navigating to your CI-Strap directory in a browser will load
the login page.
*Note: This is a quick install.  If you need to change any other settings, please refer to the [CodeIgniter Documentation](http://ellislab.com/codeigniter/user-guide/)*

## Setup (IMPORTANT!)
***
If you were following along, the installation did not create any accounts for the system.  You will need to create
one to get started.

1. Fill-out and submit the "Request Access" form.
2. Hop into your database admin system and you'll find a row in the cistrap_users table.  That's you!
3. Edit the row by changing the "active" column to 'true' and the "group" to 'admin'.
4. Success!  You should now be able to login to your installation.  Go build something!

## Notes of interest (last updated 5.2.14)
***
As you may have noticed, CI-Strap does not use password_hash, since it requires PHP 5.5.0.  Again, this was out
of necessity due to server restrictions.  Instead, CI-Strap uses [passwordhash-ci](https://github.com/glenscott/passwordhash-ci).
which is a CI library of phpass (bcrypt).  If you have PHP >5.5.0 readily available, you can easily sub out the library by editing some
functions in the user_model.

## Created by
***
Christopher Klein
[d13development](http://www.d13development.com)

## Copyright and license
Code and documentation copyright 2014 d13development.  Code released under the [MIT license](http://opensource.org/licenses/MIT).


