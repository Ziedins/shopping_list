<?php

class Api extends Controller
{

    public function index(): void
    {
        echo 'No action provided for api';
    }

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

    public function getItem(string $name): array
    {
        $item = $this->model->getItem($name);

        if(!$item) {
            http_response_code(404);
            echo 'Item not found';
            return [];
        } else {
            http_response_code(200);
            return $item;
        }
    }

    public function deleteItem(string $name): void
    {
        $result = $this->model->deleteItem($name);

        if(!$result) {
            http_response_code(404);
            echo 'Item not found';
        } else {
            http_response_code(200);
            echo 'Item deleted';
        }
    }

    public function updateItem(string $name, int $checked): void
    {
        $result = $this->model->updateItem($name, (bool)$checked);

        if(!$result) {
            http_response_code(400);
            echo 'Item not updated';
        } else {
            http_response_code(200);
            echo 'Item updated';
        }
    }

    public function getItems(): array
    {
        $items = $this->model->getItems();

        if(!$items) {
            http_response_code(404);
            echo 'Items not found';

            return [];
        } else {
            http_response_code(200);

            return $items;
        }
    }
}

