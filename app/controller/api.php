<?php

class Api extends Controller
{

    public function index(): void
    {
        echo 'No action provided for api';
    }

    public function addItem(): void
    {
        $result = false;

        if (isset($_POST['name'])) {
            $result = $this->model->addItem($_POST["name"]);
        }

        if($result === true) {
            $this->toRefererRoute();
        } else {
            http_response_code(500);
        }
    }

    public function getItem(string $name): ?array
    {
        $item = $this->model->getItem($name);

        if(!$item) {
            http_response_code(404);
            return null;
        } else {
            http_response_code(200);
            return $item;
        }
    }

    public function deleteItem(string $name): void
    {
        $result = $this->model->deleteItem($name);

        if(!$result) {
            http_response_code(500);
        } else {
            $this->toRefererRoute();
        }
    }

    public function updateItem(string $name): void
    {
        $result = $this->model->updateItem($name, isset($_POST["checked"]));

        if(!$result) {
            http_response_code(500);
        } else {
            $this->toRefererRoute();
        }
    }

    public function getItems(): array
    {
        $items = $this->model->getItems();

        if(!$items) {
            http_response_code(404);

            return [];
        } else {
            http_response_code(200);

            return $items;
        }
    }
}

