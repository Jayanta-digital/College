<?php
require_once 'config/database.php';
require_once 'config/site.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>About Us - <?php echo INSTITUTE_NAME; ?></title>
    <meta name="description" content="Learn about <?php echo INSTITUTE_NAME; ?> - our history, vision, mission, and commitment to quality education since <?php echo ESTABLISHED_YEAR; ?>.">
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="stylesheet" href="assets/css/responsive.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        .page-header {
            background: linear-gradient(135deg, var(--primary-color) 0%, #1e40af 100%);
            color: white;
            padding: 80px 0 60px;
            text-align: center;
            position: relative;
            overflow: hidden;
        }
        
        .page-header::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 320"><path fill="rgba(255,255,255,0.1)" d="M0,96L48,112C96,128,192,160,288,160C384,160,480,128,576,122.7C672,117,768,139,864,138.7C960,139,1056,117,1152,106.7C1248,96,1344,96,1392,96L1440,96L1440,320L1392,320C1344,320,1248,320,1152,320C1056,320,960,320,864,320C768,320,672,320,576,320C480,320,384,320,288,320C192,320,96,320,48,320L0,320Z"></path></svg>') no-repeat bottom;
            background-size: cover;
        }
        
        .page-header h1 {
            font-size: 48px;
            margin-bottom: 15px;
            position: relative;
            z-index: 1;
        }
        
        .page-header p {
            font-size: 18px;
            opacity: 0.9;
            position: relative;
            z-index: 1;
        }
        
        .breadcrumb {
            display: flex;
            justify-content: center;
            gap: 10px;
            font-size: 14px;
            opacity: 0.9;
            margin-top: 20px;
            position: relative;
            z-index: 1;
        }
        
        .breadcrumb a {
            color: white;
            text-decoration: none;
            transition: all 0.3s ease;
        }
        
        .breadcrumb a:hover {
            text-decoration: underline;
        }
        
        .about-section {
            padding: 80px 0;
        }
        
        .intro-section {
            background: white;
            padding: 60px;
            border-radius: 20px;
            box-shadow: var(--shadow-xl);
            margin-bottom: 60px;
            position: relative;
            overflow: hidden;
        }
        
        .intro-section::before {
            content: '';
            position: absolute;
            top: -100px;
            right: -100px;
            width: 300px;
            height: 300px;
            background: linear-gradient(135deg, var(--primary-color) 0%, var(--secondary-color) 100%);
            opacity: 0.05;
            border-radius: 50%;
        }
        
        .intro-content {
            position: relative;
            z-index: 1;
        }
        
        .intro-content h2 {
            font-size: 36px;
            color: var(--primary-color);
            margin-bottom: 25px;
        }
        
        .intro-content p {
            font-size: 16px;
            line-height: 1.9;
            color: var(--text-dark);
            margin-bottom: 20px;
            text-align: justify;
        }
        
        .highlight-text {
            background: linear-gradient(135deg, var(--accent-color) 0%, #ea580c 100%);
            color: white;
            padding: 30px;
            border-radius: 12px;
            margin: 30px 0;
            font-size: 18px;
            font-weight: 500;
            text-align: center;
            box-shadow: var(--shadow-md);
        }
        
        .stats-section {
            background: linear-gradient(135deg, var(--primary-color) 0%, #1e40af 100%);
            color: white;
            padding: 60px 0;
            margin-bottom: 60px;
            border-radius: 20px;
        }
        
        .stats-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 40px;
            text-align: center;
        }
        
        .stat-item {
            padding: 20px;
        }
        
        .stat-number {
            font-size: 48px;
            font-weight: 700;
            margin-bottom: 10px;
            color: var(--accent-color);
        }
        
        .stat-label {
            font-size: 16px;
            opacity: 0.9;
        }
        
        .vision-mission-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(400px, 1fr));
            gap: 40px;
            margin-bottom: 60px;
        }
        
        .vm-card {
            background: white;
            padding: 40px;
            border-radius: 20px;
            box-shadow: var(--shadow-lg);
            transition: all 0.3s ease;
        }
        
        .vm-card:hover {
            transform: translateY(-10px);
            box-shadow: var(--shadow-xl);
        }
        
        .vm-icon {
            width: 80px;
            height: 80px;
            background: linear-gradient(135deg, var(--primary-color) 0%, #1e40af 100%);
            color: white;
            border-radius: 20px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 40px;
            margin-bottom: 25px;
        }
        
        .vm-card h2 {
            font-size: 28px;
            color: var(--primary-color);
            margin-bottom: 20px;
        }
        
        .vm-card p {
            font-size: 15px;
            line-height: 1.8;
            color: var(--text-dark);
            text-align: justify;
        }
        
        .values-section {
            background: var(--bg-light);
            padding: 60px 40px;
            border-radius: 20px;
            margin-bottom: 60px;
        }
        
        .values-section h2 {
            font-size: 32px;
            color: var(--primary-color);
            text-align: center;
            margin-bottom: 50px;
        }
        
        .values-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 30px;
        }
        
        .value-card {
            background: white;
            padding: 30px;
            border-radius: 15px;
            text-align: center;
            box-shadow: var(--shadow-md);
            transition: all 0.3s ease;
        }
        
        .value-card:hover {
            transform: translateY(-5px);
            box-shadow: var(--shadow-lg);
        }
        
        .value-icon {
            width: 70px;
            height: 70px;
            background: linear-gradient(135deg, var(--accent-color) 0%, #ea580c 100%);
            color: white;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 32px;
            margin: 0 auto 20px;
        }
        
        .value-card h3 {
            font-size: 20px;
            color: var(--primary-color);
            margin-bottom: 15px;
        }
        
        .value-card p {
            font-size: 14px;
            color: var(--text-dark);
            line-height: 1.7;
        }
        
        .accreditation-section {
            background: white;
            padding: 60px;
            border-radius: 20px;
            box-shadow: var(--shadow-lg);
            margin-bottom: 60px;
        }
        
        .accreditation-section h2 {
            font-size: 32px;
            color: var(--primary-color);
            text-align: center;
            margin-bottom: 40px;
        }
        
        .accreditation-badges {
            display: flex;
            justify-content: center;
            gap: 50px;
            flex-wrap: wrap;
        }
        
        .badge-item {
            text-align: center;
        }
        
        .badge-icon {
            width: 120px;
            height: 120px;
            background: linear-gradient(135deg, var(--bg-light) 0%, #f3f4f6 100%);
            border-radius: 20px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 15px;
            font-size: 50px;
            color: var(--primary-color);
            border: 3px solid var(--border-color);
            transition: all 0.3s ease;
        }
        
        .badge-item:hover .badge-icon {
            transform: scale(1.1);
            border-color: var(--accent-color);
        }
        
        .badge-label {
            font-size: 16px;
            font-weight: 600;
            color: var(--text-dark);
        }
        
        .timeline-section {
            margin-bottom: 60px;
        }
        
        .timeline-section h2 {
            font-size: 32px;
            color: var(--primary-color);
            text-align: center;
            margin-bottom: 50px;
        }
        
        .timeline {
            position: relative;
            padding: 0 20px;
        }
        
        .timeline::before {
            content: '';
            position: absolute;
            left: 50%;
            top: 0;
            bottom: 0;
            width: 3px;
            background: var(--primary-color);
        }
        
        .timeline-item {
            position: relative;
            margin-bottom: 50px;
        }
        
        .timeline-item:nth-child(odd) .timeline-content {
            margin-left: 0;
            margin-right: 50%;
            padding-right: 40px;
            text-align: right;
        }
        
        .timeline-item:nth-child(even) .timeline-content {
            margin-left: 50%;
            padding-left: 40px;
        }
        
        .timeline-marker {
            position: absolute;
            left: 50%;
            top: 0;
            width: 20px;
            height: 20px;
            background: var(--accent-color);
            border: 4px solid white;
            border-radius: 50%;
            transform: translateX(-50%);
            box-shadow: 0 0 0 4px var(--primary-color);
        }
        
        .timeline-content {
            background: white;
            padding: 25px;
            border-radius: 12px;
            box-shadow: var(--shadow-md);
        }
        
        .timeline-year {
            font-size: 24px;
            font-weight: 700;
            color: var(--primary-color);
            margin-bottom: 10px;
        }
        
        .timeline-text {
            font-size: 15px;
            color: var(--text-dark);
            line-height: 1.7;
        }
        
        @media (max-width: 768px) {
            .page-header h1 {
                font-size: 36px;
            }
            
            .intro-section {
                padding: 40px 30px;
            }
            
            .vision-mission-grid {
                grid-template-columns: 1fr;
            }
            
            .timeline::before {
                left: 20px;
            }
            
            .timeline-item:nth-child(odd) .timeline-content,
            .timeline-item:nth-child(even) .timeline-content {
                margin: 0;
                margin-left: 50px;
                padding: 20px;
                text-align: left;
            }
            
            .timeline-marker {
                left: 20px;
            }
        }
    </style>
</head>
<body>
    <div class="page-header">
        <h1><i class="fas fa-university"></i> About Us</h1>
        <p>Excellence in Education Since <?php echo ESTABLISHED_YEAR; ?></p>
        <div class="breadcrumb">
            <a href="index.php"><i class="fas fa-home"></i> Home</a>
            <span>/</span>
            <span>About Us</span>
        </div>
    </div>
    
    <section class="about-section">
        <div class="container">
            <!-- Introduction -->
            <div class="intro-section">
                <div class="intro-content">
                    <h2>Welcome to <?php echo INSTITUTE_NAME; ?></h2>
                    
                    <p><?php echo INSTITUTE_NAME; ?>, located at the heart of the city, is an institute of general higher education dedicated to nurturing young minds and shaping future leaders. Established in <?php echo ESTABLISHED_YEAR; ?> as a result of decade-long popular desire and relentless effort for such an institute, we have been serving society for over <?php echo date('Y') - ESTABLISHED_YEAR; ?> years with unwavering commitment to academic excellence.</p>
                    
                    <p>Our journey began with a simple vision – to provide quality education accessible to all, regardless of their socio-economic background. What started as a small initiative with just the Arts stream has now blossomed into a comprehensive educational institution offering programs across multiple faculties including Arts, Science, Commerce, and various professional courses.</p>
                    
                    <p>Today, we take pride in our 48 permanent teaching positions, complemented by 25 dedicated guest faculty members who bring diverse expertise and industry experience to our classrooms. Our commitment to holistic education extends beyond textbooks, encompassing personality development, skill enhancement, and values-based learning that prepares students not just for careers, but for life itself.</p>
                    
                    <div class="highlight-text">
                        <i class="fas fa-quote-left"></i>
                        "Education is not the filling of a pail, but the lighting of a fire. At <?php echo INSTITUTE_SHORT_NAME; ?>, we ignite minds and inspire futures."
                        <i class="fas fa-quote-right"></i>
                    </div>
                    
                    <p>Our campus is strategically situated in a vibrant semi-urban area, serving as a crucial junction point on two National Highways. This prime location makes us easily accessible while providing a conducive learning environment away from the hustle of metropolitan chaos. The institute is equipped with state-of-the-art facilities including modern laboratories, a well-stocked library with digital resources, sports facilities, and comfortable hostel accommodations for outstation students.</p>
                    
                    <p>We are proud to be <?php echo RECOGNITION; ?> and <?php echo INSTITUTE_TAGLINE; ?>. This recognition is a testament to our commitment to maintaining the highest standards of education, infrastructure, and student services. Our faculty members are highly qualified, many holding doctoral degrees, and are actively engaged in research and publication activities.</p>
                </div>
            </div>
            
            <!-- Statistics -->
            <div class="stats-section">
                <div class="stats-grid">
                    <div class="stat-item">
                        <div class="stat-number"><?php echo date('Y') - ESTABLISHED_YEAR; ?>+</div>
                        <div class="stat-label">Years of Excellence</div>
                    </div>
                    <div class="stat-item">
                        <div class="stat-number">5000+</div>
                        <div class="stat-label">Students Enrolled</div>
                    </div>
                    <div class="stat-item">
                        <div class="stat-number">73</div>
                        <div class="stat-label">Faculty Members</div>
                    </div>
                    <div class="stat-item">
                        <div class="stat-number">25+</div>
                        <div class="stat-label">Courses Offered</div>
                    </div>
                    <div class="stat-item">
                        <div class="stat-number">95%</div>
                        <div class="stat-label">Placement Rate</div>
                    </div>
                </div>
            </div>
            
            <!-- Vision & Mission -->
            <div class="vision-mission-grid">
                <div class="vm-card">
                    <div class="vm-icon">
                        <i class="fas fa-eye"></i>
                    </div>
                    <h2>Our Vision</h2>
                    <p>To emerge as a leading center of academic excellence that fosters intellectual curiosity, critical thinking, and innovation. We envision creating global citizens who are not only professionally competent but also socially responsible and culturally aware.</p>
                    <p>Our vision is to be recognized as an institution that transforms lives through quality education, preparing students to meet the challenges of a rapidly changing world while staying rooted in strong ethical values and cultural heritage.</p>
                </div>
                
                <div class="vm-card">
                    <div class="vm-icon">
                        <i class="fas fa-bullseye"></i>
                    </div>
                    <h2>Our Mission</h2>
                    <p>To provide accessible, affordable, and quality higher education to all sections of society, with special focus on economically and socially disadvantaged communities. We are committed to nurturing talent, promoting research, and fostering innovation.</p>
                    <p>Our mission encompasses creating an inclusive learning environment that encourages diversity, promotes gender equality, and empowers students with knowledge, skills, and values needed for personal and professional success in a globalized world.</p>
                </div>
            </div>
            
            <!-- Core Values -->
            <div class="values-section">
                <h2><i class="fas fa-heart"></i> Our Core Values</h2>
                <div class="values-grid">
                    <div class="value-card">
                        <div class="value-icon">
                            <i class="fas fa-graduation-cap"></i>
                        </div>
                        <h3>Academic Excellence</h3>
                        <p>We are committed to maintaining the highest standards of teaching, learning, and research.</p>
                    </div>
                    
                    <div class="value-card">
                        <div class="value-icon">
                            <i class="fas fa-users"></i>
                        </div>
                        <h3>Inclusivity</h3>
                        <p>We believe in equal opportunities for all, regardless of background, gender, or social status.</p>
                    </div>
                    
                    <div class="value-card">
                        <div class="value-icon">
                            <i class="fas fa-lightbulb"></i>
                        </div>
                        <h3>Innovation</h3>
                        <p>We encourage creative thinking, research, and innovative approaches to problem-solving.</p>
                    </div>
                    
                    <div class="value-card">
                        <div class="value-icon">
                            <i class="fas fa-handshake"></i>
                        </div>
                        <h3>Integrity</h3>
                        <p>We uphold the highest ethical standards in all our academic and administrative activities.</p>
                    </div>
                    
                    <div class="value-card">
                        <div class="value-icon">
                            <i class="fas fa-hands-helping"></i>
                        </div>
                        <h3>Social Responsibility</h3>
                        <p>We actively engage in community service and social development initiatives.</p>
                    </div>
                    
                    <div class="value-card">
                        <div class="value-icon">
                            <i class="fas fa-globe"></i>
                        </div>
                        <h3>Global Perspective</h3>
                        <p>We prepare students to thrive in a diverse, interconnected world.</p>
                    </div>
                </div>
            </div>
            
            <!-- Accreditation & Recognition -->
            <div class="accreditation-section">
                <h2><i class="fas fa-award"></i> Accreditation & Recognition</h2>
                <div class="accreditation-badges">
                    <div class="badge-item">
                        <div class="badge-icon">
                            <i class="fas fa-certificate"></i>
                        </div>
                        <div class="badge-label">NAAC A++ Accredited</div>
                    </div>
                    <div class="badge-item">
                        <div class="badge-icon">
                            <i class="fas fa-university"></i>
                        </div>
                        <div class="badge-label">UGC Recognized</div>
                    </div>
                    <div class="badge-item">
                        <div class="badge-icon">
                            <i class="fas fa-star"></i>
                        </div>
                        <div class="badge-label">State Affiliated</div>
                    </div>
                    <div class="badge-item">
                        <div class="badge-icon">
                            <i class="fas fa-trophy"></i>
                        </div>
                        <div class="badge-label">ISO Certified</div>
                    </div>
                </div>
            </div>
            
            <!-- Timeline -->
            <div class="timeline-section">
                <h2><i class="fas fa-history"></i> Our Journey</h2>
                <div class="timeline">
                    <div class="timeline-item">
                        <div class="timeline-marker"></div>
                        <div class="timeline-content">
                            <div class="timeline-year"><?php echo ESTABLISHED_YEAR; ?></div>
                            <div class="timeline-text">
                                Founded as a pioneering institution with Arts stream, driven by community vision and leadership.
                            </div>
                        </div>
                    </div>
                    
                    <div class="timeline-item">
                        <div class="timeline-marker"></div>
                        <div class="timeline-content">
                            <div class="timeline-year">1985</div>
                            <div class="timeline-text">
                                Expanded to include Science stream, establishing well-equipped laboratories and research facilities.
                            </div>
                        </div>
                    </div>
                    
                    <div class="timeline-item">
                        <div class="timeline-marker"></div>
                        <div class="timeline-content">
                            <div class="timeline-year">1995</div>
                            <div class="timeline-text">
                                Introduced Commerce stream and professional courses, broadening educational opportunities.
                            </div>
                        </div>
                    </div>
                    
                    <div class="timeline-item">
                        <div class="timeline-marker"></div>
                        <div class="timeline-content">
                            <div class="timeline-year">2005</div>
                            <div class="timeline-text">
                                Achieved NAAC accreditation, marking excellence in quality education and infrastructure.
                            </div>
                        </div>
                    </div>
                    
                    <div class="timeline-item">
                        <div class="timeline-marker"></div>
                        <div class="timeline-content">
                            <div class="timeline-year">2015</div>
                            <div class="timeline-text">
                                Launched postgraduate programs and research centers, enhancing academic depth.
                            </div>
                        </div>
                    </div>
                    
                    <div class="timeline-item">
                        <div class="timeline-marker"></div>
                        <div class="timeline-content">
                            <div class="timeline-year">2020</div>
                            <div class="timeline-text">
                                Implemented digital learning platforms and smart classrooms for modern education.
                            </div>
                        </div>
                    </div>
                    
                    <div class="timeline-item">
                        <div class="timeline-marker"></div>
                        <div class="timeline-content">
                            <div class="timeline-year">2025</div>
                            <div class="timeline-text">
                                Achieved NAAC A++ grade with CGPA 3.5, celebrating 50+ years of educational excellence.
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    
    <!-- Footer -->
    <footer class="main-footer">
        <div class="container">
            <div class="footer-grid">
                <div class="footer-column">
                    <h3>Contact Us</h3>
                    <ul class="contact-info">
                        <li><i class="fas fa-map-marker-alt"></i> <?php echo INSTITUTE_ADDRESS; ?></li>
                        <li><i class="fas fa-phone"></i> <?php echo INSTITUTE_PHONE; ?></li>
                        <li><i class="fas fa-envelope"></i> <?php echo INSTITUTE_EMAIL; ?></li>
                    </ul>
                </div>
                <div class="footer-column">
                    <h3>Quick Links</h3>
                    <ul class="footer-links">
                        <li><a href="index.php">Home</a></li>
                        <li><a href="about.php">About Us</a></li>
                        <li><a href="contact.php">Contact</a></li>
                        <li><a href="portal/admission.php">Admissions</a></li>
                    </ul>
                </div>
                <div class="footer-column">
                    <h3>Resources</h3>
                    <ul class="footer-links">
                        <li><a href="results.php">Results</a></li>
                        <li><a href="notices.php">Notices</a></li>
                        <li><a href="portal/student.php">Student Portal</a></li>
                        <li><a href="library.php">Library</a></li>
                    </ul>
                </div>
                <div class="footer-column">
                    <h3>Connect With Us</h3>
                    <div class="social-links">
                        <a href="<?php echo FACEBOOK_URL; ?>" target="_blank"><i class="fab fa-facebook"></i></a>
                        <a href="<?php echo TWITTER_URL; ?>" target="_blank"><i class="fab fa-twitter"></i></a>
                        <a href="<?php echo INSTAGRAM_URL; ?>" target="_blank"><i class="fab fa-instagram"></i></a>
                        <a href="<?php echo YOUTUBE_URL; ?>" target="_blank"><i class="fab fa-youtube"></i></a>
                        <a href="<?php echo LINKEDIN_URL; ?>" target="_blank"><i class="fab fa-linkedin"></i></a>
                    </div>
                </div>
            </div>
            <div class="footer-bottom">
                <p>&copy; 2025 <?php echo INSTITUTE_SHORT_NAME; ?>. All Rights Reserved.</p>
            </div>
        </div>
    </footer>
    
    <script src="assets/js/main.js"></script>
</body>
</html>
