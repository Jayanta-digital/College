<?php
session_start();
require_once '../config/database.php';

$success = '';
$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    try {
        // Collect form data
        $data = [
            'full_name' => sanitize($_POST['full_name']),
            'father_name' => sanitize($_POST['father_name']),
            'mother_name' => sanitize($_POST['mother_name']),
            'date_of_birth' => $_POST['dob'],
            'gender' => $_POST['gender'],
            'category' => $_POST['category'],
            'email' => sanitize($_POST['email']),
            'phone' => sanitize($_POST['phone']),
            'address' => sanitize($_POST['address']),
            'city' => sanitize($_POST['city']),
            'state' => sanitize($_POST['state']),
            'pincode' => sanitize($_POST['pincode']),
            'course' => $_POST['course'],
            'previous_school' => sanitize($_POST['previous_school']),
            'previous_percentage' => floatval($_POST['previous_percentage']),
            'application_date' => date('Y-m-d'),
            'status' => 'Pending'
        ];
        
        // Insert into database
        $result = $supabase->insert('admissions', $data);
        
        if ($result) {
            $success = 'Application submitted successfully! You will receive a confirmation email shortly.';
            $_POST = array(); // Clear form
        } else {
            $error = 'Failed to submit application. Please try again.';
        }
    } catch (Exception $e) {
        $error = 'An error occurred: ' . $e->getMessage();
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Online Admission Form</title>
    <link rel="stylesheet" href="../assets/css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        .admission-header {
            background: linear-gradient(135deg, var(--primary-color) 0%, #1e40af 100%);
            color: white;
            padding: 60px 0;
            text-align: center;
        }
        
        .admission-header h1 {
            font-size: 36px;
            margin-bottom: 10px;
        }
        
        .admission-form-container {
            max-width: 900px;
            margin: -50px auto 50px;
            background: white;
            border-radius: 20px;
            box-shadow: var(--shadow-xl);
            padding: 50px;
        }
        
        .form-section {
            margin-bottom: 40px;
        }
        
        .section-title {
            font-size: 22px;
            color: var(--primary-color);
            margin-bottom: 25px;
            padding-bottom: 10px;
            border-bottom: 2px solid var(--accent-color);
        }
        
        .form-row {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 20px;
            margin-bottom: 20px;
        }
        
        .form-group {
            margin-bottom: 20px;
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
            padding: 12px 15px;
            border: 2px solid var(--border-color);
            border-radius: 8px;
            font-size: 15px;
            font-family: inherit;
            transition: all 0.3s ease;
        }
        
        .form-control:focus {
            outline: none;
            border-color: var(--primary-color);
            box-shadow: 0 0 0 3px rgba(30, 58, 138, 0.1);
        }
        
        select.form-control {
            cursor: pointer;
        }
        
        .success-message {
            background: #d1fae5;
            color: #065f46;
            padding: 15px 20px;
            border-radius: 8px;
            margin-bottom: 25px;
            border-left: 4px solid #10b981;
        }
        
        .error-message {
            background: #fee2e2;
            color: #991b1b;
            padding: 15px 20px;
            border-radius: 8px;
            margin-bottom: 25px;
            border-left: 4px solid #ef4444;
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
        }
        
        .btn-submit:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 20px rgba(245, 158, 11, 0.3);
        }
        
        .btn-reset {
            background: var(--border-color);
            color: var(--text-dark);
            padding: 15px 40px;
            border: none;
            border-radius: 25px;
            font-size: 16px;
            font-weight: 600;
            cursor: pointer;
            margin-left: 15px;
        }
        
        .form-footer {
            text-align: center;
            margin-top: 30px;
            padding-top: 30px;
            border-top: 1px solid var(--border-color);
        }
        
        .back-link {
            display: inline-block;
            margin-top: 15px;
            color: var(--primary-color);
        }
    </style>
