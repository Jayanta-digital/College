<?php
session_start();
require_once 'config/database.php';
require_once 'config/site.php';

$success = '';
$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    try {
        // Validate input
        $name = sanitize($_POST['name']);
        $email = sanitize($_POST['email']);
        $phone = sanitize($_POST['phone']);
        $subject = sanitize($_POST['subject']);
        $message = sanitize($_POST['message']);
        
        // Validation
        if (empty($name) || empty($email) || empty($message)) {
            $error = 'Please fill in all required fields.';
        } elseif (!validateEmail($email)) {
            $error = 'Please enter a valid email address.';
        } else {
            // Insert into database
            $data = [
                'name' => $name,
                'email' => $email,
                'phone' => $phone,
                'subject' => $subject,
                'message' => $message,
                'status' => 'Unread',
                'created_at' => date('Y-m-d H:i:s')
            ];
            
            $result = $supabase->insert('contact_messages', $data);
            
            if ($result) {
                $success = 'Thank you for contacting us! We will get back to you soon.';
                // Clear form
                $_POST = array();
            } else {
                $error = 'Failed to send message. Please try again.';
            }
        }
    } catch (Exception $e) {
        $error = 'An error occurred. Please try again later.';
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact Us - <?php echo INSTITUTE_NAME; ?></title>
    <meta name="description" content="Get in touch with <?php echo INSTITUTE_NAME; ?>. Contact information, office hours, and inquiry form.">
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
        
        .contact-section {
            padding: 80px 0;
        }
        
        .contact-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 50px;
            margin-bottom: 60px;
        }
        
        .contact-info-cards {
            display: grid;
            gap: 25px;
        }
        
        .info-card {
            background: white;
            padding: 30px;
            border-radius: 15px;
            box-shadow: var(--shadow-md);
            transition: all 0.3s ease;
            border-left: 4px solid var(--primary-color);
        }
        
        .info-card:hover {
            transform: translateY(-5px);
            box-shadow: var(--shadow-lg);
        }
        
        .info-card-icon {
            width: 60px;
            height: 60px;
            background: linear-gradient(135deg, var(--primary-color) 0%, #1e40af 100%);
            color: white;
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 28px;
            margin-bottom: 20px;
        }
        
        .info-card h3 {
            font-size: 20px;
            color: var(--primary-color);
            margin-bottom: 15px;
        }
        
        .info-card p {
            color: var(--text-dark);
            line-height: 1.8;
            font-size: 15px;
            margin-bottom: 8px;
        }
        
        .info-card a {
            color: var(--text-dark);
            text-decoration: none;
            transition: color 0.3s ease;
        }
        
        .info-card a:hover {
            color: var(--primary-color);
        }
        
        .contact-form-container {
            background: white;
            padding: 40px;
            border-radius: 15px;
            box-shadow: var(--shadow-lg);
        }
        
        .contact-form-container h2 {
            font-size: 28px;
            color: var(--primary-color);
            margin-bottom: 10px;
        }
        
        .contact-form-container .subtitle {
            color: var(--text-light);
            margin-bottom: 30px;
            font-size: 15px;
        }
        
        .form-group {
            margin-bottom: 25px;
        }
        
        .form-group label {
            display: block;
            margin-bottom: 8px;
            font-weight: 600;
            color: var(--text-dark);
            font-size: 14px;
        }
        
        .form-group label .required {
            color: var(--danger-color);
        }
        
        .form-control {
            width: 100%;
            padding: 14px 18px;
            border: 2px solid var(--border-color);
            border-radius: 10px;
            font-size: 15px;
            font-family: 'Poppins', sans-serif;
            transition: all 0.3s ease;
        }
        
        .form-control:focus {
            outline: none;
            border-color: var(--primary-color);
            box-shadow: 0 0 0 4px rgba(30, 58, 138, 0.1);
        }
        
        textarea.form-control {
            min-height: 150px;
            resize: vertical;
        }
        
        .btn-submit {
            background: linear-gradient(135deg, var(--accent-color) 0%, #ea580c 100%);
            color: white;
            padding: 15px 40px;
            border: none;
            border-radius: 25px;
            font-size: 16px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
            width: 100%;
        }
        
        .btn-submit:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 20px rgba(245, 158, 11, 0.3);
        }
        
        .success-message {
            background: linear-gradient(135deg, #d1fae5 0%, #a7f3d0 100%);
            color: #065f46;
            padding: 18px 25px;
            border-radius: 12px;
            margin-bottom: 25px;
            border-left: 4px solid #10b981;
            display: flex;
            align-items: center;
            gap: 12px;
            font-weight: 500;
        }
        
        .error-message {
            background: linear-gradient(135deg, #fee2e2 0%, #fecaca 100%);
            color: #991b1b;
            padding: 18px 25px;
            border-radius: 12px;
            margin-bottom: 25px;
            border-left: 4px solid #ef4444;
            display: flex;
            align-items: center;
            gap: 12px;
            font-weight: 500;
        }
        
        .map-section {
            background: white;
            padding: 40px;
            border-radius: 15px;
            box-shadow: var(--shadow-md);
            margin-bottom: 60px;
        }
        
        .map-section h2 {
            font-size: 28px;
            color: var(--primary-color);
            margin-bottom: 25px;
            text-align: center;
        }
        
        .map-container {
            border-radius: 12px;
            overflow: hidden;
            box-shadow: var(--shadow-md);
        }
        
        .map-container iframe {
            width: 100%;
            height: 450px;
            border: 0;
        }
        
        .office-hours {
            background: linear-gradient(135deg, var(--bg-light) 0%, #f3f4f6 100%);
            padding: 40px;
            border-radius: 15px;
            margin-bottom: 60px;
        }
        
        .office-hours h2 {
            font-size: 28px;
            color: var(--primary-color);
            margin-bottom: 30px;
            text-align: center;
        }
        
        .hours-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 20px;
        }
        
        .hours-card {
            background: white;
            padding: 25px;
            border-radius: 12px;
            text-align: center;
            box-shadow: var(--shadow-sm);
            transition: all 0.3s ease;
        }
        
        .hours-card:hover {
            transform: translateY(-3px);
            box-shadow: var(--shadow-md);
        }
        
        .hours-card h3 {
            color: var(--primary-color);
            margin-bottom: 15px;
            font-size: 18px;
        }
        
        .hours-card p {
            color: var(--text-dark);
            font-size: 16px;
            font-weight: 600;
        }
        
        .social-connect {
            background: linear-gradient(135deg, var(--primary-color) 0%, #1e40af 100%);
            color: white;
            padding: 50px;
            border-radius: 15px;
            text-align: center;
        }
        
        .social-connect h2 {
            font-size: 32px;
            margin-bottom: 15px;
        }
        
        .social-connect p {
            font-size: 16px;
            margin-bottom: 30px;
            opacity: 0.9;
        }
        
        .social-links-large {
            display: flex;
            justify-content: center;
            gap: 20px;
            flex-wrap: wrap;
        }
        
        .social-link {
            width: 60px;
            height: 60px;
            background: rgba(255, 255, 255, 0.2);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 28px;
            color: white;
            transition: all 0.3s ease;
            text-decoration: none;
        }
        
        .social-link:hover {
            background: white;
            color: var(--primary-color);
            transform: translateY(-5px);
        }
        
        @media (max-width: 768px) {
            .contact-grid {
                grid-template-columns: 1fr;
                gap: 40px;
            }
            
            .page-header h1 {
                font-size: 36px;
            }
            
            .contact-form-container {
                padding: 30px 20px;
            }
            
            .map-container iframe {
                height: 300px;
            }
        }
    </style>
</head>
<body>
    <!-- Include header/navigation from index.php or create a separate header.php -->
    <div class="page-header">
        <h1><i class="fas fa-envelope"></i> Contact Us</h1>
        <p>We'd love to hear from you!</p>
        <div class="breadcrumb">
            <a href="index.php"><i class="fas fa-home"></i> Home</a>
            <span>/</span>
            <span>Contact Us</span>
        </div>
    </div>
    
    <section class="contact-section">
        <div class="container">
            <div class="contact-grid">
                <!-- Contact Information -->
                <div class="contact-info-cards">
                    <div class="info-card">
                        <div class="info-card-icon">
                            <i class="fas fa-map-marker-alt"></i>
                        </div>
                        <h3>Visit Us</h3>
                        <p><?php echo INSTITUTE_ADDRESS; ?></p>
                        <p><?php echo INSTITUTE_CITY . ', ' . INSTITUTE_STATE; ?></p>
                        <p>PIN: <?php echo INSTITUTE_PINCODE; ?></p>
                    </div>
                    
                    <div class="info-card">
                        <div class="info-card-icon">
                            <i class="fas fa-phone-alt"></i>
                        </div>
                        <h3>Call Us</h3>
                        <p><a href="tel:<?php echo str_replace(['+', '-', ' '], '', INSTITUTE_PHONE); ?>"><?php echo INSTITUTE_PHONE; ?></a></p>
                        <p><a href="tel:+919876543210">+91-9876543210</a> (Admission)</p>
                        <p><a href="tel:+919876543211">+91-9876543211</a> (Examination)</p>
                    </div>
                    
                    <div class="info-card">
                        <div class="info-card-icon">
                            <i class="fas fa-envelope"></i>
                        </div>
                        <h3>Email Us</h3>
                        <p><a href="mailto:<?php echo INSTITUTE_EMAIL; ?>"><?php echo INSTITUTE_EMAIL; ?></a></p>
                        <p><a href="mailto:admissions@excellenceinstitute.edu">admissions@excellenceinstitute.edu</a></p>
                        <p><a href="mailto:principal@excellenceinstitute.edu">principal@excellenceinstitute.edu</a></p>
                    </div>
                </div>
                
                <!-- Contact Form -->
                <div class="contact-form-container">
                    <h2>Send us a Message</h2>
                    <p class="subtitle">Fill out the form below and we'll get back to you as soon as possible.</p>
                    
                    <?php if ($success): ?>
                    <div class="success-message">
                        <i class="fas fa-check-circle"></i>
                        <span><?php echo $success; ?></span>
                    </div>
                    <?php endif; ?>
                    
                    <?php if ($error): ?>
                    <div class="error-message">
                        <i class="fas fa-exclamation-circle"></i>
                        <span><?php echo $error; ?></span>
                    </div>
                    <?php endif; ?>
                    
                    <form method="POST" action="">
                        <div class="form-group">
                            <label>Full Name <span class="required">*</span></label>
                            <input type="text" 
                                   name="name" 
                                   class="form-control" 
                                   placeholder="Enter your full name"
                                   value="<?php echo isset($_POST['name']) ? htmlspecialchars($_POST['name']) : ''; ?>"
                                   required>
                        </div>
                        
                        <div class="form-group">
                            <label>Email Address <span class="required">*</span></label>
                            <input type="email" 
                                   name="email" 
                                   class="form-control" 
                                   placeholder="your.email@example.com"
                                   value="<?php echo isset($_POST['email']) ? htmlspecialchars($_POST['email']) : ''; ?>"
                                   required>
                        </div>
                        
                        <div class="form-group">
                            <label>Phone Number</label>
                            <input type="tel" 
                                   name="phone" 
                                   class="form-control" 
                                   placeholder="Enter your phone number"
                                   value="<?php echo isset($_POST['phone']) ? htmlspecialchars($_POST['phone']) : ''; ?>">
                        </div>
                        
                        <div class="form-group">
                            <label>Subject</label>
                            <input type="text" 
                                   name="subject" 
                                   class="form-control" 
                                   placeholder="What is this regarding?"
                                   value="<?php echo isset($_POST['subject']) ? htmlspecialchars($_POST['subject']) : ''; ?>">
                        </div>
                        
                        <div class="form-group">
                            <label>Message <span class="required">*</span></label>
                            <textarea name="message" 
                                      class="form-control" 
                                      placeholder="Write your message here..."
                                      required><?php echo isset($_POST['message']) ? htmlspecialchars($_POST['message']) : ''; ?></textarea>
                        </div>
                        
                        <button type="submit" class="btn-submit">
                            <i class="fas fa-paper-plane"></i> Send Message
                        </button>
                    </form>
                </div>
            </div>
            
            <!-- Office Hours -->
            <div class="office-hours">
                <h2><i class="fas fa-clock"></i> Office Hours</h2>
                <div class="hours-grid">
                    <div class="hours-card">
                        <h3>General Office</h3>
                        <p>Monday - Friday</p>
                        <p>9:00 AM - 5:00 PM</p>
                    </div>
                    <div class="hours-card">
                        <h3>Saturday</h3>
                        <p>9:00 AM - 2:00 PM</p>
                        <p>Limited Services</p>
                    </div>
                    <div class="hours-card">
                        <h3>Library</h3>
                        <p>Monday - Saturday</p>
                        <p>8:00 AM - 6:00 PM</p>
                    </div>
                    <div class="hours-card">
                        <h3>Sunday & Holidays</h3>
                        <p>Closed</p>
                        <p>Emergency: <?php echo INSTITUTE_PHONE; ?></p>
                    </div>
                </div>
            </div>
            
            <!-- Map -->
            <div class="map-section">
                <h2><i class="fas fa-map-marked-alt"></i> Our Location</h2>
                <div class="map-container">
                    <!-- Replace with your actual location coordinates -->
                    <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3153.0197127854843!2d-122.41941568468147!3d37.77492997975903!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0x0!2zMzfCsDQ2JzI5LjciTiAxMjLCsDI1JzA0LjEiVw!5e0!3m2!1sen!2sus!4v1234567890123!5m2!1sen!2sus" 
                            allowfullscreen="" 
                            loading="lazy" 
                            referrerpolicy="no-referrer-when-downgrade"></iframe>
                </div>
            </div>
            
            <!-- Social Media Connect -->
            <div class="social-connect">
                <h2><i class="fas fa-share-alt"></i> Connect With Us</h2>
                <p>Follow us on social media for latest updates and announcements</p>
                <div class="social-links-large">
                    <a href="<?php echo FACEBOOK_URL; ?>" class="social-link" target="_blank" title="Facebook">
                        <i class="fab fa-facebook-f"></i>
                    </a>
                    <a href="<?php echo TWITTER_URL; ?>" class="social-link" target="_blank" title="Twitter">
                        <i class="fab fa-twitter"></i>
                    </a>
                    <a href="<?php echo INSTAGRAM_URL; ?>" class="social-link" target="_blank" title="Instagram">
                        <i class="fab fa-instagram"></i>
                    </a>
                    <a href="<?php echo YOUTUBE_URL; ?>" class="social-link" target="_blank" title="YouTube">
                        <i class="fab fa-youtube"></i>
                    </a>
                    <a href="<?php echo LINKEDIN_URL; ?>" class="social-link" target="_blank" title="LinkedIn">
                        <i class="fab fa-linkedin-in"></i>
                    </a>
                </div>
            </div>
        </div>
    </section>
    
    <!-- Footer -->
    <footer class="main-footer">
        <div class="container">
            <div class="footer-bottom">
                <p>&copy; 2025 <?php echo INSTITUTE_SHORT_NAME; ?>. All Rights Reserved.</p>
            </div>
        </div>
    </footer>
    
    <script src="assets/js/main.js"></script>
</body>
</html>
