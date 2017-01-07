# malicious-php-injection-removal

This is a Php malicious injection codes removal guide & script for beginner programmers, wordpress users & php hobbyists

## Problem

Linux server have strange looking base64 encoded codes in php files. Seems that the server is compromised. 

Generally, the malicious php code injections are variations of the PHP/Agent.GC - trojan: http://www.virusradar.com/en/PHP_Agent.GC/description 

Used for sending brute force admin login requests to other cpanels and wordpresses from your infected server. 

## Solution

1- Start with getting all subfolders in the infected main directory.

(You can run "find . -type d > subdirectories.txt" at linux command line, convert the output text in to comma separeted array.)

2- Then paste these sub directories in the $subfolders array.

3- Open a malicious code contained file. 

Copy its beginning and ending to the injectedCodeBeginning and injectedCodeEnding variables. 

4- After you finish with editing this script, run it from your server via sudo access. 

(for example in the linux command line - try putty if you don't have any idea how to - "php5 /var/www/pathtothescript/viruscleaner.php")

### Notes 
You should start <?php and finish with ?> for exact removal. 

If you can't open the files via your text editor because of your OS virus program, 

use putty to remote connect your server and type "nano absolutepathtofile/viruscleaner.php" to open it via linux nano text editor. 

Mouse left click selection copies the highlighted. 