</head>
<body>
    <div class="admission-header">
        <h1><i class="fas fa-graduation-cap"></i> Online Admission Form</h1>
        <p>Academic Year 2025-26</p>
    </div>
    
    <div class="container">
        <div class="admission-form-container">
            <?php if ($success): ?>
            <div class="success-message">
                <i class="fas fa-check-circle"></i> <?php echo $success; ?>
            </div>
            <?php endif; ?>
            
            <?php if ($error): ?>
            <div class="error-message">
                <i class="fas fa-exclamation-circle"></i> <?php echo $error; ?>
            </div>
            <?php endif; ?>
            
            <form method="POST" action="" enctype="multipart/form-data">
                <!-- Personal Information -->
                <div class="form-section">
                    <h2 class="section-title">
                        <i class="fas fa-user"></i> Personal Information
                    </h2>
                    
                    <div class="form-row">
                        <div class="form-group">
                            <label>Full Name <span class="required">*</span></label>
                            <input type="text" name="full_name" class="form-control" required>
                        </div>
                        
                        <div class="form-group">
                            <label>Father's Name <span class="required">*</span></label>
                            <input type="text" name="father_name" class="form-control" required>
                        </div>
                    </div>
                    
                    <div class="form-row">
                        <div class="form-group">
                            <label>Mother's Name <span class="required">*</span></label>
                            <input type="text" name="mother_name" class="form-control" required>
                        </div>
                        
                        <div class="form-group">
                            <label>Date of Birth <span class="required">*</span></label>
                            <input type="date" name="dob" class="form-control" required>
                        </div>
                    </div>
                    
                    <div class="form-row">
                        <div class="form-group">
                            <label>Gender <span class="required">*</span></label>
                            <select name="gender" class="form-control" required>
                                <option value="">Select Gender</option>
                                <option value="Male">Male</option>
                                <option value="Female">Female</option>
                                <option value="Other">Other</option>
                            </select>
                        </div>
                        
                        <div class="form-group">
                            <label>Category <span class="required">*</span></label>
                            <select name="category" class="form-control" required>
                                <option value="">Select Category</option>
                                <option value="General">General</option>
                                <option value="OBC">OBC</option>
                                <option value="SC">SC</option>
                                <option value="ST">ST</option>
                            </select>
                        </div>
                    </div>
                </div>
                
                <!-- Contact Information -->
                <div class="form-section">
                    <h2 class="section-title">
                        <i class="fas fa-address-book"></i> Contact Information
                    </h2>
                    
                    <div class="form-row">
                        <div class="form-group">
                            <label>Email Address <span class="required">*</span></label>
                            <input type="email" name="email" class="form-control" required>
                        </div>
                        
                        <div class="form-group">
                            <label>Phone Number <span class="required">*</span></label>
                            <input type="tel" name="phone" class="form-control" pattern="[0-9]{10}" required>
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <label>Address <span class="required">*</span></label>
                        <textarea name="address" class="form-control" rows="3" required></textarea>
                    </div>
                    
                    <div class="form-row">
                        <div class="form-group">
                            <label>City <span class="required">*</span></label>
                            <input type="text" name="city" class="form-control" required>
                        </div>
                        
                        <div class="form-group">
                            <label>State <span class="required">*</span></label>
                            <input type="text" name="state" class="form-control" required>
                        </div>
                        
                        <div class="form-group">
                            <label>PIN Code <span class="required">*</span></label>
                            <input type="text" name="pincode" class="form-control" pattern="[0-9]{6}" required>
                        </div>
                    </div>
                </div>
                
                <!-- Academic Information -->
                <div class="form-section">
                    <h2 class="section-title">
                        <i class="fas fa-book"></i> Academic Information
                    </h2>
                    
                    <div class="form-row">
                        <div class="form-group">
                            <label>Course Applied For <span class="required">*</span></label>
                            <select name="course" class="form-control" required>
                                <option value="">Select Course</option>
                                <option value="BA">Bachelor of Arts (BA)</option>
                                <option value="BSc">Bachelor of Science (BSc)</option>
                                <option value="BCom">Bachelor of Commerce (BCom)</option>
                                <option value="BBA">Bachelor of Business Administration (BBA)</option>
                                <option value="BCA">Bachelor of Computer Applications (BCA)</option>
                                <option value="MA">Master of Arts (MA)</option>
                                <option value="MSc">Master of Science (MSc)</option>
                                <option value="MCom">Master of Commerce (MCom)</option>
                            </select>
                        </div>
                        
                        <div class="form-group">
                            <label>Previous School/College <span class="required">*</span></label>
                            <input type="text" name="previous_school" class="form-control" required>
                        </div>
                    </div>
                    
                    <div class="form-row">
                        <div class="form-group">
                            <label>Previous Percentage/CGPA <span class="required">*</span></label>
                            <input type="number" name="previous_percentage" class="form-control" step="0.01" min="0" max="100" required>
                        </div>
                        
                        <div class="form-group">
                            <label>Upload Photo</label>
                            <input type="file" name="photo" class="form-control" accept="image/*">
                        </div>
                    </div>
                </div>
                
                <div class="form-footer">
                    <button type="submit" class="btn-submit">
                        <i class="fas fa-paper-plane"></i> Submit Application
                    </button>
                    <button type="reset" class="btn-reset">
                        <i class="fas fa-redo"></i> Reset Form
                    </button>
                    
                    <br>
                    <a href="../index.php" class="back-link">
                        <i class="fas fa-arrow-left"></i> Back to Home
                    </a>
                </div>
            </form>
        </div>
    </div>
    
    <br><br>
</body>
</html>
