Parser for BFMD (Broccoli flavored MarkDown: Create a parser that takes a given input and converts it to some output using some of the standard MarkDown components and some special flavor.
 ```php
 BFMD has the following components: 
 ● The paragraph behaviour is the same as in the normal MarkDown (Read up on it here) 
 ● [linked text](URL) that will be converted to <a href="URL">linked text</a> 
 ● # Some text that will be converted to <h1>Some text</h1> 
 ● ## Some text #2 that will be converted to <h2>Some text #2</h2> 
 ● ___EAT___ that will be converted to <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/0/03/Broccol i_and_cross_sec tion_edit.jpg/320px-Broccoli_and_cross_section_edit.jpg" title="Broccoli is yummy!" alt="A lovely picture of broccoli" />
 ```
 
 ##To Run this Project:
 1. Go to Project Directory
 2. Run ```sh runtest.sh``` from terminal
 3. Make sure PHP is setup and composer load all dependencies after perform step 2. 
    Note: Sometimes i fetched problem to setup composer and composer update by this command ```sudo apt install -y composer && composer update```
    So, if you fetch problem, please setup manually from terminal.                                                                                           
 4. After run Step 2 command, Some Environment will be setup and Show result of three task.
 4. Or you can do run manually by set up following dependencies:
 ```
    # Update Package Index
    sudo apt -y update
    
    #Install PHP
    apt install -y php
    
    # Run Command
    apt install -y composer
    
    # RUN composer update command from project root directory
    composer update
    
    # TO CHECK TEST ( Pass Argument from Terminal or Query String in URL)
    * 1 = ANAGRAM TEST
    * 2 = BFMD TEST
    * 3 = TDD NUMBER FACTORS TEST  
    -- Run this command Terminal
    php index.php ARGUMENT
    
    # We need to setup curl & apache2 or httpd
    apt install -y apache2 or apt -y install httpd
    systemctl start apache2 or systemctl start httpd.service
    -- From Terminal: curl http://localhost/Alam/index.php?task=1
    -- From browser: http://localhost/Alam/index.php?task=1
 ```
 
 
