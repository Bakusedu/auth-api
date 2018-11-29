<?php
// Helper function

// Redirect to specified page
function redirectTo($page) {
  header("Location: " . $page);
  exit;
}
