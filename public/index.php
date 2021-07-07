<?php

/*
|--------------------------------------------------------------------------
| Create The Application
|--------------------------------------------------------------------------
|
| First we need to get an application instance. This creates an instance
| of the application / container and bootstraps the application so it
| is ready to receive HTTP / Console requests from the environment.
|
*/

$app = require __DIR__.'/../bootstrap/app.php';

/*
|--------------------------------------------------------------------------
| Run The Application
|--------------------------------------------------------------------------
|
| Once we have the application, we can handle the incoming request
| through the kernel, and send the associated response back to
| the client's browser allowing them to enjoy the creative
| and wonderful application we have prepared for them.
|



    private function sortPublishers():array
    {
        $result = [];
        $banned = [];
        $updated = [];
        
        $yesterday = new \DateTime(Application::TTL);
        $publishers = $this->repository->findAll();
        foreach ($publishers as $publisher) {
            if ($publisher->getDeletedAt() > $yesterday) {
                $banned[$publisher->getId()] = $publisher->getApplicationsSorted()->getIterator();
                foreach($banned[$publisher->getId()] as $application) {
                    if ($application->getDeletedAt() > $yesterday) {
                        $result[$publisher->getId()] = $result[$application->getId()];
                    }
                }
            }
        }
        arsort($banned);

        return $result;
    }




*/

$app->run();
