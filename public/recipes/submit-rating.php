<?php

require_once('../../private/initialize.php');

$user = $session->get_user();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $recipeId = $_POST['recipe_id'] ?? null;
    $rating = $_POST['rating'] ?? null;
    $userId = (int) $user->id;

    if ($recipeId && is_numeric($recipeId) && is_numeric($rating) && $rating >= 1 && $rating <= 5) {
        
        $existingRating = Rating::find_by_user_and_recipe($userId, $recipeId);

        if ($existingRating) {
            $existingRating->rating = $rating;

            if ($existingRating->save()) {
              echo "Rating updated successfully.";
            } else {
              echo "Error updating rating.";
            }
        } else {
            $newRating = new Rating([
                'user_id' => $userId, 
                'recipe_id' => (int) $recipeId,
                'rating' => (int) $rating
            ]);

            if ($newRating->save()) {
                echo "Rating saved successfully.";
            } else {
                echo "Error saving rating.";
            }
        }
    } else {
        echo "Invalid data. Please check your inputs.";
    }
} else {
  echo "No data submitted.";
}
