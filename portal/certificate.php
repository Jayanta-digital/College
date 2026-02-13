<?php
session_start();
require_once '../config/database.php';
require_once '../includes/functions.php';

$certificate_found = false;
$certificate_data = null;
$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $certificate_number = sanitize($_POST['certificate_number']);
    $roll_number = sanitize($_POST['roll_number']);
    
    if (empty($certificate_number) || empty($roll_number)) {
        $error = 'Please enter both certificate number and roll number';
    } else {
        // Demo certificate verification
        // In production, query the database
        $certificate_data = [
            'certificate_number' => $certificate_number,
            'student_name' => 'John Doe',
            'roll_number' => $roll_number,
            'course' => 'Bachelor of Science (Computer Science)',
            'duration' => '2022-2025',
            'cgpa' => '8.5',
            'grade' => 'First Class with Distinction',
            'issue_date' => '2025-06-15',
            'certificate_type' => 'Provisional Certificate'
        ];
        $certificate_found = true;
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Certificate Verification - Excellence Institute</title>
    <link rel="stylesheet" href="../assets/css/style.css">
    <link rel="stylesheet" href="../assets/css/responsive.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        body {
            background: var(--bg-light);
        }
        
        .page-header {
            background: linear-gradient(135deg, var(--primary-color) 0%, #1e40af 100%);
            color: white;
            padding: 60px 0;
            text-align: center;
        }
        
        .page-header h1 {
            font-size: 36px;
            margin-bottom: 10px;
        }
        
        .certificate-container {
            max-width: 900px;
            margin: -50px auto 50px;
            background: white;
            border-radius: 20px;
            box-shadow: var(--shadow-xl);
            padding: 50px;
        }
        
        .verification-box {
            background: var(--bg-light);
            padding: 30px;
            border-radius: 15px;
            margin-bottom: 30px;
        }
        
        .verification-box h2 {
            font-size: 22px;
            color: var(--primary-color);
            margin-bottom: 20px;
            text-align: center;
        }
        
        .form-group {
            margin-bottom: 20px;
        }
        
        .form-group label {
            display: block;
            margin-bottom: 8px;
            font-weight: 600;
            color: var(--text-dark);
        }
        
        .form-control {
            width: 100%;
            padding: 12px 15px;
            border: 2px solid var(--border-color);
            border-radius: 8px;
            font-size: 15px;
            transition: all 0.3s ease;
        }
        
        .form-control:focus {
            outline: none;
            border-color: var(--primary-color);
            box-shadow: 0 0 0 3px rgba(30, 58, 138, 0.1);
        }
        
        .btn-verify {
            background: linear-gradient(135deg, var(--accent-color) 0%, #ea580c 100%);
            color: white;
            padding: 12px 40px;
            border: none;
            border-radius: 25px;
            font-size: 16px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
            width: 100%;
        }
        
        .btn-verify:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 20px rgba(245, 158, 11, 0.3);
        }
        
        .error-message {
            background: #fee2e2;
            color: #991b1b;
            padding: 15px 20px;
            border-radius: 8px;
            margin-bottom: 25px;
            border-left: 4px solid #ef4444;
        }
        
        .certificate-card {
            border: 3px solid var(--primary-color);
            border-radius: 15px;
            padding: 40px;
            background: linear-gradient(135deg, #f9fafb 0%, #ffffff 100%);
            position: relative;
            overflow: hidden;
        }
        
        .certificate-card::before {
            content: '';
            position: absolute;
            top: -50%;
            right: -50%;
            width: 200%;
            height: 200%;
            background: radial-gradient(circle, rgba(30, 58, 138, 0.05) 0%, transparent 70%);
            pointer-events: none;
        }
        
        .certificate-header {
            text-align: center;
            margin-bottom: 30px;
            border-bottom: 2px solid var(--accent-color);
            padding-bottom: 20px;
        }
        
        .certificate-header img {
            width: 80px;
            height: 80px;
            margin-bottom: 15px;
        }
        
        .certificate-header h2 {
            color: var(--primary-color);
            font-size: 26px;
            margin-bottom: 5px;
        }
        
        .certificate-header p {
            color: var(--text-light);
            font-size: 14px;
        }
        
        .certificate-body {
            margin: 30px 0;
        }
        
        .cert-info-grid {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 20px;
            margin: 25px 0;
        }
        
        .cert-info-item {
            padding: 15px;
            background: white;
            border-radius: 8px;
            border-left: 4px solid var(--accent-color);
        }
        
        .cert-label {
            font-size: 13px;
            color: var(--text-light);
            margin-bottom: 5px;
        }
        
        .cert-value {
            font-size: 16px;
            font-weight: 600;
            color: var(--text-dark);
        }
        
        .certificate-statement {
            text-align: center;
            font-size: 16px;
            color: var(--text-dark);
            padding: 20px;
            background: rgba(30, 58, 138, 0.05);
            border-radius: 10px;
            margin: 25px 0;
        }
        
        .certificate-footer {
            display: flex;
            justify-content: space-between;
            margin-top: 40px;
            padding-top: 30px;
            border-top: 2px solid var(--border-color);
        }
        
        .signature-box {
            text-align: center;
        }
        
        .signature-line {
            width: 150px;
            height: 2px;
            background: var(--text-dark);
            margin: 40px auto 10px;
        }
        
        .signature-label {
            font-size: 13px;
            color: var(--text-light);
        }
        
        .verification-badge {
            display: inline-block;
            background: var(--success-color);
            color: white;
            padding: 8px 20px;
            border-radius: 20px;
            font-size: 14px;
            font-weight: 600;
            margin-top: 20px;
        }
        
        .certificate-actions {
            display: flex;
            gap: 15px;
            justify-content: center;
            margin-top: 30px;
        }
        
        .btn-download,
        .btn-print {
            padding: 12px 30px;
            border: none;
            border-radius: 8px;
            font-size: 15px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
        }
        
        .btn-download {
            background: var(--success-color);
            color: white;
        }
        
        .btn-print {
            background: var(--primary-color);
            color: white;
        }
        
        .btn-download:hover,
        .btn-print:hover {
            transform: translateY(-2px);
            box-shadow: var(--shadow-md);
        }
        
        .info-section {
            background: #fef3c7;
            border-left: 4px solid #f59e0b;
            padding: 20px;
            border-radius: 8px;
            margin-bottom: 30px;
        }
        
        .info-section h3 {
            color: #92400e;
            margin-bottom: 10px;
            font-size: 18px;
        }
        
        .info-section ul {
            margin-left: 20px;
            color: #78350f;
        }
        
        .info-section ul li {
            margin-bottom: 8px;
        }
        
        @media print {
            body * {
                visibility: hidden;
            }
            .certificate-card,
            .certificate-card * {
                visibility: visible;
            }
            .certificate-card {
                position: absolute;
                left: 0;
                top: 0;
                width: 100%;
            }
            .certificate-actions,
            .page-header,
            .verification-box,
            .info-section {
                display: none !important;
            }
        }
    </style>
</head>
<body>
    <div class="page-header">
        <h1><i class="fas fa-certificate"></i> Certificate Verification</h1>
        <p>Verify the authenticity of certificates issued by Excellence Institute</p>
    </div>
    
    <div class="container">
        <div class="certificate-container">
            <?php if (!$certificate_found): ?>
            
            <div class="info-section">
                <h3><i class="fas fa-info-circle"></i> How to Verify Certificate</h3>
                <ul>
                    <li>Enter your Certificate Number (printed on the certificate)</li>
                    <li>Enter your Roll Number</li>
                    <li>Click "Verify Certificate" button</li>
                    <li>If valid, your certificate details will be displayed</li>
                </ul>
            </div>
            
            <div class="verification-box">
                <h2><i class="fas fa-search"></i> Verify Your Certificate</h2>
                
                <?php if ($error): ?>
                <div class="error-message">
                    <i class="fas fa-exclamation-circle"></i> <?php echo $error; ?>
                </div>
                <?php endif; ?>
                
                <form method="POST" action="">
                    <div class="form-group">
                        <label for="certificate_number">
                            Certificate Number <span style="color: var(--danger-color);">*</span>
                        </label>
                        <input type="text" 
                               id="certificate_number" 
                               name="certificate_number" 
                               class="form-control" 
                               placeholder="e.g., CERT/2025/0001"
                               value="<?php echo isset($_POST['certificate_number']) ? htmlspecialchars($_POST['certificate_number']) : ''; ?>"
                               required>
                    </div>
                    
                    <div class="form-group">
                        <label for="roll_number">
                            Roll Number <span style="color: var(--danger-color);">*</span>
                        </label>
                        <input type="text" 
                               id="roll_number" 
                               name="roll_number" 
                               class="form-control" 
                               placeholder="e.g., 2025001"
                               value="<?php echo isset($_POST['roll_number']) ? htmlspecialchars($_POST['roll_number']) : ''; ?>"
                               required>
                    </div>
                    
                    <button type="submit" class="btn-verify">
                        <i class="fas fa-check-circle"></i> Verify Certificate
                    </button>
                </form>
            </div>
            
            <?php else: ?>
            
            <!-- Certificate Display -->
            <div class="certificate-card">
                <div class="certificate-header">
                    <img src="../assets/images/logo.png" alt="Institute Logo">
                    <h2>EXCELLENCE INSTITUTE</h2>
                    <p>Established 1972 | NAAC Accredited A++ Grade</p>
                    <p style="font-size: 12px;">Affiliated to State University | Recognized by UGC</p>
                </div>
                
                <div class="certificate-body">
                    <h3 style="text-align: center; color: var(--accent-color); font-size: 24px; margin-bottom: 20px;">
                        <?php echo htmlspecialchars($certificate_data['certificate_type']); ?>
                    </h3>
                    
                    <div class="certificate-statement">
                        This is to certify that <strong style="color: var(--primary-color); font-size: 18px;">
                        <?php echo htmlspecialchars($certificate_data['student_name']); ?></strong> 
                        has successfully completed the course of study and passed the examination for the degree of 
                        <strong><?php echo htmlspecialchars($certificate_data['course']); ?></strong>
                    </div>
                    
                    <div class="cert-info-grid">
                        <div class="cert-info-item">
                            <div class="cert-label">Roll Number</div>
                            <div class="cert-value"><?php echo htmlspecialchars($certificate_data['roll_number']); ?></div>
                        </div>
                        
                        <div class="cert-info-item">
                            <div class="cert-label">Certificate Number</div>
                            <div class="cert-value"><?php echo htmlspecialchars($certificate_data['certificate_number']); ?></div>
                        </div>
                        
                        <div class="cert-info-item">
                            <div class="cert-label">Duration</div>
                            <div class="cert-value"><?php echo htmlspecialchars($certificate_data['duration']); ?></div>
                        </div>
                        
                        <div class="cert-info-item">
                            <div class="cert-label">CGPA</div>
                            <div class="cert-value"><?php echo htmlspecialchars($certificate_data['cgpa']); ?></div>
                        </div>
                        
                        <div class="cert-info-item">
                            <div class="cert-label">Grade</div>
                            <div class="cert-value"><?php echo htmlspecialchars($certificate_data['grade']); ?></div>
                        </div>
                        
                        <div class="cert-info-item">
                            <div class="cert-label">Issue Date</div>
                            <div class="cert-value"><?php echo date('d M Y', strtotime($certificate_data['issue_date'])); ?></div>
                        </div>
                    </div>
                </div>
                
                <div class="certificate-footer">
                    <div class="signature-box">
                        <div class="signature-line"></div>
                        <div class="signature-label">Controller of Examinations</div>
                    </div>
                    
                    <div class="signature-box">
                        <div class="signature-line"></div>
                        <div class="signature-label">Principal</div>
                    </div>
                </div>
                
                <div style="text-align: center;">
                    <span class="verification-badge">
                        <i class="fas fa-shield-alt"></i> VERIFIED CERTIFICATE
                    </span>
                </div>
            </div>
            
            <div class="certificate-actions">
                <button onclick="window.print()" class="btn-print">
                    <i class="fas fa-print"></i> Print Certificate
                </button>
                <button onclick="downloadCertificate()" class="btn-download">
                    <i class="fas fa-download"></i> Download PDF
                </button>
            </div>
            
            <div style="text-align: center; margin-top: 30px;">
                <a href="certificate.php" class="btn-secondary">
                    <i class="fas fa-search"></i> Verify Another Certificate
                </a>
            </div>
            
            <?php endif; ?>
            
            <div style="text-align: center; margin-top: 30px;">
                <a href="../index.php" style="color: var(--primary-color); text-decoration: none;">
                    <i class="fas fa-arrow-left"></i> Back to Home
                </a>
            </div>
        </div>
    </div>
    
    <br><br>
    
    <script>
        function downloadCertificate() {
            // In production, this would generate and download a PDF
            alert('Certificate download feature will be implemented with PDF generation library.');
            // You can use libraries like jsPDF or generate PDF on server side
        }
    </script>
</body>
</html>
