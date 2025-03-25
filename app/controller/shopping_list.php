<?php
class shopping_list extends Controller
{
    public function index(): void
    {
        $items = $this->model->getItems();
        require APP . 'view/shopping_list/index.php';
    }

    public function item(string $name): void
    {
        $item = $this->model->getItem($name);
        require APP . 'view/shopping_list/item.php';
    }
}
