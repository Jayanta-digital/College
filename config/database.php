<?php
/**
 * Database Configuration using Supabase
 * 
 * Replace these credentials with your actual Supabase project details:
 * 1. Go to https://supabase.com
 * 2. Create a new project
 * 3. Get your project URL and anon key from Settings > API
 * 4. Update the credentials below
 */

// Supabase Configuration
define('SUPABASE_URL', 'https://fqpeckoatooxypzunnyi.supabase.co');
define('SUPABASE_KEY', 'eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJpc3MiOiJzdXBhYmFzZSIsInJlZiI6ImZxcGVja29hdG9veHlwenVubnlpIiwicm9sZSI6ImFub24iLCJpYXQiOjE3NzA5NjIyNTMsImV4cCI6MjA4NjUzODI1M30.0XrJSmZayJ3lz3edToffyYqZjoe2yyfCzToPBDRdjb8);

// Database Connection using PDO (PostgreSQL)
// Supabase uses PostgreSQL, get connection details from Settings > Database
define('DB_HOST', 'db.fqpeckoatooxypzunnyi.supabase.co');
define('DB_PORT', '5432');
define('DB_NAME', 'postgres');
define('DB_USER', 'postgres');
define('DB_PASS', 'Kumar212@212');

// Create PDO connection
try {
    $dsn = "pgsql:host=" . DB_HOST . ";port=" . DB_PORT . ";dbname=" . DB_NAME;
    $pdo = new PDO($dsn, DB_USER, DB_PASS, [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        PDO::ATTR_EMULATE_PREPARES => false,
    ]);
} catch (PDOException $e) {
    die("Database connection failed: " . $e->getMessage());
}

// Supabase REST API Helper Class
class SupabaseClient {
    private $url;
    private $key;
    
    public function __construct() {
        $this->url = SUPABASE_URL;
        $this->key = SUPABASE_KEY;
    }
    
    /**
     * Query data from Supabase
     * @param string $table - Table name
     * @param array $filters - WHERE conditions
     * @param string $select - Columns to select
     * @param array $options - Additional options (order, limit, offset)
     * @return array
     */
    public function select($table, $filters = [], $select = '*', $options = []) {
        $url = $this->url . '/rest/v1/' . $table . '?select=' . $select;
        
        // Add filters
        foreach ($filters as $key => $value) {
            $url .= '&' . $key . '=eq.' . urlencode($value);
        }
        
        // Add ordering
        if (isset($options['order'])) {
            $url .= '&order=' . $options['order'];
        }
        
        // Add limit
        if (isset($options['limit'])) {
            $url .= '&limit=' . $options['limit'];
        }
        
        // Add offset
        if (isset($options['offset'])) {
            $url .= '&offset=' . $options['offset'];
        }
        
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, [
            'apikey: ' . $this->key,
            'Authorization: Bearer ' . $this->key,
            'Content-Type: application/json'
        ]);
        
        $response = curl_exec($ch);
        curl_close($ch);
        
        return json_decode($response, true);
    }
    
    /**
     * Insert data into Supabase
     * @param string $table - Table name
     * @param array $data - Data to insert
     * @return array
     */
    public function insert($table, $data) {
        $url = $this->url . '/rest/v1/' . $table;
        
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
        curl_setopt($ch, CURLOPT_HTTPHEADER, [
            'apikey: ' . $this->key,
            'Authorization: Bearer ' . $this->key,
            'Content-Type: application/json',
            'Prefer: return=representation'
        ]);
        
        $response = curl_exec($ch);
        curl_close($ch);
        
        return json_decode($response, true);
    }
    
    /**
     * Update data in Supabase
     * @param string $table - Table name
     * @param array $filters - WHERE conditions
     * @param array $data - Data to update
     * @return array
     */
    public function update($table, $filters, $data) {
        $url = $this->url . '/rest/v1/' . $table;
        
        // Add filters
        $filterQuery = [];
        foreach ($filters as $key => $value) {
            $filterQuery[] = $key . '=eq.' . urlencode($value);
        }
        $url .= '?' . implode('&', $filterQuery);
        
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'PATCH');
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
        curl_setopt($ch, CURLOPT_HTTPHEADER, [
            'apikey: ' . $this->key,
            'Authorization: Bearer ' . $this->key,
            'Content-Type: application/json',
            'Prefer: return=representation'
        ]);
        
        $response = curl_exec($ch);
        curl_close($ch);
        
        return json_decode($response, true);
    }
    
    /**
     * Delete data from Supabase
     * @param string $table - Table name
     * @param array $filters - WHERE conditions
     * @return bool
     */
    public function delete($table, $filters) {
        $url = $this->url . '/rest/v1/' . $table;
        
        // Add filters
        $filterQuery = [];
        foreach ($filters as $key => $value) {
            $filterQuery[] = $key . '=eq.' . urlencode($value);
        }
        $url .= '?' . implode('&', $filterQuery);
        
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'DELETE');
        curl_setopt($ch, CURLOPT_HTTPHEADER, [
            'apikey: ' . $this->key,
            'Authorization: Bearer ' . $this->key,
            'Content-Type: application/json'
        ]);
        
        $response = curl_exec($ch);
        curl_close($ch);
        
        return true;
    }
    
    /**
     * Upload file to Supabase Storage
     * @param string $bucket - Bucket name
     * @param string $path - File path in bucket
     * @param string $file - Local file path
     * @return array
     */
    public function uploadFile($bucket, $path, $file) {
        $url = $this->url . '/storage/v1/object/' . $bucket . '/' . $path;
        
        $fileContent = file_get_contents($file);
        $mimeType = mime_content_type($file);
        
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $fileContent);
        curl_setopt($ch, CURLOPT_HTTPHEADER, [
            'apikey: ' . $this->key,
            'Authorization: Bearer ' . $this->key,
            'Content-Type: ' . $mimeType
        ]);
        
        $response = curl_exec($ch);
        curl_close($ch);
        
        return json_decode($response, true);
    }
    
    /**
     * Get public URL for uploaded file
     * @param string $bucket - Bucket name
     * @param string $path - File path in bucket
     * @return string
     */
    public function getPublicUrl($bucket, $path) {
        return $this->url . '/storage/v1/object/public/' . $bucket . '/' . $path;
    }
}

// Initialize Supabase Client
$supabase = new SupabaseClient();

// Helper function to sanitize input
function sanitize($data) {
    return htmlspecialchars(strip_tags(trim($data)));
}

// Helper function to validate email
function validateEmail($email) {
    return filter_var($email, FILTER_VALIDATE_EMAIL);
}

// Helper function to generate random string
function generateRandomString($length = 10) {
    return bin2hex(random_bytes($length / 2));
}
?>
