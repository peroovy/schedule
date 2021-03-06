<?php

    require_once 'IQuery.php';

    class EventAdding implements IQuery
    {
        private int $user_id;
        private string $description;
        private string $title;
        private string $date;

        public function __construct(int $user_id, string $title, string $description,
                                    int $day, string $month, int $year)
        {
            $this->user_id = $user_id;
            $this->title = $title;
            $this->date = date('Y-m-d', strtotime("$day $month $year"));
            $this->description = $description;
        }

        public function GetParameters(): array
        {
            return [
                'user_id' => $this->user_id,
                'description' => $this->description,
                'title' => $this->title,
                'date' => $this->date
            ];
        }

        public function GetQuery(): string
        {
            return "INSERT INTO events VALUES (NULL, :user_id, :title, :description, :date)";
        }
    }