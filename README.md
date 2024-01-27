# marketplace-demo

Requirements : 

Docker & Docker compose installed.

   
Installation:

1- pull the repository

    git clone https://github.com/sinazahed/marketplace-demo.git

2- get in directory

    cd marketplace-demo

3 - run the instalation script :

    chmod +x install.sh
    
    ./install.sh



# Sending Email:

sending notification email in this project implemented by event listener.
for send the emails in production it is better to process that in backgound.
you can set the connection to (database , redis , ....) config the queue driver in .env file and add

    use Illuminate\Contracts\Queue\ShouldQueue;
    
and implenet ShouldQueue in event class

    implements implements ShouldQueue

then

    php artisan queue work

**too keep this process active in production , you need to use supervisor**
    
Important : For sending email set the smtp server configuration in .env file



# Notes:

 Postman collection is placed in the root of project.

 some fake users and media are inserted in database for testing but you can also register with api.

# Tests

    php artisan test

test covrage : 90%


 

 
