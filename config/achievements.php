<?php

return [
    'types' => [
        'Comments Written',
        'Lessons Watched',
    ],
    'constants' => [
        'LESSON_WATCHED' => 'Lessons Watched',
        'COMMENT_WRITTEN' => 'Comments Written',
        // Comments Written
        'FIRST_COMMENT_WRITTEN' => 1,
        'THREE_COMMENTS_WRITTEN' => 3,
        'FIVE_COMMENTS_WRITTEN' => 5,
        'TEN_COMMENTS_WRITTEN' => 10,
        'TWENTY_COMMENTS_WRITTEN' => 20,
        // Lessons Watched
        'FIRST_LESSON_WATCHED' => 1,
        'FIVE_LESSONS_WATCHED' => 5,
        'TEN_LESSONS_WATCHED' => 10,
        'TWENTY_FIVE_LESSONS_WATCHED' => 25,
        'FIFTY_LESSONS_WATCHED' => 50,
        // Comment & Lessons Series
        'COMMENTS_WRITTEN' => [1, 5, 10, 25, 50],
        'LESSONS_WATCHED' => [1, 3, 5, 10, 20],
    ],
    'achievements' => [
        // **Comments Written**
        [
            'name' => 'First Comment Written',
            'type' => 'Comments Written',
            'value' => 1,
            'description' => 'Write your first comment.',
        ],
        [
            'name' => '3 Comments Written',
            'type' => 'Comments Written',
            'value' => 3,
            'description' => 'Write 3 comments.',
        ],
        [
            'name' => '5 Comments Written',
            'type' => 'Comments Written',
            'value' => 5,
            'description' => 'Write 5 comments.',
        ],
        [
            'name' => '10 Comments Written',
            'type' => 'Comments Written',
            'value' => 10,
            'description' => 'Write 10 comments.',
        ],
        [
            'name' => '20 Comments Written',
            'type' => 'Comments Written',
            'value' => 20,
            'description' => 'Write 20 comments and become a true community member!',
        ],
        // **Lessons Watched**
        [
            'name' => 'First Lesson Watched',
            'type' => 'Lessons Watched',
            'value' => 1,
            'description' => 'Take your first step to learning.',
        ],
        [
            'name' => '5 Lessons Watched',
            'type' => 'Lessons Watched',
            'value' => 5,
            'description' => 'Continue your learning journey by watching 5 lessons.',
        ],
        [
            'name' => '10 Lessons Watched',
            'type' => 'Lessons Watched',
            'value' => 10,
            'description' => 'Keep up the good work! Watch 10 lessons to unlock this badge.',
        ],
        [
            'name' => '25 Lessons Watched',
            'type' => 'Lessons Watched',
            'value' => 25,
            'description' => 'Become a dedicated learner by watching 25 lessons!',
        ],
        [
            'name' => '50 Lessons Watched',
            'type' => 'Lessons Watched',
            'value' => 50,
            'description' => "Wow! You've watched 50 lessons! You're a true learning champion!",
        ],
    ],
];
