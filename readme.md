# traffic-api

Playground for rTraffic - API development

Code writing requirements.
---

Language of choice - PHP (>=5.6.x), Java (latest JRE)

Requirements -

    1. GitHub account -- tell Paul your account name to be added to the project
    2. Ensure that your installed PHP version matches the requirements.
    3. IDE of Choice - PHPStorm for PHP, Android Studio/Inteliij Idea. Install both, and set it up. You can get PHPStorm for free with your @northsouth.edu account
    4. Style guidelines:
        Function declarations:
            private function someFunction (Object $objectOne)
            {
                //content
            }
        Tabs or Space: Spaces, 4 equals one tab.
        Indentation: strict
        Object {Variable / Function / Class / Object} Naming - Universally camelCase
        Comment style - // for single line, /* ..*/ for multi line
        Attribution - Add your GitHub username to the @authors attribute at the beginning of file if you perform any modification
        Comment requirement - Variables -> Optional, Functions -> Mandatory
        
        Your commits will be verified by StyleCI to conform to these requirements.
        
    5. Code Coverage - Unit Testing -- but not at the first phase. We hope for 100% test coverage and eventual continuous integration / auto deploy.
    
    6. Deploy Environment - Will be provided by Paul for now
    
    
Current Tasks:

    1. Create GitHub account if you don't have one already, and notify Paul about your username.
    2. Setup a PHP compatible web server (XAMPP for those of you on Windows, try to get PHP 7.0 if you can. For Linux, nginx with php7-fpm works well)
    3. Setup your IDE -- I recommend watching https://laracasts.com/series/how-to-be-awesome-in-phpstorm/ to learn how to truly put the power of PHPStorm to use.
    4. Write your first hello world! script:
        <?php
            echo "Hello World!";
    5. Verify that you have a working PHP environment -- we need the mcrypt, mbstring, curl, mysql, pdo extensions for now. This is verifiable via:
        <?php
            phpinfo();
    4. Report to Paul for a crash course on introduction to the MVC paradigm and some primers on modern PHP.