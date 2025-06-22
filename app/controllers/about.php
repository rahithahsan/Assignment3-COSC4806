<?php
class About extends Controller
{
    public function index(): void
    {
        $this->view('about/index');
    }
}