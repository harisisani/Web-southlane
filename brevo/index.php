<?php
// 
# ------------------
# Create a campaign
# ------------------

# Include the Brevo library
require_once(__DIR__ . "./vendor/autoload.php");

use Sendinblue\Client\Api\EmailCampaignsApi;
use Sendinblue\Client\Configuration;
use Sendinblue\Client\Model\CreateEmailCampaign;

# Set your Sendinblue API key
Configuration::getDefaultConfiguration()->setApiKey("api-key", "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");

# Instantiate the client
$api_instance = new EmailCampaignsApi();

# Create a new email campaign object
$emailCampaigns = new CreateEmailCampaign();

# Define the campaign settings
$emailCampaigns['name'] = "Campaign sent via the API";
$emailCampaigns['subject'] = "My subject";
$emailCampaigns['sender'] = array("name" => "From name", "email" => "no-reply@southlaneanimalhospital.com");
$emailCampaigns['type'] = "classic";

# Content that will be sent
$emailCampaigns['htmlContent'] = "Congratulations! You successfully sent this example campaign via the Brevo API.";

$createEmailCampaign->setRecipients([
    'listIds' => [2, 7], // Replace with your list IDs
    'emails' => ['haris.isani@gmail.com', 'haris.isani@clientpoint.net'], // Add email addresses directly
]);

# Make the call to the client
try {
    $result = $api_instance->createEmailCampaign($emailCampaigns);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling EmailCampaignsApi->createEmailCampaign: ', $e->getMessage(), PHP_EOL;
}
?>
