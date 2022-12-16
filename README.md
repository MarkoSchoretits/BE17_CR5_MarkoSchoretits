# BE17_CR5_MarkoSchoretits
5th Code Review @ CodeFactory

This Project has been created as a solution to the 3rd Code Review on Backend Web Development @ CodeFactory Vienna in 2022. 
As usual I provided 120%, which was computed as 100% acomplished. 
The task had been definend as follows:

CodeReview 5
Good Morning Students!

Welcome to your 5th Code Review. 

You will need to achieve more than 60 points to pass this Code Review successfully. 

You will be graded according to the results achieved. Please see the number of points for each task below. 

The grading system has the following rules:

Up to 60 points = red

Between 61 and 79 = yellow

Over 80 = green

You can submit your solution (as GitHub project link) until Saturday at 18:00:00.


Project description: “Adopt a Pet”
You love animals and think it is time to adopt one. You like all sorts of animals: small animals, large animals, you may like reptiles and birds and may be open to adopting animals of any age. 

Let's then create an animal adoption platform to connect users (people interested in adopting pets) and animals (pets interested in being adopted). 

All users must introduce their first_name and last_name, email, phone_number, address, picture and password in order to register on the platform.

All animals must have a name, a photo and live at a specific location(a single line like “Praterstrasse 23” is enough). They also have a description, size, age, vaccinated, must belong to a breed and have a status "Adopted" or "Available"(this last one used only for bonus points).

For the regular points of this CodeReview, you need to create a structure using PHP and MySQL (apart from HTML, CSS, JS, etc) that will display all data from the animals.

 

Project Naming:

Create a GitHub Repository named: BE17_CR5_YourName. Push the files into it and send the link through the learning management system (LMS). Set your repository to private. Add codefactorygit as a collaborator. See an example of a GitHub link below:

https://github.com/JohnDoe/repositoryname.git.

Your MySQL database MUST be named: BE17_CR5_animal_adoption_yourname

For this CodeReview, the following criteria will be graded:

 
(5) Create a database (BE17_CR5_animal_adoption_yourname) initially with 2 tables: user and animal. Add sufficient test data in the animal table: at least 10 records in total between small animals and large animals. Remember that animals have their age so make sure there are at least 4 senior animals in the DB (older than 8 years old).

(20) Display all animals on a single web page (home.php). Make sure a nice GUI is presented here (only backenders exempt)

(15) There should be a link on the navbar "Senior" that will display all senior animals (animals older than 8 years old). Here you can decide whether to create a filter on the home page ($GET method) and reorganize the result from the query or create a new page senior.php and the link should lead to it.

(15) Create a show more/show details button that will lead to a new page (details.php) with only the information from that specific record/animal.

(15) Create a registration and login system for the user. The user should be able to see at least their email and picture when logged in.

Create separate sessions for normal users and administrators.

(15)Normal Users:

They will be able ONLY to see(read) and access all data. No action buttons (create, edit or delete) should be available for the animals (CRUD)

(15) Admin:

Only the admin is able to create, update and delete data about animals (CRUD) within the admin panel, therefore an Admin Panel/Dashboard  should be created. Normal users MUST NOT access this page if they try.

Bonus points
(20)Pet Adoption

In order to accomplish this task, a new table pet_adoption will need to be created. This table should hold the user_id and the pet_id (as foreign keys) plus other information that you may think is relevant i.e: adoption_date. 

Each Pet information/card should have a button "Take me home" that, when clicked, will "adopt" the pet. When it does, a new record should be created in the table pet_adoption.

Hint: if you use the POST method to create the adoption, you will need a form. Get method won't need it. 

You can expand on it using the status column for a filter and only show the pet to be adopted ("available") according to their status. Not required though.


Note: Don’t forget to upload your php code together with your database .sql file to the GitHub repository. Please organize your project content (files) into folders according to its type.


Submission status
Submission status	Submitted for grading
Grading status	Graded
Due date	Saturday, 19 November 2022, 6:00 PM
Time remaining	Assignment was submitted 3 hours 28 mins early
Last modified	Saturday, 19 November 2022, 2:32 PM
Online text	
(41 words)
https://github.com/MarkoSchoretits/BE17_CR5_MarkoSchoretits

All functions, including extras and one nice-to-have: created, tested and ...

Feedback
Grade	100.00 / 100.00
Graded on	Wednesday, 23 November 2022, 3:17 PM
Graded by	Picture of Manuel WidnerManuel Widner
Feedback comments	
Hi Markus,
good codereview, you accomplished all the tasks.
Overall the design could be a bit more user friendly otherwise great work.
For the adoptions you can try to check if the animal id is already in the adoption table and if so inform the user or remove the adopt button once adopted.

Well done, keep up the good work.
