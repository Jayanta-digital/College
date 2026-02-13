<?php
/**
 * Helper Functions for Institute Website
 * These functions interact with the database to fetch data
 */

/**
 * Get latest notices
 * @param int $limit - Number of notices to fetch
 * @return array
 */
function getLatestNotices($limit = 10) {
    global $supabase;
    
    try {
        $notices = $supabase->select('notices', [], '*', [
            'order' => 'date.desc',
            'limit' => $limit
        ]);
        
        // Mark notices posted within last 7 days as new
        foreach ($notices as &$notice) {
            $noticeDate = strtotime($notice['date']);
            $currentDate = time();
            $daysDiff = ($currentDate - $noticeDate) / (60 * 60 * 24);
            $notice['is_new'] = $daysDiff <= 7;
        }
        
        return $notices;
    } catch (Exception $e) {
        // Return demo data if database is not set up
        return getDemoNotices($limit);
    }
}

/**
 * Get latest events
 * @param int $limit - Number of events to fetch
 * @return array
 */
function getLatestEvents($limit = 6) {
    global $supabase;
    
    try {
        return $supabase->select('events', [], '*', [
            'order' => 'date.desc',
            'limit' => $limit
        ]);
    } catch (Exception $e) {
        return getDemoEvents($limit);
    }
}

/**
 * Get latest achievements
 * @param int $limit - Number of achievements to fetch
 * @return array
 */
function getLatestAchievements($limit = 3) {
    global $supabase;
    
    try {
        return $supabase->select('achievements', [], '*', [
            'order' => 'date.desc',
            'limit' => $limit
        ]);
    } catch (Exception $e) {
        return getDemoAchievements($limit);
    }
}

/**
 * Get announcements for marquee
 * @return array
 */
function getAnnouncements() {
    global $supabase;
    
    try {
        return $supabase->select('announcements', ['is_active' => true], '*', [
            'order' => 'date.desc',
            'limit' => 5
        ]);
    } catch (Exception $e) {
        return getDemoAnnouncements();
    }
}

/**
 * Get latest tenders
 * @param int $limit - Number of tenders to fetch
 * @return array
 */
function getLatestTenders($limit = 5) {
    global $supabase;
    
    try {
        return $supabase->select('tenders', [], '*', [
            'order' => 'date.desc',
            'limit' => $limit
        ]);
    } catch (Exception $e) {
        return getDemoTenders($limit);
    }
}

/**
 * Get gallery images
 * @param int $limit - Number of images to fetch
 * @return array
 */
function getGalleryImages($limit = 6) {
    global $supabase;
    
    try {
        return $supabase->select('gallery', [], '*', [
            'order' => 'date.desc',
            'limit' => $limit
        ]);
    } catch (Exception $e) {
        return getDemoGallery($limit);
    }
}

/**
 * Get student by roll number and password
 * @param string $roll_number
 * @param string $password
 * @return array|false
 */
function getStudent($roll_number, $password) {
    global $supabase;
    
    try {
        $students = $supabase->select('students', [
            'roll_number' => $roll_number
        ], '*');
        
        if (!empty($students) && password_verify($password, $students[0]['password'])) {
            return $students[0];
        }
        return false;
    } catch (Exception $e) {
        return false;
    }
}

/**
 * Get results by student ID
 * @param int $student_id
 * @return array
 */
function getStudentResults($student_id) {
    global $supabase;
    
    try {
        return $supabase->select('results', [
            'student_id' => $student_id
        ], '*', [
            'order' => 'exam_date.desc'
        ]);
    } catch (Exception $e) {
        return [];
    }
}

// =====================================
// Demo Data Functions (for testing)
// =====================================

function getDemoNotices($limit) {
    $notices = [
        [
            'id' => 1,
            'date' => date('Y-m-d', strtotime('-2 days')),
            'title' => 'Admission 2025-26: Online Application Open',
            'file_url' => 'assets/documents/admission-notice.pdf',
            'is_new' => true
        ],
        [
            'id' => 2,
            'date' => date('Y-m-d', strtotime('-5 days')),
            'title' => 'Semester Examination Form Fill-up Notice',
            'file_url' => 'assets/documents/exam-form.pdf',
            'is_new' => true
        ],
        [
            'id' => 3,
            'date' => date('Y-m-d', strtotime('-10 days')),
            'title' => 'Scholarship Distribution Ceremony - 2025',
            'file_url' => 'assets/documents/scholarship.pdf',
            'is_new' => false
        ],
        [
            'id' => 4,
            'date' => date('Y-m-d', strtotime('-15 days')),
            'title' => 'Annual Sports Week Announcement',
            'file_url' => 'assets/documents/sports.pdf',
            'is_new' => false
        ],
        [
            'id' => 5,
            'date' => date('Y-m-d', strtotime('-20 days')),
            'title' => 'Library Timing Update Notice',
            'file_url' => 'assets/documents/library.pdf',
            'is_new' => false
        ]
    ];
    
    return array_slice($notices, 0, $limit);
}

