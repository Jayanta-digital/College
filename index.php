<?php
session_start();
require_once 'config/database.php';
require_once 'includes/functions.php';

// Fetch latest notices
$notices = getLatestNotices(10);
$events = getLatestEvents(6);
$achievements = getLatestAchievements(3);
$announcements = getAnnouncements();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Excellence Institute of Higher Education - Home</title>
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="stylesheet" href="assets/css/responsive.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
</head>
<body>
    <!-- Top Header Bar -->
    <div class="top-header">
        <div class="container">
            <div class="top-header-content">
                <div class="top-left">
                    <span><i class="fas fa-phone"></i> +91-XXXXXXXXXX</span>
                    <span><i class="fas fa-envelope"></i> info@excellenceinstitute.edu</span>
                </div>
                <div class="top-right">
                    <a href="accreditation.php">Accreditation</a>
                    <a href="rti.php">RTI</a>
                    <a href="alumni/login.php">Alumni Login</a>
                    <a href="contact.php">Contact Us</a>
                    <a href="placement.php">Placement Portal</a>
                </div>
            </div>
        </div>
    </div>

    <!-- Main Header -->
    <header class="main-header">
        <div class="container">
            <div class="header-content">
                <div class="logo-section">
                    <img src="assets/images/logo.png" alt="Institute Logo" class="logo">
                    <div class="logo-text">
                        <h1>Excellence Institute</h1>
                        <p class="tagline">NAAC Accredited A++ Grade (CGPA 3.5)</p>
                    </div>
                </div>
                <div class="header-buttons">
                    <a href="portal/admission.php" class="header-btn">
                        <i class="fas fa-graduation-cap"></i>
                        <span>Online Admission</span>
                    </a>
                    <a href="portal/student.php" class="header-btn">
                        <i class="fas fa-user-graduate"></i>
                        <span>Student Portal</span>
                    </a>
                    <a href="portal/certificate.php" class="header-btn">
                        <i class="fas fa-certificate"></i>
                        <span>Certificate</span>
                    </a>
                    <a href="results.php" class="header-btn">
                        <i class="fas fa-poll"></i>
                        <span>Results</span>
                    </a>
                </div>
            </div>
        </div>
    </header>

    <!-- Navigation Menu -->
    <nav class="main-nav">
        <div class="container">
            <div class="nav-wrapper">
                <ul class="nav-menu">
                    <li class="active"><a href="index.php"><i class="fas fa-home"></i> Home</a></li>
                    <li class="dropdown">
                        <a href="#"><i class="fas fa-info-circle"></i> About Us <i class="fas fa-chevron-down"></i></a>
                        <ul class="dropdown-menu">
                            <li><a href="about.php">About Institute</a></li>
                            <li><a href="vision-mission.php">Vision & Mission</a></li>
                            <li><a href="facilities.php">Facilities</a></li>
                            <li><a href="code-of-conduct.php">Code of Conduct</a></li>
                            <li><a href="best-practices.php">Best Practices</a></li>
                        </ul>
                    </li>
                    <li class="dropdown">
                        <a href="#"><i class="fas fa-user-tie"></i> Administration <i class="fas fa-chevron-down"></i></a>
                        <ul class="dropdown-menu">
                            <li><a href="governing-body.php">Governing Body</a></li>
                            <li><a href="principal.php">Principal</a></li>
                        </ul>
                    </li>
                    <li class="dropdown">
                        <a href="#"><i class="fas fa-book"></i> Academic <i class="fas fa-chevron-down"></i></a>
                        <ul class="dropdown-menu">
                            <li><a href="academic-calendar.php">Academic Calendar</a></li>
                            <li><a href="admission.php">Admission</a></li>
                            <li><a href="fees.php">Fees Details</a></li>
                            <li><a href="scholarship.php">Scholarship & Awards</a></li>
                            <li><a href="examination.php">Examination</a></li>
                            <li><a href="syllabus.php">Syllabus</a></li>
                            <li><a href="results.php">Results</a></li>
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
                        <a href="#"><i class="fas fa-certificate"></i> Courses <i class="fas fa-chevron-down"></i></a>
                        <ul class="dropdown-menu">
                            <li><a href="courses-ug.php">Undergraduate</a></li>
                            <li><a href="courses-pg.php">Postgraduate</a></li>
                            <li><a href="courses-certificate.php">Certificate Courses</a></li>
                        </ul>
                    </li>
                    <li><a href="library.php"><i class="fas fa-book-reader"></i> Library</a></li>
                    <li><a href="iqac.php"><i class="fas fa-star"></i> IQAC</a></li>
                </ul>
                <div class="mobile-menu-toggle">
                    <i class="fas fa-bars"></i>
                </div>
            </div>
        </div>
    </nav>

    <!-- Announcement Marquee -->
    <?php if (!empty($announcements)): ?>
    <div class="announcement-bar">
        <div class="container">
            <div class="announcement-wrapper">
                <span class="announcement-label"><i class="fas fa-bullhorn"></i> Announcements</span>
                <div class="announcement-content">
                    <marquee behavior="scroll" direction="left" scrollamount="5">
                        <?php foreach ($announcements as $announcement): ?>
                            <?php echo htmlspecialchars($announcement['text']); ?> &nbsp;&nbsp;&nbsp;|&nbsp;&nbsp;&nbsp;
                        <?php endforeach; ?>
                    </marquee>
                </div>
                <a href="announcements.php" class="view-all-link">View All</a>
            </div>
        </div>
    </div>
    <?php endif; ?>

    <!-- Hero Slider -->
    <section class="hero-slider">
        <div class="slider-container">
            <div class="slide active" style="background-image: url('assets/images/slider1.jpg');">
                <div class="slide-content">
                    <h2 class="slide-title">Welcome to Excellence Institute</h2>
                    <p class="slide-text">Empowering minds, Building futures</p>
                    <a href="about.php" class="btn-primary">Learn More</a>
                </div>
            </div>
            <div class="slide" style="background-image: url('assets/images/slider2.jpg');">
                <div class="slide-content">
                    <h2 class="slide-title">Quality Education Since 1972</h2>
                    <p class="slide-text">50+ Years of Academic Excellence</p>
                    <a href="admission.php" class="btn-primary">Apply Now</a>
                </div>
            </div>
            <div class="slide" style="background-image: url('assets/images/slider3.jpg');">
                <div class="slide-content">
                    <h2 class="slide-title">State-of-the-Art Facilities</h2>
                    <p class="slide-text">Modern Infrastructure for Holistic Development</p>
                    <a href="facilities.php" class="btn-primary">Explore</a>
                </div>
            </div>
        </div>
        <div class="slider-controls">
            <button class="prev-slide"><i class="fas fa-chevron-left"></i></button>
            <button class="next-slide"><i class="fas fa-chevron-right"></i></button>
        </div>
        <div class="slider-dots"></div>
    </section>

    <!-- Main Content -->
    <div class="container main-content">
        <div class="content-grid">
            <!-- Left Column -->
            <aside class="sidebar">
                <!-- Principal's Message -->
                <div class="widget principal-message">
                    <h3 class="widget-title">From The Principal's Desk</h3>
                    <div class="principal-content">
                        <img src="assets/images/principal.jpg" alt="Principal" class="principal-photo">
                        <h4>Dr. John Anderson</h4>
                        <p class="designation">M.Sc., Ph.D., Principal</p>
                        <p class="message">Welcome to our esteemed institution. We are committed to providing quality education and nurturing future leaders...</p>
                        <a href="principal.php" class="read-more">Read More <i class="fas fa-arrow-right"></i></a>
                    </div>
                </div>

                <!-- Important Links -->
                <div class="widget important-links">
                    <h3 class="widget-title">Important Links</h3>
                    <ul class="links-list">
                        <li><a href="https://antiragging.in/" target="_blank"><i class="fas fa-hand-paper"></i> Anti-Ragging Affidavit</a></li>
                        <li><a href="portal/admission.php"><i class="fas fa-file-alt"></i> Online Admission Form</a></li>
                        <li><a href="portal/student.php"><i class="fas fa-user"></i> Student Login</a></li>
                        <li><a href="results.php"><i class="fas fa-chart-line"></i> Examination Results</a></li>
                        <li><a href="library.php"><i class="fas fa-book"></i> Digital Library</a></li>
                        <li><a href="scholarship.php"><i class="fas fa-award"></i> Scholarships</a></li>
                    </ul>
                </div>

                <!-- Quick Access Buttons -->
                <div class="widget quick-access">
                    <h3 class="widget-title">Quick Access</h3>
                    <div class="quick-buttons">
                        <a href="nirf.php" class="quick-btn">
                            <img src="assets/images/nirf-logo.png" alt="NIRF">
                            <span>NIRF</span>
                        </a>
                        <a href="naac.php" class="quick-btn">
                            <img src="assets/images/naac-logo.png" alt="NAAC">
                            <span>NAAC</span>
                        </a>
                        <a href="nss.php" class="quick-btn">
                            <img src="assets/images/nss-logo.png" alt="NSS">
                            <span>NSS</span>
                        </a>
                        <a href="lms.php" class="quick-btn">
                            <i class="fas fa-laptop-code"></i>
                            <span>LMS</span>
                        </a>
                    </div>
                </div>

                <!-- Tenders -->
                <div class="widget tenders">
                    <h3 class="widget-title">Tenders</h3>
                    <ul class="tender-list">
                        <?php
                        $tenders = getLatestTenders(5);
                        foreach ($tenders as $tender):
                        ?>
                        <li>
                            <span class="date"><?php echo date('d M Y', strtotime($tender['date'])); ?></span>
                            <a href="<?php echo $tender['file_url']; ?>" target="_blank">
                                <?php echo htmlspecialchars($tender['title']); ?>
                            </a>
                        </li>
                        <?php endforeach; ?>
                    </ul>
                    <a href="tenders.php" class="view-all">View All Tenders <i class="fas fa-arrow-right"></i></a>
                </div>
            </aside>

            <!-- Center Column -->
            <main class="main-column">
                <!-- About Section -->
                <section class="about-section">
                    <h2 class="section-title">About The Institute</h2>
                    <div class="about-content">
                        <p>Excellence Institute, located at the heart of the city, is an institute of general higher education. Established in 1972 as a result of decade-long popular desire and relentless effort for such an institute, we have been serving society for over 50 years.</p>
                        <p>Started with arts stream, we now have 48 permanent teaching positions, with 25 guest faculty members engaged across all three faculties - Arts, Science, and Vocational Courses, along with several professional courses.</p>
                        <p>Our campus is equipped with state-of-the-art facilities including modern laboratories, a well-stocked library with digital resources, sports facilities, and hostel accommodations. We are committed to providing holistic education that prepares students for the challenges of the modern world.</p>
                        <a href="about.php" class="btn-secondary">Read More About Us</a>
                    </div>
                </section>

                <!-- Events Section -->
                <section class="events-section">
                    <h2 class="section-title">Latest Events</h2>
                    <div class="events-grid">
                        <?php foreach ($events as $event): ?>
                        <div class="event-card">
                            <div class="event-image">
                                <img src="<?php echo $event['image_url']; ?>" alt="<?php echo htmlspecialchars($event['title']); ?>">
                                <span class="event-date"><?php echo date('d M Y', strtotime($event['date'])); ?></span>
                            </div>
                            <div class="event-content">
                                <h3><?php echo htmlspecialchars($event['title']); ?></h3>
                                <p><?php echo htmlspecialchars(substr($event['description'], 0, 100)); ?>...</p>
                                <a href="event-details.php?id=<?php echo $event['id']; ?>" class="read-more">Read More <i class="fas fa-arrow-right"></i></a>
                            </div>
                        </div>
                        <?php endforeach; ?>
                    </div>
                    <div class="text-center">
                        <a href="events.php" class="btn-secondary">View All Events</a>
                    </div>
                </section>

                <!-- Achievements Section -->
                <section class="achievements-section">
                    <h2 class="section-title">Recent Achievements</h2>
                    <div class="achievements-slider">
                        <?php foreach ($achievements as $achievement): ?>
                        <div class="achievement-card">
                            <img src="<?php echo $achievement['image_url']; ?>" alt="Achievement">
                            <div class="achievement-content">
                                <h4><?php echo htmlspecialchars($achievement['title']); ?></h4>
                                <p><?php echo htmlspecialchars($achievement['description']); ?></p>
                            </div>
                        </div>
                        <?php endforeach; ?>
                    </div>
                    <div class="text-center">
                        <a href="achievements.php" class="btn-secondary">View All Achievements</a>
                    </div>
                </section>

                <!-- Gallery Preview -->
                <section class="gallery-preview">
                    <h2 class="section-title">Gallery</h2>
                    <div class="gallery-grid">
                        <?php
                        $galleryImages = getGalleryImages(6);
                        foreach ($galleryImages as $image):
                        ?>
                        <div class="gallery-item">
                            <img src="<?php echo $image['url']; ?>" alt="Gallery Image">
                            <div class="gallery-overlay">
                                <i class="fas fa-search-plus"></i>
                            </div>
                        </div>
                        <?php endforeach; ?>
                    </div>
                    <div class="text-center">
                        <a href="gallery.php" class="btn-secondary">View Full Gallery</a>
                    </div>
                </section>
            </main>

            <!-- Right Column -->
            <aside class="sidebar-right">
                <!-- Notice Board -->
                <div class="widget notice-board">
                    <h3 class="widget-title"><i class="fas fa-clipboard"></i> News & Notices</h3>
                    <div class="notice-list">
                        <?php foreach ($notices as $notice): ?>
                        <div class="notice-item">
                            <span class="notice-date"><?php echo date('d M Y', strtotime($notice['date'])); ?></span>
                            <h4><?php echo htmlspecialchars($notice['title']); ?></h4>
                            <?php if ($notice['file_url']): ?>
                            <a href="<?php echo $notice['file_url']; ?>" target="_blank" class="notice-link">
                                <i class="fas fa-file-pdf"></i> Click Here
                            </a>
                            <?php endif; ?>
                            <?php if ($notice['is_new']): ?>
                            <span class="new-badge">NEW</span>
                            <?php endif; ?>
                        </div>
                        <?php endforeach; ?>
                    </div>
                    <a href="notices.php" class="view-all">View All Notices <i class="fas fa-arrow-right"></i></a>
                </div>

                <!-- Anti-Ragging -->
                <div class="widget anti-ragging">
                    <h3 class="widget-title">Ragging Free Campus</h3>
                    <div class="anti-ragging-content">
                        <img src="assets/images/anti-ragging.jpg" alt="Anti Ragging">
                        <p>Ragging is strictly prohibited. It is a criminal offence inviting stringent punishment.</p>
                        <a href="anti-ragging.php" class="btn-danger">View Committee</a>
                    </div>
            </div>

                <!-- Visitor Counter -->
                <div class="widget visitor-counter">
                    <h3 class="widget-title">Visitor Counter</h3>
                    <div class="counter-display">
                        <i class="fas fa-users"></i>
                        <span class="counter-number">125,847</span>
                    </div>
                </div>
            </aside>
        </div>
    </div>

    <!-- Footer -->
    <footer class="main-footer">
        <div class="container">
            <div class="footer-grid">
                <div class="footer-column">
                    <h3>Contact Us</h3>
                    <ul class="contact-info">
                        <li><i class="fas fa-map-marker-alt"></i> City Center, State - 123456</li>
                        <li><i class="fas fa-phone"></i> +91-XXXXXXXXXX</li>
                        <li><i class="fas fa-envelope"></i> info@excellenceinstitute.edu</li>
                    </ul>
                    <div class="social-links">
                        <a href="#"><i class="fab fa-facebook"></i></a>
                        <a href="#"><i class="fab fa-twitter"></i></a>
                        <a href="#"><i class="fab fa-instagram"></i></a>
                        <a href="#"><i class="fab fa-youtube"></i></a>
                        <a href="#"><i class="fab fa-linkedin"></i></a>
                    </div>
                </div>
                <div class="footer-column">
                    <h3>Useful Links</h3>
                    <ul class="footer-links">
                        <li><a href="https://www.ugc.ac.in/" target="_blank">UGC</a></li>
                        <li><a href="http://www.naac.gov.in/" target="_blank">NAAC</a></li>
                        <li><a href="#">University</a></li>
                        <li><a href="app.php">Download Mobile App</a></li>
                        <li><a href="terms.php">Terms and Conditions</a></li>
                    </ul>
                </div>
                <div class="footer-column">
                    <h3>Quick Links</h3>
                    <ul class="footer-links">
                        <li><a href="portal/admission.php">Online Portal</a></li>
                        <li><a href="iqac.php">IQAC</a></li>
                        <li><a href="gallery.php">Gallery</a></li>
                        <li><a href="publications.php">Publications</a></li>
                        <li><a href="rti.php">RTI</a></li>
                    </ul>
                </div>
                <div class="footer-column">
                    <h3>Our Location</h3>
                    <div class="map-container">
                        <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3153.0197127854843!2d-122.41941568468147!3d37.77492997975903!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0x0!2zMzfCsDQ2JzI5LjciTiAxMjLCsDI1JzA0LjEiVw!5e0!3m2!1sen!2sus!4v1234567890123!5m2!1sen!2sus" width="100%" height="150" style="border:0;" allowfullscreen="" loading="lazy"></iframe>
                    </div>
                </div>
            </div>
            <div class="footer-bottom">
                <p>&copy; 2025 Excellence Institute. All Rights Reserved. | Powered by Excellence Tech Solutions</p>
            </div>
        </div>
    </footer>

    <script src="assets/js/main.js"></script>
</body>
          </html>
