<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ChatGPT Chatbot</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            display: flex;
            flex-direction: column;
            align-items: center;
            background-color: #f4f4f9;
        }
        .container {
            width: 80%;
            max-width: 600px;
            margin-top: 50px;
            padding: 20px;
            background: white;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
        }
        textarea {
            width: 100%;
            padding: 10px;
            margin: 10px 0;
            font-size: 16px;
            border: 1px solid #ccc;
            border-radius: 4px;
            resize: none;
        }
        button {
            padding: 10px 15px;
            background-color: #007BFF;
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 16px;
        }
        button:hover {
            background-color: #0056b3;
        }
        .response {
            margin-top: 20px;
            padding: 10px;
            background: #f9f9f9;
            border: 1px solid #ccc;
            border-radius: 4px;
            font-size: 16px;
        }
        .error {
            color: red;
        }
    </style>
</head>
<?php include 'sidebar_student.php'; ?>

<body>
    <div class="container">
        <h1>ChatGPT Assistant</h1>
        <form method="POST">
            <label for="user-input">Enter your message:</label>
            <textarea id="user-input" name="user_input" rows="4" placeholder="Type your question or message here..." required></textarea>
            <button type="submit">Send</button>
        </form>

        <?php
        // Your Google API Key
        $apiKey = getenv('AIzaSyCgZmvvYYe06Aia3LMQkKq4ubwDAv55-sM'); // Use environment variable for security

        // Gemini API Endpoint
        $endpoint = "https://generativelanguage.googleapis.com/v1beta/models/gemini-1.5-flash-latest:generateText";

        // Check if the form is submitted
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Get user input
            $userInput = htmlspecialchars($_POST['user_input'], ENT_QUOTES, 'UTF-8');

            // Request Payload
            $data = [
                "prompt" => ["text" => $userInput],
                "parameters" => [
                    "temperature" => 0.7, // Adjust for creativity
                    "maxOutputTokens" => 100 // Number of words in the response
                ]
            ];

            // cURL Initialization
            $ch = curl_init($endpoint);

            // Convert payload to JSON
            $jsonData = json_encode($data);

            // Set cURL options
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_POST, true);
            curl_setopt($ch, CURLOPT_HTTPHEADER, [
                "Content-Type: application/json",
                "Authorization: Bearer $apiKey"
            ]);
            curl_setopt($ch, CURLOPT_POSTFIELDS, $jsonData);

            // Execute the request
            $response = curl_exec($ch);

            // Handle cURL errors
            if (curl_errno($ch)) {
                echo "<div class='response error'>cURL Error: " . curl_error($ch) . "</div>";
            } else {
                // Decode the JSON response
                $responseData = json_decode($response, true);

                // Display the API response
                if (isset($responseData['candidates'][0]['output'])) {
                    $output = htmlspecialchars($responseData['candidates'][0]['output'], ENT_QUOTES, 'UTF-8');
                    echo "<div class='response'><strong>API Response:</strong><pre>$output</pre></div>";
                } else {
                    echo "<div class='response error'>Unexpected API Response: " . htmlspecialchars($response, ENT_QUOTES, 'UTF-8') . "</div>";
                }
            }

            // Close cURL
            curl_close($ch);
        }
        ?>

    </div>
</body>
</html>
