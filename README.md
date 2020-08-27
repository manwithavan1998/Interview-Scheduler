# Interview-Scheduler
This is a project where the admin can schedule an interview with an interviewer and an interviewee.
If at the time of scheduling an interview, any of the participants are not available , then the page will re-direct to an error page.
You can see the total interview list by clicking on the interview list tab on the navigation bar.



Things that can be implemented differently :
* Multiple interviewees can be an option for an interview.
* In place of interviewer id, name and description could be used.
* Interview List could be represented using table.

Steps to run the project :
* install xampp in your system and start apache and sql from there.
* make a directory with name 'your_project_name' in C:\xampp\htdocs
* download all the files here and add them to your project folder
* then import the interview.sql databse in your databse by opening phpmyadmin.
* then simply use apache2 web server to run the project on localhost as localhost/your_project_name/home2.php