function getDemoEvents($limit) {
    $events = [
        [
            'id' => 1,
            'date' => date('Y-m-d', strtotime('-3 days')),
            'title' => 'Annual Cultural Festival 2025',
            'description' => 'A three-day cultural extravaganza featuring dance, music, drama performances by students from all departments.',
            'image_url' => 'assets/images/events/event1.jpg'
        ],
        [
            'id' => 2,
            'date' => date('Y-m-d', strtotime('-7 days')),
            'title' => 'National Science Day Celebration',
            'description' => 'Special lectures, science exhibitions, and interactive sessions celebrating National Science Day.',
            'image_url' => 'assets/images/events/event2.jpg'
        ],
        [
            'id' => 3,
            'date' => date('Y-m-d', strtotime('-12 days')),
            'title' => 'Career Guidance Workshop',
            'description' => 'Industry experts sharing insights on career opportunities and professional development.',
            'image_url' => 'assets/images/events/event3.jpg'
        ],
        [
            'id' => 4,
            'date' => date('Y-m-d', strtotime('-18 days')),
            'title' => 'Independence Day Celebration',
            'description' => 'Flag hoisting ceremony, cultural programs, and patriotic activities.',
            'image_url' => 'assets/images/events/event4.jpg'
        ],
        [
            'id' => 5,
            'date' => date('Y-m-d', strtotime('-25 days')),
            'title' => 'Blood Donation Camp',
            'description' => 'Annual blood donation drive in collaboration with local blood bank.',
            'image_url' => 'assets/images/events/event5.jpg'
        ],
        [
            'id' => 6,
            'date' => date('Y-m-d', strtotime('-30 days')),
            'title' => 'Inter-College Sports Meet',
            'description' => 'Athletic competitions with neighboring colleges featuring various sports.',
            'image_url' => 'assets/images/events/event6.jpg'
        ]
    ];
    
    return array_slice($events, 0, $limit);
}

function getDemoAchievements($limit) {
    $achievements = [
        [
            'id' => 1,
            'date' => date('Y-m-d'),
            'title' => 'Student Secures 1st Position in State Level Debate',
            'description' => 'Congratulations to Priya Sharma for securing 1st position in the State Level Inter-College Debate Competition.',
            'image_url' => 'assets/images/achievements/achievement1.jpg'
        ],
        [
            'id' => 2,
            'date' => date('Y-m-d', strtotime('-5 days')),
            'title' => 'Research Paper Published in International Journal',
            'description' => 'Dr. Rajesh Kumar\'s research paper on Climate Change accepted in prestigious international journal.',
            'image_url' => 'assets/images/achievements/achievement2.jpg'
        ],
        [
            'id' => 3,
            'date' => date('Y-m-d', strtotime('-10 days')),
            'title' => 'Institute Wins Best NSS Unit Award',
            'description' => 'Our NSS unit recognized as the Best NSS Unit in the state for community service activities.',
            'image_url' => 'assets/images/achievements/achievement3.jpg'
        ]
    ];
    
    return array_slice($achievements, 0, $limit);
}

function getDemoAnnouncements() {
    return [
        [
            'id' => 1,
            'text' => 'Online Admission 2025-26 Now Open - Last Date: March 31, 2025',
            'date' => date('Y-m-d'),
            'is_active' => true
        ],
        [
            'id' => 2,
            'text' => 'Semester Examination Form Fill-up from February 15 to February 28, 2025',
            'date' => date('Y-m-d'),
            'is_active' => true
        ],
        [
            'id' => 3,
            'text' => 'Anti-Ragging Affidavit Submission Mandatory for All New Students',
            'date' => date('Y-m-d'),
            'is_active' => true
        ]
    ];
}

function getDemoTenders($limit) {
    $tenders = [
        [
            'id' => 1,
            'date' => date('Y-m-d', strtotime('-2 days')),
            'title' => 'Tender for Library Book Procurement 2025',
            'file_url' => 'assets/documents/tender-library.pdf'
        ],
        [
            'id' => 2,
            'date' => date('Y-m-d', strtotime('-8 days')),
            'title' => 'Notice Inviting Quotation for Laboratory Equipment',
            'file_url' => 'assets/documents/tender-lab.pdf'
        ],
        [
            'id' => 3,
            'date' => date('Y-m-d', strtotime('-15 days')),
            'title' => 'Tender for Canteen Services - 2025',
            'file_url' => 'assets/documents/tender-canteen.pdf'
        ]
    ];
    
    return array_slice($tenders, 0, $limit);
}

function getDemoGallery($limit) {
    $gallery = [];
    for ($i = 1; $i <= $limit; $i++) {
        $gallery[] = [
            'id' => $i,
            'url' => 'assets/images/gallery/gallery' . $i . '.jpg',
            'title' => 'Gallery Image ' . $i,
            'date' => date('Y-m-d')
        ];
    }
    return $gallery;
}
?>
