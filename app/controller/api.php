<?php

class Api extends Controller
{

    public function index(): void
    {
        echo 'No action provided for api';
    }

    /**
     * @param $params
     * @return void
     */
    public function addItem(string $item): void
    {
        if (!isset($_POST)) {
            http_response_code(404);
            echo 'addItem endpoint only has POST operation';
            return;
        }

        $result = $this->model->addItem(
            $item
        );

        if($result === true) {
            http_response_code(201);
            echo 'Item added successfully';
            return;
        }

        http_response_code(400);
        echo 'Item not added , issues:'.PHP_EOL;

        foreach ($result as $issue) {
            if($issue === 1) http_response_code(409);
        }
    }

}

