# Changia Platform
## About Changia Platform

This is a project based on a challenge 'Beemathon' by [Beem Africa](https://beem.africa)

This is a platform that will enable Organizations, Communities, Companies, Government or Individuals to entreat for money from the community and let the community keep track of what they are contributing. The key advantage of this platform is to give Transparency to contributors.

## How It Works
* A person (client) creates an account within the platform
* The client creates a new need for contribution (Entreaty) and publishes it to the public
  
  (If the entreaty is private, the client should send the link to target individuals)
* Individuals interested in contributing will visit the site and see details of the need/entreaty
 and if convinced, they will have two options for contribution: (Online or through USSD menu)
* Whenever individuals contribute, the system will be keeping track of the collections: Target, Collected and Remaining
* If a target was specified (or if deadline reached) the contribution window will be closed and (if configured) the contributed 
money will be disbursed to the client's wallet.
  
#### Additionally:
* The platform sends Confirmation SMS to individuals who contribute.


## APIs Used
* SMS 
* PAYMENT COLLECTION
* PAYMENT CHECKOUT
* DISBURSEMENT

## Deployment Process
 The App is developed using Laravel 8 and Bootstrap 4.
 Demployment is simply as follows:
* Clone this repo
* Enter your configurations in the ```.env``` file
* Run ```composer install```
* Run ```npm install```
* Run ```php artisan migrate --seed```
* Run ```npm run prod```


## Demo
Live demo is available [ https://changia.ringlesoft.com ](Here)

## Team
* David J. Ringo _(Ringle)_
