<?php
session_start();
require_once 'config/database.php';
require_once 'includes/functions.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Examination Results - Excellence Institute</title>
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="stylesheet" href="assets/css/responsive.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
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
        
        .breadcrumb {
            display: flex;
            justify-content: center;
            gap: 10px;
            font-size: 14px;
            opacity: 0.9;
        }
        
        .breadcrumb a {
            color: white;
        }
        
        .results-container {
            max-width: 800px;
            margin: -50px auto 50px;
            background: white;
            border-radius: 20px;
            box-shadow: var(--shadow-xl);
            padding: 50px;
        }
        
        .search-box {
            background: var(--bg-light);
            padding: 30px;
            border-radius: 15px;
            margin-bottom: 30px;
        }
        
        .search-box h2 {
            font-size: 22px;
            color: var(--primary-color);
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
        
        .btn-search {
            background: linear-gradient(135deg, var(--primary-color) 0%, #1e40af 100%);
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
        
        .btn-search:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 20px rgba(30, 58, 138, 0.3);
        }
        
        .result-card {
            background: white;
            border: 2px solid var(--border-color);
            border-radius: 15px;
            padding: 30px;
            margin-top: 30px;
        }
        
        .result-header {
            text-align: center;
            padding-bottom: 20px;
            border-bottom: 2px solid var(--border-color);
            margin-bottom: 25px;
        }
        
        .result-header h3 {
            color: var(--primary-color);
            font-size: 24px;
            margin-bottom: 10px;
        }
        
        .result-info {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 15px;
            margin-bottom: 25px;
        }
        
        .info-item {
            padding: 12px;
            background: var(--bg-light);
            border-radius: 8px;
        }
        
        .info-label {
            font-size: 13px;
            color: var(--text-light);
            margin-bottom: 3px;
        }
        
        .info-value {
            font-size: 16px;
            font-weight: 600;
            color: var(--text-dark);
        }
        
        .marks-table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 25px;
        }
        
        .marks-table th,
        .marks-table td {
            padding: 12px;
            text-align: left;
            border-bottom: 1px solid var(--border-color);
        }
        
        .marks-table th {
            background: var(--bg-light);
            font-weight: 600;
            color: var(--primary-color);
        }
        
        .result-summary {
            background: var(--bg-light);
            padding: 20px;
            border-radius: 10px;
            text-align: center;
        }
        
        .summary-item {
            display: inline-block;
            margin: 0 20px;
        }
        
        .summary-label {
            font-size: 13px;
            color: var(--text-light);
        }
        
        .summary-value {
            font-size: 24px;
            font-weight: 700;
            color: var(--primary-color);
        }
        
        .btn-download {
            background: var(--success-color);
            color: white;
            padding: 10px 30px;
            border: none;
            border-radius: 8px;
            font-weight: 600;
            cursor: pointer;
            margin-top: 20px;
        }
    </style>
</head>
<body>
    <div class="page-header">
        <h1><i class="fas fa-poll"></i> Examination Results</h1>
        <div class="breadcrumb">
            <a href="index.php">Home</a> <span>/</span> <span>Results</span>
        </div>
    </div>
    
    <div class="container">
        <div class="results-container">
            <div class="search-box">
                <h2><i class="fas fa-search"></i> Search Your Result</h2>
                <form id="resultForm" method="POST" action="">
                    <div class="form-group">
                        <label>Roll Number</label>
                        <input type="text" name="roll_number" class="form-control" placeholder="Enter your roll number" required>
                    </div>
                    
                    <div class="form-group">
                        <label>Examination</label>
                        <select name="examination" class="form-control" required>
                            <option value="">Select Examination</option>
                            <option value="semester1">Semester 1</option>
                            <option value="semester2">Semester 2</option>
                            <option value="semester3">Semester 3</option>
                            <option value="semester4">Semester 4</option>
                            <option value="semester5">Semester 5</option>
                            <option value="semester6">Semester 6</option>
                            <option value="annual">Annual Examination</option>
                        </select>
                    </div>
                    
                    <button type="submit" class="btn-search">
                        <i class="fas fa-search"></i> Search Result
                    </button>
                </form>
            </div>
            
            <?php if ($_SERVER['REQUEST_METHOD'] === 'POST'): ?>
            <!-- Demo Result Display -->
            <div class="result-card">
                <div class="result-header">
                    <h3>Excellence Institute of Higher Education</h3>
                    <p>Semester Examination Result - 2025</p>
                </div>
                
                <div class="result-info">
                    <div class="info-item">
                        <div class="info-label">Student Name</div>
                        <div class="info-value">John Doe</div>
                    </div>
                    <div class="info-item">
                        <div class="info-label">Roll Number</div>
                        <div class="info-value"><?php echo htmlspecialchars($_POST['roll_number']); ?></div>
                    </div>
                    <div class="info-item">
                        <div class="info-label">Course</div>
                        <div class="info-value">BSc Computer Science</div>
                    </div>
                    <div class="info-item">
                        <div class="info-label">Examination</div>
                        <div class="info-value"><?php echo htmlspecialchars($_POST['examination']); ?></div>
                    </div>
                </div>
                
                <table class="marks-table">
                    <thead>
                        <tr>
                            <th>Subject</th>
                            <th>Max Marks</th>
                            <th>Obtained</th>
                            <th>Grade</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>Mathematics</td>
                            <td>100</td>
                            <td>85</td>
                            <td>A</td>
                        </tr>
                        <tr>
                            <td>Physics</td>
                            <td>100</td>
                            <td>78</td>
                            <td>B+</td>
                        </tr>
                        <tr>
                            <td>Chemistry</td>
                            <td>100</td>
                            <td>92</td>
                            <td>A+</td>
                        </tr>
                        <tr>
                            <td>Computer Science</td>
                            <td>100</td>
                            <td>88</td>
                            <td>A</td>
                        </tr>
                        <tr>
                            <td>English</td>
                            <td>100</td>
                            <td>75</td>
                            <td>B+</td>
                        </tr>
                    </tbody>
                </table>
                
                <div class="result-summary">
                    <div class="summary-item">
                        <div class="summary-label">Total Marks</div>
                        <div class="summary-value">500</div>
                    </div>
                    <div class="summary-item">
                        <div class="summary-label">Obtained Marks</div>
                        <div class="summary-value">418</div>
                    </div>
                    <div class="summary-item">
                        <div class="summary-label">Percentage</div>
                        <div class="summary-value">83.6%</div>
                    </div>
                    <div class="summary-item">
                        <div class="summary-label">Result</div>
                        <div class="summary-value" style="color: var(--success-color);">PASS</div>
                    </div>
                </div>
                
                <div style="text-align: center;">
                    <button class="btn-download" onclick="window.print()">
                        <i class="fas fa-download"></i> Download Result
                    </button>
                </div>
            </div>
            <?php endif; ?>
        </div>
    </div>
    
    <br><br>
    
    <?php include 'includes/footer.php'; ?>
</body>
</html>
