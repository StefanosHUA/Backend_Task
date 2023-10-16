# Backend_Task
Directory of Companies API in Laravel - PostgreSQL

&nbsp;&nbsp;

Firstly, to run and test the project you have to have the following installed: 

&nbsp;
-PHP (Using version 8.2.11)

&nbsp;
-Composer (Using version 2.6.5)

&nbsp;
-Laravel (Using version 10.28.0)

&nbsp;
-PostgreSQL & PG Admin 

&nbsp;
-Postman (To test the API)

&nbsp;
Firstly, you need to connect the app to the Postgresql database. In order to achieve that, Create a new Database using PGAdmin, go to the .env file of the project and change the following to match the credentials 
of the database you created:
&nbsp;

DB_CONNECTION=pgsql
&nbsp;

DB_HOST=Your_Host_Name
&nbsp;

DB_PORT=Your_Port_Num
&nbsp;

DB_DATABASE=Your_DB_Name
&nbsp;

DB_USERNAME=Your_DB_Username
&nbsp;

DB_PASSWORD=Your_DB_Password
&nbsp;

Then, you need to cd to our project's directory, run the 'php artisan migrate' command in order for the DB Schema to be created. Now the DB Schema has been created successfully!
Afterwards, you need to populate the Database we just created via an HTML File. To achieve that, the ParseHtmlData Module has been created in the /app/console/commands directory of our project that implements the HTML parsing logic.
Additionally, a custom command has been created so that it can be run in the terminal when needed. 
&nbsp;

#More specifically and how it works
&nbsp;

Specifically, we have created the command "php artisan parse:htmlfile file:///C:/DirectoryToYourHTMLFile". When executed, the above command is recognized by the application through the ParseHtmlData module, as it has been declared using the $signature property.
Then, in the the ParseHtmlData module, using the file_get_contents function, the HTML file content is extracted and saved into a variable. After that, the variable (and the HTML file content) is parsed to a newly created crawler instance which will allow us to manipulate the file's data.
As our goal is to match the correct data between each data category of each company, we then use crawler to split the data into 3 categories essentially, in order to save it effectively:

&nbsp;
1)A Company Entity which is divided by a 'tr' tag in the html file.

&nbsp;
2)A Company Entity's data which is divided by a 'td' tag in the html file.

&nbsp;
3)Logo, a part of a company entity's data which is divided by an 'img' tag inside a 'td' tag.

&nbsp;
After all the above, a company instance is created and filled with data, so that each company attribute (name, company_id etc) is filled with its corresponding data from the html file, and then saved in the database.

&nbsp;
#So far so good but we still need to expose the saved data to an API. To achieve that goal, I have created / modified our project's /routes/api and Controllers file:

&nbsp;
Firstly, I have created a custom controllers file. There, a custom Controller (function) has been created to suit the functionality of each endpoint needed. 
Then, I have added the neccessary GET/POST/PUT/DELETE routes in the /routes/api file mentioned before. 

&nbsp;
#Each Controller's - Endpoint's functionality: 

&nbsp;
1) GET Companies (/companies url) => Maps the application to the GetFilteredData function in the  CompanyController which queries and returns all companies stored in the database. Filter criteria can be added to the query in order to return all companies based on a certain attribute (City, Country, Industry or Funding State)

&nbsp;
2) GET Companies By ID => Maps the application to the GetCompanyById function in the CompanyController which takes as input a parameter (company_id) inserted in the url and returns from the database the company that matches that parameter.

&nbsp;
3)POST Companies => Maps the application to the CreateEntry function in the CompanyController which 

&nbsp;
4)

&nbsp;
5)













