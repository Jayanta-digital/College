<?php
/**
 * Header Template
 * Includes top bar, logo section, and main navigation
 */
require_once __DIR__ . '/../config/database.php';
require_once __DIR__ . '/functions.php';

// Get announcements for marquee
$announcements = getAnnouncements();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Excellence Institute - NAAC Accredited A++ Grade Institute">
    <meta name="keywords" content="college, institute, education, admission, results">
    <link rel="icon" type="image/png" href="<?php echo $_SERVER['REQUEST_URI']; ?>assets/images/logo.png">
    
    <!-- CSS Files -->
    <link rel="stylesheet" href="<?php echo $_SERVER['REQUEST_URI']; ?>assets/css/style.css">
    <link rel="stylesheet" href="<?php echo $_SERVER['REQUEST_URI']; ?>assets/css/responsive.css">
    <link rel="stylesheet" href="<?php echo $_SERVER['REQUEST_URI']; ?>assets/css/utilities.css">
    
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
</head>
<body>
    <!-- Top Header -->
    <div class="top-header">
        <div class="container">
            <div class="top-header-content">
                <div class="top-left">
                    <span><i class="fas fa-envelope"></i> info@excellenceinstitute.edu</span>
                    <span><i class="fas fa-phone"></i> +91-9876543210</span>
                </div>
                <div class="top-right">
                    <a href="https://www.facebook.com" target="_blank" title="Facebook">
                        <i class="fab fa-facebook"></i>
                    </a>
                    <a href="https://www.twitter.com" target="_blank" title="Twitter">
                        <i class="fab fa-twitter"></i>
                    </a>
                    <a href="https://www.instagram.com" target="_blank" title="Instagram">
                        <i class="fab fa-instagram"></i>
                    </a>
                    <a href="https://www.youtube.com" target="_blank" title="YouTube">
                        <i class="fab fa-youtube"></i>
                    </a>
                    <a href="https://www.linkedin.com" target="_blank" title="LinkedIn">
                        <i class="fab fa-linkedin"></i>
                    </a>
                </div>
            </div>
        </div>
    </div>

    <!-- Main Header -->
    <header class="main-header">
        <div class="container">
            <div class="header-content">
                <div class="logo-section">
                    <img src="assets/images/logo.png" alt="Institute Logo" class="logo-img">
                    <div class="logo-text">
                        <h1>EXCELLENCE INSTITUTE</h1>
                        <p class="tagline">NAAC Accredited A++ Grade (CGPA 3.5)</p>
                    </div>
                </div>
                
                <div class="header-buttons">
                    <a href="portal/admission.php" class="header-btn btn-admission">
                        <i class="fas fa-graduation-cap"></i>
                        <span>Apply Online</span>
                    </a>
                    <a href="portal/certificate.php" class="header-btn btn-certificate">
                        <i class="fas fa-certificate"></i>
                        <span>Certificate</span>
                    </a>
                    <a href="portal/student.php" class="header-btn btn-portal">
                        <i class="fas fa-user"></i>
                        <span>Student Portal</span>
                    </a>
                    <a href="results.php" class="header-btn btn-results">
                        <i class="fas fa-poll"></i>
                        <span>Results</span>
                    </a>
                </div>
            </div>
        </div>
    </header>

    <!-- Navigation -->
    <nav class="main-nav">
        <div class="container">
            <button class="mobile-menu-toggle">
                <i class="fas fa-bars"></i>
            </button>
            
            <ul class="nav-menu">
                <li><a href="index.php"><i class="fas fa-home"></i> Home</a></li>
                
                <li class="dropdown">
                    <a href="#"><i class="fas fa-info-circle"></i> About Us <i class="fas fa-chevron-down"></i></a>
                    <ul class="dropdown-menu">
                        <li><a href="about.php">About College</a></li>
                        <li><a href="vision-mission.php">Vision & Mission</a></li>
                        <li><a href="facilities.php">Facilities</a></li>
                        <li><a href="code-of-conduct.php">Code of Conduct</a></li>
                        <li><a href="best-practices.php">Best Practices</a></li>
                    </ul>
                </li>
                
                <li class="dropdown">
                    <a href="#"><i class="fas fa-users"></i> Administration <i class="fas fa-chevron-down"></i></a>
                    <ul class="dropdown-menu">
                        <li><a href="governing-body.php">Governing Body</a></li>
                        <li><a href="principal.php">Principal's Desk</a></li>
                    </ul>
                </li>
                
                <li class="dropdown">
                    <a href="#"><i class="fas fa-book-open"></i> Academic <i class="fas fa-chevron-down"></i></a>
                    <ul class="dropdown-menu">
                        <li><a href="portal/admission.php">Admission</a></li>
                        <li><a href="courses.php">Courses</a></li>
                        <li><a href="academic-calendar.php">Academic Calendar</a></li>
                        <li><a href="examination.php">Examination</a></li>
                        <li><a href="results.php">Results</a></li>
                        <li><a href="scholarship.php">Scholarship & Awards</a></li>
                        <li><a href="syllabus.php">Syllabus</a></li>
                    </ul>
                </li>
                
                <li><a href="departments.php"><i class="fas fa-building"></i> Departments</a></li>
                
                <li class="dropdown">
                    <a href="#"><i class="fas fa-chalkboard-teacher"></i> Staff <i class="fas fa-chevron-down"></i></a>
                    <ul class="dropdown-menu">
                        <li><a href="teaching-staff.php">Teaching Staff</a></li>
                        <li><a href="non-teaching-staff.php">Non-Teaching Staff</a></li>
                        <li><a href="library-staff.php">Library Staff</a></li>
                    </ul>
                </li>
                
                <li class="dropdown">
                    <a href="#"><i class="fas fa-book"></i> Library <i class="fas fa-chevron-down"></i></a>
                    <ul class="dropdown-menu">
                        <li><a href="library.php">Library</a></li>
                        <li><a href="digital-library.php">Digital Library</a></li>
                    </ul>
                </li>
                
                <li><a href="events.php"><i class="fas fa-calendar-alt"></i> Events</a></li>
                
                <li class="dropdown">
                    <a href="#"><i class="fas fa-star"></i> IQAC <i class="fas fa-chevron-down"></i></a>
                    <ul class="dropdown-menu">
                        <li><a href="about-iqac.php">About IQAC</a></li>
                        <li><a href="aqar.php">AQAR</a></li>
                        <li><a href="ssr.php">SSR</a></li>
                        <li><a href="feedback-reports.php">Feedback Reports</a></li>
                    </ul>
                </li>
                
                <li><a href="contact.php"><i class="fas fa-envelope"></i> Contact</a></li>
            </ul>
        </div>
    </nav>

    <!-- Announcements Marquee -->
    <?php if (!empty($announcements)): ?>
    <div class="announcements-section">
        <div class="announcement-wrapper">
            <div class="announcement-label">
                <i class="fas fa-bullhorn"></i> Announcements
            </div>
            <div class="announcement-content">
                <marquee behavior="scroll" direction="left" scrollamount="5" onmouseover="this.stop();" onmouseout="this.start();">
                    <?php
                    $announcement_texts = array_map(function($ann) {
                        return htmlspecialchars($ann['text']);
                    }, $announcements);
                    echo implode(' <span class="separator">|</span> ', $announcement_texts);
                    ?>
                </marquee>
            </div>
        </div>
    </div>
    <?php endif; ?>
